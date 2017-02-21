
<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/9/2016
 * Time: 9:13 PM
 */
?>
<nav class="navbar navbar-inverse navbar-fixed-top   ">
    <div class="container-fluid">
        <div class = "nav navbar-header">
            <button type = "button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#menue1">
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>

            </button>
            <a href="Main.php" class = "navbar-brand" >Home </a>
        </div>

        <div class="collapse navbar-collapse" id = "menue1">
            <ul class = "nav navbar-nav navbar navbar-right  ">
                <li class="mbtm">
                    <button class = "btn btn-sm btn-danger navbar-btn " href="#">Remove a Bus </button>
                </li>
<!--                <span class="mbtm"></span>-->
                <li>
                    <form action="create.php">
                        <button class = "btn btn-sm btn-success navbar-btn "  type="submit">Add a Bus </button>
                    </form>

                </li>
                <li ><a href="logout.php">logout</a></li>
            </ul>

        </div>
    </div><!--container-->
</nav><!--navbar-->