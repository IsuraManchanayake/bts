<?php
/**
 * Created by PhpStorm.
 * User: acer v5
 * Date: 12/17/2016
 * Time: 11:31 PM
 */
class User
{
    private $userName;
    private $password;

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
}
Class CostPerKm{
    private $BusType;
    private $CostPerKm;

    /**
     * CostPerKm constructor.
     * @param $BusType
     * @param $CostPerKm
     */
    public function __construct($BusType, $CostPerKm)
    {
        $this->BusType = $BusType;
        $this->CostPerKm = $CostPerKm;
    }


    /**
     * @return mixed
     */
    public function getBusType()
    {
        return $this->BusType;
    }

    /**
     * @param mixed $BusType
     */
    public function setBusType($BusType)
    {
        $this->BusType = $BusType;
    }

    /**
     * @return mixed
     */
    public function getCostPerKm()
    {
        return $this->CostPerKm;
    }

    /**
     * @param mixed $CostPerKm
     */
    public function setCostPerKm($CostPerKm)
    {
        $this->CostPerKm = $CostPerKm;
    }

}
class BusOwner extends User
{
    private $ID;
    private $name;
    private $userName;


    private $nic;
    private $email;
    private $buses;

    /**
     * BusOwner constructor.
     * @param $ID
     * @param $name
     * @param $userName
     * @param $nic
     * @param $email
     */
    public function __construct($ID, $name, $userName, $nic, $email)
    {
        $this->ID = $ID;
        $this->name = $name;
        $this->userName = $userName;
        $this->nic = $nic;
        $this->email = $email;
    }

    /**
     * BusOwner constructor.
     * @param $ID
     * @param $name
     * @param $nic
     * @param $email
     * @param $buses
     */


    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }
    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNic()
    {
        return $this->nic;
    }

    /**
     * @param mixed $nic
     */
    public function setNic($nic)
    {
        $this->nic = $nic;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBuses()
    {
        return $this->buses;
    }

    /**
     * @param mixed $buses
     */
    public function setBuses($buses)
    {
        $this->buses = $buses;
    }
}
class Bus extends User{
    private $regNumber;
    private $seatCount;
    private $type;
    private $wifi;
    private $curtain;
    private $images;
    private $busJourney;

    /**
     * @return mixed
     */
    public function getRegNumber()
    {
        return $this->regNumber;
    }

    /**
     * @param mixed $regNumber
     */
    public function setRegNumber($regNumber)
    {
        $this->regNumber = $regNumber;
    }

    /**
     * @return mixed
     */
    public function getSeatCount()
    {
        return $this->seatCount;
    }

    /**
     * @param mixed $seatCount
     */
    public function setSeatCount($seatCount)
    {
        $this->seatCount = $seatCount;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * @param mixed $wifi
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;
    }

    /**
     * @return mixed
     */
    public function getCurtain()
    {
        return $this->curtain;
    }

    /**
     * @param mixed $curtain
     */
    public function setCurtain($curtain)
    {
        $this->curtain = $curtain;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getBusJourney()
    {
        return $this->busJourney;
    }

    /**
     * @param mixed $busJourney
     */
    public function setBusJourney($busJourney)
    {
        $this->busJourney = $busJourney;
    }

}
class Admin extends User{
    private $adminID;

    /**
     * @return mixed
     */
    public function getCostPerKm()
    {
        return $this->costPerKm;
    }

    /**
     * @param mixed $costPerKm
     */

    /**
     * @return mixed
     */
    public function getAdminID()
    {
        return $this->adminID;
    }

    /**
     * @param mixed $adminID
     */
    public function setAdminID($adminID)
    {
        $this->adminID = $adminID;
    }

}
class BusJourney{
    private $busJourneyID;
    private $fromLocation;
    private $toLocation;
    private $duration;
    private $bus;
    private $schedules;
    private $route;

    /**
     * @return mixed
     */
    public function getBusJourneyID()
    {
        return $this->busJourneyID;
    }

    /**
     * @param mixed $busJourneyID
     */
    public function setBusJourneyID($busJourneyID)
    {
        $this->busJourneyID = $busJourneyID;
    }

    /**
     * @return mixed
     */
    public function getFromLocation()
    {
        return $this->fromLocation;
    }

    /**
     * @param mixed $fromLocation
     */
    public function setFromLocation($fromLocation)
    {
        $this->fromLocation = $fromLocation;
    }

    /**
     * @return mixed
     */
    public function getToLocation()
    {
        return $this->toLocation;
    }

    /**
     * @param mixed $toLocation
     */
    public function setToLocation($toLocation)
    {
        $this->toLocation = $toLocation;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getBus()
    {
        return $this->bus;
    }

    /**
     * @param mixed $bus
     */
    public function setBus($bus)
    {
        $this->bus = $bus;
    }

    /**
     * @return mixed
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * @param mixed $schedules
     */
    public function setSchedules($schedules)
    {
        $this->schedules = $schedules;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

}
class Location{
    private $townID;
    private $townName;
    private $GMAPLink;
    private $Position;

    /**
     * Location constructor.
     * @param $townID
     * @param $townName
     * @param $GMAPLink
     * @param $Position
     */
    public function __construct($townID, $townName, $GMAPLink, $Position)
    {
        $this->townID = $townID;
        $this->townName = $townName;
        $this->GMAPLink = $GMAPLink;
        $this->Position = $Position;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->Position;
    }

    /**
     * @param mixed $Position
     */
    public function setPosition($Position)
    {
        $this->Position = $Position;
    }

    /**
     * Location constructor.
     * @param $townID
     * @param $townName
     * @param $GMAPLink
     */

    /**
     * @return mixed
     */
    public function getTownID()
    {
        return $this->townID;
    }

    /**
     * @param mixed $townID
     */
    public function setTownID($townID)
    {
        $this->townID = $townID;
    }

    /**
     * @return mixed
     */
    public function getTownName()
    {
        return $this->townName;
    }

    /**
     * @param mixed $townName
     */
    public function setTownName($townName)
    {
        $this->townName = $townName;
    }

    /**
     * @return mixed
     */
    public function getGMAPLink()
    {
        return $this->GMAPLink;
    }

    /**
     * @param mixed $GMAPLink
     */
    public function setGMAPLink($GMAPLink)
    {
        $this->GMAPLink = $GMAPLink;
    }

}
class Route{
    private $routeID;
    private $locations=array();


    /**
     * Route constructor.
     * @param $routeID
     */
    public function __construct($routeID)
    {
        $this->routeID = $routeID;
    }

    /**
     * @return mixed
     */
    public function getRouteID()
    {
        return $this->routeID;
    }

    /**
     * @param mixed $routeID
     */
    public function setRouteID($routeID)
    {
        $this->routeID = $routeID;
    }

    /**
     * @return mixed
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param mixed $locations
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;
    }

}
class Schedule{
    private $scheduleID;
    private $fromTime;
    private $toTime;
    private $valid;
    private $bookings;
    private $date;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getScheduleID()
    {
        return $this->scheduleID;
    }

    /**
     * @param mixed $scheduleID
     */
    public function setScheduleID($scheduleID)
    {
        $this->scheduleID = $scheduleID;
    }

    /**
     * @return mixed
     */
    public function getFromTime()
    {
        return $this->fromTime;
    }

    /**
     * @param mixed $fromTime
     */
    public function setFromTime($fromTime)
    {
        $this->fromTime = $fromTime;
    }

    /**
     * @return mixed
     */
    public function getToTime()
    {
        return $this->toTime;
    }

    /**
     * @param mixed $toTime
     */
    public function setToTime($toTime)
    {
        $this->toTime = $toTime;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @param mixed $bookings
     */
    public function setBookings($bookings)
    {
        $this->bookings = $bookings;
    }

}
class Booking{
    private $ticketNo;
    private $scheduleID;
    private $seats;
    private $customerName;
    private $nic;
    private $email;
    private $state;
    private $payment;
    private $payPalPayment;
    private $fromLocation;
    private $toLocation;

    /**
     * @return mixed
     */
    public function getScheduleID()
    {
        return $this->scheduleID;
    }

    /**
     * @param mixed $scheduleID
     */
    public function setScheduleID($scheduleID)
    {
        $this->scheduleID = $scheduleID;
    }

    /**
     * @return mixed
     */
    public function getTicketNo()
    {
        return $this->ticketNo;
    }

    /**
     * @param mixed $ticketNo
     */
    public function setTicketNo($ticketNo)
    {
        $this->ticketNo = $ticketNo;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getNic()
    {
        return $this->nic;
    }

    /**
     * @param mixed $nic
     */
    public function setNic($nic)
    {
        $this->nic = $nic;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return mixed
     */
    public function getPayPalPayment()
    {
        return $this->payPalPayment;
    }

    /**
     * @param mixed $payPalPayment
     */
    public function setPayPalPayment($payPalPayment)
    {
        $this->payPalPayment = $payPalPayment;
    }

    /**
     * @return mixed
     */
    public function getFromLocation()
    {
        return $this->fromLocation;
    }

    /**
     * @param mixed $fromLocation
     */
    public function setFromLocation($fromLocation)
    {
        $this->fromLocation = $fromLocation;
    }

    /**
     * @return mixed
     */
    public function getToLocation()
    {
        return $this->toLocation;
    }

    /**
     * @param mixed $toLocation
     */
    public function setToLocation($toLocation)
    {
        $this->toLocation = $toLocation;
    }



}
class SheduleBookingView
{
    private $scheduleID;
    private $regNumber;
    private $phoneNumber;
    private $noSeats;
    private $type;
    private $wifi;
    private $haveCurtains;
    private $fromTime;
    private $fromTownID;
    private $fromTownName;
    private $toTime;
    private $toTownName;
    private $toTownID;
    private $busJourneyID;
    private $duration;

    /**
     * SheduleBookingView constructor.
     * @param $scheduleID
     * @param $regNumber
     * @param $phoneNumber
     * @param $noSeats
     * @param $type
     * @param $wifi
     * @param $haveCurtains
     * @param $fromTime
     * @param $fromTownName
     * @param $toTime
     * @param $toTownName
     */
    public function __construct($scheduleID, $regNumber, $phoneNumber, $noSeats, $type, $wifi, $haveCurtains, $fromTime, $fromTownName, $toTime, $toTownName, $duration)
    {
        $this->scheduleID = $scheduleID;
        $this->regNumber = $regNumber;
        $this->phoneNumber = $phoneNumber;
        $this->noSeats = $noSeats;
        $this->type = $type;
        $this->wifi = $wifi;
        $this->haveCurtains = $haveCurtains;
        $this->fromTime = $fromTime;
        $this->fromTownName = $fromTownName;
        $this->toTime = $toTime;
        $this->toTownName = $toTownName;
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getScheduleID()
    {
        return $this->scheduleID;
    }

    /**
     * @param mixed $scheduleID
     */
    public function setScheduleID($scheduleID)
    {
        $this->scheduleID = $scheduleID;
    }

    /**
     * @return mixed
     */
    public function getRegNumber()
    {
        return $this->regNumber;
    }

    /**
     * @param mixed $regNumber
     */
    public function setRegNumber($regNumber)
    {
        $this->regNumber = $regNumber;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getNoSeats()
    {
        return $this->noSeats;
    }

    /**
     * @param mixed $noSeats
     */
    public function setNoSeats($noSeats)
    {
        $this->noSeats = $noSeats;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * @param mixed $wifi
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;
    }

    /**
     * @return mixed
     */
    public function getHaveCurtains()
    {
        return $this->haveCurtains;
    }

    /**
     * @param mixed $haveCurtains
     */
    public function setHaveCurtains($haveCurtains)
    {
        $this->haveCurtains = $haveCurtains;
    }

    /**
     * @return mixed
     */
    public function getFromTime()
    {
        return $this->fromTime;
    }

    /**
     * @param mixed $fromTime
     */
    public function setFromTime($fromTime)
    {
        $this->fromTime = $fromTime;
    }

    /**
     * @return mixed
     */
    public function getFromTownID()
    {
        return $this->fromTownID;
    }

    /**
     * @param mixed $fromTownID
     */
    public function setFromTownID($fromTownID)
    {
        $this->fromTownID = $fromTownID;
    }

    /**
     * @return mixed
     */
    public function getFromTownName()
    {
        return $this->fromTownName;
    }

    /**
     * @param mixed $fromTownName
     */
    public function setFromTownName($fromTownName)
    {
        $this->fromTownName = $fromTownName;
    }

    /**
     * @return mixed
     */
    public function getToTime()
    {
        return $this->toTime;
    }

    /**
     * @param mixed $toTime
     */
    public function setToTime($toTime)
    {
        $this->toTime = $toTime;
    }

    /**
     * @return mixed
     */
    public function getToTownName()
    {
        return $this->toTownName;
    }

    /**
     * @param mixed $toTownName
     */
    public function setToTownName($toTownName)
    {
        $this->toTownName = $toTownName;
    }

    /**
     * @return mixed
     */
    public function getToTownID()
    {
        return $this->toTownID;
    }

    /**
     * @param mixed $toTownID
     */
    public function setToTownID($toTownID)
    {
        $this->toTownID = $toTownID;
    }

    /**
     * @return mixed
     */
    public function getBusJourneyID()
    {
        return $this->busJourneyID;
    }

    /**
     * @param mixed $busJourneyID
     */
    public function setBusJourneyID($busJourneyID)
    {
        $this->busJourneyID = $busJourneyID;
    }


}

