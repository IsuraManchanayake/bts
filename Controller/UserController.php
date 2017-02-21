<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 20/12/2016
 * Time: 01:24 AM
 */
include_once '../DaoImpl/BusOwnerDao.php';
include_once '../DaoImpl/UserDao.php';
class UserController
{
    private static $busOwner;
    private static $user;

    private static function init()
    {
        if(UserController::$busOwner==null) {
            UserController::$busOwner = new BusOwnerDao();
            UserController::$user = new UserDao();
        }
    }
    public static function createBusOwner($conn,$busOwner){
        self::init();
        UserController::$busOwner->lockBookingTable($conn);
        $re=null;
        try {
            $lastID = UserController::$busOwner->getLastBusOwnerID($conn);
            mysqli_autocommit($conn, FALSE);
            $conn->begin_transaction();
            $newID = intval($lastID)+1;
            $busOwner->setID($newID);

            $re=UserController::$busOwner->insertBusOwner($conn, $busOwner);
            UserController::$busOwner->unlockBookingTable($conn);
            if($re=='Suceed') {
                echo "fff";
                mysqli_commit($conn);
            }else{
                echo $re;
                mysqli_rollback($conn);
            }

        } catch (Exception $e) {
            echo $e;
            mysqli_rollback($conn);
        } finally {

            mysqli_autocommit($conn, TRUE);

            UserController::$busOwner->unlockBookingTable($conn);

        }
        return $re;

    }
    public static function getAllUsers($conn){
        self::init();

        return UserController::$user->getAllUserNames($conn);
    }
}