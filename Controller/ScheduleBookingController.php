<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 02:16 PM
 */
include_once '../DaoImpl/SchduleBookingDao.php';
include_once '../DaoImpl/RouteLocationDao.php';
include_once '../DaoImpl/AdminDao.php';
include_once '../DaoImpl/BookingDao.php';
include_once '../DaoImpl/BookingSeatDao.php';
include_once '../DaoImpl/BookingSeatViewDao.php';
include_once '../DaoImpl/NearestLocationDao.php';
include_once '../DaoImpl/CostPerKmDao.php';
include_once '../DaoImpl/ImageDao.php';


class ScheduleBookingController
{
    private static $scheduleBooking;
    private static $routeLocation;
    private static $admin;
    private static $booking;
    private static $bookingSeat;
    private static $bookingSeatView;
    private static $nearestLocation;
    private static $costPerKm;
    private static $image;

    private static function init()
    {
        if (ScheduleBookingController::$scheduleBooking == null) {
            ScheduleBookingController::$scheduleBooking = new SchduleBookingDao();
            ScheduleBookingController::$routeLocation = new RouteLocationDao();
            ScheduleBookingController::$admin = new AdminDao();
            ScheduleBookingController::$booking = new BookingDao();
            ScheduleBookingController::$bookingSeat = new BookingSeatDao();
            ScheduleBookingController::$bookingSeatView=new BookingSeatViewDao();
            ScheduleBookingController::$nearestLocation=new NearestLocationDao();
            ScheduleBookingController::$costPerKm=new CostPerKmDao();
            ScheduleBookingController::$image=new ImageDao();
        }

    }

    public static function getBookingScheduleFromScheduleID($conn, $scheduleID)
    {
        self::init();
        return ScheduleBookingController::$scheduleBooking->getScheduleData($conn, $scheduleID);
    }

    public static function getRouteLocation($conn, $routeID, $fromTownID, $toTownID)
    {
        self::init();
        return ScheduleBookingController::$routeLocation->getRouteLocation($conn, $routeID, $fromTownID, $toTownID);
    }


    public static function getCostPerKm($conn,$type)
    {
        self::init();
        return ScheduleBookingController::$costPerKm->getCostPerKmForBusType($conn,$type);
    }

    public static function createBooking($conn, $booking)
    {
        self::init();
        ScheduleBookingController::$booking->lockBookingTable($conn);
        try {
            $lastTicket = substr(ScheduleBookingController::$booking->getLatestTicket($conn), 1);
            mysqli_autocommit($conn, FALSE);
            $conn->begin_transaction();
            $newTicket = base_convert(intval(base_convert($lastTicket, 16, 10)) + 1, 10, 16);
            $newTicket = "T" . str_pad($newTicket, 9, "0", STR_PAD_LEFT);
            $booking->setTicketNo($newTicket);
            ScheduleBookingController::$booking->insert($conn, $booking);
            ScheduleBookingController::$booking->unlockBookingTable($conn);
            $seats = $booking->getSeats();
            ScheduleBookingController::$bookingSeat->insert($conn, $newTicket, $seats);

                mysqli_commit($conn);


        } catch (Exception $e) {
            echo $e;
            mysqli_rollback($conn);
        } finally {

            mysqli_autocommit($conn, TRUE);

            ScheduleBookingController::$booking->unlockBookingTable($conn);
        }
    }
    public static function getFirstScheduleInAGivenDate($conn,$RegNumber,$day){
        self::init();
        $temp= ScheduleBookingController::$scheduleBooking->getFirstBookingDataForSpecificDay($conn,$RegNumber,$day);
        if($temp==null){
            $temp=ScheduleBookingController::$scheduleBooking->getNearestBookingDataWithSpecifiDayBefore($conn,$RegNumber,$day);
            if($temp==null){
                $temp=ScheduleBookingController::$scheduleBooking->getNearestBookingDataWithSpecifiDayAfter($conn,$RegNumber,$day);
            }
        }
        return $temp;
    }

    public static function getBookingsInAGivenSchedule($conn,$RouteID,$ScheduleID){
        self::init();
        return ScheduleBookingController::$bookingSeatView->getBookingsForScheduleID($conn,$RouteID,$ScheduleID);
    }
    public static function getNextBookingSchedule($conn,$RegNumber,$FromInt){
        self::init();
        return ScheduleBookingController::$scheduleBooking->getNextScheduleID($conn,$RegNumber,$FromInt);
    }
    public static function getBeforeSchedule($conn,$RegNumber,$FromInt){
        self::init();
        return ScheduleBookingController::$scheduleBooking->getBeforeScheduleID($conn,$RegNumber,$FromInt);
    }
    public static function getBookingInTheExactDate($conn,$RegNumber,$day){
        self::init();
        $temp= ScheduleBookingController::$scheduleBooking->getFirstBookingDataForSpecificDay($conn,$RegNumber,$day);
        return $temp;
    }
    public static function getNearestTenSchedules($conn,$RegNumber,$time){
        self::init();
        return ScheduleBookingController::$scheduleBooking->getNextBookingSchedules($conn,$RegNumber,$time);
    }
    public static function getAvailableSeats($conn,$Seat,$ScheduleID){
        self::init();
        return ScheduleBookingController::$bookingSeat->getAvailableSeats($conn,$Seat,$ScheduleID);
    }
    public static function getNearestLocation($conn,$RegNumber,$time){
        self::init();
        return ScheduleBookingController::$nearestLocation->getNearestLocationPoint($conn,$RegNumber,$time);
    }
    public static function getImagesForBus($conn,$RegNumber){
        self::init();
        return ScheduleBookingController::$image->getImagesForBus($conn,$RegNumber);
    }

}

?>