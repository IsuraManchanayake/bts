<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/7/2016
 * Time: 8:40 PM
 */
include("Constants.php");
$conn = mysqli_connect(SERVER,"root",null);
if (!$conn) {
    die("Database connection failed: " . mysqli_error());
}


$db_select = mysqli_select_db($conn,DATABASE);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error());
}

function exicute_query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("database failed:".mysqli_error($conn));
    }
    return $result;
}
?>


