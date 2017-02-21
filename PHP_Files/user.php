<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 11:56 AM
 */
$income=get_whole_income($_SESSION["buses"]);
?>
<div class="modal-header">
    <div class="media">
        <div class="media-left">
            <a href="#"><img class = "media-object img-thumbnail img-resize " src="../Image/b4.jpg"  >
            </a>
        </div>
        <div class="media-body"><h2 class="media-heading"><?php echo ($_SESSION["Name"])?></h2>
        </div>
        <div class="media-bottom"><a class=" btn btn-primary btn-sm pull-right btn-edit"  href="Main.php">Edit</a></div>
    </div>

</div><!--modal header-->
<div class="panel panel-primary ">
    <div class="panel-heading" >
        <h2 class="pnl-heading">Sumary</h2>
    </div>
    <div class="panel-body">
        <p><strong>Total Bookings :</strong> <?php echo $income["countt"]?></p>
        <p><strong>Total income :</strong> <?php echo $income["summ"]?></p>
    </div>
    <!--<div class="panel-footer "><a href="#" >more</a></div>-->
</div>
</div><!--end of user detail-->
