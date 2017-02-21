 
<!-- <!DOCTYPE html>
<html>
<head>
	<title>DB test</title>
</head>
<body>
	<?php
		// $db = new DB();
		// $routeid = $db->quote('6');
		// $result = $db->select("select routeid, townid, distance from routedestination where routeid = ".$routeid);
		// echo '<table border = "1">';
		// while($row = $result->fetch_assoc()) {
  //               echo "<tr>";
  //               echo "<td>" . $row['routeid'] . "</td>";
  //               echo "<td>" . $row['townid'] . "</td>";
  //               echo "<td>" . $row['distance'] . "</td>";
  //               echo "</tr>";
  //           }
  //       echo '</table>';
	?>
</body>
</html>  -->


<?php

class DB {

    protected static $connection;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() { 
        if(!isset(self::$connection)) {
            $config = parse_ini_file('../Include/config.ini'); 
        	self::$connection = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
        }

        if(self::$connection === false) {
        	printf("Connect failed: %123s\n", mysqli_connect_error());
            return false;
        }
        //echo 'connected';
        return self::$connection;
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        $connection = $this -> connect();
        $result = $connection -> query($query);
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database result on success
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        return $result;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    	//return $value;
    }
}

?>