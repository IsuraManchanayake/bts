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
    <div class="page-header"><h2><u>View Routes</u><br><br></h2></div>
    <div class="row">
        <?php

                $Locations=AdminController::getRoutesData($mysqli);

                echo'<table class="table table-condensed table-responsive table-hover table-bordered" style="border:inset">';
                echo'<thead>';
                echo'<tr>';
                echo'<th>Route ID</th>';
                echo'</tr>';
                echo'</thead>';
                echo'<tbody>';


                foreach($Locations as $loc) {
                    echo '<tr style="...">';
                    echo '<td>' . htmlspecialchars($loc->getRouteID()) . '</td>';
                    echo '</tr>';
                }

                echo'</tbody>';
                echo'</table>';



        ?>
</div>
</body>
</html>