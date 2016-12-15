drop database bus;
create database bus;
use bus;
#plan to use mysql password encryption. It will go for a length around 250
create table BusOwner(
	ID varchar(5),
	Name varchar(100),
	Password varchar(300),
	Nic varchar(10),
	PRIMARY KEY(ID)
);
#Bus owner ID is produced by the application. It won't change. The row can be only deleted. Thus only 'on delete cascade'
create table Bus(
	RegNumber varchar(10),
	ID varchar(5),
	phoneNumber int(10),
	NoSeat int(3),
	Type varchar(10),
	wifi tinyint,
	haveCurtains tinyint,
	password varchar(300),
	PRIMARY KEY(RegNumber),
	FOREIGN KEY(ID) REFERENCES BusOwner(ID)
	on delete cascade
);
#RegNumber of the bus is a user insertion field. user can enter it wrongly. Thus he may need to change it later. Hence require both on update/delete cascade
#number is to have a order of photoes for a bus. A single bus may have none or more photoes.
create table Photo(
	RegNumber varchar(10),
	Photo blob,
	number int(2),
	PRIMARY KEY(RegNumber,number),
	FOREIGN KEY(RegNumber) REFERENCES Bus(RegNumber)
	on delete cascade
	on update cascade
);
create table BusPhone(
	RegNumber varchar(10),
	Tel varchar(15),
	PRIMARY KEY(RegNumber,Tel),
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
	TownName varchar(200),
	PRIMARY KEY(TownID)
);
# Distance is the distance to the town from the start of the route
#Town may get deleted. (Express halt change)
create table RouteDestination(
	RouteID int(4),
	TownID varchar(5),
	Distance int(3),
	PRIMARY KEY(RouteID,TownID),
	FOREIGN KEY(RouteID) REFERENCES Route(RouteID)
	on delete cascade
	on update cascade,
	FOREIGN KEY(TownID) REFERENCES Location(TownID)
	on delete cascade
	on update cascade
);
#Duration is the total time taken for the journy
create table BusJourny(
	BusJournyID varchar(10),
	RegNumber varchar(6),
	RouteID int(4),
	FromTown varchar(5),
	ToTown varchar(5),
	Duration time,
	PRIMARY KEY(BusJournyID),
	FOREIGN KEY(RegNumber) REFERENCES Bus(RegNumber)
	on delete cascade
	on update cascade,
	FOREIGN KEY(RouteID) REFERENCES Route(RouteID),
	FOREIGN KEY(FromTown) REFERENCES Location(TownID),
	FOREIGN KEY(ToTown) REFERENCES Location(TownID)
);

create table Shedule(
	SheduleID varchar(8),
	BusJournyID varchar(6),
	StartTime time,
	PRIMARY KEY(SheduleID),
	FOREIGN KEY(BusJournyID) REFERENCES BusJourny(BusJournyID)
);
create table Booking(
	TicketNo varchar(10),
	SheduleID varchar(8),
	CustomerName varchar(150),
	State varchar(10),
	Nic varchar(10),
	Email varchar(150),
	Payment Numeric(4,2),
	PaypalPayment varchar(200),
	FromTown varchar(5),
	ToTown varchar(5),
	PRIMARY KEY(TicketNo),
	FOREIGN KEY(SheduleID) REFERENCES Shedule(SheduleID),
	FOREIGN KEY(FromTown) REFERENCES Location(TownID),
	FOREIGN KEY(ToTown) REFERENCES Location(TownID)
);

