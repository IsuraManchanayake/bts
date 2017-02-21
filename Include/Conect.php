<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/7/2016
 * Time: 8:40 PM
 */
include("Constants.php");
$connection = mysqli_connect(SERVER,USER,PASS);
$mysqli=$connection;
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
?>


