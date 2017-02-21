<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>BookMyBus.lk</title>
    <?php session_start() ;
    $username=$_SESSION["AdminID"];
    ?>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        .clickable {
            cursor: pointer;
        }

        .panel-heading span {
            margin-top: -23px;
            font-size: 15px;
            margin-right: -9px;
        }

        a.clickable {
            color: inherit;
        }

        a.clickable:hover {
            text-decoration: none;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 1000px
        }

        /* Set gray background color and 100% height */

        body {
            padding-top: 65px;
            background-image: url("http://pngimg.com/upload/bus_PNG8615.png");
            background-size: 1366px;
            background-repeat: no-repeat;
        }

        .set {
            margin-top: -5px;
            padding-top: 20px;
            /*background-image: url("http://imagescdn.tweaktown.com/content/7/7/7722_50_nvidia-geforce-gtx-1070-titan-performance-under-500.png");*/
            height: 1000px;
            border-radius: 5px;
            width: 100%;
            /*background-color: #4cae4c;*/
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">BOOK MY BUS</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">


            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="margin-right: 20px">
                        <?php  echo'<i class="glyphicon glyphicon-user"></i>&nbsp;'.$username.' <span class="caret"></span></a>';    ?>
                    <ul class="dropdown-menu">
                        <li><a href="AccountSet.php">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="row">
    <div class="col-sm-2">
        <div class="set">
            <div class="panel panel-primary" style="margin: 7.5px">
                <a class="ajax-link" href="#" style="text-decoration: none">
                    <div class="panel-heading clickable" align="center" id="home" style="background-color: #2e6da4">
                        <h3 class="panel-title" style="color: #ffffff ">
                            <i class="glyphicon glyphicon-home "></i>&nbsp;&nbsp;Home</h3>
                        <span class="pull-right "><i class="glyphicon glyphicon-minus"
                                                     style="color: #ffffff;"></i></span>
                    </div>
                </a>
                <div class="panel-body">
                    Redirecting to Home ...
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 7.5px">
                <div class="panel-heading clickable p1" align="center" style="background-color: #2e6da4">
                    <h3 class="panel-title" style="color: #ffffff ">
                        <i class="glyphicon glyphicon-stats "></i>&nbsp;&nbsp;Statistics</h3>
                    <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
                </div>
                <div class="panel-body">
                    <div id="collapse1">
                        <ul class="list-group">
                            <a class="ajax-link" href="VeiwIncome.php" style="text-decoration: none">
                                <li class="list-group-item"> Veiw Income</li>
                            </a>
                            <a  class="ajax-link" href="viewCost.php" style="text-decoration: none" id="uth">
                                <li class="list-group-item">Veiw Cost per Km</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary" style="margin: 7.5px">
                <div class="panel-heading clickable p2" align="center" style="background-color: #2e6da4">
                    <h3 class="panel-title" style="color: #ffffff ">
                        <i class="glyphicon glyphicon-stats "></i>&nbsp;&nbsp;Modify Database</h3>
                    <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
                </div>
                <div class="panel-body">
                    <div id="collapse2">
                        <ul class="list-group">
                            <a class="ajax-link" href="addNewRoute.php" style="text-decoration: none" id="newRoute" >
                                <li class="list-group-item"> Add a new  Route</li>
                            </a>
                            <a class="ajax-link" href="addLocationToRoute.php" style="text-decoration: none" id="locationToRoute">
                                <li class="list-group-item">Add Location to a Route</li>
                            </a>
                            <a class="ajax-link" href="ViewRoutes.php" style="text-decoration: none" id="seeRoute">
                                <li class="list-group-item"> View Routes</li>
                            </a>
                            <a class="ajax-link" href="addNewLocation.php" style="text-decoration: none" id="newLocation">
                                <li class="list-group-item">Define new Location </li>
                            </a>
                            <a class="ajax-link" href="ViewLocations.php" style="text-decoration: none" id="seeLocation">
                                <li class="list-group-item">View Locations </li>
                            </a>
                           <!-- <a class="ajax-link" href="removeBusOwner.php" style="text-decoration: none">
                                <li class="list-group-item">Remove Bus Owner</li>
                            </a>-->
                            <a class="ajax-link" href="ChangeCost.php" style="text-decoration: none">
                                <li class="list-group-item">Change cost per Km</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary" style="margin: 7.5px">

                <div class="panel-heading clickable p3" align="center" style="background-color: #2e6da4">
                    <h3 class="panel-title" style="color: #ffffff;">
                        <i class="glyphicon glyphicon-wrench "></i>&nbsp;&nbsp;Settings</h3>
                    <span class="pull-right "><i class="glyphicon glyphicon-minus" style="color: #ffffff;"></i></span>
                </div>
                <div class="panel-body">
                    <div id="collapse3">
                        <ul class="list-group">
                            <a class="ajax-link" href="AccountSet.php" style="text-decoration: none">
                                <li class="list-group-item">Account Settings</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-10" style="background: rgba(200,200,200,0.15)" id="main" style="height:1500px ">

    </div>

</div>


<script type="text/javascript">
    $(document).on('click', '.panel-heading span.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });
    $(document).on('click', '.panel div.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });
    $(document).ready(function () {
        $('.panel-heading span.clickable').click();
        $('.panel div.clickable').click();
    });


</script>
<script type="text/javascript">
    //It will load content once your page get load
    //$(document).ready(function(){
    //   $("#main").load(this.href);
    //});


    /*$(function () {
        $("#uth").on("click", function () {
            $("#main").load('viewCost.php');
        });

    });
    $(function () {
        $("#newRoute").on("click", function () {
            //$("#main").load('addNewRoute.php');
        });

    });
    $(function () {
        $("#locationToRoute").on("click", function () {
            $("#main").load('addLocationToRoute.php');
        });

    });
    $(function () {
        $("#newLocation").on("click", function () {
            $("#main").load('addNewLocation.php');
        });

    });*/


    /* $(document).ready(function(){
     $("#uth").click(function(){
     $("#main").load(this.href);
     });
     });*/
    /*$('#uth').on("click",function(){
     var url= "veiwCost.php"; //insert your URL
     $.ajax({
     url: url,
     success: function(data){
     $('#uth').html(data); //copy and paste for your special case
     }
     });
     });*/

</script>

<footer class="container-fluid">
    <p><br>Contact US</br>
        <em>Perfetto Solutions</em></p>
</footer>

</body>
</html>