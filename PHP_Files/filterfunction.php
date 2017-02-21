

<?php


include '../Include/includes.php';
include '../Include/model/searchresultmodel.php';

$db = new DB();

date_default_timezone_set('Asia/Colombo');

$from = $db->quote(get_townid($_REQUEST['from']));
$to = $db->quote(get_townid($_REQUEST['to']));
$fromtime = $db->quote(strtotime($_REQUEST['date'].' '.$_REQUEST['at']));
$qtype = $db->quote($_REQUEST['bustype']);
$type = $_REQUEST['bustype'];
$wifi = $_REQUEST['wifi'];
$curtain = $_REQUEST['curtain'];
$priceub = $_REQUEST['priceub'];
$threshold = $db->quote(3600 * $_REQUEST['timethresh']);

$searchresults = array();
$statement = '';

//echo $curtain;

$filters = array();
if($wifi == "true") {
	$filters[] = " wifi = 1 ";
}
if($curtain == "true") {
	$filters[] = " havecurtains = 1 ";
}
if($priceub > 0) {
	$filters[] = " cost <= ".$priceub." ";
}

$filterstatement = "";
if(sizeof($filters) > 1) {
	$filterstatement = "and";
}
if(sizeof($filters) > 0) {
	$last = array_pop($filters);
	$filterstatement .= implode(" and ", $filters);
	$filterstatement .= ' and '.$last;
}

if ($type != 'Normal' && $type != 'Semi-Luxury' && $type != 'Luxury' && $type != 'Super-Luxury') {
	$statement = 'select
	*,
	(maximumbookings - booked) as available
	from
	(
	select
	bjid, 
	id,
	regnumber,
	ft as journeystart,
	ftown as townstart,
	tt as journeyend,
	totown as townend,
	routeid as route,
	noseat as seatcount,
	type as bustype,
	wifi,
	maximumbookings,
	havecurtains,
	phonenumber,
	(ft + journey_duration(bjid, fd)) as longtime,
	from_unixtime(ft + journey_duration(bjid, fd), "%h:%i %p") as fromtime, 
	from_unixtime(ft + journey_duration(bjid, td), "%h:%i %p") as totime,
	(td - fd) * costperkm as cost,
	(td - fd) as distance,
	abs(ft + journey_duration(bjid, fd) -'.$fromtime.') as diff
	from 
	(
	select 
	*,
	destination_distance(bjid, ftown, '.$from.') as fd,
	destination_distance(bjid, ftown, '.$to.') as td 
	from
	(
	select * from extended_schedule left outer join costperkm
	on extended_schedule.type = costperkm.bustype
	) as with_cost
	where is_between(ftown, totown, '.$from.', routeid) and is_between(ftown, totown, '.$to.', routeid)
	) as dd
	where td >= fd
	) as titable
	left outer join
	(
	select 
	scheduleid,
	count(seatnumber) as booked
	from booking 
	natural join bookingseats
	group by scheduleid
	) as bookingcnt
	on bookingcnt.scheduleid = titable.id
	where diff <= '.$threshold.$filterstatement.'order by diff
	;';
} else {
	$statement = 'select
	*,
	(maximumbookings - booked) as available
	from
	(
	select
	bjid, 
	id,
	regnumber,
	ft as journeystart,
	ftown as townstart,
	tt as journeyend,
	totown as townend,
	routeid as route,
	noseat as seatcount,
	type as bustype,
	wifi,
	maximumbookings,
	havecurtains,
	phonenumber,
	(ft + journey_duration(bjid, fd)) as longtime,
	from_unixtime(ft + journey_duration(bjid, fd), "%h:%i %p") as fromtime, 
	from_unixtime(ft + journey_duration(bjid, td), "%h:%i %p") as totime,
	(td - fd) * costperkm as cost,
	(td - fd) as distance,
	abs(ft + journey_duration(bjid, fd) -'.$fromtime.') as diff
	from 
	(
	select 
	*,
	destination_distance(bjid, ftown, '.$from.') as fd,
	destination_distance(bjid, ftown, '.$to.') as td 
	from
	(
	select * from extended_schedule left outer join costperkm
	on extended_schedule.type = costperkm.bustype
	) as with_cost
	where is_between(ftown, totown, '.$from.', routeid) and is_between(ftown, totown, '.$to.', routeid)
	) as dd
	where td >= fd
	) as titable
	left outer join
	(
	select 
	scheduleid,
	count(seatnumber) as booked
	from booking 
	natural join bookingseats
	group by scheduleid
	) as bookingcnt
	on bookingcnt.scheduleid = titable.id
	where diff <= '.$threshold.$filterstatement.'
	and bustype = '.$qtype.'
	order by diff
	;';
}


$result = $db->select($statement);

//include 'filter.php';


$ftime = strtotime($_REQUEST['date'].' '.$_REQUEST['at']) - 3600 * $_REQUEST['timethresh'];
$ttime = $ftime + 7200 * $_REQUEST['timethresh'];


while($row = $result->fetch_assoc()) {

	$searchresult = new SearchResultModel();
	$searchresult->scheduleid = $row['id'];
	$searchresult->busjourneyid = $row['bjid'];
	$searchresult->fromtime = $row['fromtime'];
	$searchresult->fromtown = $_REQUEST['from'];
	$searchresult->totime = $row['totime'];
	$searchresult->totown = $_REQUEST['to'];
	$searchresult->route = $row['route'];
	$searchresult->seatcount = $row['seatcount'];
	$searchresult->availableseatcount = ($row['available'] > 0 ? $row['available']: $row['maximumbookings']);
	$searchresult->distance = $row['distance'];
	$searchresult->cost = $row['cost'];
	$searchresult->telephone = '+94 '.$row['phonenumber'];
	$searchresult->wifi = ($row['wifi'] > 0) ? True : False;
	$searchresult->curtains = ($row['haveCurtains'] > 0) ? True : False;
	$searchresult->bustype = $row['bustype'];
	$searchresult->townstart = get_townname($row['townstart']);
	$searchresult->townend = get_townname($row['townend']);
	$searchresult->reservable = (intval($row['longtime']) > time());

	$paths = get_images($row['regnumber']);
	$searchresult->images = (sizeof($paths) > 0) ? $paths : array('images/bus.jpg');

	$searchresults[] = $searchresult;
}

echo '<br>';
//echo filterbegin();
if(sizeof($searchresults) > 0) {
	echo '<div id="row"
	<br><p style="font-size: 20px">&nbsp&nbsp Search result(s) from <strong>'.$_REQUEST['from'].'</strong> to <strong>'.$_REQUEST['to'].'</strong> at 
	<strong>'.date("H:i A",$ftime).'</strong> - <strong>'.date("H:i A", $ttime).'</strong></p><br>
</div>';

foreach($searchresults as $searchresult) {
	echo $searchresult->searchResultToHTML();
	echo '<br>';
}
} else {
	echo '<div id="row"
	<br><p style="font-size: 20px">&nbsp&nbsp No search result from <strong>'.$_REQUEST['from'].'</strong> to <strong>'.$_REQUEST['to'].'</strong> at 
	<strong>'.date("H:i A",$ftime).'</strong> - <strong>'.date("H:i A", $ttime).'</strong></p><br>
</div>';
}
//echo filterend();



?>