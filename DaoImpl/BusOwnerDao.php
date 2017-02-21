<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 09:57 PM
 */
class BusOwnerDao
{
    public function insertBusOwner($conn,$busOwner){
        echo "dddd".$busOwner->getID()."insert into BusOwner VALUES ('".$busOwner->getID()."','".$busOwner->getName()."','".$busOwner->getUserName()."',(select password('".$busOwner->getPassword()."')),'".$busOwner->getNic()."','".$busOwner->getEmail()."')";
        $sql="insert into BusOwner VALUES (?,?,?,(select password(?)),?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('ssssss',$busOwner->getID(),$busOwner->getName(),$busOwner->getUserName(),$busOwner->getPassword(),$busOwner->getNic(),$busOwner->getEmail());
        $stmt->execute();
        if(mysqli_errno($conn)!=null){
            return mysqli_errno($conn);
        }
        return "Suceed";
    }
    public function getLastBusOwnerID($conn){
        $sql="select ID from BusOwner order by 1 desc limit 1";
        $result=mysqli_query($conn,$sql);
        $userName="00000";
        if ($row = $result->fetch_assoc()) {
            $userName=$row['ID'];
            return $userName;
        }
        return $userName;
    }
    public function lockBookingTable($conn){
        $sql="LOCK table BusOwner write";
        mysqli_query($conn,$sql);
    }
    public function unlockBookingTable($conn){
        $sql="UNLOCK tables";
        mysqli_query($conn,$sql);
    }
}