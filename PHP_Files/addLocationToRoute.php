<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Include Bootstrap Combobox -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <title>Title</title>
    <?php session_start() ;
    $username=$_SESSION["AdminID"]?>
    <style type="text/css">
        /* Adjust feedback icon position */
        #productForm .selectContainer .form-control-feedback,
        #productForm .inputGroupContainer .form-control-feedback {
            right: -15px;
        }
        .set1{
            margin-top: -5px;
            padding-top: 20px;
        }
    </style>
   <?php include_once '../Controller/AdminController.php'?>
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
            <ul class="nav navbar-nav">
                <li class="active"><a href="index1.php"><i class="glyphicon glyphicon-arrow-left"></i>back</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container set1" id="addLocation">
    <div class="page-header"><h2><u>Add new Location to a route</u><br><br></h2></div>
    <div class="row">
        <form name="proForm" method="post" class="form-horizontal"  onsubmit="return validate()">
            <?php $Routes=AdminController::getRoutesData($mysqli) ?>
            <div class="form-group">
                <label class="col-xs-3 control-label">Route</label>
                <div class="col-xs-5 selectContainer">
                    <select class="form-control" name="routeID" id="router">
                        <option value="-1">Choose a Route</option>
                        <?php foreach($Routes as $rout): ?>
                            <option value="<?php echo $rout->getRouteID(); ?>"><?php echo $rout->getRouteID(); ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <?php $locations = AdminController::getLocationsData($mysqli)  ; ?>
            <div class="form-group">
                <label class="col-xs-3 control-label">Location</label>
                <div class="col-xs-5 selectContainer">
                    <select class="form-control" name="Location1"/>
                    <option value="-1">Choose a Location to add</option>
                    <?php  foreach($locations as $loc): ?>
                        <option value="<?php echo $loc->getTownName().'     '.$loc->getGMAPLink(); ?>"><?php echo $loc->getTownName().'     '.$loc->getGMAPLink(); ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Distance</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <input type="number" class="form-control" name="Distance1" />
                        <span class="input-group-addon">Km</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-5 col-xs-offset-3">
                    <button type="submit" class="btn btn-default" name="but3" onclick="">Add Location to Route</button>
                </div>
            </div>





        </form>

        <?php $_POST = array(); //workaround for broken PHPstorm
        parse_str(file_get_contents('php://input'), $_POST); ?>

        <?php
        if (isset($_POST['but3'])) {
            if (isset($_POST['routeID']) && isset($_POST['Location1'])) {
                $maker = mysqli_real_escape_string($_POST['routeID']);
                $maker2 = mysqli_real_escape_string($_POST['Location1']);
                AdminController::insertLocationToRoute($mysqli, $maker,strtok($maker2,' '), $_POST['Distance1']);
                echo'<h3><u>Modified Route '.htmlspecialchars($maker).'<br><br></u></h3>';
                $Locations=AdminController::getLocationDataOnRoute($mysqli,$_POST['routeID']);

                echo'<table class="table table-condensed table-responsive table-hover table-bordered" style="border:inset">';
                echo'<thead>';
                echo'<tr>';
                echo'<th>Town Name</th>';
                echo'<th> Distance</th>';
                echo'</tr>';
                echo'</thead>';
                echo'<tbody>';


                foreach($Locations as $loc) {
                    echo '<tr style="...">';
                    echo '<td>' . htmlspecialchars($loc[0]) . '</td>';
                    echo '<td>' . htmlspecialchars($loc[1]) . '</td>';
                    echo '</tr>';
                }

                echo'</tbody>';
                echo'</table>';

            }
        }
        ?>



    </div>
</div>
<script type="text/javascript">
    $('select').select2();
</script>
<script type="text/javascript">
    <!--
    // Form validation code will come here.
    function validate()
    {
        var x=document.forms["proForm"]["routeID"].value;
        var y=document.forms["proForm"]["Location1"].value;
        var z=document.forms["proForm"]["Distance1"].value;
        if(  x<0 )
        {
            alert( "Please select a Route!" );
            document.forms["proForm"]["routeID"].focus() ;
            return false;
        }

        if( y<0 )
        {
            alert( "Please select a Location!" );
            document.forms["proForm"]["Location1"].focus() ;
            return false;
        }

        if( z == "" ||
         isNaN(z ) ||
         z.length > 3 )
         {
         alert( "Please provide a distance less than 999!" );
             document.forms["proForm"]["Distance1"].focus() ;
         return false;
         }

         /*if( document.myForm.Country.value == "-1" )
         {
         alert( "Please provide your country!" );
         return false;
         }*/
        return( true );
    }
    //-->
</script>

</body>
</html>