<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 7:24 PM
 *
 */

if(!isset($_SESSION["userID"])) {
    redirect_to("logout.php");
}
if(!isset($_GET["Num"])){
    redirect_to("Main.php");
}
if(!in_array($_GET["Num"],$_SESSION["buses"])){
    redirect_to("Main.php");
}
if(isset($_POST["Submitted_Journey"])){
    alert("Journey Submited");
    $routeID=$_POST["route"];
    $FromTownID=$_POST["city1"];
    $ToTownID=$_POST["city2"];
    $Time=$_POST["Time"];
    alert($Time);
    $journey=new \Busses\Jurney();
    $journey->FromTown=$FromTownID;
    $journey->ToTown=$ToTownID;
    $journey->Duration=$Time*60;
    $journey->valid=0;
    $journey->RouteID=$routeID;
    $journey->RegNumber=$_GET["Num"];
    add_journey($journey);
    redirect_to("edit_schedule.php?Num={$_GET["Num"]}");
}

$_SESSION["Routes"]=get_route_location();
//echo ("<script type='text/javascript'>alert('inside form  :')</script>");
$locations=get_locations();
$routs=get_routes();

$script="<script type='text/javascript'>   var table={};";
foreach ($_SESSION["Routes"] as $route){
    $s="var ID{$route->RouteID} = { ";

    foreach ($route->Locations as $loc){
        $t="{$loc->ID}:\"{$loc->Name}\",";
        $s.=$t;
    }
    $s.="};";
    $s.="table[\"{$route->RouteID}\"]=ID{$route->RouteID};";
    $script.=$s;
}

$script.= "</script>";
echo $script;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 basic-info">
            <form action="create_schedule.php?Num=<?php echo($_GET["Num"])?>" class="form-horizontal" onsubmit="return formValidate3()" method="post">
                <fieldset>
                    <legend>Journey Details</legend>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rout-num">Rout Number</label>
                        <div class="col-sm-3">
                            <select class="form-control"  id="route" placeholder="select rout" name="route" onchange="callPHP2()">
                                <option selected hidden>Select</option>
                                <?php
                                foreach ($routs as $rout){
                                    $string="<option class=\"\" value=\"{$rout["RouteID"]}\"";
                                    $string.=">{$rout["RouteID"]}</option>";
                                    echo $string;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rout-num">Destinations</label>
                        <div class="col-sm-4">
                            <select class="form-control"  id="city1" placeholder="select city" name="city1" onchange="city11_selected()">
                                <option selected hidden>Select a City</option>
                                <?php
                                foreach ($locations as $loc){
                                    echo " <option class=\"\" id='{$loc["TownID"]}' value='{$loc["TownID"]}'>{$loc["TownName"]}</option>";
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control"  id="city2" placeholder="select city" name="city2" onchange="city22_selected()" >
                                <option selected hidden>Select a City</option>
                                <?php
                                foreach ($locations as $loc){
                                    echo " <option class=\"\" id='{$loc["TownID"]}' value='{$loc["TownID"]}'>{$loc["TownName"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="reg-num" >Estimated Journey in Minits</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="number" id="Time" placeholder="Estimated Time Amount" name="Time">
                        </div>
                    </div>
                    <button class="btn btn-default pull-right" type="submit" name="Submitted_Journey"  >Update</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>

//

function formValidate3(){
    normalize3(document.getElementById("city2"));
    normalize3(document.getElementById("city1"));
    normalize3(document.getElementById("route"));
    normalize3(document.getElementById("Time"));
    var Time=check3(document.getElementById("Time"));
    var city2=checkSelect3(document.getElementById("city2"));
    var city1=checkSelect3(document.getElementById("city1"));
    var route=checkSelect3(document.getElementById("route"));


    if(Time || city1 || city2 || route  ){
        return false;
    }


}
function check3(elmnt){
    if(elmnt.value.toString()==''){
        elmnt.className+=" alert-danger";
        return true;
    }
    return false;
}
function checkSelect3(elmnt){
    if(elmnt.selectedIndex==0){
        elmnt.className+=" alert-danger";
        return true;
    }
    return false;
}
function normalize3(elmnt) {
    elmnt.className="form-control"
}
function HideAll(){
    $cID1=document.getElementById('city1');
    $cID2=document.getElementById('city2');

    $nums=$cID1.childElementCount;
    for ($i=1;$i<$nums;++$i){
        $cID1[$i].className="";
        $cID2[$i].className="";
        $cID1[$i].className+="hidden";
        $cID2[$i].className+="hidden";
    }
}
    window.onload=HideAll();


    function city11_selected() {
        city1_selected();
        callPHP();
    }
    function city22_selected() {

        city2_selected();
        callPHP();
    }
    function callPHP(){

        callPHP2();

    }
    function callPHP2() {
        HideAll();
        $cID1=document.getElementById('city1');
        $cID2=document.getElementById('city2');
        $nums=$cID1.childElementCount;
        var ID=document.getElementById("route").value;
        var p=table[ID];
        for (var key in p) {
            if (p.hasOwnProperty(key)) {
                for ($i=1;$i<$nums;++$i){
                    if($cID1[$i].id==key){$cID1[$i].className="";}
                    if($cID2[$i].id==key){$cID2[$i].className="";}
                }
            }
        }

    }

</script>