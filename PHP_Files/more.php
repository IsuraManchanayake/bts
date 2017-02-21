<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 12:02 PM
 */
?>
<?php include "includes/header.php";include "includes/afternav.php"; include "includes/functions.php";
include "includes/Conect.php";
if(!isset($_GET["Num"])){
    redirect_to("Main.php");
}
if(isset($_SESSION["BusConductor"])){
    if($_SESSION["BusConductor"]!=$_GET["Num"]){
        redirect_to("logout.php");
    }
}else {

    if (!isset($_SESSION["userID"])) {
        redirect_to("logout.php");
    }
    $_SESSION["buses"] = getOwnerBusses($_SESSION["userID"]);
    if (!in_array($_GET["Num"], $_SESSION["buses"])) {
        redirect_to("Main.php");
    }
}
$bus = get_bus($_GET["Num"]);
$bus = add_jurney($bus);
$bus->journey = add_schedule($bus->journey);
$arr = $bus->journey->Schedules;

?>

<div class="row rowedit">
    <div class="col-sm-3 useredit "><!--useredit2-->
        <?php include "user.php "?>
        <div class="col-sm-9 main2 " >
            <div class="row main-row">
                <div class="col-md-6">
                    <?php include "basic_info.php"?>
                </div>
                <div class="col-md-6">
                    <div class="bus-jour" >
                            <h3 class="page-header text-primary text-center"><strong><?php echo"{$bus->journey->RouteID}  -  {$bus->journey->FromTownName} - {$bus->journey->ToTownName}"?></strong></h3>
                        <div class="container-fluid">
                            <div class="">

                                <table class="table">
                                <thead>
                                <tr>
                                    <th >Start Destination</th>
                                    <th >Starting Date</th>
                                    <th >Starting Time</th>
                                    <th >Ending Date</th>
                                    <th >Ending Time</th>
                                    <th >Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                    foreach ($arr as $schedule){
                                        $T1=0;
                                        $T1 =$schedule->FromTime;
                                        $d = new DateTime( date('Y-m-d H:i:s.', $T1) );
                                        $t1=$d->format("H:i:s");
                                        $d1=$d->format("Y:m:d");
                                        $T1 =$schedule->ToTime;
                                        $d = new DateTime( date('Y-m-d H:i:s.', $T1) );
                                        $t2=$d->format("H:i:s");
                                        $d2=$d->format("Y:m:d");
                                        $Status="Active";
                                        if($schedule->Valid==0){
                                            $Status="Not";
                                        }
                                        echo " <tr>
                                        <td>{$schedule->FromTownName}</td>
                                        <td>{$d1}</td>
                                        <td>{$t1}</td>
                                        <td>{$d2}</td>
                                        <td>{$t2}</td>
                                        <td>{$Status}</td>
                                        
                                        </tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                                <a href="create_schedule.php?Num=<?php echo($_GET["Num"]    )?>" class="btn btn-sm btn-default pull-right"> Create</a>
                                <a href="edit_schedule.php?Num=<?php echo($_GET["Num"])?>" class="btn btn-sm btn-default pull-right"> Edit</a>

                            </div>

                        </div>

                    </div>

                </div>
                </div>
            </div>
        </div><!--end of main -->
    </div><!--end of row-->
    <?php include "includes/footer.php";?>

