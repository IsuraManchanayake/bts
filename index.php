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
<img class="home banner" src="images/2.jpg" style="width: 100%">
<img class="home banner" src="images/6.jpg" style="width: 100%">
<img class="home banner" src="images/1.jpg" style="width: 100%">
<img class="home banner" src="images/4.jpg" style="width: 100%">
<img class="home banner" src="images/5.jpg" style="width: 100%">

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
                <div><div class="panel panel-success center">
                    <div class="panel-heading ">
                        <div class="container-fluid">
                            
                    
<p id="search-results"> isura </p>
                </div>
            </div><!--end of main -->
        </div><!--end of row-->

    </div><!-- end of container-->

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