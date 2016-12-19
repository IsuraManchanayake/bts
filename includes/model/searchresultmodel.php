
<?php

class SearchResultModel
{
	public $scheduleid;
	public $busjourneyid;
	public $fromtime;
	public $fromtown;
	public $totime;
	public $totown;
	public $route;
	public $seatcount;
	public $availableseatcount;
	public $distance;
	public $cost;
	public $telephone;
	public $wifi;
	public $curtains;
	public $bustype;
	public $images;
	public $townstart;
	public $townend;

	function __construct() {
		 
	}

	function searchResultToHTML() {

		// $fromtime = '2:00 AM';
  // //$fromtown = 'gettah';
		// $totime = '5:00 AM';
  // //$totown = 'Kurunegala';
		// $route = '5';
		// $availableseatcount = '14';
		// $seatcount = '48';
		// $distance = '91.5';
		// $cost = '340.00';
		$this->busowner = 'DS Gunasekara';
		$banid = $this->scheduleid;
		// $telephone = '+94 71 5850 028';
  // //$bustype = 'Semi-Luxury';
		 $this->images = array('1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg');
		// $banid = $scheduleid;
		// $wifi = True;
		// $curtains = True;

		$labels = '<span class="label label-default">'.$this->seatcount.' seats</span>';
		if($this->wifi) {
			$labels = $labels.'<span class="label label-default">Wifi</span>';
		}
		if($this->curtains) {
			$labels = $labels.'<span class="label label-default">Curtains</span>';
		}

		switch ($this->bustype) {
			case 'Normal':
			$labels = $labels.'<span class="label label-warning">Normal</span>';
			break;
			case 'Semi-Luxury':
			$labels = $labels.'<span class="label label-info">Semi-Luxury</span>';
			break;
			case 'Luxury':
			$labels = $labels.'<span class="label label-success">Luxury</span>';
			break;
			case 'Super-Luxury':
			$labels = $labels.'<span class="label label-primary">Super-Luxury</span>';
			break;
		}

		$html = '
		<br>
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
				.label {
					margin-left: 5px;
				}
			</style>
		</head>
		<body>
			<div class="container">
				<div style="border: 1px solid silver; border-radius: 5px">
					<div class="row" style="padding: 5px; padding-bottom: 2px">

						<div class="col-xs-4">
							<div id="banner">';

								 foreach($this->images as $value) {
									$html = $html.'<img class="a'.$banid.' img-thumbnail" src="images/'.$value.'" style="width: 80%">';
								 }

								$html = $html.'<script type="text/javascript">
								var slideIndex = 0;
								carousel'.$banid.'();

								function carousel'.$banid.'() {
									var i;
									var x = document.getElementsByClassName("a'.$banid.'");
									for (i = 0; i < x.length; i++) {
										x[i].style.display = "none"; 
									}
									slideIndex++;
									if (slideIndex > x.length) {
										slideIndex = 1;
									} 
									x[slideIndex-1].style.display = "block"; 
									setTimeout(carousel'.$banid.', 2000); // Change image every 2 seconds
								}
							</script>
						</div>
					</div>

					<div class="col-xs-8">
						<div class="row">
							<div class="col-xs-3 vcenter">
								<p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">'.$this->fromtime.'</strong><br>'.$this->fromtown.'</p>    
							</div><!--
						--><div class="col-xs-3 vcenter">
						<p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">'.$this->totime.'</strong><br>'.$this->totown.'</p>    
					</div><!--
				--><div class="col-xs-3 vcenter">
				<p style="text-align: center;font-size: 10px"><strong style="font-size: 30px">'.$this->route.'</strong><br>route</p>
			</div><!--
		--><div class="col-xs-3 vcenter">
		<p style="text-align: center;font-size: 10px"><strong style="font-size: 30px">'.$this->availableseatcount.' / '.$this->seatcount.'</strong><br>available seats</p>
	</div>
</div>

<div class="row">
	<div class="col-xs-3 vcenter">
		<p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">'.$this->distance.' km</strong><br>distance</p>    
	</div><!--
--><div class="col-xs-3 vcenter">
<p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">'.$this->cost.' LKR</strong><br>ticket price / person</p>    
</div><!--
--><div class="col-xs-6 vcenter">
<div class="row">
	<p style="text-align: right; font-size: 20px; padding-right: 50px">
		<kbd><span>
			<i class="glyphicon glyphicon-arrow-up"></i>
		</span>'.$this->townstart.'</kbd>
	</p>
</div>
<div class="row">
	<p style="text-align: right; font-size: 20px; padding-right: 50px"><kbd><span>
		<i class="glyphicon glyphicon-arrow-down"></i>
	</span>'.$this->townend.'</kbd></p>
</div>
</div>
</div>
<div class="row">
	'.$labels.
	'</div>
	<div class="row" style="margin-right: 5px; text-align: center;">
		<button class="btn btn-primary" style="margin-top: 15px; width:50%;  position: 50%;">
			<span>
				<i class="glyphicon glyphicon-shopping-cart"></i>
			</span> Reserve
		</button>
	</div>
</div>
</div>
</div>

</div>

</body>
</html>';

return $html;
}

}

?>