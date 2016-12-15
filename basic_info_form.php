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
            <form action="more.php" class="form-horizontal">
                <fieldset>
                    <legend>Basic Info Edit</legend>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="reg-num">Reg.Number</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="reg-num" placeholder="Registation number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rout-num">Route Number</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="number" id="rout-num" placeholder="Route number" value="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rout-num">Destinations</label>
                        <div class="col-sm-4">
                            <select class="form-control"  id="city1" placeholder="select city" >
                                <option>colombo</option>
                                <option selected>kurunegala</option>
                                <option>ambalangoda</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control"  id="city2" placeholder="select city" >
                                <option selected>colombo</option>
                                <option >kurunegala</option>
                                <option>ambalangoda</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="seats">Seats</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="number" id="seats" placeholder="Route number" value="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <lable class="col-sm-4 control-label"><strong>Type</strong></lable>
                        <div class="radio col-sm-4">
                            <label>
                                <input name="type" id="luxury" type="radio">
                                Laxury
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
                    </div>

                    <div class="form-group">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="wifi" type="checkbox"><strong>Wifi</strong>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox col-sm-8 col-sm-offset-4">
                            <label>
                                <input id="curtain" type="checkbox"><strong>Curtian</strong>
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
                                <input class="form-control" type="password" id="new-pass-1" placeholder="Enter New Password" >
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" type="password" id="new-pass-1" placeholder="Re-enter New Password" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <input class="form-control" type="password" id="new-pass-1" placeholder="Password" >
                        </div>
                    </div>
                    <button class="btn btn-default pull-right" type="submit">Update</button>



                </fieldset>

            </form>
        </div>
    </div>
</div>
