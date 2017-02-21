<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 18/12/2016
 * Time: 04:34 PM
 */
class BookingSeatViewDao
{
    public function getBookingsForScheduleID($conn,$routeID,$ScheduleID){
        $sql="select b.TicketNo,b.CustomerName,b.Nic,b.Email,b.Payment,b.State,b.FromTown as FromTownID,(select TownName from Location where TownID=b.FromTown) as FromTownName,(select Distance from RouteDestination r where r.TownID=b.FromTown and routeID=?) as FromDistance,b.ToTown as ToTownID,(select TownName from Location where TownID=b.ToTown) as ToTownName,s.SeatNumber as Seat from Booking b,BookingSeats s where b.TicketNo=s.TicketNo and ScheduleID=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('ss', $routeID,$ScheduleID);
        $stmt->execute();
        $result = $stmt->get_result();
        $bookings=[];
        while ($row = $result->fetch_assoc()) {
            $booking=new BookingSeatView($row['TicketNo'],$row['CustomerName'],$row['Nic'],$row['Email'],$row['Payment'],$row['State'],$row['FromTownID'],$row['FromTownName'],$row['FromDistance'],$row['ToTownID'],$row['ToTownName'],$row['Seat']);
            array_push($bookings,$booking);
        }

        $stmt->free_result();
        return $bookings;
    }
}