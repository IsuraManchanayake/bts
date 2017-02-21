<?php

/**
 * Created by PhpStorm.
 * User: acer v5
 * Date: 12/17/2016
 * Time: 11:57 PM
 */
require_once '../include/connect.php';
require_once '../Modal/PhpClasses1.php';
class CostPerKmDao
{
    public function updateCostPerKm($conn, $CostPerKm, $BusType)
    {

        $sql = "UPDATE CostPerKm SET CostPerKm=? WHERE BusType=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('is', $CostPerKm, $BusType);
        $stmt->execute();
    }

    public function getCostPerKmData($conn)
    {
        $sql = "select BusType,CostPerKm  from CostPerKm order by CostPerKm DESC ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $Costs = array();
        while ($row = $result->fetch_assoc()) {
            $Costs[] = new CostPerKm($row['BusType'], $row['CostPerKm']);
        }

        $stmt->free_result();
        return $Costs;

    }

}
