<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/9/2016
 * Time: 9:22 PM
 */?>
<nav class="navbar navbar-inverse navbar-fixed-top  ">
    <div class="container">
        <div class = "nav navbar-header">
            <button type = "button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#menue1">
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>

            </button>
            <a href="index.php" class = "navbar-brand" >Home </a>
        </div>

        <div class="collapse navbar-collapse" id = "menue1">
            <ul class = "nav navbar-nav navbar navbar-right  ">
                <span class="mbtm"></span>
                <li>

                    <form action="SignUp.php">
                        <button class = "btn btn-sm btn-warning navbar-btn "  type="submit">Register</button>
                    </form>
                </li>
                <li ><a href="login.php"   >login</a></li>
            </ul>

        </div>
    </div><!--container-->
</nav><!--navbar-->
