<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 3:57 PM
 *
 */
$bus=get_bus($_GET["Num"]);
$bus=add_jurney($bus);
$wifi="No";
$curtain="No";
if ($bus->haveCurtains==1){
    $curtain="Yes";
}
if($bus->wifi==1){
    $wifi="Yes";
}
?>
<div class="main-details">
    <h1 class="page-header text-center text-primary"><?php echo $bus->RegNumber;?></h1>
    <img src="../Image/b4.jpg" class="img-responsive img-thumbnail center-block">
    <div class="container-fluid"><button class="btn center-block btn-sm">Change</button></div>
    <div class="container-fluid">
        <div class="">
            <form class="form-horizontal" action="edit.php">
                <fieldset>
                    <legend >Basic Info</legend>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" >Phone No</label>
                        <div class="col-sm-4"><p class="form-control-static"><?php echo $bus->PhoneNumber;?></p></div>

                    </div>
<!--                    <div class="form-group">-->
<!--                        <label class="col-sm-4 control-label" >Route</label>-->
<!--                        <div class="col-sm-4"><p class="form-control-static">--><?php //echo  $bus->journey->ToTownName;?><!--</p></div>-->
<!--                        <div class="col-sm-4"><p class="form-control-static">--><?php //echo $bus->journey->FromTownName;?><!--</p></div>-->
<!---->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label class="col-sm-4 control-label" >Route No</label>-->
<!--                        <div class="col-sm-4"><p class="form-control-static">--><?php //echo $bus->journey->RouteID;?><!--</p></div>-->
<!---->
<!--                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" >Bus Type</label>
                        <div class="col-sm-4"><p class="form-control-static"><?php echo $bus->Type;?></p></div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" >Total Seats</label>
                        <div class="col-sm-4"><p class="form-control-static"><?php echo $bus->NoSeat;?></p></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" >Has curtain</label>
                        <div class="col-sm-4"><p class="form-control-static"><?php echo $curtain?></p></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" >Has Wifi</label>
                        <div class="col-sm-4"><p class="form-control-static"><?php echo $wifi?></p></div>
                    </div>
                    <a href='edit.php?Num=<?php echo $bus->RegNumber;?>' class="btn btn-info pull-right" style="margin-bottom: 10px" name="more" value="{$bus->RegNumber}\">Edit Info</a>

                </fieldset>


            </form>
        </div>

    </div>

</div>
