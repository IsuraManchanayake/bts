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
        body{
            height:2100px;
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
    <div class="page-header"><h2><u>View Locations</u><br><br></h2></div>
    <div class="row">
        <?php

        $Locations=AdminController::getLocationsData($mysqli);

        echo'<table class="table table-condensed table-responsive table-hover table-bordered" style="border:inset">';
        echo'<thead>';
        echo'<tr>';
        echo'<th>Town ID</th>';
        echo'<th>Town Name</th>';
        echo'<th>GMAP Link</th>';
        echo'</tr>';
        echo'</thead>';
        echo'<tbody>';


        foreach($Locations as $loc) {
            echo '<tr style="...">';
            echo '<td>' . htmlspecialchars($loc->getTownID()) . '</td>';
            echo '<td>' . htmlspecialchars($loc->getTownName()) . '</td>';
            echo '<td>' . htmlspecialchars($loc->getGMAPLink()) . '</td>';
            echo '</tr>';
        }

        echo'</tbody>';
        echo'</table>';



        ?>
    </div>
        <div class="page-header"><br><br><h2><u>View Location in Google Maps</u><br><br></h2></div>

        <div class="row">
            <form name="proForm" method="post" class="form-horizontal" action="" onsubmit="return validate()">
                <?php $locations = AdminController::getLocationsData($mysqli)  ; ?>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Location with Google Map Link</label>
                    <div class="col-xs-5 selectContainer">
                        <select class="form-control" name="Location1"/>
                        <option value="-1">Choose a Location</option>
                        <?php  foreach($locations as $loc): ?>
                            <option value="<?php echo $loc->getTownName().' '.$loc->getGMAPLink(); ?>"><?php echo $loc->getTownName().' '.$loc->getGMAPLink(); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-xs-offset-3">
                        <input type="submit" data-toggle="modal" data-target="#myModal" name="but1"
                               value="View in Google Maps"/>
                    </div>
                </div>
                </form>
            </div>
    <?php $_POST = array(); //workaround for broken PHPstorm
    parse_str(file_get_contents('php://input'), $_POST); ?>
    <?php

    if (isset($_POST['but1'])) {
        $maker = mysql_real_escape_string($_POST['Location1']);
        $maker2 = substr($maker, strpos($maker, " ") + 1);
        $Location=AdminController::getLocationsDatabylink($mysqli,$maker2);
        $slink = "https://www.google.com/maps/embed/v1/place?key=AIzaSyAlJnzs83F4xXCX1ifVoFte2uKrZWv5X3Y&q=";
        $mlink = $slink . htmlspecialchars($Location->getPosition());

        echo '<div class="page-header"><h2><u>Newly Added Location:  ' . htmlspecialchars($_POST['Location1']) . '</u><br><br></h2></div>';

        echo '<iframe
            width="600"
            height="450"
            frameborder="0" style="border:0"
            src="' . htmlspecialchars($mlink) . '
    " allowfullscreen>
        </iframe>';
    }
    ?>


</body>

<script type="text/javascript">
    <!--
    // Form validation code will come here.
    function validate()
    {
        var x=document.forms["proForm"]["Location1"].value;

        if(  x== "-1" )
        {
            alert( "Please choose a location!" );
            document.forms["proForm"]["Location1"].focus() ;
            return false;
        }



        return( true );
    }
    //-->
</script>
</html>