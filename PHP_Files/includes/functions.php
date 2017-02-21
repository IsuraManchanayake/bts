<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/13/2016
 * Time: 11:55 PM
 */

function redirect_to($url){
    header("Location: {$url}");
    exit;
}
function message($message){
    echo "<script type='text/javascript'>alert(\"{$message}\")</script>";
}
function alert($message){
    echo ("<script type='text/javascript'>alert('{$message}')</script>");
}
function get_bus($b){
            $result=exicute_query("select * from bus WHERE RegNumber='{$b}'");

            while($busInfo=mysqli_fetch_array($result)){
                $bus=new \Busses\Bus();
                $bus -> RegNumber=$busInfo["RegNumber"];
                $bus -> OwnerID=$busInfo["BusOwnerID"];
                $bus -> PhoneNumber=$busInfo["phoneNumber"];
                $bus -> NoSeat=$busInfo["NoSeat"];
                $bus -> Type=$busInfo["Type"];
                $bus -> wifi=$busInfo["wifi"];
                $bus -> haveCurtains=$busInfo["haveCurtains"];
                return $bus;


            }
}
function get_buses(){
    $busIDs=$_SESSION["buses"];
    $buses=array();
    foreach ($busIDs as $b){
        array_push($buses,get_bus($b));
    }
    return $buses;
}
function add_bus($bus){
    $buss=$bus;
    $query="INSERT INTO `bus` (`RegNumber`, `BusOwnerID`, `phoneNumber`, `NoSeat`, `Type`, `wifi`, `haveCurtains`, `password`) VALUES
    ('{$buss -> RegNumber}', '{$buss->OwnerID}', '{$buss->PhoneNumber}', {$buss->NoSeat}, '{$buss->Type}', b'{$buss->wifi}', b'{$buss->haveCurtains}', (select password('{$buss->password}')))";
    $result=exicute_query($query);
    //$result2=add_journey($bus->journey);
    //

}
function getOwnerBusses($OwnerID){
    $result2=exicute_query("select RegNumber from bus where BusOwnerID='{$OwnerID}'");
    $bus=array();
    while($reg=mysqli_fetch_array($result2)){
        array_push($bus,$reg["RegNumber"]);
    }
    return $bus;
}
function update_bus($bus,$RegNumber,$pass){

    $query="update bus set `RegNumber`='{$bus -> RegNumber}',`phoneNumber`='{$bus->PhoneNumber}',`NoSeat`={$bus->NoSeat},`Type`='{$bus->Type}',`wifi`= b'{$bus->wifi}',`haveCurtains`= b'{$bus->haveCurtains}' ";

    if($pass==true){
        $query.=" ,`password`=(select password('{$bus->password}')) ";
    }

    $query.="where `RegNumber`='{$RegNumber}'";

    $result=exicute_query($query);
}
function check_pass($reg,$pass){
    $query="select RegNumber from bus WHERE RegNumber='{$reg}' AND password=(select password('{$pass}'))";
    $result=exicute_query($query);
    while($r=mysqli_fetch_array($result)){
        return false;
    }
    return true;
}
function check_reg_num($reg){
    $query="select RegNumber from bus WHERE RegNumber='{$reg}'";
    $result=exicute_query($query);
    while($r=mysqli_fetch_array($result)){
        return true;
    }
    return false;
}
function add_jurney($bus){
    $RegNumber=$bus ->RegNumber;
    $destinies=array();
    $result=exicute_query("select * from busjourney WHERE RegNumber='{$RegNumber}' AND Valid=1");
    $journey=new Busses\Jurney();
    while($journeyInfo=mysqli_fetch_array($result)){
        $ToTownName=mysqli_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["ToTown"]}'"))["TownName"];
        $FromTownName=mysqli_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["FromTown"]}'"))["TownName"];
        $journey->FromTownName=$FromTownName;
        $journey->ToTownName=$ToTownName;
        $journey->RegNumber=$journeyInfo["RegNumber"] ;
        $journey->BusJourneyID=$journeyInfo["BusJourneyID"] ;
        $journey->Duration=$journeyInfo["Duration"] ;
        $journey->FromTown=$journeyInfo["FromTown"] ;
        $journey->RouteID=$journeyInfo["RouteID"] ;
        $journey->ToTown=$journeyInfo["ToTown"] ;

    }
    $bus->journey=$journey;
    return $bus;

}//to the bus
function add_journey($journey){
    $ID=get_ID("busjourney","BusJourneyID");
    $query="INSERT INTO `busjourney` (`BusJourneyID`, `RegNumber`, `RouteID`, `FromTown`, `ToTown`, `Duration`) VALUES
    ('{$ID}', '{$journey->RegNumber}', {$journey->RouteID}, '{$journey->FromTown}', '{$journey->ToTown}', {$journey->Duration})";
    $result=exicute_query($query);
    //return $result;
}
function update_journey($RegNumber,$journey){
    $query1="update busjourney set Valid=0 where RegNumber='{$RegNumber}' and Valid=1";
    $query2="update busjourney set Valid=1 where BusJourneyID='{$journey}'";
    exicute_query($query1);
    exicute_query($query2);

}
function get_all_journey($RegNumber){

    $query="select * from  ";
    $result=exicute_query("select * from busjourney WHERE RegNumber='{$RegNumber}'");
    $Journeys=array();


    while($journeyInfo=mysqli_fetch_array($result)){
        $journey=new Busses\Jurney();
        $ToTownName=mysqli_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["ToTown"]}'"))["TownName"];
        $FromTownName=mysqli_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["FromTown"]}'"))["TownName"];
        $journey->FromTownName=$FromTownName;
        $journey->ToTownName=$ToTownName;
        $journey->RegNumber=$journeyInfo["RegNumber"] ;
        $journey->BusJourneyID=$journeyInfo["BusJourneyID"] ;
        $journey->Duration=$journeyInfo["Duration"] ;
        $journey->FromTown=$journeyInfo["FromTown"] ;
        $journey->RouteID=$journeyInfo["RouteID"] ;
        $journey->ToTown=$journeyInfo["ToTown"] ;
        $journey->valid=$journeyInfo["Valid"] ;
        $journey->Schedules=add_schedule($journey);
        array_push($Journeys,$journey);
    }
    return $Journeys;

}
function add_schedule($Journey){
    $query="select * from schedule WHERE BusJourneyID='{$Journey->BusJourneyID}'";
    $result=exicute_query($query);
    while ($s=mysqli_fetch_array($result)){
        $schedule=new \Busses\Schedule();
        $schedule->ScheduleID=$s["ScheduleID"];
        ;
        $schedule->BusJourneyID=$s["BusJourneyID"];
        $schedule->FromTownID=$s["FromTown"];
        // $s[""];
        $schedule->FromTime=$s["FromTime"];
        $schedule->ToTime=$s["ToTime"];
        $schedule->Valid=$s["Valid"];
        $schedule->FromTownName=mysqli_fetch_array(exicute_query("select TownName from location where TownID='{$s["FromTown"]}'"))["TownName"];

        array_push($Journey->Schedules,$schedule);

    }
    return $Journey;


}
function get_schedule($BusJourneyID)
{
    $query = "select * from schedule WHERE BusJourneyID='{$BusJourneyID}'";
    $result = exicute_query($query);
    $schedules = array();
    while ($s = mysqli_fetch_array($result)) {

        $schedule = new \Busses\Schedule();
        $schedule->ScheduleID = $s["ScheduleID"];;
        $schedule->BusJourneyID = $s["BusJourneyID"];
        $schedule->FromTownID = $s["FromTown"];
        // $s[""];
        $schedule->FromTime = $s["FromTime"];
        $schedule->ToTime = $s["ToTime"];
        $schedule->Valid = $s["Valid"];
        $schedule->FromTownName = mysqli_fetch_array(exicute_query("select TownName from location where TownID='{$s["FromTown"]}'"))["TownName"];

        array_push($schedules, $schedule);

    }
    return $schedules;
}
function add_schedule_to_journey($Scedule){
    $ScheduleID=get_ID("schedule","ScheduleID");
    $query="INSERT INTO `schedule` (`ScheduleID`, `BusJourneyID`, `FromTown`, `FromTime`, `Valid`) VALUES
    ('{$ScheduleID}', '{$Scedule->BusJourneyID}', '{$Scedule->FromTownID}', {$Scedule->FromTime}, b'1');";
    exicute_query($query);
}
function upadte_scheduel($scheduleID,$sts){
    $Valid=0;
    if($sts){
        $Valid=1;
    }
    $query="update  `schedule` set `Valid`=b'{$Valid}' where `ScheduleID`='{$scheduleID}'";
    exicute_query($query);

}
function get_total_income($RegNumber){
    $result=exicute_query("select count(payment) as countt,SUM(payment) as summ from booking where ScheduleID in 
                          (SELECT ScheduleID from schedule where BusJourneyID in 
                          (SELECT BusJourneyID from busjourney where RegNumber='{$RegNumber}'))");
    $income=null;
    if($income=mysqli_fetch_array($result)){
        return $income;
    }
    return $income;
}
function get_whole_income($buses){
    $totincome=array("countt"=>0,"summ"=>0.00);
    foreach ($buses as $bus){
    $income=get_total_income($bus);
    if($income["countt"]!=0) {
        $totincome["countt"]+=$income["countt"];
    }
    if($income["countt"]!=null){
        $totincome["summ"]+=$income["summ"];

    }
    }
    return $totincome;
}
function get_locations(){
    $locations=array();
    $result=exicute_query("select TownID,TownName from location");
    while($r=mysqli_fetch_array($result)){
        array_push($locations,$r);
    }
    return $locations;
}
function get_routes(){
    $routs=array();
    $result=exicute_query("select RouteID from route");
    while($r=mysqli_fetch_array($result)){
        array_push($routs,$r);
    }
    return $routs;
}
function get_ID($table,$column){
    $query="SELECT {$column} from {$table} GROUP BY {$column} DESC limit 1";
    $result=exicute_query($query);
    while ($c=mysqli_fetch_array($result)){
        return((int)$c["{$column}"]+1);
    }
}
function get_route_location(){
    $routs=array();
    $query="select RouteID from route";
    $result=exicute_query($query);
    while ($r=mysqli_fetch_array($result)){
        $route=new \Busses\Route();
        $route->RouteID=$r["RouteID"];
        $route->Locations=get_location_for_route($r["RouteID"]);
        array_push($routs,$route);

    }
    return $routs;
}
function get_location_for_route($routeID){
    $locations=array();
    $query="select TownName,TownID from location NATURAL join(select TownID from routedestination where RouteID={$routeID}) a";
    $result=exicute_query($query);
    while ($l=mysqli_fetch_array($result)){
        $location=new \Busses\Location();
        $location->ID=$l["TownID"];
        $location->Name=$l["TownName"];;
        array_push($locations,$location);
    }
    return $locations;
}
function CheckUser($userName,$password){
    $result = exicute_query("select ID,Name from busowner WHERE UserName='$userName' AND Password=(select password('$password')) limit 1");
    if(!$user=mysqli_fetch_array($result)){
        return false;
    }

    return $user;

}
function check_Authantication($userName,$password){
    $result = exicute_query("select * from user WHERE UserName='$userName' AND Password=(select password('$password')) limit 1");
    if(!$user=mysqli_fetch_array($result)){
        return false;
    }
    return $user;

}
function recursive_array_replace($find, $replace, $array){
    if (!is_array($array)) {
        return str_replace($find, $replace, $array);
    }
    $newArray = array();
    foreach ($array as $key => $value) {
        $newArray[$key] = recursive_array_replace($find, $replace, $value);
    }
    return $newArray;
}
