
<?php

include 'includes/includes.php';
include 'includes/model/searchresultmodel.php';
$db = new DB();

date_default_timezone_set('Asia/Colombo');

$from = $db->quote(get_townid($_REQUEST['from']));
$to = $db->quote(get_townid($_REQUEST['to']));
$fromtime = $db->quote(strtotime($_REQUEST['date'].' '.$_REQUEST['at']));
$type = $db->quote($_REQUEST['type']);

echo "{$_REQUEST['from']} {$_REQUEST['to']} {$_REQUEST['date']} {$_REQUEST['at']} {$_REQUEST['type']}";

echo $from.$to.$fromtime;

$searchresults = array();
$statement = '';

// any type
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
			from_unixtime(ft + journey_duration(bjid, fd)) as fromtime, 
			from_unixtime(ft + journey_duration(bjid, td)) as totime,
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
	// echo "<table border = '1'><tr>
	// <th style='text-align: center'>available</th>
	// <th style='text-align: center'>bjid</th>
	// <th style='text-align: center'>id</th>
	// <th style='text-align: center'>regnumber</th>
	// <th style='text-align: center'>journeystart</th>
	// <th style='text-align: center'>townstart</th>
	// <th style='text-align: center'>journeyend</th>
	// <th style='text-align: center'>townend</th>
	// <th style='text-align: center'>route</th>
	// <th style='text-align: center'>seatcount</th>
	// <th style='text-align: center'>bustype</th>
	// <th style='text-align: center'>wifi</th>
	// <th style='text-align: center'>maximumbookings</th>
	// <th style='text-align: center'>havecurtains</th>
	// <th style='text-align: center'>phonenumber</th>
	// <th style='text-align: center'>diff</th>
	// <th style='text-align: center'>fromtime</th>
	// <th style='text-align: center'>totime</th>
	// <th style='text-align: center'>cost</th>
	// <th style='text-align: center'>distance</th>
	// </tr></table>
	// ";
	$result = $db->select($statement);
	while($row = $result->fetch_assoc()) {
		// echo "<table border = '1'><tr>
		// <td>{$row['available']}</td>
		// <td>{$row['bjid']}</td>
		// <td>{$row['id']}</td>
		// <td>{$row['regnumber']}</td>
		// <td>{$row['journeystart']}</td>
		// <td>{$row['townstart']}</td>
		// <td>{$row['journeyend']}</td>
		// <td>{$row['townend']}</td>
		// <td>{$row['route']}</td>
		// <td>{$row['seatcount']}</td>
		// <td>{$row['bustype']}</td>
		// <td>{$row['wifi']}</td>
		// <td>{$row['maximumbookings']}</td>
		// <td>{$row['haveCurtains']}</td>
		// <td>{$row['phonenumber']}</td>
		// <td>{$row['diff']}</td>
		// <td>{$row['fromtime']}</td>
		// <td>{$row['totime']}</td>
		// <td>{$row['cost']}</td>
		// <td>{$row['distance']}</td>
		// </tr></table>";

	    $searchresult = new SearchResultModel();
	    $searchresult->cheduleid = $row['id'];
	    $searchresult->busjourneyid = $row['bjid'];
	    $searchresult->fromtime = (explode(' ', $row['fromtime'], 2))[1];
	    $searchresult->fromtown = $_REQUEST['from'];
	    $searchresult->totime = (explode(' ', $row['totime'], 2))[1];
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

	    echo $searchresult->searchResultToHTML();
	    echo '<br>';
	}
	//echo "</table>";
} else {

}
// include 'searchresult.php';
// for ($i=0; $i < 5; $i++) { 
// 	displayresult('', $from	, '', $to, '', '', '', '', '', '', '', $type, '', '', array());
// 	echo '<br>';
// }

function displaySearchContent() {

}

?>