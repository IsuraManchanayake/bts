<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 7:24 PM
 *
 */
//$_SESSION["Routes"]=get_route_location();
////echo ("<script type='text/javascript'>alert('inside form  :')</script>");
//$locations=get_locations();
//$routs=get_routes();
//
//$script="<script type='text/javascript'>   var table={};";
//foreach ($_SESSION["Routes"] as $route){
//    $s="var ID{$route->RouteID} = { ";
//
//    foreach ($route->Locations as $loc){
//        $t="{$loc->ID}:\"{$loc->Name}\",";
//        $s.=$t;
//    }
//    $s.="};";
//    $s.="table[\"{$route->RouteID}\"]=ID{$route->RouteID};";
//    $script.=$s;
//}
//
//$script.= "</script>";
//echo $script;
$journeys=get_all_journey($_GET["Num"]);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 basic-info">
            <form action="edit_timetable.php?Num=<?php echo $_GET["Num"]?>" class="form-horizontal" onsubmit="" method="post">
                <fieldset>
                    <legend>Select a Journey</legend>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control"  id="route" placeholder="select rout" name="Journey" onchange="">
                                <?php
                                foreach ($journeys as $journey){
                                    $string="<option class=\"\" value=\"{$journey->BusJourneyID}\"";
                                    if($journey->valid==1){
                                        $string.=" selected ";
                                    }
                                    $string.=">{$journey->RouteID} - {$journey->FromTownName} - {$journey->ToTownName}</option>";
                                    echo $string;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-default pull-right" type="submit" name="Submitted"  >Select</button>
                </fieldset>

            </form>
        </div>
    </div>
</div>
