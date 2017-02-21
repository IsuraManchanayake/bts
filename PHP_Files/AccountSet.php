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
    ?>
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
                     <?php  echo'<i class="glyphicon glyphicon-user"></i>&nbsp;'.$_SESSION["AdminID"].' <span class="caret"></span></a>';    ?>
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
<div class="container set1">
    <div class="row">
        <div class="col-sm-10">
            <div class="page-header"><h2><u>General Account Settings</u><br><br></h2></div>
            <div class="row">

                <form class="form-horizontal col-sm-8" method="post">


                    <div class="form-group">
                        <label class=" control-label col-sm-2" for="user" style="color: #2e6da4">User Name:</label>
                        <div class="col-sm-10" id="uname">
                            <?php echo'<p class="form-control-static" id="user">'.$_SESSION["AdminID"].'</p>'; ?>
                        </div>
                    </div>


                </form>

                <div class="col-sm-4">
                    <a href="#demo" data-toggle="collapse">Edit</a>
                </div>
            </div>
            <div id="demo" class="collapse">



                <form name="nam" class="form-inline" method="post" onsubmit="return validate()">
                    <div class="form-group" class="col-sm-6">
                        <label for="example" style="width: 180px">Name</label>
                        <input type="text" class="form-control"  placeholder="Enter new name"
                               style="width: 250px" name="namech" />
                    </div>
                    <input type="submit" class="btn btn-primary" style="width: 140px;"  name="changename" id="chn" value="Change Name"/>
                    <button type="" href="#demo" toggle="collapse" class="btn btn-default">Cancel</button>
                </form>

                <?php $_POST = array(); //workaround for broken PHPstorm
                parse_str(file_get_contents('php://input'), $_POST); ?>



                <p><br><br><br></p>
            </div>


            <div class="row">
                <form class="form-horizontal col-sm-8" method="post">
                    <div class="form-group">
                        <label class=" control-label col-sm-2" for="pswd" style="color: #2e6da4">Password:</label>
                        <div class="col-sm-10">
                            <p class="form-control-static" id="pswd">*******</p>
                        </div>
                    </div>
                </form>
                <div class="col-sm-4">
                    <a href="#demo1" data-toggle="collapse">Edit</a>
                </div>
            </div>


            <div id="demo1" class="collapse">
                <form name="pwd" class="form" method="post" onsubmit="return validate()">
                    <div class="form-group" class="col-sm-6">
                        <label for="example0" style="width: 180px">Enter current Password</label>
                        <input type="password" class="form-control"  placeholder="Enter current password"
                               style="width: 250px" name="cpassword"/>
                    </div>


                    <div class="form-group" class="col-sm-6">
                        <label for="example1" style="width: 180px">Password</label>
                        <input type="password" class="form-control"  placeholder="Enter new password"
                               style="width: 250px" name="npassword"/>
                    </div>


                    <div class="form-group" class="col-sm-6">
                        <label for="example4" style="width: 180px">ReEnter Password</label>
                        <input type="password" class="form-control"  placeholder="Enter new password"
                               style="width: 250px" name="ppwd"/>
                    </div>
                    <input type="submit" class="btn btn-primary" style="width: 140px;" value="Change Password" name="chpwd"/>
                    <button type="" href="#demo1" toggle="collapse" class="btn btn-default">Cancel</button>
                </form>


            </div>
        </div>
    </div>
</div>

<?php $_POST = array(); //workaround for broken PHPstorm
parse_str(file_get_contents('php://input'), $_POST); ?>
<?php


if (isset($_POST['changename'])  && !empty($_POST['changename'])) {
    $username=$_SESSION["AdminID"];
    $_SESSION["AdminID"]=$_POST['namech'];
    AdminController::updateUserName($mysqli,$_POST['namech'],$username);
    echo($_SESSION['AdminID']);
}
if (isset($_POST['chpwd'])  && !empty($_POST['chpwd'])) {
    AdminController::updatePassword($mysqli,$_SESSION["AdminID"],$_POST['ppwd']);
}
?>
<script type="text/javascript">
    <!--
    // Form validation code will come here.
    function validate()
    {
        var x=document.forms["nam"]["namech"].value;
        var y=document.forms["pwd"]["cpassword"].value;
        var z=document.forms["pwd"]["npassword"].value;
        var a=document.forms["pwd"]["ppwd"].value;
        if(  x== "" )
        {
            alert( "Please provide User Name to Change!" );
            document.forms["nam"]["namech"].focus() ;
            return false;
        }

        if( y== "" )
        {
            alert( "Please provide current password!" );
            document.forms["pwd"]["cpassword"].focus() ;
            return false;
        }
        if( z== "" )
        {
            alert( "Please provide new Password!" );
            document.forms["pwd"]["npassword"].focus() ;
            return false;
        }
        if( a== "" )
        {
            alert( "Please re enter new password!" );
            document.forms["pwd"]["ppwd"].focus() ;
            return false;
        }

        if( z != a)
         {
         alert( "Password mismatch when reentering." );
         document.forms["pwd"].["npassword"].focus() ;
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