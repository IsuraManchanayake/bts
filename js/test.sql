
/*important queries */
select 
	id, regnumber, routeid, ftn, ttn, duration 
	from busjourney, 
		(
			select 
			id, townname as ftn, ttn 
			from location 
			right outer join 
				(
					select 
					busjourneyid as id, 
					fromtown, 
					townname as ttn 
					from busjourney 
					left outer join 
					location 
						on busjourney.totown = location.townid
				) as c 
			on  location.townid = c.fromtown
		) 
	as d 
	where d.id = busjourney.busjourneyid;

+------+-----------+---------+-------------+-------------+----------+
| id   | regnumber | routeid | ftn         | ttn         | duration |
+------+-----------+---------+-------------+-------------+----------+
| 4001 | NA-0001   |       6 | Pettah      | Kurunegala  | 03:00:00 |
| 4002 | NA-0001   |       6 | Pettah      | Polgahawela | 02:00:00 |
| 4003 | NA-0002   |       6 | Polgahawela | Kurunegala  | 01:00:00 |
| 4004 | NA-0002   |       6 | Warakapola  | Kurunegala  | 01:30:00 |
| 4005 | NA-0004   |     100 | Pettah      | Panadura    | 01:30:00 |
| 4007 | NA-0006   |     100 | Pettah      | Katubedda   | 01:00:00 |
| 4008 | NA-0007   |     100 | Pettah      | Wellawate   | 00:40:00 |
| 4010 | NA-0009   |     255 | Mt. Lavinia | Kottawa     | 01:30:00 |
| 4011 | NA-0009   |     255 | Kottawa     | Piliyandala | 00:45:00 |
+------+-----------+---------+-------------+-------------+----------+

drop function if exists get_To_TownID;
DELIMITER $$
create function get_To_TownID (busJourney_ID varchar(10),fromTownID varchar(5))  RETURNS varchar(5)
BEGIN
DECLARE ToTownID varchar(5) DEFAULT '';
IF (exists (select BusJourneyID from BusJourney where BusJourneyID=busJourney_ID and FromTown=fromTownID))then
	select ToTown into ToTownID from BusJourney where BusJourneyID=busJourney_ID;
ELSE
select FromTown into ToTownID from BusJourney where BusJourneyID=busJourney_ID;
end IF;
RETURN ToTownID;
end$$
DELIMITER ;


-- drop function if exists distance_between_towns;
-- DELIMITER $$
-- create function distance_between_towns(fromtown varchar(5), totown varchar(5), origin varchar(5), ending varchar(5), routeid int(5)) RETURNS int(3)
-- BEGIN
-- declare fdistance int(3);
-- declare tdistance int(3);
-- declare odistance int(3);
-- declare edistance int(3);
-- set fdistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = fromtown);
-- set tdistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = totown);
-- set odistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = origin);
-- set edistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = ending);
-- if (fdistance >= 0
-- 	and
-- 	tdistance >= 0
-- 	and
-- 	odistance >= 0
-- 	and
-- 	edistance >= 0
-- 	and 
-- 	(fdistance >= odistance
-- 	and
-- 	tdistance >= fdistance
-- 	and
-- 	edistance >= tdistance)
-- 	or
-- 	(fdistance <= odistance
-- 	and
-- 	tdistance <= fdistance
-- 	and
-- 	edistance <= tdistance)
-- 	) then
-- 	return abs(fdistance - tdistance);
-- else
-- 	return null;
-- end if;
-- END$$
-- DELIMITER ;


create view BookingSchedule2 as 
select distinct(s.scheduleID),b.RegNumber,b.PhoneNumber,b.NoSeat,b.Type,b.wifi,b.haveCurtains,s.FromTime,s.FromInt,lf.TownName as FromTownName,s.FromTown as FromTownID,s.ToTime,s.ToInt,s.BusJourneyID,get_To_TownID(s.BusJourneyID,s.FromTown) as toTownID,(select tf.townName from Location tf  where toTownID=tf.TownID) as ToTownName,abs((select distance from RouteDestination r where j.RouteID=r.RouteID and r.TownID=toTownID)-(select distance from RouteDestination r where j.RouteID=r.RouteID and r.TownID=fromTownID)) as Distance  from PublicSchedule s,BusJourney j,Bus b,Location lf,Location tf where s.BusJourneyID=j.BusJourneyID and j.RegNumber=b.RegNumber and s.FromTown=lf.TownID order by 1;

drop view if exists journey_route;
create view journey_route as select busjourneyid, routeid from busjourney;

drop view if exists extended_schedule;
create view extended_schedule as (select * from bookingschedule natural join journey_route);

drop function if exists journey_duration;
DELIMITER $$
create function journey_duration(busjourneyid varchar(10), traveldistance int(3)) RETURNS bigint
BEGIN
	declare totaltime bigint;
	declare totaldistance int(3);
	declare startdistance int(3);
	declare enddistance int(3);
	declare route int(4);
	set totaltime = (select duration from BusJourney where BusJourney.busjourneyid = busjourneyid limit 1);
	set route = (select routeid from BusJourney where BusJourney.busjourneyid = busjourneyid limit 1);
	set startdistance = (select distance from routedestination, (select fromtown from BusJourney where BusJourney.busjourneyid = busjourneyid) as tt where tt.fromtown = routedestination.townid and routeid = routedestination.routeid limit 1);
	set enddistance = (select distance from routedestination, (select totown from BusJourney where BusJourney.busjourneyid = busjourneyid) as tt where tt.totown = routedestination.townid and route = routedestination.routeid limit 1);
	set totaldistance = abs(startdistance - enddistance);
	#return totaldistance / totaltime;
	return (cast(totaltime * traveldistance as decimal)/ cast(totaldistance as decimal));
END$$
DELIMITER ;


drop function if exists destination_distance;
DELIMITER $$
create function destination_distance(busjourneyid varchar(10), busstarttown varchar(5), destination varchar(5)) RETURNS int(3)
BEGIN
	declare totaltime bigint;
	declare route int(4);
	declare startdistance int(3);
	declare destinationdistance int(3);
	declare totaldistance int(3);
	set totaltime = (select duration from BusJourney where BusJourney.busjourneyid = busjourneyid);
	set route = (select routeid from BusJourney where BusJourney.busjourneyid = busjourneyid);
	set startdistance = (select distance from routedestination where routeid = route and townid = busstarttown);
	set destinationdistance = (select distance from routedestination where routeid = route and townid = destination);
	set totaldistance = abs(startdistance - destinationdistance);
	return totaldistance;
END $$
DELIMITER ;


drop view if exists searchSchedule;
create view searchSchedule
as
select
	*
	from
	(
		select
		busjourneyid, 
		scheduleid,
		regnumber,
		fromtime,
		fromtownname,
		totime,
		totownname,
		distance,
		routeid,
		noseat,
		type,
		wifi,
		haveCurtains,
		phonenumber,
		from_unixtime(fromint + journey_duration(busjourneyid, fd)) as ft, 
		from_unixtime(fromint + journey_duration(busjourneyid, td)) as tt,
		fd,
		td
		from 
		(
			select 
			*,
			destination_distance(busjourneyid, fromtownid, 2001) as fd,
			destination_distance(busjourneyid, fromtownid, 2005) as td 
			from extended_schedule
		) as dd
	where 
	td >= fd
	) as titable
	where abs(unix_timestamp(ft) - 1481871600) <= 3600
;
#====================================================================
create or replace view schedule_ext as 
	select
			scheduleid as id,
			busjourneyid as bjid,
			fromtown as ftown,
			fromtime as ft,
			totime as tt
		from schedule
		where valid = 1;

create or replace view busjourney_ext as
	select 
		* 
	from
		schedule_ext
	as st
	left outer join
	busjourney
	on
	busjourney.busjourneyid = st.bjid;

create or replace view searchSchedule
as
select
	id,
	bjid,
	ftown,
	get_To_TownID(bjid, ftown) as totown,
	ft,
	tt,
	routeid,
	duration,
	phonenumber,
	regnumber,
	NoSeat,
	type,
	wifi,
	haveCurtains
from
busjourney_ext as bjt
natural join
bus;

drop view if exists journey_route;
create view journey_route as select busjourneyid as bjid, routeid from busjourney;

drop view if exists extended_schedule;
create view extended_schedule as (select * from searchSchedule natural join journey_route);

select
	*
	from
	(
		select
			bjid, 
			id,
			regnumber,
			ft,
			ftown,
			tt,
			totown,
			routeid,
			noseat,
			type,
			wifi,
			haveCurtains,
			phonenumber,
			from_unixtime(ft + journey_duration(bjid, fd)) as ftt, 
			from_unixtime(ft + journey_duration(bjid, td)) as ttt,
			fd,
			abs(ft - 1481857200) as diff,
			from_unixtime(ft) as ft1, 
			from_unixtime(tt) as tt1,
			td
		from 
		(
			select 
				*,
				destination_distance(bjid, ftown, 2009) as fd,
				destination_distance(bjid, ftown, 2010) as td 
			from extended_schedule
		) as dd
	where td >= fd
	) as titable
	where diff <= 3600
	order by diff
;

