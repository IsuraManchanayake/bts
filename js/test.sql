
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

create view jr as select busjourneyid, routeid from busjourney;

create view manchi as (select * from bookingschedule natural join jr);

drop function if exists distance_between_towns;
DELIMITER $$
create function distance_between_towns(fromtown varchar(5), totown varchar(5), origin varchar(5), ending varchar(5), routeid int(5)) RETURNS int(3)
BEGIN
declare fdistance int(3);
declare tdistance int(3);
declare odistance int(3);
declare edistance int(3);
set fdistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = fromtown);
set tdistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = totown);
set odistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = origin);
set edistance = (select distance from routedestination where routedestination.routeid = routeid and routedestination.townid = ending);
if (fdistance >= 0
	and
	tdistance >= 0
	and
	odistance >= 0
	and
	edistance >= 0
	and 
	(fdistance >= odistance
	and
	tdistance >= fdistance
	and
	edistance >= tdistance)
	or
	(fdistance <= odistance
	and
	tdistance <= fdistance
	and
	edistance <= tdistance)
	) then
	return abs(fdistance - tdistance);
else
	return null;
end if;
END$$
DELIMITER ;

drop function if exists journey_duration;
DELIMITER $$
create function journey_duration(busjourneyid varchar(10), traveldistance int(3)) RETURNS bigint
BEGIN
	declare totaltime bigint;
	declare totaldistance int(3);
	declare startdistance int(3);
	declare enddistance int(3);
	declare route int(4);
	set totaltime = (select duration from BusJourney where BusJourney.busjourneyid = busjourneyid);
	set route = (select routeid from BusJourney where BusJourney.busjourneyid = busjourneyid);
	set startdistance = (select distance from routedestination, (select fromtown from BusJourney where BusJourney.busjourneyid = 4001) as tt where tt.fromtown = routedestination.townid and 6 = routedestination.routeid);
	set enddistance = (select distance from routedestination, (select totown from BusJourney where BusJourney.busjourneyid = busjourneyid) as tt where tt.totown = routedestination.townid and route = routedestination.routeid);
	set totaldistance = abs(startdistance - enddistance);
	return traveldistance * (totaltime / totaldistance);
END$$
DELIMITER ;

select f('4001', '10');

