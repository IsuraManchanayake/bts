<?php
/**
 * Created by PhpStorm.
 * User: acer v5
 * Date: 12/17/2016
 * Time: 7:04 PM
 */


/*include("Constants.php");
$connection = mysqli_connect(SERVER,USER,PASS);
if (!$connection) {
echo "sff";
die("Database connection failed: " . mysql_error());
}


$db_select = mysqli_select_db($connection,DATABASE);
if (!$db_select) {
die("Database selection failed: " . mysql_error());
}

function exicute_query($query){
$result = mysqli_query($query);
if(!$result){
die("database failed:".mysqli_error());
}
return $result;
}
*/

include 'constants1.php';
$mysqli = new MySQLi($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if(mysqli_connect_errno()) {
    printf("Connect failed: %123
			s\n", mysqli_connect_error());
}




?>