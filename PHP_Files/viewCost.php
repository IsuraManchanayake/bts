<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/vendor/bootstrap-combobox/css/bootstrap-combobox.css">

    <script src="/vendor/bootstrap-combobox/js/bootstrap-combobox.js"></script>

    <title>My Page2</title>
    <?php session_start() ;
    $username=$_SESSION["AdminID"]?>
    <style>
        h2 {
            color: #2b669a;
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
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
<div class="container set1" id="viewCostPerKm">
    <div class="page-header"><h2><u>Statistics</u><br><br></h2></div>
    <h3><u>Cost Per Km<br><br></u></h3>
    <table class="table table-condensed table-responsive table-hover table-bordered" style="border:inset">
        <thead>
        <tr>
            <th>Bus Type</th>
            <th> Cost Per Km: (Rs)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $costs=AdminController::getCostPerKmData($mysqli);
        foreach($costs as $cos){
            echo'<tr style="...">';
            echo'<td>'. htmlspecialchars($cos->getBusType()).'</td>';
            echo'<td>'.htmlspecialchars($cos->getCostPerKm()).'</td>';
            echo'</tr>';

        }?>

        </tbody>
    </table>
</div>

</body>
</html>
