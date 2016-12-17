
<?php

$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$date = $_REQUEST['date'];
$at = $_REQUEST['at'];
$type = $_REQUEST['type'];

echo $from.' '.$to.' '.$date.' '.$at.' '.$type;

include 'searchresult.php';
for ($i=0; $i < 5; $i++) { 
	displayresult('', '', '', '', '', '', '', '', '', '', '', '', '', '', array());
	echo '<br>';
}

function displaySearchContent() {

}

?>