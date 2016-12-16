<?php   
	$name = $_REQUEST['name'];
	echo '<table style = "border: 1px solid black">';
	for($i = 0; $i < 5; $i++)
	    echo "<tr><td>".$name."</td></tr>";  
	echo '</table';
?>