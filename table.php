<!DOCTYPE html>
<html>
<head>
  <title>table test</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <style type="text/css">
    .vcenter {
      display: inline-block;
      vertical-align: middle;
      float: none;
    }

    .vcenter2 {
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <div class="container">
    <div style="border: 1px solid silver; border-radius: 5px">
      <div class="row" style="padding: 5px; padding-bottom: 2px">

        <div class="col-xs-4">
          <div id="banner">
            <img class="home banner img-thumbnail" src="images/2.jpg" style="width: 100%">
            <img class="home banner img-thumbnail" src="images/6.jpg" style="width: 100%">
            <img class="home banner img-thumbnail" src="images/1.jpg" style="width: 100%">
            <img class="home banner img-thumbnail" src="images/4.jpg" style="width: 100%">
            <img class="home banner img-thumbnail" src="images/5.jpg" style="width: 100%">

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
                if (slideIndex > x.length) {
                  slideIndex = 1;
                } 
                x[slideIndex-1].style.display = "block"; 
              setTimeout(carousel, 2000); // Change image every 2 seconds
            }
          </script>
        </div>
      </div>

      <div class="col-xs-8">
        <div class="row">
          <div class="col-xs-3 vcenter">
            <p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">1:00 AM</strong><br>Colombo</p>    
          </div><!--
          --><div class="col-xs-3 vcenter">
            <p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">4:00 AM</strong><br>Kurunegala</p>    
          </div><!--
        --><div class="col-xs-3 vcenter">
        <p style="text-align: center;font-size: 10px"><strong style="font-size: 30px">6</strong><br>route</p>
      </div><!--
    --><div class="col-xs-3 vcenter">
    <p style="text-align: center;font-size: 10px"><strong style="font-size: 30px">10/53</strong><br>available seats</p>
  </div>
</div>

<div class="row">
          <div class="col-xs-3 vcenter">
            <p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">91 km</strong><br>distance</p>    
          </div><!--
          --><div class="col-xs-3 vcenter">
            <p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">300.00</strong><br>ticket price(LKR)</p>    
          </div><!--
        --><div class="col-xs-6 vcenter">
            <div class="row">
              <p style="text-align: center; font-size: 20px"><kbd>D.S. Gunasekara</kbd></p>
            </div>
            <div class="row">
              <p style="text-align: center; font-size: 20px"><kbd>+94 71 5852 028</kbd></p>
            </div>
          </div>
</div>
</div>
</div>

<div class="row" style="padding-left: 5px">
  <div class="col-xs-8 vcenter">
    <div class="col-xs-3 bg-danger">
      <p style="text-align: center;">53 seats</p>
    </div>
    <div class="col-xs-3 bg-warning">
      <p style="text-align: center;">Normal</p>
    </div>
    <div class="col-xs-3 bg-success">
      <p style="text-align: center;">WiFi</p>
    </div>
    <div class="col-xs-3 bg-danger">
      <p style="text-align: center;">Curtains</p>
    </div>
  </div>
  <div class="col-xs-3 vcenter" style="padding-bottom: 5px">
    <button class="btn btn-default" style="width: 100%;">
      <span>
        <i class="glyphicon glyphicon-search"></i>
      </span> Reserve
    </button>  
  </div>
</div>

</div>
</div>
</body>
</html>
