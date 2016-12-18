
<?php

include 'includes/includes.php';

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
			haveCurtains,
			phonenumber,
			#from_unixtime(ft + journey_duration(bjid, fd)) as ftt, 
			#from_unixtime(ft + journey_duration(bjid, td)) as ttt,
			fd,
			abs(ft -'.$fromtime.') as diff,
			from_unixtime(ft) as ft1, 
			from_unixtime(tt) as tt1,
			td
		from 
		(
			select 
				*,
				destination_distance(bjid, ftown, '.$from.') as fd,
				destination_distance(bjid, ftown, '.$to.') as td 
			from extended_schedule
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
echo $statement;
	echo "<table>";
	$result = $db->select($statement);
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
        echo "<td>{$row['bjid']}</td>";
    	echo "</tr>";
    }
    echo "</table>";
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