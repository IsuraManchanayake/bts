drop database bus;
create database bus;
use bus;
#plan to use mysql password encryption. It will go for a length around 250
create table BusOwner(
	ID varchar(5),
	Name varchar(100) not null,
	UserName varchar(100) unique not null,
	Password varchar(300) not null,
	Nic varchar(10) unique not null,
	Email varchar(100),
	PRIMARY KEY(ID)
);

create table CostPerKm (
    BusType varchar(15),
    CostPerKm Numeric(4,2) not null,
    Primary Key(BusType)
);

#Bus owner ID is produced by the application. It won't change. The row can be only deleted. Thus only 'on delete cascade'
create table Bus(
	RegNumber varchar(10),
	BusOwnerID varchar(5),
	phoneNumber int(10),
	NoSeat int(3),
	Type varchar(15),
	wifi bit not null default 0,
	haveCurtains bit default 0,
	password varchar(300) not null,
	PRIMARY KEY(RegNumber),
	FOREIGN KEY(BusOwnerID) REFERENCES BusOwner(ID)
	on delete cascade,
	FOREIGN KEY(Type) REFERENCES CostPerKm(BusType)
);
#RegNumber of the bus is a user insertion field. user can enter it wrongly. Thus he may need to change it later. Hence require both on update/delete cascade
#number is to have a order of photoes for a bus. A single bus may have none or more photoes.
create table Image(
	RegNumber varchar(10),
	ImagePath varchar(10) not null,
	PRIMARY KEY(RegNumber,ImagePath),
	FOREIGN KEY(RegNumber) REFERENCES Bus(RegNumber)
	on delete cascade
	on update cascade
);
create table Route(
	RouteID int(4),
	PRIMARY KEY(RouteID)
);
#Town name is the name we get from google.
create  table Location(
	TownID varchar(5),
	TownName varchar(200) not null,
	GMAPLink varchar(200),
	position varchar(25) unique,
	PRIMARY KEY(TownID)
);
# Distance is the distance to the town from the start of the route
#Town may get deleted. (Express halt change)
create table RouteDestination(
	RouteID int(5),
	TownID varchar(5),
	Distance int(3) not null,
	PRIMARY KEY(RouteID,TownID),
	FOREIGN KEY(RouteID) REFERENCES Route(RouteID)
	on delete cascade
	on update cascade,
	FOREIGN KEY(TownID) REFERENCES Location(TownID)
	on delete cascade
	on update cascade
);
#Duration is the total time taken for the journey
create table BusJourney(
	BusJourneyID varchar(10),
	RegNumber varchar(10) unique,
	RouteID int(5),
	FromTown varchar(5),
	ToTown varchar(5),
	Duration bigint not null,
	Valid bit default 1,
	PRIMARY KEY(BusJourneyID),
	FOREIGN KEY(RegNumber) REFERENCES Bus(RegNumber)
	on delete cascade
	on update cascade,
	FOREIGN KEY(RouteID) REFERENCES Route(RouteID),
	FOREIGN KEY(FromTown) REFERENCES Location(TownID),
	FOREIGN KEY(ToTown) REFERENCES Location(TownID)
);

create table Schedule(
	ScheduleID varchar(8),
	BusJourneyID varchar(6),
	FromTown varchar(5) not null,
	FromTime bigint not null,
	ToTime bigint,
	Valid bit default 1,
	PRIMARY KEY(ScheduleID),
	FOREIGN KEY(BusJourneyID) REFERENCES BusJourney(BusJourneyID),
	FOREIGN KEY(FromTown) REFERENCES Location(TownID)
);
create table Booking(
	TicketNo varchar(10),
	ScheduleID varchar(8),
	CustomerName varchar(150) not null,
	State varchar(10) not null default 'Valid',
	Nic varchar(10) not null,
	Email varchar(150) not null,
	Payment Numeric(7,2), 
	PaypalPayment varchar(200),
	FromTown varchar(5),
	ToTown varchar(5),
	PRIMARY KEY(TicketNo),
	FOREIGN KEY(ScheduleID) REFERENCES Schedule(ScheduleID),
	FOREIGN KEY(FromTown) REFERENCES Location(TownID),
	FOREIGN KEY(ToTown) REFERENCES Location(TownID)
);

create table BookingSeats(
	TicketNo varchar(10),
	SeatNumber int,
	PRIMARY KEY(TicketNo,SeatNumber),
	FOREIGN KEY(TicketNo) REFERENCES Booking(TicketNo)
);

create table Admin (
	AdminID varchar(4),
	Name varchar(100) unique not null,
	Password varchar(300) not null,
	Primary Key(AdminID)
);


create view publicBus 
	as 
	select RegNumber,phoneNumber,NoSeat,Type,wifi,haveCurtains from bus;


create view user as 
	select RegNumber as userName,password,'bus' as type from  bus union 
	select Name as userName,Password as password,'admin' as type from admin union 
	select UserName as userName,Password as password,'owner' as type from busOwner;


create view publicSchedule as 
     select ScheduleID, BusJourneyID, FromTown, (SELECT FROM_UNIXTIME(FromTime)) as FromTime,FromTime as FromInt,(SELECT FROM_UNIXTIME(ToTime)) as ToTime,ToTime as ToInt from  Schedule where Valid = b'1';

create view BookingSchedule as 
select distinct(s.scheduleID),b.RegNumber,j.RouteID,b.PhoneNumber,b.NoSeat,b.Type,b.wifi,b.haveCurtains,s.FromTime,s.FromInt,lf.TownName as FromTownName,s.FromTown as FromTownID,s.ToTime,s.ToInt,s.BusJourneyID,get_To_TownID(s.BusJourneyID,s.FromTown) as toTownID,(select tf.townName from Location tf  where toTownID=tf.TownID) as ToTownName,(select distance from RouteDestination r where j.RouteID=r.RouteID and r.TownID=toTownID) as ToDistance,(select distance from RouteDestination r where j.RouteID=r.RouteID and r.TownID=fromTownID) as FromDistance,(select duration from Busjourney bj where j.BusJourneyID=bj.BusJourneyID) as duration,abs((select ToDistance)-(select FromDistance)) as Distance from PublicSchedule s,BusJourney j,Bus b,Location lf,Location tf where s.BusJourneyID=j.BusJourneyID and j.RegNumber=b.RegNumber and s.FromTown=lf.TownID and j.valid = 1 order by 1;

drop function if exists get_nearest_schedule;
DELIMITER $$
create function get_nearest_schedule (regnum varchar(10),time bigint)  RETURNS varchar(8)
BEGIN
DECLARE Schedule_ID varchar(8) DEFAULT '';
select `ScheduleID` into Schedule_ID from (select abs(`FromTime`-30300),`ScheduleID` from `Schedule` WHERE `ScheduleID` in (select `ScheduleID` from `Schedule` where `BusJourneyID` in (select `BusJourneyID` from `Busjourney` where RegNumber=regnum)) order by 1 limit 1) b ;
RETURN Schedule_ID;
end$$
DELIMITER ;

drop function if exists get_NearestLocationForward;
DELIMITER $$
create function get_NearestLocationForward(Schedule_ID varchar(8),time bigInt)  RETURNS varchar(200)
BEGIN
DECLARE Distance_val INT(3);
DECLARE Duration_val bigint;
DECLARE FromTime_val bigint;
DECLARE RouteID_val INT(5);
DECLARE FromDistance_val bigint;
DECLARE position_val varchar(200);
DECLARE temp float;
DECLARE temp1 float;
Select FromInt,Duration,Distance,RouteID,FromDistance into FromTime_val,Duration_val,Distance_val,RouteID_val,FromDistance_val from BookingSchedule b where ScheduleID=Schedule_ID limit 1;
Select position,abs(Distance-(((time-FromTime_val)/Duration_val)*Distance_val+FromDistance_val)) into position_val,temp from RouteDestination r,Location l where r.TownID=l.TownID and RouteID=RouteID_val order by 2 limit 1;
RETURN position_val;
end$$
DELIMITER ;

drop function if exists get_NearestLocationBackword;
DELIMITER $$
create function get_NearestLocationBackword(Schedule_ID varchar(8),time bigInt)  RETURNS varchar(200)
BEGIN
DECLARE Distance_val INT(3);
DECLARE Duration_val bigint;
DECLARE FromTime_val bigint;
DECLARE RouteID_val INT(5);
DECLARE FromDistance_val bigint;
DECLARE position_val varchar(200);
DECLARE temp float;
DECLARE temp1 float;
Select FromInt,Duration,Distance,RouteID,FromDistance into FromTime_val,Duration_val,Distance_val,RouteID_val,FromDistance_val from BookingSchedule b where ScheduleID=Schedule_ID limit 1;
Select position,abs(Distance-(FromDistance_val-((time-FromTime_val)/Duration_val)*Distance_val)),(FromDistance_val-((time-FromTime_val)/Duration_val)*Distance_val) into position_val,temp,temp1 from RouteDestination r,Location l where r.TownID=l.TownID and RouteID=RouteID_val order by 2 limit 1;
RETURN position_val;
end$$
DELIMITER ;


drop function if exists get_NearestLocation;
DELIMITER $$
create function get_NearestLocation(regnum_val varchar(10),time bigInt)  RETURNS varchar(200)
BEGIN
DECLARE Schedule_ID varchar(10);
DECLARE FromDistance_val bigint;
DECLARE ToDistance_val bigint;
DECLARE position_val varchar(200);
Select * into Schedule_ID from (select get_nearest_schedule(regnum_val,time)) s;
Select FromDistance,ToDistance into FromDistance_val,ToDistance_val from bookingSchedule b where ScheduleID=Schedule_ID limit 1;
IF(FromDistance_val<ToDistance_val)Then
	Select * into position_val from (select get_NearestLocationForward(Schedule_ID,time)) k;
ELSE
	Select * into position_val from (select get_NearestLocationBackword(Schedule_ID,time)) p;
END IF;
RETURN position_val;
end$$
delimiter ;



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



delimiter //
drop trigger if exists BookingSeat_check1 //
create trigger BookingSeat_check1 before insert on BookingSeats 
	for each row
	begin
		if  (exists (select bo.TicketNo from Booking bo,BookingSeats bos where bo.TicketNo=bos.TicketNo and bos.SeatNumber=New.SeatNumber and bo.ScheduleID=((select ScheduleID from BookingSeats bs,Booking b where NEW.TicketNo=b.TicketNo limit 1)))) then
			signal sqlstate '45001' set message_text = 'Seats are already booked';
		end if;
	end //
delimiter ;


delimiter //
drop trigger if exists BookingSeat_check2 //
create trigger BookingSeat_check2 before update on BookingSeats 
	for each row
	begin
		if  (exists (select bo.TicketNo from Booking bo,BookingSeats bos where bo.TicketNo=bos.TicketNo and bos.SeatNumber=New.SeatNumber and bo.ScheduleID=((select ScheduleID from BookingSeats bs,Booking b where NEW.TicketNo=b.TicketNo limit 1)))) then
			signal sqlstate '45001' set message_text = 'Seats are already booked';
		end if;
	end //
delimiter ;

delimiter //
drop trigger if exists BusJourney_check1 //
create trigger BusJourney_check1 before insert on BusJourney 

	for each row
	begin
		if not (exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.FromTown = RouteDestination.TownID) and 
			exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.ToTown = RouteDestination.TownID)) then
			signal sqlstate '45001' set message_text = 'RouteID mismatch';
		end if;
	end //

delimiter ;

delimiter //
drop trigger if exists BusJourney_check2 //
create trigger BusJourney_check2 before update on BusJourney 

	for each row
	begin
		if not (exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.FromTown = RouteDestination.TownID) and 
			exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.ToTown = RouteDestination.TownID)) then
			signal sqlstate '45001' set message_text = 'RouteID mismatch';
		end if;
	end //

delimiter ;

delimiter //
drop trigger if exists BusOwner_check1 //
create trigger BusOwner_check1 before insert on BusOwner 

	for each row
	begin
		if ( 
			exists (select * from Admin where Admin.Name = new.UserName) or
			exists (select * from Bus where Bus.RegNumber = new.UserName)
			) then
		signal sqlstate '45000' set message_text = 'BusOwner: UserName not unique';
		end if;
	end //

delimiter ;

delimiter //
drop trigger if exists BusOwner_check2 //
create trigger BusOwner_check2 before update on BusOwner 

	for each row
	begin
		if ( 
			exists (select * from Admin where Admin.Name = new.UserName) or
			exists (select * from Bus where Bus.RegNumber = new.UserName)
			) then
		signal sqlstate '45000' set message_text = 'BusOwner: UserName not unique';
		end if;
	end //

delimiter ;

delimiter //
drop trigger if exists Admin_check1 //
create trigger Admin_check1 before insert on Admin 

	for each row
	begin
		if ( 
			exists (select * from BusOwner where BusOwner.UserName = new.Name) or
			exists (select * from Bus where Bus.RegNumber = new.Name)
			) then
		signal sqlstate '45000' set message_text = 'Admin: UserName not unique';
		end if;
	end //

delimiter ;

delimiter //
drop trigger if exists Admin_check2 //
create trigger Admin_check2 before update on Admin 

	for each row
	begin
		if ( 
			exists (select * from BusOwner where BusOwner.UserName = new.Name) or
			exists (select * from Bus where Bus.RegNumber = new.Name)
			) then
		signal sqlstate '45000' set message_text = 'Admin: UserName not unique';
		end if;
	end //

delimiter ;

delimiter //
drop trigger if exists Bus_check1 //
create trigger Bus_check1 before insert on Bus 

	for each row
	begin
		if ( 
			exists (select * from BusOwner where BusOwner.UserName = new.RegNumber) or
			exists (select * from Admin where Admin.Name = new.RegNumber)
			) then
		signal sqlstate '45000' set message_text = 'Bus: UserName not unique';
		end if;

		if (new.NoSeat != 53 and new.NoSeat != 48 and new.NoSeat != 26) then
			signal sqlstate '45003' set message_text = 'Bus: NoSeat not valid';
		end if;

		if (new.Type != 'Super-Luxury' and new.Type != 'Luxury' and new.Type != 'Semi-Luxury' and new.Type != 'Normal') then
			signal sqlstate '45004' set message_text = 'Bus: Type not valid';
		end if;

	end //

delimiter ;

delimiter //
drop trigger if exists Bus_check2 //
create trigger Bus_check2 before update on Bus 

	for each row
	begin
		if ( 
			exists (select * from BusOwner where BusOwner.UserName = new.RegNumber) or
			exists (select * from Admin where Admin.Name = new.RegNumber)
			) then
		signal sqlstate '45000' set message_text = 'Bus: UserName not unique';
		end if;

		if (new.NoSeat != 53 and new.NoSeat != 48 and new.NoSeat != 26) then
			signal sqlstate '45003' set message_text = 'Bus: NoSeat not valid';
		end if;

		if (new.Type != 'Super-Luxury' and new.Type != 'Luxury' and new.Type != 'Semi-Luxury' and new.Type != 'Normal') then
			signal sqlstate '45004' set message_text = 'Bus: Type not valid';
		end if;
		
	end //

delimiter ;



delimiter //
drop trigger if exists Schedule_check1 //
create trigger Schedule_check1 before insert on Schedule
 	for each row
 	begin
     	set new.ToTime = new.FromTime + (select Duration from BusJourney where BusJourney.BusJourneyID = new.BusJourneyID limit 1);
		if (exists
				(select * from Schedule where 
					((new.FromTime between Schedule.FromTime and Schedule.ToTime) or 
					(new.ToTime between Schedule.FromTime and Schedule.ToTime)) and 
					new.BusJourneyID = Schedule.BusJourneyID and Schedule.Valid = 1
				)
			) then
			signal sqlstate '45002' set message_text = 'Schedule: Overlapping schedules';
		end if;
  	end //
delimiter ;



delimiter //
drop trigger if exists Schedule_check2 //
create trigger Schedule_check2 before update on Schedule
 	for each row
 	begin
     	set new.ToTime = new.FromTime + (select Duration from BusJourney where BusJourney.BusJourneyID = new.BusJourneyID limit 1);
		if (exists
				(select * from Schedule where 
					((new.FromTime between Schedule.FromTime and Schedule.ToTime) or 
					(new.ToTime between Schedule.FromTime and Schedule.ToTime)) and 
					new.BusJourneyID = Schedule.BusJourneyID and Schedule.Valid = 1
				)
			and
				new.Valid = 1
			and 
				not exists (select * from schedule where schedule.scheduleid)
			) then
			signal sqlstate '45002' set message_text = 'Schedule: Overlapping schedules';
		end if;
  	end //
delimiter ;

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
END$$
DELIMITER ;

drop function if exists is_between;
DELIMITER $$
create function is_between(end1 varchar(5), end2 varchar(5), town varchar(5), route int(4)) RETURNS int(1)
BEGIN

	declare end1d int(3);
	declare end2d int(3);
	declare townd int(3);

	set end1d = (select distance from RouteDestination where routeid = route and townid = end1);
	set end2d = (select distance from RouteDestination where routeid = route and townid = end2);
	set townd = (select distance from RouteDestination where routeid = route and townid = town);

	if((end1d <= townd and townd <= end2d) or (end1d >= townd and townd >= end2d)) then
		return 1;
	else 
		return 0;
	end if;

END$$
DELIMITER ;

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
	NoSeat as maximumbookings,
	haveCurtains
from
busjourney_ext as bjt
natural join
bus;

create or replace view journey_route as select busjourneyid as bjid, routeid from busjourney;

create or replace view extended_schedule as (select * from searchSchedule natural join journey_route);


INSERT INTO `busowner` (`ID`, `Name`, `UserName`, `Password`, `Nic`, `Email`) VALUES
('1001', 'BusOwner1', 'BO1', password('123'), '1231231231', NULL),
('1002', 'BusOwner2', 'BO2', password('123'), '1231231232', NULL),
('1003', 'BusOwner3', 'BO3', password('123'), '1231231233', NULL),
('1004', 'BusOwner4', 'BO4', password('123'), '1231231234', NULL),
('1005', 'BusOwner5', 'BO5', password('123'), '1231231235', NULL),
('1006', 'BusOwner6', 'BO6', password('123'), '1231231236', NULL);

insert into CostPerKm values ('Super-Luxury','45'),
	 ('Luxury','35'),
	 ('Semi-Luxury','25'),
	 ('Normal','15');

INSERT INTO `bus` (`RegNumber`, `BusOwnerID`, `phoneNumber`, `NoSeat`, `Type`, `wifi`, `haveCurtains`, `password`) VALUES
('NA-0001', '1001', 77123123, 53, 'Semi-Luxury', b'0', b'0', password('123')),
('NA-0002', '1001', 77123123, 53, 'Semi-Luxury', b'1', b'0', password('123')),
('NA-0003', '1002', 77123124, 26, 'Normal', b'0', b'0', password('123')),
('NA-0004', '1005', 77123122, 53, 'Normal', b'0', b'0', password('123')),
('NA-0005', '1001', 77123111, 53, 'Normal', b'0', b'0', password('123')),
('NA-0006', '1001', 77123423, 48, 'Semi-Luxury', b'0', b'1', password('123')),
('NA-0007', '1003', 77123113, 53, 'Luxury', b'1', b'1', password('123')),
('NA-0008', '1003', 77123103, 53, 'Semi-Luxury', b'1', b'1', password('123')),
('NA-0009', '1004', 77133123, 48, 'Super-Luxury', b'1', b'1', password('123')),
('NA-0010', '1002', 77121123, 53, 'Luxury', b'0', b'0', password('123'));

INSERT INTO `location` (`TownID`, `TownName`, `GMAPLink`, `position`) VALUES
('2001', 'Pettah', 'Pettah+Bus+Stop', '6.934112, 79.850159'),
('2002', 'Kiribathgoda', 'Kiribathgoda Junction Bus Stop, Colombo-Kandy Hwy, Kiribathgoda', '6.977844, 79.926849'),
('2003', 'Nittabuwa', 'Nittabuwa Junction, A1, Nittabuwa', '7.143574, 80.095554'),
('2004', 'Warakapola', 'Warakapola, A1, Ambepussa','7.226103, 80.198753'),
('2005', 'Polgahawela', 'Polgahawela Bus Station, 06 Kurunegala Road, Polgahawela 037', '7.335225, 80.299858'),
('2006', 'Kurunegala', 'Kurunegala', '7.487121, 80.364970'),
('2007', 'Bambalapitiya', 'Unity Plaza Bus Stop, Galle Rd, Colombo', '6.893335, 79.855568'),
('2008', 'Wellawatte', 'Wellawatte Mosque Bus Stop, Galle Rd, Colombo', '7.097967, 79.846366'),
('2009', 'Mt. Lavinia', 'Mt. Lavinia Bus Stand, A2, Dehiwala-Mount Lavinia', '6.832668, 79.867303'),
('2010', 'Katubadda', 'Katubadda, Bandaranayake Mawatha, Moratuwa', '6.797471, 79.888536'),
('2011', 'Panadura', 'SLTB Bus Station, Panadura', '6.712196, 79.907509'),
('2012', 'Piliyandala', 'Piliyandala Bus Stand, Piliyandala', '6.801638, 79.922395'),
('2013', 'Kottawa', 'Kottawa Bus Station, Pannipitiya', '6.841214, 79.965180');

INSERT INTO `route` (`RouteID`) VALUES
(6),
(100),
(255);

INSERT INTO `routedestination` (`RouteID`, `TownID`, `Distance`) VALUES
(6, '2001', 0),
(6, '2002', 10),
(6, '2003', 20),
(6, '2004', 30),
(6, '2005', 40),
(6, '2006', 50),
(100, '2001', 0),
(100, '2007', 15),
(100, '2008', 30),
(100, '2009', 35),
(100, '2010', 45),
(100, '2011', 60),
(255, '2009', 0),
(255, '2010', 10),
(255, '2012', 40),
(255, '2013', 60);
B
INSERT INTO `busjourney` (`BusJourneyID`, `RegNumber`, `RouteID`, `FromTown`, `ToTown`, `Duration`) VALUES
('4001', 'NA-0001', 6, '2001', '2006', '10800'),
('4003', 'NA-0002', 6, '2005', '2006', '3600'),
('4005', 'NA-0004', 100, '2001', '2011', '5400'),
('4007', 'NA-0006', 100, '2001', '2010', '3600'),
('4008', 'NA-0007', 100, '2001', '2008', '2400'),
('4010', 'NA-0009', 255, '2009', '2013', '5400');

INSERT INTO `schedule` (`ScheduleID`, `BusJourneyID`, `FromTown`, `FromTime`, `ToTime`, `Valid`) VALUES
('6001', '4001', '2001', 1481842800, 1481853600, b'1'),
('6002', '4001', '2006', 1481857200, 1481868000, b'1'),
('6003', '4001', '2001', 1481871600, 1481882400, b'1'),
('6004', '4001', '2006', 1481886000, 1481896800, b'1'),
('6005', '4003', '2005', 1481857200, 1481860800, b'1'),
('6006', '4003', '2006', 1481864400, 1481868000, b'1'),
('6007', '4003', '2005', 1481871600, 1481875200, b'1'),
('6008', '4003', '2006', 1481878800, 1481882400, b'1'),
('6009', '4005', '2001', 1481857200, 1481862600, b'1'),
('6010', '4005', '2011', 1481866200, 1481871600, b'1'),
('6011', '4005', '2001', 1481882400, 1481887800, b'1'),
('6012', '4005', '2011', 1481893200, 1481898600, b'1'),
('6013', '4007', '2001', 1481841000, 1481844600, b'1'),
('6014', '4007', '2010', 1481848200, 1481851800, b'1'),
('6015', '4007', '2001', 1481859000, 1481862600, b'1'),
('6016', '4007', '2010', 1481866200, 1481869800, b'1'),
('6017', '4007', '2001', 1481873400, 1481877000, b'1'),
('6018', '4007', '2010', 1481880600, 1481884200, b'1'),
('6019', '4007', '2001', 1481887800, 1481891400, b'1'),
('6020', '4007', '2010', 1481895000, 1481898600, b'1'),
('6021', '4007', '2001', 1481902200, 1481905800, b'1'),
('6022', '4007', '2010', 1481909400, 1481913000, b'1'),
('6023', '4008', '2001', 1481851800, 1481854200, b'1'),
('6024', '4008', '2008', 1481859000, 1481861400, b'1'),
('6025', '4008', '2001', 1481866200, 1481868600, b'1'),
('6026', '4008', '2008', 1481873400, 1481875800, b'1'),
('6027', '4008', '2001', 1481880600, 1481883000, b'1'),
('6028', '4008', '2008', 1481887800, 1481890200, b'1'),
('6029', '4008', '2001', 1481895000, 1481897400, b'1'),
('6030', '4008', '2008', 1481902200, 1481904600, b'1'),
('6031', '4010', '2009', 1481855400, 1481860800, b'1'),
('6032', '4010', '2013', 1481862600, 1481868000, b'1'),
('6033', '4010', '2009', 1481869800, 1481875200, b'1'),
('6034', '4010', '2013', 1481877000, 1481882400, b'1'),
('6035', '4010', '2009', 1481884200, 1481889600, b'1'),
('6036', '4010', '2013', 1481891400, 1481896800, b'1'),
('6037', '4010', '2009', 1481898600, 1481904000, b'1'),
('6038', '4010', '2013', 1481905800, 1481911200, b'1');

insert into booking (ticketno, scheduleid, customername, state, nic, email, payment, paypalpayment) values 
('7001', '6001', 'isura01', 'Valid', '950304101V', 'isura01.dhaminda@gmail.com', '500.00', 'abc10001s'),
('7002', '6002', 'isura02', 'Valid', '950304102V', 'isura02.dhaminda@gmail.com', '501.00', 'abc10002s'),
('7003', '6002', 'isura03', 'Valid', '950304103V', 'isura03.dhaminda@gmail.com', '502.00', 'abc10003s'),
('7004', '6002', 'isura04', 'Valid', '950304104V', 'isura04.dhaminda@gmail.com', '503.00', 'abc10004s'),
('7005', '6002', 'isura05', 'Valid', '950304105V', 'isura05.dhaminda@gmail.com', '504.00', 'abc10005s'),
('7006', '6006', 'isura06', 'Valid', '950304106V', 'isura06.dhaminda@gmail.com', '505.00', 'abc10006s'),
('7007', '6007', 'isura07', 'Valid', '950304107V', 'isura07.dhaminda@gmail.com', '506.00', 'abc10007s'),
('7008', '6008', 'isura08', 'Valid', '950304108V', 'isura08.dhaminda@gmail.com', '507.00', 'abc10008s'),
('7009', '6003', 'isura09', 'Valid', '950304109V', 'isura09.dhaminda@gmail.com', '508.00', 'abc10009s'),
('7010', '6013', 'isura10', 'Valid', '950304110V', 'isura10.dhaminda@gmail.com', '509.00', 'abc10010s'),
('7011', '6013', 'isura11', 'Valid', '950304111V', 'isura11.dhaminda@gmail.com', '510.00', 'abc10011s'),
('7012', '6012', 'isura12', 'Valid', '950304112V', 'isura12.dhaminda@gmail.com', '511.00', 'abc10012s'),
('7013', '6013', 'isura13', 'Valid', '950304113V', 'isura13.dhaminda@gmail.com', '512.00', 'abc10013s'),
('7014', '6014', 'isura14', 'Valid', '950304114V', 'isura14.dhaminda@gmail.com', '513.00', 'abc10014s'),
('7015', '6015', 'isura15', 'Valid', '950304115V', 'isura15.dhaminda@gmail.com', '514.00', 'abc10015s'),
('7016', '6016', 'isura16', 'Valid', '950304116V', 'isura16.dhaminda@gmail.com', '515.00', 'abc10016s'),
('7017', '6017', 'isura17', 'Valid', '950304117V', 'isura17.dhaminda@gmail.com', '516.00', 'abc10017s'),
('7018', '6018', 'isura18', 'Valid', '950304118V', 'isura18.dhaminda@gmail.com', '517.00', 'abc10018s'),
('7019', '6019', 'isura19', 'Valid', '950304119V', 'isura19.dhaminda@gmail.com', '518.00', 'abc10019s');

delimiter //
drop trigger if exists Booking_check1 //
create trigger Booking_check1 before insert on Booking
 	for each row
 	begin

 		declare fromtime_val bigint;
 		select FromTime into fromtime_val from Schedule where Schedule.ScheduleID = new.ScheduleID;
 		if(fromtime_val < unix_timestamp(now())) then
 			signal sqlstate '45006' set message_text = 'Booking: time mismatch';
 		end if;
  	end //
delimiter ;

delimiter //
drop trigger if exists Booking_check2 //
create trigger Booking_check2 before update on Booking
 	for each row
 	begin

 		declare fromtime_val bigint;
 		select FromTime into fromtime_val from Schedule where Schedule.ScheduleID = new.ScheduleID;
 		if(fromtime_val < unix_timestamp(now())) then
 			signal sqlstate '45006' set message_text = 'Booking: time mismatch';
 		end if;
  	end //
delimiter ;

-- insert into bookingseats values
-- ('7001', '2'), 
-- ('7002', '1'), 
-- ('7003', '2'), 
-- ('7004', '3'), 
-- ('7005', '2'), 
-- ('7006', '2'), 
-- ('7007', '3'), 
-- ('7008', '1'), 
-- ('7009', '1'), 
-- ('7010', '1'), 
-- ('7011', '1'), 
-- ('7012', '1'), 
-- ('7013', '2'), 
-- ('7014', '3'), 
-- ('7015', '3'), 
-- ('7016', '3'), 
-- ('7017', '3'), 
-- ('7018', '3'), 
-- ('7019', '2');

insert into image values 
('NA-0001', 'b1.png'),
('NA-0002', 'b2.png'),
('NA-0003', 'b3.png'),
('NA-0004', 'b4.jpg'),
('NA-0005', 'b5.png'),
('NA-0006', 'b6.jpg'),
('NA-0007', 'b7.jpg'),
('NA-0008', 'b8.jpg'),
('NA-0009', 'b9.jpg'),
('NA-0010', 'b10.jpg'),
('NA-0001', 'b11.jpg'),
('NA-0002', 'b12.jpg'),
('NA-0003', 'b13.png'),
('NA-0004', 'b14.jpg'),
('NA-0005', 'b15.png');


insert into admin values
('9000', 'isura1', password('123')),
('9001', 'isura2', password('123')),
('9002', 'isura3', password('123')),
('9003', 'isura4', password('123')),
('9004', 'isura5', password('123')),
('9005', 'isura6', password('123')),
('9006', 'isura7', password('123'));