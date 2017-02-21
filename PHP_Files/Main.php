
<?php
session_start();
include "includes/header.php";include "includes/afternav.php";include "includes/functions.php";include "includes/Conect.php";
if(!isset($_SESSION["userID"])){
    redirect_to("logout.php");

}
$_SESSION["buses"]=getOwnerBusses($_SESSION["userID"]);


?>

<div class="row rowedit">
        <div class="col-sm-3 useredit "><!--useredit2-->
            <?php include "user.php "?>
        <div class="col-sm-9 main2 " >
            <?php include "bus_abstrak.php"?>
        </div><!--end of main -->
    </div><!--end of row-->
<!--</div><!-- end of container-->

<?php include "includes/footer.php";?>
