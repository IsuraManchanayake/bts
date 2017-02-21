<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 20/12/2016
 * Time: 06:34 PM
 */
class NearestLocationDao
{
    public function getNearestLocationPoint($conn,$RegNumber,$time){
        $sql="select get_NearestLocation(?,?) as point;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('sd', $RegNumber,$time);
        $stmt->execute();

        $result = $stmt->get_result();
        $res=null;
        if ($row = $result->fetch_assoc()) {
            $res=$row['point'];
        }

        $stmt->free_result();
        return $res;
    }
}