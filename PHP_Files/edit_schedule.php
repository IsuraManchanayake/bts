<?php
session_start();
include "includes/header.php";include "includes/afternav.php";include "includes/functions.php"; include "includes/Conect.php";
if(!isset($_SESSION["userID"])) {
    redirect_to("logout.php");
}
if(!isset($_GET["Num"])){
    redirect_to("Main.php");
}
if(!in_array($_GET["Num"],$_SESSION["buses"])){
    redirect_to("Main.php");
}
$journeys=get_all_journey($_GET["Num"]);
?>

<div class="row rowedit">
        <div class="col-sm-3 useredit "><!--useredit2-->
            <?php include "user.php "?>
        <div class="col-sm-9 main2 " >
            <?php include "edit_schedule_form.php" ?>
        </div><!--end of main -->
    </div><!--end of row-->
<!--</div><!-- end of container-->

<?php include "includes/footer.php";?>
