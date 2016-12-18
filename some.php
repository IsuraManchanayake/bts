<?php   
	// $name = $_REQUEST['name'];
	// echo '<table style = "border: 1px solid black">';
	// for($i = 0; $i < 5; $i++)
	//     echo "<tr><td>".$name."</td></tr>";  
	// echo '</table';
?>

<?php
	//echo strtotime('2016-12-16 14:34:03.32');
	echo "Time: " . date("Y-m-d H:i:s") . "<br>\n";

$shortName = exec('date +%Z');
echo "Short timezone:" . $shortName . "<br>";

$longName = timezone_name_from_abbr($shortName);
echo "Long timezone:" . $longName . "<br>";

date_default_timezone_set('Asia/Colombo');
echo "Time: " . date("Y-m-d H:i:s", 1481857200) . "<br>\n";
?>