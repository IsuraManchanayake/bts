
<?php
	
	include 'connect.php';

	function get_all_location_names($con) {
		$query = 'select townname from location order by townname';
        $result = return_rows($con, $query);
        return $result;
	}	

?>