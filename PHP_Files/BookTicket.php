<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 01:10 PM
 */
session_start();
include_once '../Controller/ScheduleBookingController.php';

include_once '../Modal/PhpClasses.php';
require_once '../Include/header.php';
include './includes/beforenav.php';
require_once '../Include/functions.php';
require '../Include/PublicConnect.php';
$booked=false;
if (isSet($_GET['post'])) {
    if (isset($_GET['scheduleID']) && isset($_GET['name']) && isset($_GET['nic']) && isset($_GET['email']) && isset($_GET['payment']) && isset($_GET['fromTown']) && isset($_GET['toTown']) && isset($_GET['selectedSeats'])) {
        $ScheduleID = $_GET['scheduleID'];
        $Name = $_GET['name'];
        $Nic = $_GET['nic'];
        $Email = $_GET['email'];
        $Payment = $_GET['payment'];
        $From = $_GET['fromTown'];
        $To = $_GET['toTown'];
        $SelectedSeats = $_GET['selectedSeats'];
        $Seats = explode(',', $SelectedSeats);
        $booking = new Booking($ScheduleID, $Name, $Nic, $Email, $Payment, $From, $To, $Seats);

        ScheduleBookingController::createBooking($conn, $booking);
        $booked=true;
    } else {

    }
}
if (isset($_GET["ScheduleID"]) && isset($_GET['RouteID']) && isset($_GET['FromTownID']) && isset($_GET['ToTownID'])) {
    $ScheduleID = $_GET['ScheduleID'];
    $RouteID = $_GET['RouteID'];
    $FroTownID = $_GET['FromTownID'];
    $ToTownID = $_GET['ToTownID'];
    $bookingSchedule = ScheduleBookingController::getBookingScheduleFromScheduleID($conn, $ScheduleID);
    $AvailableSeats = ScheduleBookingController::getAvailableSeats($conn, $bookingSchedule->getNoSeats(), $ScheduleID);
    $route = ScheduleBookingController::getRouteLocation($conn, $RouteID, $FroTownID, $ToTownID);
    $cost = 0;
    $cost = ScheduleBookingController::getCostPerKm($conn,$bookingSchedule->getType());
    $images=ScheduleBookingController::getImagesForBus($conn,$bookingSchedule->getRegNumber());

} else {
    if($booked){
        redirect_to("index.php");
    }
    echo "Invalid Data Input";
    die();
}
$locations = $route->getLocations();
if (sizeof($locations) < 2) {
    echo "Invalid Data Input";
    die();
}
$from = $locations[0];
$to = $locations[sizeof($locations) - 1];
if (abs($from->getDistance() - $to->getDistance()) > $bookingSchedule->getDistance()) {
    echo "Invalid Data Input";
    die();
}
$distance = abs($from->getDistance() - $to->getDistance());
$journeyTime = getJourneyTime($bookingSchedule->getDuration(), $bookingSchedule->getFromDistance(), $bookingSchedule->getToDistance(), $from->getDistance(), $to->getDistance(), $bookingSchedule->getDistance(), $bookingSchedule->getFromInt());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/BookTicket.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 50%;
            margin: auto;
        }
    </style>
    <?php
    echo "<script>var availableSeats=[];";

    foreach ($AvailableSeats as $seatNum) {
        echo "availableSeats.push(".$seatNum.");";
    }
    echo "</script>";
    ?>


</head>
<body style="background-color:#ffffff ">
<input type="hidden" id="cost" <?php echo 'value="' . $cost . '"' ?> />
<input type="hidden" id="distance" <?php echo 'value="' . $distance . '"' ?> />

<div class="container-fluid" style="background-color: #ffffff">


    <div class="row">


        <div id="myCarousel" class="col-md-12 carousel slide" data-ride="carousel"
             style="height: 500px;overflow:hidden;background-color: white">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                    $i=0;
                    $st='class="active"';
                    foreach ($images as $image){
                        echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.$st.'></li>';
                        $st="";
                        $i+=1;
                    }
                    if(sizeof($images)==0){
                        echo '<li data-target="#myCarousel" data-slide-to="0" '.$st.'></li>';
                    }
                ?>

            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                $st=' active';
                foreach ($images as $image){
                    echo '<div class="item'.$st.'">
                    <img src="../Image/'.$image.'" alt="Chania" width="800px" height=500px>
                </div>';
                    $st="";
                }
                if(sizeof($images)==0){
                    echo '<div class="item'.$st.'">
                    <img src="../Image/bus.jpg" alt="Chania" width="800px" height=500px>
                </div>';
                    $st="";
                }
                ?>


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
        <span style="text-align: center;color:white;font-size: 30pt;font-weight: 900;">Buy Tickets</span>
        <br>
        <br>
    </div>
    <div class="row" style="text-align: center;background-color: #122b40;color:white;font-size:13pt">
        <div class="col-md-2"><?php echo $bookingSchedule->getRegNumber(); ?></div>
        <div class="col-md-2"><span><i
                    class="glyphicon glyphicon-check"></i>&nbsp<?php echo $bookingSchedule->getType(); ?></span></div>
        <div class="col-md-2"><span><i <?php if ($bookingSchedule->getWifi()) {
                    echo "class='glyphicon glyphicon-check'";
                } else {
                    echo "class='glyphicon glyphicon-remove'";
                } ?>></i>&nbspWifi</span></div>
        <div class="col-md-2"><span><i <i <?php if ($bookingSchedule->getHaveCurtains()) {
                    echo "class='glyphicon glyphicon-check'";
                } else {
                    echo "class='glyphicon glyphicon-remove'";
                } ?>></i>&nbspCourtains</span></div>
        <div class="col-md-2"><span><i
                    class="glyphicon glyphicon-check"></i>&nbsp<?php echo $bookingSchedule->getNoSeats(); ?>&nbsp Seats</span>
        </div>
        <div class="col-md-2"><span><i
                    class="glyphicon glyphicon-earphone"></i>&nbsp&nbsp<?php echo $bookingSchedule->getPhoneNumber(); ?></span>
        </div>

    </div>
    <div class="row" style="padding-top:10px;">

        <div class="col-md-11 col-md-offset-1" style="padding-left: 40px">

            <div class="col-md-12">
                <h2>Bus Journy - <?php echo getJourneyDuration($bookingSchedule->getDuration()); ?></h2>
                <div class="col-md-2 col-md-offset-1" style="text-align: right;"><h3>From:</h3></div>
                <div class="col-md-3"><h3><?php echo $bookingSchedule->getFromTownName(); ?>
                        <br><br><?php echo getTimeFromStringTimeStamp($bookingSchedule->getFromTime()); ?></h3></div>
                <div class="col-md-2 " style="text-align: right;"><h3>To:</h3></div>
                <div class="col-md-3"><h3><?php echo $bookingSchedule->getToTownName(); ?>
                        <br><br><?php echo getTimeFromStringTimeStamp($bookingSchedule->getToTime()); ?></h3></div>


            </div>
            <div class="col-md-12">


                <h2>Your Journy
                    -<?php echo getCallculatedDuration($bookingSchedule->getDuration(), $bookingSchedule->getDistance(), $locations[0]->getDistance(), $locations[sizeof($locations) - 1]->getDistance()) ?> </h2>
                <div class="col-md-2 col-md-offset-1" style="text-align: right;"><h3>From:</h3></div>
                <div class="col-md-3"><h3><?php echo $locations[0]->getTownName(); ?>
                        <br><br><?php echo $journeyTime[0]; ?></h3></div>
                <div class="col-md-2 " style="text-align: right;"><h3>To:</h3></div>
                <div class="col-md-3"><h3><?php $locations = $route->getLocations();
                        echo $locations[sizeof($locations) - 1]->getTownName(); ?>
                        <br><br><?php echo $journeyTime[1]; ?></h3></div>
            </div>
        </div>
        <div>
        </div>
    </div>
    <form role="form" action="BookTicket.php" method="get"  onsubmit="return validateForm()">
        <input type="hidden" id="selectedSeats" name="selectedSeats" value=""/>
        <input type="hidden" id="scheduleID" name="scheduleID" <?php echo 'value="' . $ScheduleID . '"' ?>/>
        <input type="hidden" id="fromTown" name="fromTown" <?php echo 'value="' . $from->getTownID() . '"' ?>/>
        <input type="hidden" id="toTown" name="toTown" <?php echo 'value="' . $to->getTownID() . '"' ?>"/>
        <div class="row">
            <div class="col-md-8">
                <h3>Fill ticket details</h3>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Name</h4></div>
                    <div class="input-group col-md-7">
                        <input class="form-control" type="text" id="name" name="name" placeholder="Your name"
                               style="margin-top:4px;width: 100%"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Email</h4></div>
                    <div class="input-group col-md-7">
                        <input class="form-control" type="email" id="email" name="email" placeholder="Your email"
                               style="margin-top:4px;width: 100%"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <div class="col-md-4">
                            <h4>NIC</h4>
                        </div>
                        <div class="input-group col-md-4" style="float: left;margin-top:4px;">
                            <input id="nic" type="text" class="form-control" name="nic" placeholder="Your NIC">
                            <span class="input-group-addon">V</span>
                        </div>
                        <div id="nicCheck" class="col-md-3" style="color: red;"></div>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4"><h4>From</h4></div>
                    <div class="input-group col-md-6">
                        <h4><?php echo $from->getTownName(); ?></h4>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4"><h4>To</h4></div>
                    <div class="input-group col-md-6">
                        <h4><?php echo $to->getTownName(); ?></h4>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Date</h4></div>
                    <div class="input-group col-md-2">
                        <h4><?php echo getDateFromTimeStamp($bookingSchedule->getFromInt()); ?></h4>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Number of Tickets</h4></div>
                    <div class="input-group col-md-2">
                        <select id="ticketCount" class="btn btn-default form-control"
                                style="width:100%;margin-top: 4px;" onchange="ticketNoSelect()">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="6">10</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Children under 12</h4></div>
                    <div class="input-group col-md-2">
                        <select id="ticketCountChildren" class="btn btn-default form-control"
                                style="width:100%;margin-top: 4px;" onchange="callcualatePayment();">
                            <option value="0" selected>0</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Select Seat Numbers</h4></div>

                    <div class="input-group col-md-2" style="float:left">
                        <select id="availableSeats" class="btn btn-default form-control"
                                style="width:100%;margin-top: 4px;">

                        </select>

                    </div>
                    <div class="col-md-1"><input type="button" class="btn btn-danger" value="Select"
                                                 style="margin-top: 4px" onclick="selectSeat()"/></div>
                    <div style="clear: both"></div>
                </div>
                <div class="col-md-12"
                     style="border-style: solid;border-width: 2px;margin: 20px;margin-top: 4px;margin-bottom: 4px;padding: 0px">
                    <div class="col-md-12"
                         style="padding: 0px;margin: 0px;border-bottom-style: solid;border-bottom-width: 2px;"><h5>
                            &nbsp;Selected Seats.(If want to remove a selected one, click on it)</h5></div>
                    <div id="seatHolder" class="col-md-12" style="height: 100px;padding-left: 20px;padding-top:10px;">

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Journy distance</h4></div>
                    <div class="input-group col-md-3">
                        <h4 id="distance"><?php echo $distance; ?> Km</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Adult price</h4></div>
                    <div class="input-group col-md-3">
                        <h4 id="ticketPrice">
                            Rs. <?php $english_format_number = number_format($cost * $distance, 2, '.', '');
                            echo $english_format_number ?></h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4"><h4>Total Cost</h4></div>
                    <div class="input-group col-md-3">
                        <h4 id="total">Rs. <?php echo $english_format_number ?></h4>
                        <input type="hidden" id="payment" name="payment" value="<?php echo $english_format_number ?>"/>
                    </div>
                </div>

                <div style="text-align: right">
                    <input class="btn btn-danger" type="submit" value="Confirm"/>
                </div>
            </div>
        </div>
        <div class="form-group"><input class="form-control" type="hidden" id="post" name="post" value="1"/></div>

    </form>
    <br>
    <br>
    <br>
</div>
<script type="text/javascript" src="../JS/BookTicket.js"></script>


</body>
</html>
