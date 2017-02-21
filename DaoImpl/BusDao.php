<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 09:57 PM
 */

class BusDao
{
 public function get_bus($conn,$regNumber){
     $query="select * from bus WHERE RegNumber=?";
     $stmt=$conn->prepare($query);
     $stmt->bind_Param('s',$regNumber);
     $stmt->execute();
     $result = $stmt->get_result();

     while($busInfo=$result->fetch_assoc()){
         $bus=new \Busses\Bus();
         $bus -> RegNumber=$busInfo["RegNumber"];
         $bus -> OwnerID=$busInfo["BusOwnerID"];
         $bus -> PhoneNumber=$busInfo["phoneNumber"];
         $bus -> NoSeat=$busInfo["NoSeat"];
         $bus -> Type=$busInfo["Type"];
         $bus -> wifi=$busInfo["wifi"];
         $bus -> haveCurtains=$busInfo["haveCurtains"];
         $stmt->free_result();
         return $bus;
     }
 }
 public function add_bus($conn,$bus){
     $buss=$bus;
     $query="INSERT INTO `bus` (`RegNumber`, `BusOwnerID`, `phoneNumber`, `NoSeat`, `Type`, `wifi`, `haveCurtains`, `password`) VALUES
    (?,?,?,?,?,?,?,?)";
     "('{$buss -> RegNumber}', '{$buss->OwnerID}', '{$buss->PhoneNumber}', {$buss->NoSeat}, '{$buss->Type}', b'{$buss->wifi}', b'{$buss->haveCurtains}', '{$buss->password}')";
     $stmt=$conn->prepare($query);
     $stmt->bind_Param('sssdsdds',$buss -> RegNumber,$buss->OwnerID,$buss->PhoneNumber,$buss->NoSeat,$buss->Type,$buss->wifi,$buss->haveCurtains,$buss->password);
     $stmt->execute();
     if(mysqli_error($conn)!=null){
         die("database failed :(");
         //throw new Exception('My SQl Error');
     }
     return true;
 }
 public function getOwnerBusses($conn,$OwnerID){
        $query="select RegNumber from bus where BusOwnerID=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('s',$OwnerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $bus=array();
        while($reg=$result->fetch_assoc()){
            array_push($bus,$reg["RegNumber"]);
        }
        return $bus;
    }
 public function update_bus($bus,$RegNumber,$pass,$conn){

     $query="update bus set `RegNumber`='{$bus -> RegNumber}',`phoneNumber`='{$bus->PhoneNumber}',`NoSeat`={$bus->NoSeat},`Type`='{$bus->Type}',`wifi`= b'{$bus->wifi}',`haveCurtains`= b'{$bus->haveCurtains}' ";

     if($pass==true){
         $query.=" ,`password`='{$bus->password}' ";
     }
     $query.="where `RegNumber`='{$RegNumber}'";
     $result=mysqli_query($conn,$query);
     if(mysqli_errno($conn)!=null){
         die("database error");
     }
 }
 public function check_pass($reg,$pass,$conn){
     $query="select RegNumber from bus WHERE RegNumber=? AND password=?";
     $stmt=$conn->prepare($query);
     $stmt->bind_Param('ss',$reg,$pass);
     $stmt->execute();
     $result = $stmt->get_result();
     while($busInfo=$result->fetch_assoc()){
         return false;
     }
     return true;
 }

 public function check_reg_num($reg,$conn){
     $query="select RegNumber from bus WHERE RegNumber=?";
     $stmt=$conn->prepare($query);
     $stmt->bind_Param('s',$reg);
     $stmt->execute();
     $result = $stmt->get_result();
     while($r=$result->fetch_assoc()){
         return true;
     }
     return false;
 }
}