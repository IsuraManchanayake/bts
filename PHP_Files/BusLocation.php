<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 20/12/2016
 * Time: 12:45 PM
 */
session_start();
include_once '../Controller/ScheduleBookingController.php';

include_once '../Modal/PhpClasses.php';
require_once '../Include/header.php';
//include '../Include/beforenav.php';
require_once '../Include/functions.php';
require '../Include/PublicConnect.php';

if(isset($_GET['RegNumber'])){
    $RegNumber=$_GET['RegNumber'];
    $Time=getActualTime();
    $Point=ScheduleBookingController::getNearestLocation($conn,$RegNumber,$Time);
    $Time=getDayBefore();
    $Schedules=ScheduleBookingController::getNearestTenSchedules($conn,$RegNumber,$Time);
    if($Schedules==null){
        redirect_to("index.php");
    }
}else{
    echo "Invalid Data Input";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 50%;
            margin: auto;
        }
    </style>
</head>
<body style="background-color:#efffef ">

<div class="container-fluid" style="background-color: #eaeaff">


    <div class="row">


        <div id="myCarousel" class="col-md-12 carousel slide" data-ride="carousel"
             style="height: 500px;overflow:hidden;background-color: white">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>

            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="../Resources/Bus_1.png" alt="Chania" width="800px" height=500px>
                </div>

                <div class="item">
                    <img src="../Resources/Bus_2.png" alt="Chania" width="800px" height=500px>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <div class="row"
         style="text-align: center;background-color: #122b40;border-style: solid;border-color: white;border-left-width: 0px;border-right: 0px;">
        <br>
        <span style="text-align: center;color:white;font-size: 30pt;font-weight: 900;">Bus Detail</span>
        <br>
        <br>
    </div>
    <div class="row" style="text-align: center;background-color: #122b40;color:white;font-size:13pt">
        <div class="col-md-2">BE-1922</div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbspSemi Luxiary</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbspWifi</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbspCourtains</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-check"></i>&nbsp53 Seats</span></div>
        <div class="col-md-2"><span><i class="glyphicon glyphicon-earphone"></i>&nbsp&nbsp071-2345423</span></div>

    </div>
    <div class="row" style="padding-top:10px;">
        <h2>Predicted Bus Location</h2>
        <div class="col-md-12">
            <iframe
                width="100%"
                height="550"
                frameborder="0" style="border:0"
                <?php echo "src=\"https://www.google.com/maps/embed/v1/place?key=AIzaSyAUPcMFQBI6x3H5ouZen7cgm_9iSH_87CM
    &q=".$Point."\"";?> allowfullscreen
            >
            </iframe>
        </div>
        <div class="col-md-12">
            <h2>Journy Shedule</h2>
            <table class="table " style="border-color:black">
                <tr class="danger">
                    <th>Date</th>
                    <th>From</th>
                    <th>Time</th>
                    <th>To</th>
                    <th>Time</th>
                </tr>
                <?php
                    if($Schedules!=null){
                        foreach($Schedules as $Schedule){
                            echo "<tr class=\"warning\">";
                            echo "<td>".getDateFromTimeStamp($Schedule->getFromInt())."</td>";
                            echo "<td>".$Schedule->getFromTownName()."</td>";
                            echo "<td>".getTimeFromStringTimeStamp($Schedule->getFromTime())."</td>";
                            echo "<td>".$Schedule->getToTownName()."</td>";
                            echo "<td>".getTimeFromStringTimeStamp($Schedule->getToTime())."</td>";
                            echo "</tr>";
                        }
                    }
                ?>

            </table>
        </div>
        <div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

</div>

</body>
</html>

