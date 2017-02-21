
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
	public $reservable;
	public $visible = 1;

	function __construct() {

	}

	function searchResultToHTML() {
		$banid = $this->scheduleid;
		$fromtownid = get_townid($this->fromtown);
		$totownid = get_townid($this->totown);

		$labels = '<span class="label label-default">'.$this->seatcount.' seats</span> ';
		if($this->wifi) {
			$labels = $labels.'<span class="label label-default">Wifi</span> ';
		}
		if($this->curtains) {
			$labels = $labels.'<span class="label label-default">Curtains</span> ';
		}

		switch ($this->bustype) {
			case 'Normal':
			$labels = $labels.'<span class="label label-warning">Normal</span> ';
			break;
			case 'Semi-Luxury':
			$labels = $labels.'<span class="label label-info">Semi-Luxury</span> ';
			break;
			case 'Luxury':
			$labels = $labels.'<span class="label label-success">Luxury</span> ';
			break;
			case 'Super-Luxury':
			$labels = $labels.'<span class="label label-primary">Super-Luxury</span> ';
			break;
		}

		$html = '
			<form role="form" action="BookTicket.php" method="get">
				<div class="container" style="width:100%">
					<div style="border: 1px solid silver; border-radius: 5px">
						<div class="row" style="padding: 5px; padding-bottom: 2px">

							<div class="col-xs-4">
								<div id="banner">';

									foreach($this->images as $value) {
										$html = $html.'<img class="a'.$banid.' img-thumbnail" src="'.$value.'" style="width: 80%">';
									}

									$html = $html.'<script type="text/javascript">
									var slideIndex'.$banid.' = 0;
									carousel'.$banid.'();

									function carousel'.$banid.'() {
										var i;
										var x = document.getElementsByClassName("a'.$banid.'");
										for (i = 0; i < x.length; i++) {
											x[i].style.display = "none"; 
										}
										slideIndex'.$banid.'++;
										if (slideIndex'.$banid.' > x.length) {
											slideIndex'.$banid.' = 1;
										} 
										x[slideIndex'.$banid.'-1].style.display = "block"; 
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
			<p style="text-align: center;font-size: 10px"><strong style="font-size: 20px">'.$this->cost.' LKR</strong><br><strong>booking</strong> price / person</p>    
		</div><!--
		--><div class="col-xs-6 vcenter">
		<div class="row">
			<p style="text-align: right; font-size: 20px; padding-right: 50px">
				<kbd><span>
					<i class="glyphicon glyphicon-arrow-up"></i>
				</span>'.$this->townstart.'</kbd>
				<kbd><span>
				<i class="glyphicon glyphicon-arrow-down"></i>
			</span>'.$this->townend.'</kbd>
			</p>
		</div>
		<div class="row">
			<p style="text-align: right; font-size: 20px; padding-right: 50px"><kbd><span>
				<i class="glyphicon glyphicon-phone-alt"></i>
			</span>'.$this->telephone.'</kbd></p>
		</div>
		</div>
		</div>
		<div class="row">
			'.$labels.
			'</div>
			<div class="row" style="margin-right: 5px; text-align: center;">
			<input type="hidden" name="FromTownID" value="'.$fromtownid.'">
			<input type="hidden" name="ToTownID" value="'.$totownid.'">
			<input type="hidden" name="RouteID" value="'.$this->route.'">
				<button class="btn btn-primary"'.($this->reservable ? "" : ' disabled = "true" title = "disabled: the bus has already started journey"').' style="margin-top: 2px; width:50%;  position: 50%;" name = "ScheduleID" value = "'.$this->scheduleid.'">
					<span>
						<i class="glyphicon glyphicon-shopping-cart"></i>
					</span> Reserve
				</button>
				
			</div>
		</div>
		</div>
		</div>

		</div>
		</form>';

		return $html;
	}



}

?>