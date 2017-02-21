<?php


if(isset($_POST["Journey"])){
    update_journey($_GET["Num"],$_POST["Journey"]);
}

$bus=get_bus($_GET["Num"]);
$bus=add_jurney($bus);
$journey=$bus->journey;
if(isset($_POST["Add"])){
    $Schedule=new \Busses\Schedule();
    $Schedule->BusJourneyID=$journey->BusJourneyID;
    $Schedule->FromTime=strtotime("{$_POST["date"]} {$_POST["time"]}");
    $Schedule->FromTownID=$_POST["startingCity"];
    $Schedule->Valid=1;
    add_schedule_to_journey($Schedule);
    unset($_POST["Add"]);
}
$schedules=get_schedule($journey->BusJourneyID);
if(isset($_POST["Done"])){
    foreach ($schedules as $schedule){
        $scheduleID=$schedule->ScheduleID;
        upadte_scheduel($scheduleID,isset($_POST["{$scheduleID}"]));
    }
    unset($_POST["Done"]);
    redirect_to("more.php?Num={$_GET["Num"]}");

}


$dom=new DOMDocument();
$dt = new DateTime();
$dt->setDate(2016,10,1);
$dt->setTime(10,11);
$var = strtotime("2000-10-1 10:11");
?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 basic-info">

            <form action="edit_timetable.php?Num=<?php echo $_GET["Num"]?>" class="form-horizontal" onsubmit="" method="post">
                <fieldset>
                    <legend>Select a Journey</legend>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Activate / Deactivate</th>
                            <th>From Town</th>
                            <th>Starting Date</th>
                            <th>Starting Time</th>
                            <th>Ending Date</th>
                            <th>Ending Time</th>

                        </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($schedules as $schedule){
                                echo "<tr><td><label>
                                    <input id=\"{$schedule->ScheduleID}\" type=\"checkbox\" name=\"{$schedule->ScheduleID}\"";
                                if($schedule->Valid==1){
                                    echo " checked ";
                                };
                                "";
                               echo ">
                                    </label></td>";
                                $T1=0;
                                $T1 =$schedule->FromTime;
                                $d = new DateTime( date('Y-m-d H:i:s.', $T1) );
                                $t1=$d->format("H:i:s");
                                $d1=$d->format("Y:m:d");
                                $T1 =$schedule->ToTime;
                                $d = new DateTime( date('Y-m-d H:i:s.', $T1) );
                                $t2=$d->format("H:i:s");
                                $d2=$d->format("Y:m:d");
                                echo " 
                                        <td>{$schedule->FromTownName}</td>
                                        <td>{$d1}</td>
                                        <td>{$t1}</td>
                                        <td>{$d2}</td>
                                        <td>{$t2}</td>
                                        </tr>";
                            }?>
                        </tbody>
                </table>
                </fieldset>
                <div class="container-fluid" style="margin-top: 5px">
                    <button class="btn btn-default pull-right" type="submit" name="Done"  >Done</button>
                </div>

            </form>
                <form class="form-horizontal" onsubmit="return test()" method="post" action="edit_timetable.php?Num=<?php echo $_GET["Num"]?>">
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="#new-password" role="button" data-toggle="collapse" class="btn btn-warning btn-sm">
                            Create New Schedule
                        </a>
                    </div>
                </div>
                    <div class="collapse" id="new-password">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="rout-num">Starting From</label>
                                <div class="col-sm-4">
                                    <select class="form-control"  id="startingCity" placeholder="startingCity" name="startingCity" onchange="city11_selected()">
                                        <?php
                                        $fromTownID=$journey->FromTown;
                                        $fromTown=$journey->FromTownName;
                                        $toTownID=$journey->ToTown;
                                        $toTown=$journey->ToTownName;
                                        echo " <option class=\"\" id='{$fromTownID}' value='{$fromTownID}' selected>{$fromTown}</option>";
                                        echo " <option class=\"\" id='{$toTownID}' value='{$toTownID}' selected>{$toTown}</option>";

                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-sm-offset-4">
                                <input class="form-control" type="date" id="date" name="date"  value="<?php echo date('Y-m-d'); ?>" >
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control" type="time" id="time" name="time" value="00:00" >
                            </div>
                        </div>
                        <div class="container-fluid">
                            <button class="btn btn-warning pull-right" type="submit" name="Add"  >Add</button>
                        </div>

                    </div>
                </form>

        </div>
    </div>
</div>
<script type='text/javascript'>

    function test(){

    }
</script>
