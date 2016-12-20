<?php
function filterbegin() {
  return '<div class="row">

  <div class="col-xs-2" style="maring-top: 20px;  border: 1px solid silver; border-radius: 5px">
    <br>
    <p style="text-align: center; font-size:25px"><strong>Filter Results</strong></p><br>
    <div class="row checkbox">
      <label for="inputEmail3" class="col-sm-9 control-label" style="margin-left: -5px"><strong>Wifi</strong></label>
      <label>
        <input id="wificheck" type="checkbox"> 
      </label>
    </div>
    <div class="row checkbox">
      <label for="inputEmail3" class="col-sm-9 control-label" style="margin-left: -5px"><strong>Curtains</strong></label>
      <label>
        <input id="curtaincheck" type="checkbox">
      </label>
    </div>

    <hr>

    <div class="row">
      <label for="inputEmail3" class="col-sm-5 control-label" style="font-size: 10px">Booking price less than</label>
      <div class="col-sm-7">
        <input type="number" class="form-control pull-right" id="priceub" min = "10" style="text-align: right" placeholder="LKR">
      </div>
    </div>

    <hr>

    <div class="row">
      <label for="inputEmail3" class="col-sm-12 control-label" >Bus type</label>
    </div>
    <div class="radio">
      <label class="col-sm-10">Any</label>
      <label>
        <input type="radio" name="bustyperadio" id="optionsRadios1" value="Any" checked>
      </label>
    </div>
    <div class="radio">
      <label class="col-sm-10">Normal</label>
      <label>
        <input type="radio" name="bustyperadio" id="optionsRadios2" value="Normal">
      </label>
    </div>
    <div class="radio">
      <label class="col-sm-10">Semi-Luxury</label>
      <label>
        <input type="radio" name="bustyperadio" id="optionsRadios3" value="Semi-Luxury">
      </label>
    </div>
    <div class="radio">
      <label class="col-sm-10">Luxury</label>
      <label>
        <input type="radio" name="bustyperadio" id="optionsRadios4" value="Luxury">
      </label>
    </div>
    <div class="radio">
      <label class="col-sm-10">Super-Luxury</label>
      <label>
        <input type="radio" name="bustyperadio" id="optionsRadios5" value="Super-Luxury">
      </label>
    </div>

    <hr>

    <div class="row">
      <label for="inputEmail3" class="col-sm-5 control-label" style="font-size: 10px">Time accuracy in hours</label>
      <div class="col-sm-7">
        <input type="number" class="form-control pull-right" id="timethreshold" placeholder="" style="text-align: right" value = "1" min = "1">
      </div>
    </div>

    <br>
    <button class="btn btn-primary" style="width: 100%;" onclick="filter()">
      <span>
        <i class="glyphicon glyphicon-filter"></i>
      </span> Filter
    </button>  
    <br>  
    <br>
  </div>

  <div class="col-xs-10">
    <div id = "ss" style="width: 100%">';
    }

    function filterend() {
      return '   
    </div>
  </div>

</div>';
}
?>


<!-- <!DOCTYPE html>
<html>
<head>
  <title>table test</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
  <div class="container" style="width:100%">
    <div class="col-xs-2" style="maring-top: 20px;  border: 1px solid silver; border-radius: 5px">
      <br>
      <p style="text-align: center; font-size:25px"><strong>Filter Results</strong></p><br>
      <div class="row checkbox">
        <label for="inputEmail3" class="col-sm-9 control-label" style="margin-left: -5px"><strong>Wifi</strong></label>
        <label>
          <input type="checkbox"> 
        </label>
      </div>
      <div class="row checkbox">
        <label for="inputEmail3" class="col-sm-9 control-label" style="margin-left: -5px"><strong>Curtains</strong></label>
        <label>
          <input type="checkbox">
        </label>
      </div>

      <hr>
      
      <div class="row">
        <label for="inputEmail3" class="col-sm-5 control-label" style="font-size: 10px">Booking price less than</label>
        <div class="col-sm-7">
          <input type="number" class="form-control pull-right" id="inputEmail3" min = "10" style="text-align: right" placeholder="LKR">
        </div>
      </div>
      
      <hr>

      <div class="row">
        <label for="inputEmail3" class="col-sm-12 control-label" >Bus type</label>
      </div>
      <div class="radio">
        <label class="col-sm-10">Any</label>
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
        </label>
      </div>
      <div class="radio">
        <label class="col-sm-10">Normal</label>
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
        </label>
      </div>
      <div class="radio">
        <label class="col-sm-10">Semi-Luxury</label>
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
        </label>
      </div>
      <div class="radio">
        <label class="col-sm-10">Luxury</label>
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
        </label>
      </div>
      <div class="radio">
        <label class="col-sm-10">Super-Luxury</label>
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
        </label>
      </div>

      <hr>
      
      <div class="row">
        <label for="inputEmail3" class="col-sm-5 control-label" style="font-size: 10px">Time accuracy in hours</label>
        <div class="col-sm-7">
          <input type="number" class="form-control pull-right" id="inputEmail3" placeholder="" style="text-align: right" value = "1" min = "1">
        </div>
      </div>

      <br>
      <button class="btn btn-primary" style="width: 100%;">
          <span>
            <i class="glyphicon glyphicon-filter"></i>
          </span> Filter
        </button>  
        <br>  
      <br>
    </div> 
  </div> 
</div>
</div>
</div>

</body>
</html>
 -->