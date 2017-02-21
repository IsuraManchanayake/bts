<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 10:00 PM
 */
class ScheduleDao
{
    public function add_schedule($Journey,$conn){
        $query="select * from schedule WHERE BusJourneyID=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('s',$Journey->BusJourneyID);
        $stmt->execute();
        $result = $stmt->get_result();
        while($s=$result->fetch_assoc()){
            $schedule=new \Busses\Schedule();
            $schedule->ScheduleID=$s["ScheduleID"];
            $schedule->BusJourneyID=$s["BusJourneyID"];
            $schedule->FromTownID=$s["FromTown"];
            $schedule->FromTime=$s["FromTime"];
            $schedule->ToTime=$s["ToTime"];
            $schedule->Valid=$s["Valid"];
            $schedule->FromTownName=mysql_fetch_array(mysql_query("select TownName from location where TownID='{$s["FromTown"]}'"))["TownName"];
            array_push($Journey->Schedules,$schedule);

        }
        return $Journey;


    }
    public function get_schedule($BusJourneyID,$conn)
    {
        $query = "select * from schedule WHERE BusJourneyID=?";
        $schedules = array();
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('s',$BusJourneyID);
        $stmt->execute();
        $result = $stmt->get_result();
        while($s=$result->fetch_assoc()){
            $schedule = new \Busses\Schedule();
            $schedule->ScheduleID = $s["ScheduleID"];;
            $schedule->BusJourneyID = $s["BusJourneyID"];
            $schedule->FromTownID = $s["FromTown"];
            $schedule->FromTime = $s["FromTime"];
            $schedule->ToTime = $s["ToTime"];
            $schedule->Valid = $s["Valid"];
            $schedule->FromTownName = mysql_fetch_array(mysql_query("select TownName from location where TownID='{$s["FromTown"]}'"))["TownName"];
            array_push($schedules, $schedule);
        }
        return $schedules;
    }
    public function add_schedule_to_journey($Scedule,$conn){
        $ScheduleID=get_ID("schedule","ScheduleID");
        $query="INSERT INTO `schedule` (`ScheduleID`, `BusJourneyID`, `FromTown`, `FromTime`, `Valid`) VALUES(?,?,?,?,b'1');";
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('sssd',$ScheduleID,$Scedule->BusJourneyID,$Scedule->FromTownID,$Scedule->FromTime);
        $stmt->execute();
        if(mysqli_errno()!=null){
            die("Database Error");
        }
    }
    public function upadte_scheduel($scheduleID,$sts,$conn){
        $Valid=0;
        if($sts){
            $Valid=1;
        }
        $query="update  `schedule` set `Valid`=? where `ScheduleID`=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_Param('ds',$Valid,$scheduleID);
        $stmt->execute();
        if(mysqli_errno()!=null){
            die("Database Error");
        }
    }

}