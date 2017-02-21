<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 20/12/2016
 * Time: 01:01 PM
 */
class GetNearestScheduleDao
{
    public function getNearesetSchedule($conn,$RegNumber,$Time){
        $sql="select get_nearest_schedule(?,?) as ScheduleID";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('sd', $RegNumber,$Time);
        $stmt->execute();

        $result = $stmt->get_result();
        $res=null;
        if ($row = $result->fetch_assoc()) {
            $res=SheduleBookingView($row['ScheduleID']);
        }

        $stmt->free_result();
        return $res;
    }
}