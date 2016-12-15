-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2016 at 05:44 ප.ව.
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(4) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Password` varchar(300) NOT NULL,
  `CostPerKm` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `Admin_check1` BEFORE INSERT ON `admin` FOR EACH ROW begin
if ( 
exists (select * from BusOwner where BusOwner.UserName = new.Name) or
exists (select * from Bus where Bus.RegNumber = new.Name)
) then
signal sqlstate '45000' set message_text = 'Admin: UserName not unique';
end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Admin_check2` BEFORE UPDATE ON `admin` FOR EACH ROW begin
if ( 
exists (select * from BusOwner where BusOwner.UserName = new.Name) or
exists (select * from Bus where Bus.RegNumber = new.Name)
) then
signal sqlstate '45000' set message_text = 'Admin: UserName not unique';
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `TicketNo` varchar(10) NOT NULL,
  `ScheduleID` varchar(8) DEFAULT NULL,
  `CustomerName` varchar(150) NOT NULL,
  `State` varchar(10) NOT NULL,
  `Nic` varchar(10) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Payment` decimal(4,2) DEFAULT NULL,
  `PaypalPayment` varchar(200) DEFAULT NULL,
  `FromTown` varchar(5) DEFAULT NULL,
  `ToTown` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `RegNumber` varchar(10) NOT NULL,
  `BusOwnerID` varchar(5) DEFAULT NULL,
  `phoneNumber` int(10) DEFAULT NULL,
  `NoSeat` int(3) DEFAULT NULL,
  `Type` varchar(15) DEFAULT NULL,
  `wifi` bit(1) NOT NULL DEFAULT b'0',
  `haveCurtains` bit(1) DEFAULT b'0',
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`RegNumber`, `BusOwnerID`, `phoneNumber`, `NoSeat`, `Type`, `wifi`, `haveCurtains`, `password`) VALUES
('NA-0001', '1001', 77123123, 63, 'semi', b'0', b'0', '123'),
('NA-0002', '1001', 77123123, 63, 'semi', b'1', b'0', '123'),
('NA-0003', '1002', 77123124, 10, 'normal', b'0', b'0', '123'),
('NA-0004', '1005', 77123122, 63, 'normal', b'0', b'0', '123'),
('NA-0005', '1001', 77123111, 63, 'normal', b'0', b'0', '123'),
('NA-0006', '1001', 77123423, 50, 'semi', b'0', b'1', '123'),
('NA-0007', '1003', 77123113, 63, 'luxary', b'1', b'1', '123'),
('NA-0008', '1003', 77123103, 63, 'semi', b'1', b'1', '123'),
('NA-0009', '1004', 77133123, 50, 'super-lux', b'1', b'1', '123'),
('NA-0010', '1002', 77121123, 63, 'bol', b'0', b'0', '123');

--
-- Triggers `bus`
--
DELIMITER $$
CREATE TRIGGER `Bus_check1` BEFORE INSERT ON `bus` FOR EACH ROW begin
if ( 
exists (select * from BusOwner where BusOwner.UserName = new.RegNumber) or
exists (select * from Admin where Admin.Name = new.RegNumber)
) then
signal sqlstate '45000' set message_text = 'Bus: UserName not unique';
end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Bus_check2` BEFORE UPDATE ON `bus` FOR EACH ROW begin
if ( 
exists (select * from BusOwner where BusOwner.UserName = new.RegNumber) or
exists (select * from Admin where Admin.Name = new.RegNumber)
) then
signal sqlstate '45000' set message_text = 'Bus: UserName not unique';
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `busjourney`
--

CREATE TABLE `busjourney` (
  `BusJourneyID` varchar(10) NOT NULL,
  `RegNumber` varchar(10) DEFAULT NULL,
  `RouteID` int(5) DEFAULT NULL,
  `FromTown` varchar(5) DEFAULT NULL,
  `ToTown` varchar(5) DEFAULT NULL,
  `Duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `busjourney`
--

INSERT INTO `busjourney` (`BusJourneyID`, `RegNumber`, `RouteID`, `FromTown`, `ToTown`, `Duration`) VALUES
('3001', 'NA-0001', 6, '2001', '2006', '03:00:00'),
('3002', 'NA-0003', 6, '2001', '2004', '03:00:00'),
('3003', 'NA-0005', 6, '2001', '2003', '00:00:00');

--
-- Triggers `busjourney`
--
DELIMITER $$
CREATE TRIGGER `BusJourney_check1` BEFORE INSERT ON `busjourney` FOR EACH ROW begin
if not (exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.FromTown = RouteDestination.TownID) and 
exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.ToTown = RouteDestination.TownID)) then
signal sqlstate '45001' set message_text = 'RouteID mismatch';
end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BusJourney_check2` BEFORE UPDATE ON `busjourney` FOR EACH ROW begin
if not (exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.FromTown = RouteDestination.TownID) and 
exists (select * from RouteDestination where RouteDestination.RouteID = new.RouteID and new.ToTown = RouteDestination.TownID)) then
signal sqlstate '45001' set message_text = 'RouteID mismatch';
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `busowner`
--

CREATE TABLE `busowner` (
  `ID` varchar(5) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `Nic` varchar(10) NOT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `busowner`
--

INSERT INTO `busowner` (`ID`, `Name`, `UserName`, `Password`, `Nic`, `Email`) VALUES
('1001', 'BusOwner1', 'BO1', '123', '1231231231', NULL),
('1002', 'BusOwner2', 'BO2', '123', '1231231232', NULL),
('1003', 'BusOwner3', 'BO3', '123', '1231231233', NULL),
('1004', 'BusOwner4', 'BO4', '123', '1231231234', NULL),
('1005', 'BusOwner5', 'BO5', '123', '1231231235', NULL),
('1006', 'BusOwner6', 'BO6', '123', '1231231236', NULL);

--
-- Triggers `busowner`
--
DELIMITER $$
CREATE TRIGGER `BusOwner_check1` BEFORE INSERT ON `busowner` FOR EACH ROW begin
if ( 
exists (select * from Admin where Admin.Name = new.UserName) or
exists (select * from Bus where Bus.RegNumber = new.UserName)
) then
signal sqlstate '45000' set message_text = 'BusOwner: UserName not unique';
end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BusOwner_check2` BEFORE UPDATE ON `busowner` FOR EACH ROW begin
if ( 
exists (select * from Admin where Admin.Name = new.UserName) or
exists (select * from Bus where Bus.RegNumber = new.UserName)
) then
signal sqlstate '45000' set message_text = 'BusOwner: UserName not unique';
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `RegNumber` varchar(10) NOT NULL,
  `ImagePath` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `TownID` varchar(5) NOT NULL,
  `TownName` varchar(200) NOT NULL,
  `GMAPLink` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`TownID`, `TownName`, `GMAPLink`) VALUES
('2001', 'Pettah', 'Pettah+Bus+Stop'),
('2002', 'Kiribathgoda', 'Kiribathgoda Junction Bus Stop, Colombo-Kandy Hwy, Kiribathgoda'),
('2003', 'Nittabuwa', 'Nittabuwa Junction, A1, Nittabuwa'),
('2004', 'Warakapola', 'Warakapola, A1, Ambepussa'),
('2005', 'Polgahawela', 'Polgahawela Bus Station, 06 Kurunegala Road, Polgahawela 037'),
('2006', 'Kurunegala', 'Kurunegala'),
('2007', 'Bambalapitiya', 'Unity Plaza Bus Stop, Galle Rd, Colombo'),
('2008', 'Wellawate', 'Wellawate Mosque Bus Stop, Galle Rd, Colombo'),
('2009', 'Mt. Lavinia', 'Mt. Lavinia Bus Stand, A2, Dehiwala-Mount Lavinia'),
('2010', 'Moratuwa', 'Katubadda, Bandaranayake Mawatha, Moratuwa'),
('2011', 'Panadura', 'SLTB Bus Station, Panadura'),
('2012', 'Piliyandala', 'Piliyandala Bus Stand, Piliyandala'),
('2013', 'Kottawa', 'Kottawa Bus Station, Pannipitiya');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `RouteID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`RouteID`) VALUES
(6),
(100),
(255);

-- --------------------------------------------------------

--
-- Table structure for table `routedestination`
--

CREATE TABLE `routedestination` (
  `RouteID` int(5) NOT NULL,
  `TownID` varchar(5) NOT NULL,
  `Distance` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routedestination`
--

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
(100, '2010', 45),
(100, '2011', 60),
(255, '2009', 0),
(255, '2010', 20),
(255, '2012', 40),
(255, '2013', 60);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ScheduleID` varchar(8) NOT NULL,
  `BusJourneyID` varchar(6) DEFAULT NULL,
  `FromTime` bigint(20) NOT NULL,
  `ToTime` bigint(20) NOT NULL,
  `Valid` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `schedule`
--
DELIMITER $$
CREATE TRIGGER `Schedule_check1` BEFORE INSERT ON `schedule` FOR EACH ROW begin

if (exists
(select * from Schedule where 
(new.FromTime between Schedule.FromTime and Schedule.ToTime) or 
(new.ToTime between Schedule.FromTime and Schedule.ToTime)
)
) then
signal sqlstate '45002' set message_text = 'Schedule: Overlapping schedules';
end if;

     set new.ToTime = new.FromTime + (select Duration from BusJourney where BusJourney.BusJourneyID = new.BusJourneyID limit 1);
  end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Schedule_check2` BEFORE UPDATE ON `schedule` FOR EACH ROW begin

if (exists
(select * from Schedule where 
(new.FromTime between Schedule.FromTime and Schedule.ToTime) or 
(new.ToTime between Schedule.FromTime and Schedule.ToTime)
)
) then
signal sqlstate '45002' set message_text = 'Schedule: Overlapping schedules';
end if;

     set new.ToTime = new.FromTime + (select Duration from BusJourney where BusJourney.BusJourneyID = new.BusJourneyID limit 1);
  end
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`TicketNo`),
  ADD KEY `ScheduleID` (`ScheduleID`),
  ADD KEY `FromTown` (`FromTown`),
  ADD KEY `ToTown` (`ToTown`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`RegNumber`),
  ADD KEY `BusOwnerID` (`BusOwnerID`);

--
-- Indexes for table `busjourney`
--
ALTER TABLE `busjourney`
  ADD PRIMARY KEY (`BusJourneyID`),
  ADD KEY `RegNumber` (`RegNumber`),
  ADD KEY `RouteID` (`RouteID`),
  ADD KEY `FromTown` (`FromTown`),
  ADD KEY `ToTown` (`ToTown`);

--
-- Indexes for table `busowner`
--
ALTER TABLE `busowner`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Nic` (`Nic`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`RegNumber`,`ImagePath`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`TownID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`RouteID`);

--
-- Indexes for table `routedestination`
--
ALTER TABLE `routedestination`
  ADD PRIMARY KEY (`RouteID`,`TownID`),
  ADD KEY `TownID` (`TownID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `BusJourneyID` (`BusJourneyID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`ScheduleID`) REFERENCES `schedule` (`ScheduleID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`FromTown`) REFERENCES `location` (`TownID`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`ToTown`) REFERENCES `location` (`TownID`);

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`BusOwnerID`) REFERENCES `busowner` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `busjourney`
--
ALTER TABLE `busjourney`
  ADD CONSTRAINT `busjourney_ibfk_1` FOREIGN KEY (`RegNumber`) REFERENCES `bus` (`RegNumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `busjourney_ibfk_2` FOREIGN KEY (`RouteID`) REFERENCES `route` (`RouteID`),
  ADD CONSTRAINT `busjourney_ibfk_3` FOREIGN KEY (`FromTown`) REFERENCES `location` (`TownID`),
  ADD CONSTRAINT `busjourney_ibfk_4` FOREIGN KEY (`ToTown`) REFERENCES `location` (`TownID`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`RegNumber`) REFERENCES `bus` (`RegNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `routedestination`
--
ALTER TABLE `routedestination`
  ADD CONSTRAINT `routedestination_ibfk_1` FOREIGN KEY (`RouteID`) REFERENCES `route` (`RouteID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routedestination_ibfk_2` FOREIGN KEY (`TownID`) REFERENCES `location` (`TownID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`BusJourneyID`) REFERENCES `busjourney` (`BusJourneyID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
