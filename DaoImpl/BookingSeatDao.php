<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:01 PM
 */
require_once '../Modal/PhpClasses.php';
class BookingSeatDao
{
    public  function insert($conn,$ticketNo,$seats){

        $sql="INSERT INTO BookingSeats VALUES (?,?)";
        $stmt = $conn->prepare($sql);

        foreach ($seats as &$seat){
            $stmt->bind_Param('sd', $ticketNo,$seat);
            $stmt->execute();
        }
        if(mysqli_error($conn)!=null){
            throw new Exception('My SQl Error');
        };
    }
    public function getAvailableSeats($conn,$SeatNum,$ScheduleID){

        $availableSeats=array();


        if (!($stmt = $conn->prepare("CALL getSeatInBus(?,?)"))) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }

        $stmt->bind_Param('ds', $SeatNum,$ScheduleID);
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        do {

            $id_out = NULL;
            if (!$stmt->bind_result($id_out)) {
                echo "Bind failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            while ($stmt->fetch()) {
                array_push($availableSeats,$id_out);
            }
        } while ($stmt->more_results() && $stmt->next_result());

        return $availableSeats;
    }
}

