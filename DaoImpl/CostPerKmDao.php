<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 20/12/2016
 * Time: 09:58 PM
 */
class CostPerKmDao
{
    public function getCostPerKmForBusType($conn,$Type){
        $sql="select c.CostPerKm as Cost from CostPerKm c where BusType=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('s', $Type);
        $stmt->execute();

        $result = $stmt->get_result();
        $res=null;
        if ($row = $result->fetch_assoc()) {
            $res=$row['Cost'];
        }

        $stmt->free_result();
        return $res;
    }
}