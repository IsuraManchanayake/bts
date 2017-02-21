<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:00 PM
 */
require_once '../Modal/PhpClasses.php';
class BookingDao
{
    const VALID_STATE="Valid";
    const REFUND_STATE="Refunded";

    public function insert($conn,$booking){
        $sql="INSERT INTO Booking(TicketNo,ScheduleID,CustomerName,Nic,Email,Payment,FromTown,ToTown) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('ssssssss', $booking->getTicketNo(),$booking->getScheduleID(),$booking->getCustomerName(),$booking->getNic(),$booking->getEmail(),$booking->getPayment(),$booking->getFromLocation(),$booking->getToLocation());
        $stmt->execute();
        if(mysqli_error($conn)!=null){
            throw new Exception('My SQl Error');
        };
        return true;
    }
    public function updateRefundForSpecificTicket($conn,$TicketNo){
        $sql="update Booking set State=''"+BookingDao::REFUND_STATE+"' where TicketNo=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('s', $TicketNo);
        $stmt->execute();
        return true;
    }
    public function updateRefundForScheduleID($conn,$ScheduleID){
        $sql="update Booking set State=''"+BookingDao::REFUND_STATE+"' where ScheduleID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('s', $ScheduleID);
        $stmt->execute();
        return true;
    }
    public function getLatestTicket($conn){
        $sql="select TicketNo from Booking order by 1 desc limit 1";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            return  $row["TicketNo"];
        } else {
            return '0';
        }
    }
    public function lockBookingTable($conn){
        $sql="LOCK table booking write";
        mysqli_query($conn,$sql);
    }
    public function unlockBookingTable($conn){
        $sql="UNLOCK tables";
        mysqli_query($conn,$sql);
    }
}