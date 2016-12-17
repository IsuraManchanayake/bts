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
</nav> <!--navbar-->



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
      <img src="images/cover1.png" alt="Chania">
  </div>

  <div class="item">
      <img src="images/cover2.png" alt="Chania">
  </div>

  <div class="item">
      <img src="images/cover3.png" alt="Flower">
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



<div class="row" >
    <div id = "search-results">

        <?php
        //include('searchresult.php');
        //displayresult('', '', '', '', '', '', '', '', '', '', '', '', '', '', array());
        ?>
    </div>
</div>
</div> 



<div style="border: 1px solid silver; border-radius: 5px; top: 200px; width: 100%; display: block; position: absolute; background: rgba(255, 255, 255, 0.6">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-2">
                <div class="row">
                    <div class="col-sm-3 vcenter">
                        <label class="filter-col" for="pref-perpage" style="text-align: center;">From</label>
                    </div><!--
                --><div class="col-sm-9 vcenter">
                <select id="from" class="form-control">
                    <option selected style="color: silver">select</option>
                    <?php
                    $rows = get_all_location_names($mysqli);
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
                                <select id="to" class="form-control">
                                    <option selected style="color: silver">select</option>
                                    <?php
                                    $rows = get_all_location_names($mysqli);
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
                                <input id="date" type="date" value="<?php echo date("Y-m-d");?>" class="form-control input" id="pref-perpage">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-3 vcenter">
                                <label class="filter-col" style="text-align: center;">Time</label>
                                    </div><!--
                                --><div class="col-sm-9 vcenter">
                                <input id="at" type="time" class="form-control input" id="pref-perpage">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-3 vcenter">
                                <label class="filter-col" style="text-align: center; font-size: 11px">Bus Type</label>
                                    </div><!--
                                --><div class="col-sm-9 vcenter">
                                <select id="type" class="form-control">
                                    <option>Normal</option>
                                    <option>Semi-Luxury</option>
                                    <option>Luxury</option>
                                    <option>Super-Luxury</option>
                                </select> 
                            </div>
                        </div>               
                    </div>


                    <div class="col-sm-2" >    
                        <button class="btn btn-primary" style="width: 100%;" onclick="search()">
                            <span>
                                <i class="glyphicon glyphicon-search"></i>
                            </span> Search
                        </button>  
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/search.js"></script>
    </body>
    </html>