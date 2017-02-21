<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style type="text/css">
     #banner{
        width:100%;
        position: absolute;
        z-index: -1;
    }
    #search-bar{ 
        display: block;
        position: absolute;
        top:200px;
    }
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
</style>
<?php include '../Include/includes.php'; ?>
<title>Bus Ticketing System</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="row">
        <div class="col-xs-7">
            <a href="index.php" class = "navbar-brand" >Bus Ticketing System </a>
        </div>
        <div class="col-xs-5">
            <form class="navbar-form navbar-left" method="get" action="../PHP_Files/BusLocation.php">
                <div class="form-group">
                    <input type="text" name="RegNumber" class="form-control" placeholder="search the bus live.. ">
                </div>
                <button type="submit" class="btn btn-success"><span>
                <i class="glyphicon glyphicon-search"></i>
            </span>Search
                </button>
            </form>
            <form class="navbar-form navbar-left">
                <a href="../PHP_Files/SignUp.php" class="btn btn-primary">
            <span>
            <i class="glyphicon glyphicon-pencil"></i>
            </span>
                    Sign Up
                </a>
                <a href="../PHP_Files/Login.php" class="btn btn-primary">
            <span>
                <i class="glyphicon glyphicon-log-in"></i>
            </span> Log in</a>
            </form>
        </div>
    </div>
    </nav>



<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="../Image/cover1.png" alt="Chania">
  </div>

  <div class="item">
      <img src="../Image/cover2.png" alt="Chania">
  </div>
</div>

<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>


<div class="container" id = "search-results" style="width: 100%">
<!-- search results come here via search.php -->
</div> <!-- container search-result end-->
</div>
</div> 



<div style="border: 1px solid silver; border-radius: 5px; top: 300px; width: 100%; display: block; position: absolute; background: rgba(255, 255, 255, 0.6">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <div class="row">
                    <div class="col-sm-3 vcenter">
                        <label class="filter-col" for="pref-perpage" style="text-align: center;">From</label>
                    </div><!--
                --><div class="col-sm-9 vcenter">
                <select id="from" class="form-control" style="font-size: 11px">
                    <option selected style="color: silver">select</option>
                    <?php
                    $rows = get_all_location_names();
                    while($row = $rows->fetch_assoc()) {
                        echo "<option>" . $row['townname'] . "</option>";
                    }
                    ?> 
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="row">
            <div class="col-sm-3 vcenter">
                <label class="filter-col" for="pref-perpage" style="text-align: center;">To</label>
                                    </div><!--
                                --><div class="col-sm-9 vcenter">
                                <select id="to" class="form-control" style="font-size: 11px">
                                    <option selected style="color: silver">select</option>
                                    <?php
                                    $rows = get_all_location_names();
                                    while($row = $rows->fetch_assoc()) {
                                        echo "<option>" . $row['townname'] . "</option>";
                                    }
                                    ?>                   
                                </select>
                            </div>
                        </div>  
                    </div>

                    <div class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-3 vcenter">
                                <label class="filter-col" style="text-align: center;">Date</label>
                                    </div><!--
                                --><div class="col-sm-9 vcenter">
                                <input id="date" type="date" style="font-size: 11px"value="<?php echo date("Y-m-d");?>" class="form-control input" id="pref-perpage">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-3 vcenter">
                                <label class="filter-col" style="text-align: center;">Time</label>
                                    </div><!--
                                --><div class="col-sm-9 vcenter">
                                <input id="at" type="time" class="form-control input" style="font-size: 11px" id="pref-perpage">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-3 vcenter">
                                <label class="filter-col" style="text-align: center; font-size: 11px">Bus Type</label>
                                    </div><!--
                                --><div class="col-sm-9 vcenter">
                                <select id="type" class="form-control" style="font-size: 11px">
                                    <option selected style="color: silver">Any</option>
                                    <?php
                                    $rows = get_all_bus_types();
                                    while($row = $rows->fetch_assoc()) {
                                        echo "<option>" . $row['bustype'] . "</option>";
                                    }   
                                    ?>
                                </select> 
                            </div>
                        </div>               
                    </div>


                    <div class="col-sm-2" >    
                        <button class="btn btn-primary" style="width: 100%;" href="#search-results" onclick="search()">
                            <span>
                                <i class="glyphicon glyphicon-search"></i>
                            </span> Search
                        </button>  
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../JS/search.js"></script>
        <script type="text/javascript" src="../JS/filter.js"></script>
    </body>
    </html>