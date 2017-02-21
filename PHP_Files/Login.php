<?php session_start();?>
<?php include "includes/header.php";
include "includes/beforenav.php";
include "includes/Conect.php";
include "includes/functions.php";
include "includes/authenticate.php";//this code will authenticate all users;
?>



<div class="row rowedit">

    <div class="col-sm-12 main2 " >

        <?php include "login_form.php"?>

    </div><!--end of main -->

</div><!--end of row-->
<!--</div><!-- end of container-->

<?php include "includes/footer.php";?>
