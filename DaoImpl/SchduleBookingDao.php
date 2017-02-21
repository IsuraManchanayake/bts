<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 02:18 PM
 */
include_once '../Modal/PhpClasses.php';
class SchduleBookingDao
{
    public function getScheduleData($conn,$scheduleID){
        $sql="select RegNumber,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance,FromInt,ToInt,FromDistance,ToDistance,RouteID,FromTownID,ToTownID from BookingSchedule where ScheduleID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('s', $scheduleID);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        if ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($scheduleID,$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance'],$row['FromInt'],$row['ToInt'],$row['FromDistance'],$row['ToDistance'],$row['RouteID'],$row['FromTownID'],$row['ToTownID']);
        }

        $stmt->free_result();
        return $booking;
    }
    public function getNextBookingSchedules($conn,$RegNumber,$FromInt){
        $sql="select ScheduleID,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance,FromInt,ToInt,FromDistance,ToDistance,RouteID,FromTownID,ToTownID from BookingSchedule where RegNumber=? and FromInt>=? order by FromInt limit 10";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('sd', $RegNumber,$FromInt);
        $stmt->execute();

        $result = $stmt->get_result();
        $bookings=array();
        while ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($row['ScheduleID'],$RegNumber,$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance'],$row['FromInt'],$row['ToInt'],$row['FromDistance'],$row['ToDistance'],$row['RouteID'],$row['FromTownID'],$row['ToTownID']);
            array_push($bookings,$booking);
        }

        $stmt->free_result();
        return $bookings;
    }
    public function getFirstBookingDataForSpecificDay($conn,$RegNumber,$day){
        $sql="select ScheduleID,RegNumber,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance,FromInt,ToInt,FromDistance,ToDistance,RouteID,FromTownID,ToTownID from BookingSchedule where RegNumber=? and FromTime like ? order by FromInt limit 1";
        $stmt = $conn->prepare($sql);
        $day=$day."%";
        $stmt->bind_Param('ss', $RegNumber,$day);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        if ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($row['ScheduleID'],$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance'],$row['FromInt'],$row['ToInt'],$row['FromDistance'],$row['ToDistance'],$row['RouteID'],$row['FromTownID'],$row['ToTownID']);
        }

        $stmt->free_result();
        return $booking;
    }
    public function getNearestBookingDataWithSpecifiDayBefore($conn,$RegNumber,$day){
        $sql="select ScheduleID,RegNumber,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance,FromInt,ToInt,FromDistance,ToDistance,RouteID,FromTownID,ToTownID from BookingSchedule where RegNumber=? and FromTime < ? order by FromTime desc limit 1";
        $stmt = $conn->prepare($sql);
        $day=$day."%";
        $stmt->bind_Param('ss', $RegNumber,$day);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        if ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($row['ScheduleID'],$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance'],$row['FromInt'],$row['ToInt'],$row['FromDistance'],$row['ToDistance'],$row['RouteID'],$row['FromTownID'],$row['ToTownID']);
        }

        $stmt->free_result();
        return $booking;
    }
    public function getNearestBookingDataWithSpecifiDayAfter($conn,$RegNumber,$day){
        $sql="select ScheduleID,RegNumber,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance,FromInt,ToInt,FromDistance,ToDistance,RouteID,FromTownID,ToTownID from BookingSchedule where RegNumber=? and FromTime > ? order by FromTime desc limit 1";
        $stmt = $conn->prepare($sql);
        $day=$day."%";
        $stmt->bind_Param('ss', $RegNumber,$day);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        if ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($row['ScheduleID'],$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance'],$row['FromInt'],$row['ToInt'],$row['FromDistance'],$row['ToDistance'],$row['RouteID'],$row['FromTownID'],$row['ToTownID']);
        }

        $stmt->free_result();
        return $booking;
    }
    public function getBeforeScheduleID($conn,$RegNumber,$FromInt){
        $sql="select ScheduleID,RegNumber,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance,FromInt,ToInt,FromDistance,ToDistance,RouteID,FromTownID,ToTownID from BookingSchedule where RegNumber=? and FromInt < ? order by FromTime desc limit 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('sd', $RegNumber,$FromInt);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        if ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($row['ScheduleID'],$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance'],$row['FromInt'],$row['ToInt'],$row['FromDistance'],$row['ToDistance'],$row['RouteID'],$row['FromTownID'],$row['ToTownID']);
        }

        $stmt->free_result();
        return $booking;
    }
    public function getNextScheduleID($conn,$RegNumber,$FromInt){
        $sql="select ScheduleID,RegNumber,PhoneNumber,NoSeat,Type,Wifi,HaveCurtains,FromTime,ToTime,FromTownName,ToTownName,Duration,Distance,FromInt,ToInt,FromDistance,ToDistance,RouteID,FromTownID,ToTownID from BookingSchedule where RegNumber=? and FromInt > ? order by FromTime  limit 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('sd', $RegNumber,$FromInt);
        $stmt->execute();

        $result = $stmt->get_result();
        $booking=null;
        if ($row = $result->fetch_assoc()) {
            $booking=new SheduleBookingView($row['ScheduleID'],$row['RegNumber'],$row['PhoneNumber'],$row['NoSeat'],$row['Type'],$row['Wifi'],$row['HaveCurtains'],$row['FromTime'],$row['FromTownName'],$row['ToTime'],$row['ToTownName'],$row['Duration'],$row['Distance'],$row['FromInt'],$row['ToInt'],$row['FromDistance'],$row['ToDistance'],$row['RouteID'],$row['FromTownID'],$row['ToTownID']);
        }

        $stmt->free_result();
        return $booking;
    }
}