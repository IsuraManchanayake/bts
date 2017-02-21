<?php
/**
 * Created by PhpStorm.
 * User: acer v5
 * Date: 12/18/2016
 * Time: 11:22 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Include Bootstrap Combobox -->

    <title>Title</title>
    <style type="text/css">
        .set1 {
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
                        <i class="glyphicon glyphicon-user"></i>&nbsp;User Name <span class="caret"></span></a>
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
        <form name="proForm" method="post" class="form-horizontal" action="" onsubmit="return validate()">
            <div class="form-group">
                <label class="col-xs-3 control-label">Location</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <input type="text" class="form-control" name="location1"/>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Google MAP Link</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <input type="text" class="form-control" name="link"/>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Lat. Lon. Posistion</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <input type="text" class="form-control" name="pos"/>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-5 col-xs-offset-3">
                    <input type="submit" data-toggle="modal" data-target="#myModal" name="but1"
                           value="Add Location to DB"/>
                </div>
            </div>
        </form>


    </div>


    <?php $_POST = array(); //workaround for broken PHPstorm
    parse_str(file_get_contents('php://input'), $_POST); ?>


    <?php
    if (isset($_POST['but1'])) {
        AdminController::insertLocation($mysqli, $_POST['location1'], $_POST['link'],$_POST['pos']);
        $Locations=AdminController::getLocationsData($mysqli);
        $slink="https://www.google.com/maps/embed/v1/place?key=AIzaSyAlJnzs83F4xXCX1ifVoFte2uKrZWv5X3Y&q=";
        $mlink=$slink.htmlspecialchars($_POST['pos']);

        echo'<div class="page-header"><h2><u>Newly Added Location:  '.htmlspecialchars($_POST['location1']).'</u><br><br></h2></div>';

        echo'<iframe
            width="600"
            height="450"
            frameborder="0" style="border:0"
            src="'.htmlspecialchars($mlink).'
    " allowfullscreen>
        </iframe>';





        echo'<div class="page-header"><h2><u><br><br>Locations in Database</u><br><br></h2></div>';


        echo'<table class="table table-condensed table-responsive table-hover table-bordered" style="border:inset">';
        echo'<thead>';
        echo'<tr>';
        echo'<th style="background-color: #2aabd2">Town ID</th>';
        echo'<th style="background-color: #2aabd2">Town Name</th>';
        echo'<th style="background-color: #2aabd2"> GMAP Link</th>';
        echo'</tr>';
        echo'</thead>';
        echo'<tbody>';

        foreach($Locations as $loc) {
            echo '<tr style="...">';
            echo '<td style="background-color:#b9def0">' . htmlspecialchars($loc->getTownID()) . '</td>';
            echo '<td style="background-color: #c4e3f3">' . htmlspecialchars($loc->getTownName()) . '</td>';
            echo '<td>' . htmlspecialchars($loc->getGMAPLink()) . '</td>';
            echo '</tr>';
        }

        echo'</tbody>';
        echo'</table>';
        //insert moddals
    }
    ?>


</div>

<script type="text/javascript">
    $('select').select2();
</script>
<script type="text/javascript">
    <!--
    // Form validation code will come here.
    function validate()
    {
        var x=document.forms["proForm"]["location1"].value;
        var y=document.forms["proForm"]["link"].value;
        var z=document.forms["proForm"]["pos"].value;
        if(  x== "" )
        {
            alert( "Please provide Town Name!" );
            document.forms["proForm"]["location1"].focus() ;
            return false;
        }

        if( y== "" )
        {
            alert( "Please provide GMAP Link!" );
            document.forms["proForm"]["link"].focus() ;
            return false;
        }
        if(z== "" )
        {
            alert( "Please provide position!" );
            document.forms["proForm"]["pos"].focus() ;
            return false;
        }

        /*if( document.myForm.Zip.value == "" ||
            isNaN( document.myForm.Zip.value ) ||
            document.myForm.Zip.value.length != 5 )
        {
            alert( "Please provide a zip in the format #####." );
            document.myForm.Zip.focus() ;
            return false;
        }

        if( document.myForm.Country.value == "-1" )
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
