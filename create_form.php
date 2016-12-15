<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 7:24 PM
 */?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 basic-info">
            <form  action="more.php" class="form-horizontal" id="createbus" onsubmit="return formvalidate()" method="post">
                <fieldset>
                    <legend>Add a Bus</legend>

                    <div class="form-group has-warning " >
                        <label class="col-sm-4 control-label" for="reg-num">Reg.Number</label>
                        <div class="col-sm-4">
                            <input class="form-control " type="text" name="reg_num" id="reg-num" placeholder="Registation number" ><span > </span>
                        </div>

                    </div>

                    <div class="form-group has-warning ">
                        <label class="col-sm-4 control-label" for="rout-num">Route Number</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="number" id="rout-num" placeholder="Route number">
                        </div>

                    </div>
                    <div class="form-group has-warning">
                        <label class="col-sm-4 control-label" for="rout-num">Destinations</label>
                        <div class="col-sm-4">
                            <select class="form-control "  id="city1" placeholder="select city" >
                                <option>colombo</option>
                                <option>kurunegala</option>
                                <option>ambalangoda</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control"  id="city2" placeholder="select city" >
                                <option>colombo</option>
                                <option>kurunegala</option>
                                <option>ambalangoda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label class="col-sm-4 control-label" for="seats">Seats</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="number" id="seats" placeholder="Route number" >
                        </div>
                    </div>
                    <div class="form-group has-error">
                        <lable class="col-sm-4 control-label  "><strong class="">Type</strong></lable>
                        <div class="radio col-sm-4 ">
                            <label>
                                <input name="type" id="luxury" type="radio" >
                                <span >Laxury</span>
                            </label>
                        </div>
                        <div class="radio col-sm-4">
                            <label>
                                <input name="type" id="A/C" type="radio">
                                A/C
                            </label>
                        </div>
                        <div class="radio col-sm-4 col-sm-offset-4">
                            <label>
                                <input name="type" id="Semi" type="radio">
                                Semi
                            </label>
                        </div>
                        <div class="radio col-sm-4">
                            <label>
                                <input name="type" id="normal" type="radio">
                                Normal
                            </label>
                        </div>
                        <span class="glyphicon glyphicon-ok form-control-feedback   "></span>
                    </div>

                    <div class="form-group has-warning">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="wifi" type="checkbox"><strong>Wifi</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group has-error">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="curtain" type="checkbox"><strong>Curtian</strong>
                            </label>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                                <input class="form-control" type="password" id="pass-1" placeholder="Enter Password" >
                            </div>
                        </div>

                    <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4">
                                <input class="form-control" type="password" id="pass-1" placeholder="Re-enter Password" >
                            </div>
                    </div>

                    <button class="btn btn-success pull-right" type="submit" onclick="">Create</button>



                </fieldset>

            </form>
        </div>
    </div>
</div>
