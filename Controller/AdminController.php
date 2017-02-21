<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 02:16 PM
 */
include_once '../DaoImpl1/AdminDao.php';
include_once '../DaoImpl1/CostPerKmDao.php';
include_once '../DaoImpl1/IncomeDao.php';
include_once '../DaoImpl1/LocationDao.php';
include_once '../DaoImpl1/RouteDao.php';

class AdminController
{
    private static $Admin;
    private static $CostPerKm;
    private static $Income;
    private static $Location;
    private static $Route;

    private static function init()
    {
        if (AdminController::$Admin == null) {
            AdminController::$Admin = new AdminDao();
            AdminController::$CostPerKm = new CostPerKmDao();
            AdminController::$Income = new IncomeDao();
            AdminController::$Location = new LocationDao();
            AdminController::$Route = new RouteDao();

        }

    }

    public static function updatePassword($conn, $name,$password)
    {
        self::init();
         AdminController::$Admin->updatePassword($conn, $name,$password);
    }

    public static function updateUserName($conn, $user1,$user2)
    {
        self::init();
        return AdminController::$Admin->updateUserName($conn,$user1,$user2);
    }


    public static function getAdminData($conn,$userName)
    {
        self::init();
        return AdminController::$Admin->getAdminData($conn,$userName);
    }

    public static function insertLocation($conn,$name,$GMAPLink,$Position)
    {
        self::init();
        AdminController::$Location->lockLocationTable($conn);
        try {
            $index = AdminController::$Location->selectNextTownID($conn);
            mysqli_autocommit($conn, FALSE);
            $conn->begin_transaction();
            AdminController::$Location->insertLocation($conn,$index,$name,$GMAPLink,$Position);

            mysqli_commit($conn);


        } catch (Exception $e) {
            echo $e;
            mysqli_rollback($conn);
        } finally {

            mysqli_autocommit($conn, TRUE);

            AdminController::$Location->unlockLocationTable($conn);

        }
    }
    public static function getLocationsData($conn){
        self::init();
        return AdminController::$Location->getLocationsData($conn);

    }


    public static function getLocationsDatabyLink($conn,$link){
        self::init();
        return AdminController::$Location->getLocationsDatabylink($conn,$link);
    }

    public static function getLocationDataOnRoute($conn,$RouteID){
        self::init();
        return AdminController::$Location->getLocationDataOnRoute($conn,$RouteID);
    }

    public static function getLocationDataNotOnRoute($conn,$RouteID){
        self::init();
        return AdminController::$Location->getLocationDataNotOnRoute($conn,$RouteID);
    }

    public static function modifyLocationName($conn,$name,$name1){
        self::init();
        AdminController::$Location->modifyLocationName($conn,$name,$name1);
    }

    public static function modifyLocationGMAPLink($conn,$GMAP,$name){
        self::init();
        AdminController::$Location->modifyLocationGMAPLink($conn,$GMAP,$name);
    }

    public static function updateCostPerKm($conn,$CostPerKm,$BusType){
        self::init();
        AdminController::$CostPerKm->updateCostPerKm($conn,$CostPerKm,$BusType);
    }

    public static function getCostPerKmData($conn){
        self::init();
       return AdminController::$CostPerKm->getCostPerKmData($conn);
    }

    public static function getIncome($conn){
        self::init();
       return AdminController::$Income->getIncome($conn);
    }

    public static function getIncomeByMonth($conn){
        self::init();
       return AdminController::$Income->getIncomeByMonth($conn);
    }

    public static function getRoutesData($conn){
        self::init();
       return  AdminController::$Route->getRoutesData($conn);
    }

    public static function AddRoute($conn,$RouteID){
        self::init();
        AdminController::$Route->AddRoute($conn,$RouteID);
    }

    public static function insertLocationToRoute($conn,$routeID,$name1,$distance){
        self::init();
        AdminController::$Route->insertLocationToRoute($conn,$routeID,$name1,$distance);
    }

    public static function deletelocationFromRoute($conn,$routeID,$name){
        self::init();
        AdminController::$Route->deletelocationFromRoute($conn,$routeID,$name);
    }

    public static function deleteRoute($conn,$routeID){
        self::init();
        AdminController::$Route->deleteRoute($conn,$routeID);
    }


}

?>