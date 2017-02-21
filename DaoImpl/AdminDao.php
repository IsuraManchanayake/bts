<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:01 PM
 */
include_once '../Modal/PhpClasses.php';

class AdminDao
{

    public function updateCostPerKm($conn, $admin)
    {
        $sql="UPDATE Admin SET CostPerKm=:cost";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cost', $admin->getCostPerKm());
        $stmt->bindParam(':id', $admin->getAdminID());
        $stmt->execute();
    }
    public function updatePassword($conn,$admin){
        $sql="UPDATE Admin SET Password=(select password(:pass))";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pass', $admin->getPassword());
        $stmt->execute();
    }
    public function getCostPerKM($conn){
        $sql="SELECT CostPerKm from Admin; ";
        $result = mysqli_query($conn,$sql);;
        $costPerKm=0;
        while ($row = $result->fetch_assoc()) {
            $costPerKm=$row['CostPerKm'];
        }

        return $costPerKm;
    }

}