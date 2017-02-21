<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 7:24 PM
 *
 */

$locations=get_locations();
$routs=get_routes();

if(isset($_POST["reg-num"])&&check_reg_num($_POST["reg-num"])){
    echo ("<script type='text/javascript'>alert('Register Number Already exists for another bus please check and refill the whole form again :')</script>");
    redirect_to("create.php?invalid=1");
}
//echo ("<script type='text/javascript'>alert('Invalid username password combination!')</script>");
if(isset($_GET["invalid"])&& $_GET["invalid"]==1){
    alert("Invalid Registration: Number Already exists ");
}
if(isset($_POST["Submitted"])){
    //server side form validation
    echo ("<script type='text/javascript'>alert('inside form process :')</script>");
    $bus=new \Busses\Bus();
    $bus->RegNumber=$_POST["reg-num"];
    $bus->OwnerID=$_SESSION["userID"];
    $bus->PhoneNumber=$_POST["number"];
    $bus->NoSeat=$_POST["seats"];
    $bus->Type=$_POST["types"];

    $bus->wifi=0;
    $bus->haveCurtains=0;
    if(isset($_POST["wifi"])){
        $bus->wifi=1;
    }
    if(isset($_POST["curtain"])){
        $bus->haveCurtains=1;
    }
    $bus->journey=null;
    $bus->password=$_POST["pass"];

    $jrny=new \Busses\Jurney();
    $jrny->BusJourneyID;
    $jrny->RegNumber=$bus->RegNumber;
    $jrny->RouteID=$_POST["route"];
    $jrny->FromTown=$_POST["city1"];
    $jrny->ToTown=$_POST["city2"];
    $jrny->Duration=$_POST["Time"];

    $bus->journey=$jrny;
    $result=add_bus($bus);
    redirect_to("more.php?Num={$bus->RegNumber}");



}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 basic-info">
            <form action="create.php" class="form-horizontal" onsubmit="return formValidate2()" method="post">
                <fieldset>
                    <legend>Basic Details</legend>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="reg-num" >Reg.Number</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="reg-num" placeholder="XXX-0000" name="reg-num">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="reg-num" >Phone Number</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="number" id="number" placeholder="Phone number" name="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rout-num">Type</label>
                        <div class="col-sm-4">
                            <select class="form-control"  name="types" id="types" placeholder="select city" onselect="typeSelected()">
                                <option selected hidden>Select</option>
                                <option value="Super-Luxury">Super-Luxury</option>
                                <option value="Luxury">Luxury</option>
                                <option value="Semi-Luxury">Semi-Luxury</option>
                                <option value="Normal">Normal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="seats" name="">Seats</label>
                        <div class="col-sm-3">
                            <select class="form-control"  id="seats" placeholder="select city" onselect="" name="seats">
                                <option selected hidden>Select</option>
                                <option value="53">53</option>
                                <option value="48">48</option>
                                <option value="26">26</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="wifi" type="checkbox" name="wifi"><strong>Wifi</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="curtain" type="checkbox" name="curtain"><strong>Curtian</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <input class="form-control" type="password" id="pass1" name="pass" placeholder="Password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <input class="form-control" type="password" id="pass2" placeholder="Re-Enter Password" >
                        </div>
                    </div>

                    <button class="btn btn-default pull-right" type="submit" name="Submitted" >Update</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>
    function typeSelected(){

    }
    function hideseats($vals){
        var cID=document.getElementById($city);
        var nums=$cID.childElementCount;
        for (var i=1;i<nums;++i){
            cID[i].className="";
        }
        var select=document.getElementById("seats")
        for(var i=0;i<$vals.size;i++){
            select[$vals[i].className=" hidden"];
        }
    }

    function formValidate2(){
        normalize2(document.getElementById("reg-num"));
        normalize2(document.getElementById("pass1"));
        normalize2(document.getElementById("pass2"));
        normalize2(document.getElementById("types"));
        normalize2(document.getElementById("seats"));
        var reg_num=check2(document.getElementById("reg-num"));
        var pass1=check2(document.getElementById("pass1"));
        var pass2=check2(document.getElementById("pass2"));
        var types=checkSelect2(document.getElementById("types"));
        var seats=checkSelect2(document.getElementById("seats"));


        if(reg_num || pass1 || pass2 || types || seats ||  check_passwor2()){
            return false;
        }
    }
    function check2(elmnt){
        if(elmnt.value.toString()==''){
            elmnt.className+=" alert-danger";
            return true;
        }
        return false;
    }
    function checkSelect2(elmnt){
        if(elmnt.selectedIndex==0){
            elmnt.className+=" alert-danger";
            return true;
        }
        return false;
    }
    function normalize2(elmnt) {
        elmnt.className="form-control"
    }
    function check_passwor2() {
        var pa1=document.getElementById("pass1");
        var pa2=document.getElementById("pass2");
        if(pa2.value!=pa1.value){
            pa1.className+=" alert-danger";
            pa2.className+=" alert-danger";
            return true
        }
        return false;
    }

</script>