<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
         #banner{
            width:100%;
            position: absolute;
            z-index: -1;
           }
          #container{ 
            display: block;
            position: absolute;
            top:200px;
            right: 0px
            padding:20px;
            width: 100%;
            }
    </style>
<?php include('includes/queries.php'); ?>
    <title>Title</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top   ">

    <div class="container-fluid">
        <div class = "nav navbar-header">
            <button type = "button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#menue1">
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>

            </button>
            <a href="index.php" class = "navbar-brand" >Bus Ticketing System </a>
            
        </div>
        <div class=""></div>
        <div class="collapse navbar-collapse" id = "menue1">
            <ul class = "nav navbar-nav navbar navbar-right  ">
                <span class="mbtm"></span>
                <li>
                    <button class = "btn btn-sm btn-warning navbar-btn "  href="#">Register</button>
                </li>
                <li ><a href="#"   >login</a></li>
            </ul>

        </div>
    </div><!--container-->
</nav><!--navbar-->


<div id = "top">
<div id="banner">
<img class="home banner" src="2.jpg" style="width: 100%">
<img class="home banner" src="6.jpg" style="width: 100%">
<img class="home banner" src="1.jpg" style="width: 100%">
<img class="home banner" src="4.jpg" style="width: 100%">
<img class="home banner" src="5.jpg" style="width: 100%">

<script type="text/javascript">
    var slideIndex = 0;
    carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("home banner");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
<div class="col-sm-9 main2 " >
                <div class=""><div class="panel panel-success center">
                    <div class="panel-heading ">
                        <div class="container-fluid">
                            <p><h2 class="">NW-1402 <span class="text-muted"><button class="btn btn-danger pull-right">Suspend</button></span></h2></p>
                        </div>
                        <div class="container-fluid"><span class="text-muted">Active</span></div>
                    </div>
                    <div class="panel-body ">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="images\bus.jpg" class="img-resize img-rounded img-bus">
                                </div>
                                <div class="col-xs-8">
                                    <form action="template.html" class="form-horizontal" >
                                        <div class="form-group">
                                            <strong><span class="text-info">Route :</span></strong> <span class="text-muted">Ambalangoda- Colombo</span>
                                        </div>
                                        <div class="form-group">
                                            <strong><span class="text-info">Route NO :</span></strong> <span class="text-muted">02</span>
                                        </div>
                                        <div class="form-group">
                                            <strong><span class="text-info">Total bookings :</span></strong> <span class="text-muted">30</span>
                                        </div>
                                        <div class="form-group">
                                            <strong><span class="text-info">Total income :</span></strong> <span class="text-muted">1000.00</span>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right">More</button>


                                    </form>
                                </div>
                            </div>
                    </div>
                        </div>
                    <div class="panel-footer panel-success"></div>

                </div></div>
                <div class=""><div class="panel panel-danger center">
                    <div class="panel-heading ">
                        <div class="container-fluid">
                            <?php
                                test1($mysqli);
                                ?>
                            <p><h2 class="">NW-1402 <span class="text-muted"><button class="btn btn-success pull-right">Activate</button></span></h2></p>
                        </div>
                        <div class="container-fluid"><span class="text-muted">Suspended</span></div>


                    </div>
                    <div class="panel-body panel-danger">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="images\bus.jpg" class="img-resize img-rounded img-bus">
                                </div>
                                <div class="col-xs-8">
                                    <form action="template.html" class="form-horizontal" >
                                        <div class="form-group">
                                            <strong><span class="text-info">Route :</span></strong> <span class="text-muted">Ambalangoda- Colombo</span>
                                        </div>
                                        <div class="form-group">
                                            <strong><span class="text-info">Route NO :</span></strong> <span class="text-muted">02</span>
                                        </div>
                                        <div class="form-group">
                                            <strong><span class="text-info">Total bookings :</span></strong> <span class="text-muted">30</span>
                                        </div>
                                        <div class="form-group">
                                            <strong><span class="text-info">Total income :</span></strong> <span class="text-muted">1000.00</span>
                                        </div>

                                        <button type="submit" class="btn btn-info pull-right">More</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--<p><strong>Total Bookings :</strong> 10</p>-->
                        <!--<p><strong>Total income :</strong> 1000</p>-->
                    </div>
                    <div class="panel-footer panel-danger"></div>
                </div></div>
            </div><!--end of main -->
        </div><!--end of row-->
    </div><!-- end of container-->
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
</div>


<div id="container">
    <div class="row">
        <div id="filter-panel">
            <div class="panel panel-default" >
                <div class="panel-body">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">From : </label>
                            <select id="pref-perpage" class="form-control">
                                <option selected style="color: silver">select</option>
                                <?php
                                    $rows = get_all_location_names($mysqli);
                                    while($row = $rows->fetch_assoc()) {
                                        echo "<option>" . $row['townname'] . "</option>";
                                    }
                                ?> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">To : </label>
                            <select id="pref-perpage" class="form-control">
                                <option selected style="color: silver">select</option>
                                <?php
                                    $rows = get_all_location_names($mysqli);
                                    while($row = $rows->fetch_assoc()) {
                                        echo "<option>" . $row['townname'] . "</option>";
                                    }
                                ?>                   
                            </select>   
                        </div> <!-- form group [rows] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Date :  </label>
                            <input type="date" value="<?php echo date("Y-m-d");?>" class="form-control input-sm" id="pref-perpage">
                        </div><!-- form group [Date] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Time : </label>
                            <input type="time" class="form-control input-sm" id="pref-perpage">
                        </div>
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0; margin-top:0" for="pref-orderby">Bus Type : </label>
                            <select id="pref-orderby" class="form-control">
                                <option>Normal</option>
                                <option>Semi-Luxury</option>
                                <option>Luxury</option>
                                <option>Super-Luxury</option>
                            </select>                                
                        </div> <!-- form group [order by] --> 
                        <div class="form-group">    
                            
                            <button type="submit" class="btn btn-default filter-col" style="margin-top:0">
                            <span>
                                <i class="glyphicon glyphicon-search"></i></span> Search
                            </button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
</div>
</div>
 
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>          
</body>
</html>