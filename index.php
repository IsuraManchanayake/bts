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
    #container{ 
        display: block;
        position: absolute;
        top:200px;
        right: 0px
        padding:20px;
        width: 100%;
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
    </nav><!--navbar-->


    <div id = "container">
        <div id="banner">
            
          <style>
              .carousel-inner > .item > img,
              .carousel-inner > .item > a > img {
                  width: 100%;
                  margin: auto;
              }
          </style>
          
          <div class="container col-sm-12">
              <br>
              <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
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
                      <img src="images/cover1.png" alt="Chania" width="460" height="345">
                  </div>

                  <div class="item">
                      <img src="images/cover2.png" alt="Chania" width="460" height="345">
                  </div>

                  <div class="item">
                      <img src="images/cover3.png" alt="Flower" width="460" height="345">
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
      </div>



      <div class="col-sm-9 main2 " >
        <div id = "search-results">
            <?php
        //include('searchresult.php');
        //displayresult('', '', '', '', '', '', '', '', '', '', '', '', '', '', array());
            ?>
        </div>
    </div><!-- end of container-->
</div>
</div>


<div id="container">
    <div class="row">
        <div id="filter-panel">
            <div class="panel panel-default" >
                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-1">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">From : </label>
                        </div>
                        <div class="col-md-2">
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

                        <div class="col-md-1">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">To : </label>
                        </div>
                        <div class="col-md-2">
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

                        <div class="col-md-1">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Date :  </label>
                        </div>
                        <div class="col-md-2">
                            <input id="date" type="date" value="<?php echo date("Y-m-d");?>" class="form-control input" id="pref-perpage">
                        </div>

                        <div class="col-md-1">
                            <label class="filter-col" style="margin-right:0;">Time : </label>
                        </div>
                        <div class="col-md-2">
                            <input id="at" type="time" class="form-control input" id="pref-perpage">
                        </div>

                        <div class="col-md-1">
                            <label class="filter-col" style="margin-right:0; margin-top:0">Bus Type : </label>
                        </div>
                        <div class="col-md-2">
                            <select id="type" class="form-control">
                                <option>Normal</option>
                                <option>Semi-Luxury</option>
                                <option>Luxury</option>
                                <option>Super-Luxury</option>
                            </select>                                
                        </div>

                    </div>  

                    <div class="row">
                        <div class="col-md-15" >    
                            <button class="btn btn-default filter-col" style="margin-top:0; width: 100%" onclick="search()">
                                <span>
                                    <i class="glyphicon glyphicon-search"></i>
                                </span> Search
                            </button>  
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
</div>


<script type="text/javascript" src="js/search.js"></script>
</body>
</html>