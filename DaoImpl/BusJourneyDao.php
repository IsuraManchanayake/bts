<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:00 PM
 */
class BusJourneyDao
{
    public function add_jurney($bus,$conn){
        $RegNumber=$bus ->RegNumber;
        $journey=new Busses\Jurney();
        $query="select * from busjourney WHERE RegNumber=? AND Valid=1";
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('s',$RegNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        while($journeyInfo=$result->fetch_assoc()){
            $ToTownName=mysql_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["ToTown"]}'"))["TownName"];
            $FromTownName=mysql_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["FromTown"]}'"))["TownName"];
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

    public function add_journey($journey,$conn){
        $ID=$this->get_ID("busjourney","BusJourneyID");
        $query="INSERT INTO `busjourney` (`BusJourneyID`, `RegNumber`, `RouteID`, `FromTown`, `ToTown`, `Duration`) VALUES(?,?,?,?,?,?)";
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('ssdssd',$ID,$journey->RegNumber,$journey->RouteID,$journey->FromTown,$journey->ToTown,$journey->Duration);
        $stmt->execute();
        if(mysqli_errno($conn)!=null){
            die("database error");
        }
    }
    public function update_journey($RegNumber,$journey,$conn){

        $query1="update busjourney set Valid=0 where RegNumber='{$RegNumber}' and Valid=1";
        $query2="update busjourney set Valid=1 where BusJourneyID='{$journey}'";
        mysqli_query($query1);
        mysqli_query($query2);

    }
    public function get_all_journey($RegNumber,$conn){
        $query=exicute_query("select * from busjourney WHERE RegNumber='{$RegNumber}'");
        $Journeys=array();
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('s',$RegNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        while($journeyInfo=$result->fetch_assoc()){
            $journey=new Busses\Jurney();
            $ToTownName=mysql_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["ToTown"]}'"))["TownName"];
            $FromTownName=mysql_fetch_array(exicute_query("select TownName from location where TownID='{$journeyInfo["FromTown"]}'"))["TownName"];
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
    function get_ID($conn){
        $query="SELECT `BusJourneyID` from `busjourney` GROUP BY `BusJourneyID` DESC limit 1";
        //$result=exicute_query($query);
        $stmt=$conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        while($c=$result->fetch_assoc()){
            return((int)$c["BusJourneyID"]+1);
        }
    }
}