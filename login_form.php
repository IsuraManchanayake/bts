<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 7:24 PM
 */?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 basic-info" style="margin-top: 50px">
            <form  action="Main.php" class="form-horizontal" id="login" onsubmit="return loginvalidate()" method="post">
                <fieldset>
                    <legend>Login</legend>

                    <div class="form-group has-warning " >
                        <div class="col-sm-8 col-sm-offset-2">
                            <input class="form-control " type="text" name="name" id="name" placeholder="Username" ><span > </span>
                        </div>

                    </div>


                    <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <input class="form-control" type="password" id="pass" placeholder="Password" >
                            </div>
                    </div>

                    <button class="btn btn-success btn-sm pull-right" type="submit" onclick="">Login</button>



                </fieldset>

            </form>
        </div>
    </div>
</div>
