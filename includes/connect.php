<?php
	include 'constants.php';
	$mysqli = new MySQLi($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	echo 'connect.php included!';
	
	if(mysqli_connect_errno()) {
		printf("Connect failed: %123
			s\n", mysqli_connect_error());
	}
	
	function return_rows($db, $query) {
		$res = $db->query($query) or die($db->error.__LINE__);
		if($res->num_rows > 0) {
			return $res;
		}
	}

	function test1($mysql_con) {
		$query = 'SELECT * FROM bus';
            $result = return_rows($mysql_con, $query);

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['RegNumber'] . "</td>";
                echo "<td>" . $row['BusOwnerID'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "</tr>";
            }
	}

?>