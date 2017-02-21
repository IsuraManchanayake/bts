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
    $bus=get_bus($_GET["Num"]);
    $bus=add_jurney($bus);
    if(isset($_POST["Submitted"]) && check_pass($_SESSION["CurrentBus"],$_POST["pass2"]) ){

        $newbus=$bus;
        $newbus->RegNumber=$_POST["reg_num"];
        $newbus->PhoneNumber=$_POST["number"];
        $newbus->NoSeat=$_POST["seats"];
        $newbus->Type=$_POST["types"];
        $newbus->wifi=0;
        $newbus->haveCurtains=0;
        if(isset($_POST["wifi"])){
            $newbus->wifi=1;
        }
        if(isset($_POST["curtain"])){
            $newbus->haveCurtains=1;
        }

        if($_POST["pass1"]!=''&& $_POST["pass2"]!=''){

            $newbus->password=$_POST["pass1"];

            update_bus($newbus,$_SESSION["CurrentBus"],true);

        }else{
            echo ("<script type='text/javascript'>alert('fignirn123')</script>");
            echo ("<script type='text/javascript'>alert('fignirn')</script>");
            update_bus($newbus,$_SESSION["CurrentBus"],false);
        }
        $_SESSION["CurrentBus"]=$_POST["reg_num"];
        $_POST = array();
        redirect_to("more.php?Num={$_SESSION["CurrentBus"]}");



    }
    else{
     alert("not submitted");
    }
//    else{
//        redirect_to("edit.php?Num={$_SESSION["CurrentBus"]}");
//    }

//onsubmit=" return formValidate2()"
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 basic-info">
            <form action="edit.php?Num=<?php echo $_GET["Num"];?>" class="form-horizontal"  method="post" onsubmit="return formValidate2()">
                <fieldset>
                    <legend>Basic Info Edit</legend>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="reg-num">Reg.Number</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="reg-num" placeholder="Registration number" name="reg_num" value="<?php echo $_SESSION["CurrentBus"]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="reg-num">Contact Number</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="number" id="number" placeholder="Phone number" name="number" value="<?php echo $bus->PhoneNumber?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rout-num">Seats</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="seats" id="seats" placeholder="select city" onselect="">
                                <option <?php if($bus->NoSeat=="53"){echo "selected";}?> value="53">53</option>
                                <option <?php if($bus->NoSeat=="48"){echo "selected";}?> value="48">48</option>
                                <option <?php if($bus->NoSeat=="26"){echo "selected";}?> value="26">26</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rout-num">Type</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="types" id="types" placeholder="select city" onselect="">
                                <option <?php if($bus->Type=="Super-Luxury"){echo "selected";}?> value="Super-Luxury">Super-Luxury</option>
                                <option <?php if($bus->Type=="Luxury"){echo "selected";}?> value="Luxury">Luxury</option>
                                <option <?php if($bus->Type=="Semi-Luxury"){echo "selected";}?> value="Semi-Luxury">Semi-Luxury</option>
                                <option <?php if($bus->Type=="Normal"){echo "selected";}?> value="Normal">Normal</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="wifi" type="checkbox" <?php if($bus->wifi=="1"){echo "checked";}?> ><strong>Wifi</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="curtain" type="checkbox" <?php if($bus->haveCurtains=="1"){echo  "checked";}?>><strong>Curtian</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <a href="#new-password" role="button" data-toggle="collapse" class="btn btn-warning btn-sm">
                                Edit Password
                            </a>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="collapse" id="new-password">
                            <div class="col-sm-6">
                                <input class="form-control " type="password" id="pass1" name="pass1" placeholder="Enter New Password" >
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" type="password" id="pass2" name="pass2" placeholder="Re-enter New Password" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <input class="form-control" type="password" id="pass" name="pass" placeholder="Password" >
                        </div>
                    </div>
                    <button class="btn btn-default pull-right" type="submit" name="Submitted">Update</button>



                </fieldset>

            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>
    function formValidate2(){
        normalize4(document.getElementById("reg-num"));
        normalize4(document.getElementById("pass"));
        normalize4(document.getElementById("pass1"));
        normalize4(document.getElementById("pass2"));


        var reg_num=check4(document.getElementById("reg-num"));
        var pass=check4(document.getElementById("pass"));
        check_password2();

        if(reg_num || pass || check_password2()){
            return false;
        }


    }
    function check4(elmnt){
        if(elmnt.value.toString()==''){
            elmnt.className+=" alert-danger";
            return true;
        }
        return false;
    }

    function normalize4(elmnt) {
        elmnt.className="form-control"
    }
    function check_password2() {
        var pa1=document.getElementById("pass1");
        var pa2=document.getElementById("pass2");
        if(pa2.value!=pa1.value){
            alert("inside password");
            pa1.className+=" alert-danger";
            pa2.className+=" alert-danger";
            return true
        }
        return false;
    }



</script>
