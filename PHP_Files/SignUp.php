<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 20/12/2016
 * Time: 01:22 AM
 */

session_start();
include_once '../Controller/UserController.php';

include_once '../Modal/PhpClasses.php';
require_once '../Include/header.php';
//include '../Include/beforenav.php';
require_once '../Include/functions.php';
require '../Include/PublicConnect.php';

$userNames=UserController::getAllUsers($conn);
$re=null;
if(isset($_GET['name'])){
    if(isset($_GET['userName']) && isset($_GET['nic']) && isset($_GET['email']) && isset($_GET['password'])){
        $busOwner=new BusOwner(null,$_GET['name'],$_GET['userName'],$_GET['nic'],$_GET['email'],null);
        $busOwner->setPassword($_GET['password']);
        $re=UserController::createBusOwner($conn,$busOwner);
    }else{
        echo "Invalid Data Input For the page";
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/SignUp.css">
    <script src="../JS/jQuery.js"></script>
    <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/SignUp.js"></script>
    <?php
        echo "<script>";
        echo "var userNames=[];";
        foreach ($userNames as $userName){
            echo "userNames.push('".$userName."');";
        }
        if($re=="Suceed"){
            echo "userNames.push('".$_GET['userName']."');";
        }else{
            if($re!=null){
            echo "alert('NIC must be unique')";}
        }
        echo "</script>";

    ?>
</head>
<body>
<div class="container container-table">

    <div class="row vertical-center-row" >
        <H1 class="text-center" style="background-color: #bae3e1;">Bus Owner Registraion Forum</H1>
        <form id="myForm" class="col-md-12" style="padding-top:30px;background-color: #bae6f1;" onsubmit="return submitData()" role="form" action="SignUp.php" method="get" >
            <div class="input-div">
                <div >
                    <div class="col-md-3">
                        <label class="control-label" style="font-size: larger;padding-top: 4px;">Name</label>
                    </div>

                    <div class="input-group col-md-5" style="float: left;">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Your Name">

                    </div>

                    <div class="col-md-3" id="nameCheck"  style="color: red;"></div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="input-div">
                <div >
                    <div class="col-md-3">
                        <label class="control-label" style="font-size: larger;padding-top: 4px;">User Name</label>
                    </div>

                    <div class="input-group col-md-5" style="float: left;">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="userName" type="text" class="form-control" name="userName" placeholder="Unique Name" onkeyup="isUserNameOk();">

                    </div>

                    <div class="col-md-3" id="userNameCheck"  style="color: red;"></div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="input-div">
                <div>
                    <div class="col-md-3">
                        <label class="control-label" style="font-size: larger;padding-top: 4px;">NIC</label>
                    </div>
                    <div class="input-group col-md-4" style="float: left;">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-modal-window"></i></span>
                        <input id="nic" type="text" class="form-control" name="nic" placeholder="Your NIC">
                        <span class="input-group-addon">V</span>
                    </div>
                    <div id="nicCheck" class="col-md-3" style="color: red;"></div>

                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="input-div">
                <div>
                    <div class="col-md-3">
                        <label class="control-label" style="font-size: larger;padding-top: 4px;">Email</label>
                    </div>
                    <div class="input-group col-md-7" style="float: left;">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" type="email" class="form-control" name="email" placeholder="Your Email">
                    </div>
                    <div id="emailCheck" class="col-md-2" style="color: red;"></div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="input-div">
                <div>
                    <div class="col-md-3">
                        <label class="control-label" style="font-size: larger;padding-top: 4px;">Password</label>
                    </div>
                    <div class="input-group col-md-5">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" onkeyup="checkPassword();">
                    </div>
                </div>
            </div>
            <div >
                <div >
                    <div class=" col-md-3">
                        <label class="control-label" style="font-size: larger;padding-top: 4px;">Re Enter Password</label>
                    </div>
                    <div class="input-group col-md-5" style="float: left;">
                        <input id="ReEnterpassword" type="password" class="form-control" name="password" placeholder="Retype Password" onkeyup="checkPassword()">
                        <span id="passwordCorrect" class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>
                    </div>
                    <div id="passwordCheck" class="col-md-2" style="color: red;"></div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="row padding-onSide" style="padding-top: 20px;">
                <strong>Agreement
                </strong>
            </div>
            <div class=" row padding-onSide" >
                <textarea readonly class="col-md-12 " id="agreement" rows="10" >You are obliged to follow your honour code. You cannot create more than the buses you already have. If any change happen you are obliged to update the site with the relevant changes. You must provide responsibility to Bus conductor to update the changes of seat booking simultaneously. Any violation of these regulations or misuse or attempt to misuse may lead to forever banishment from the site.</textarea>
            </div>
            <script type="text/javascript">
                $('#passwordCorrect').hide();

            </script>
            <div class="input-div row" style="padding-top: 20px;">
                <div class="col-md-12 text-right"><strong>Do you agree on the Agreement?</strong>
                    <div class="radio-inline">
                        <label><input id="yesOpt" type="radio" name="optradio" checked onclick="checkSignOption()">Yes</label>
                    </div>
                    <div class="radio-inline">
                        <label><input id=noOpt" type="radio" name="optradio" onclick="checkSignOption()">No</label>
                    </div>
                </div>
            </div>
            <div class="input-div text-right">
                <button id="btnSubmit" type="submit" class="btn btn-danger btn-md"> Sign Up</button>
            </div>

        </form>
    </div>

</div>
</body>
<?php
if($re!=null && $re=="Suceed"){
    echo "<script>alert('Sucessfully BusOwner Created!!');</script>";
}else if($re!=null){
    echo "<script>alert('Sucessfully BusOwner Creation failed!!');</script>";
}
?>
</html>
