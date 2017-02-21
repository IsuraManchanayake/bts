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
<body><nav class="navbar navbar-inverse navbar-fixed-top">
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
<?php $costs=AdminController::getCostPerKmData($mysqli);  ?>
<div class="container set1" id="addLocation">
    <div class="page-header"><h2 style="color: #2b669a"><u>Change Cost Per Km</u><br><br></h2></div>
    <div class="row">
        <form name="proForm" method="post" class="form-horizontal" onsubmit="return validate()">
            <div class="form-group">
                <label class="col-xs-3 control-label">Super Luxury</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon">Rs</span>
                        <?php echo'<input type="number" class="form-control" name="Su-Lu" value="'.htmlspecialchars($costs[0]->getCostPerKm()).'"/>'; ?>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Luxury</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon">Rs</span>
                        <?php echo'<input type="number" class="form-control" name="Lu" value="'.htmlspecialchars($costs[1]->getCostPerKm()).'"/>';?>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Semi-Luxury</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon">Rs</span>
                        <?php echo'<input type="number" class="form-control" name="Se-Lu" value="'.htmlspecialchars($costs[2]->getCostPerKm()).'" />';?>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Normal</label>
                <div class="col-xs-3 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon">Rs</span>
                        <?php echo'<input type="number" class="form-control" name="No" value="'.htmlspecialchars($costs[3]->getCostPerKm()).'" />';?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-5 col-xs-offset-3">
                    <button type="submit" class="btn btn-default" name="but4">Save Changes</button>
                </div>
            </div>
        </form>
        <?php $_POST = array(); //workaround for broken PHPstorm
        parse_str(file_get_contents('php://input'), $_POST); ?>

        <?php
        if (isset($_POST['but4'])) {
            AdminController::updateCostPerKm($mysqli,$_POST['Su-Lu'],"Super-Luxury");
            AdminController::updateCostPerKm($mysqli,$_POST['Lu'],"Luxury");
            AdminController::updateCostPerKm($mysqli,$_POST['Se-Lu'],"Semi-Luxury");
            AdminController::updateCostPerKm($mysqli,$_POST['No'],"Normal");
        }
        ?>

    </div>
</div>
<script type="text/javascript">
    <!--
    // Form validation code will come here.
    function validate()
    {
        var x=document.forms["proForm"]["Su-Lu"].value;
        var y=document.forms["proForm"]["Lu"].value;
        var z=document.forms["proForm"]["Se-Lu"].value;
        var a=document.forms["proForm"]["No"].value;
        if(  x== "" || isNaN(x) || x>9999)
        {
            alert( "Please provide valid cost to Super Luxury!" );
            document.forms["proForm"]["Su-Lu"].focus() ;
            return false;
        }

        if( y== "" || isNaN(y) || y>9999 )
        {
            alert( "Please provide valid cost to Luxury!" );
            document.forms["proForm"]["Lu"].focus() ;
            return false;
        }
        if( z== "" || isNaN(z) || z>9999 )
        {
            alert( "Please provide valid cost to Semi Luxury!" );
            document.forms["proForm"]["Se-Lu"].focus() ;
            return false;
        }
        if( a== "" || isNaN(a) || a>9999 )
        {
            alert( "Please provide valid cost to Normal!" );
            document.forms["proForm"]["No"].focus() ;
            return false;
        }


        return( true );
    }
    //-->
</script>
</body>
</html>