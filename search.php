
<?php

include 'includes/includes.php';
include 'includes/model/searchresultmodel.php';

$db = new DB();

date_default_timezone_set('Asia/Colombo');

$from = $db->quote(get_townid($_REQUEST['from']));
$to = $db->quote(get_townid($_REQUEST['to']));
$fromtime = $db->quote(strtotime($_REQUEST['date'].' '.$_REQUEST['at']));
$qtype = $db->quote($_REQUEST['type']);
$type = $_REQUEST['type'];

$searchresults = array();
$statement = '';

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
	from_unixtime(ft + journey_duration(bjid, fd), "%h:%i %p") as fromtime, 
	from_unixtime(ft + journey_duration(bjid, td), "%h:%i %p") as totime,
	(td - fd) * costperkm as cost,
			#fd,
	(td - fd) as distance,
	abs(ft -'.$fromtime.') as diff
			#from_unixtime(ft) as ft1, 
			#from_unixtime(tt) as tt1,
			#td
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
	where diff <= 3600
	order by diff
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
	from_unixtime(ft + journey_duration(bjid, fd), "%h:%i %p") as fromtime, 
	from_unixtime(ft + journey_duration(bjid, td), "%h:%i %p") as totime,
	(td - fd) * costperkm as cost,
			#fd,
	(td - fd) as distance,
	abs(ft -'.$fromtime.') as diff
			#from_unixtime(ft) as ft1, 
			#from_unixtime(tt) as tt1,
			#td
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
	where diff <= 3600
	and bustype = '.$qtype.'
	order by diff
	;';
}

echo '<br>';
$result = $db->select($statement);
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

	$searchresults[] = $searchresult;

	echo $searchresult->searchResultToHTML();
	echo '<br>';
}

?>