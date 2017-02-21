<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 01:17 PM
 */
include("Constants.php");
$conn = mysqli_connect(SERVER,PUBLIC_USER,PUBLIC_PASS);
if (!$conn) {
    echo "Server refused connection";
    die("Database connection failed: " . mysqli_error());
}


$db_select = mysqli_select_db($conn,DATABASE);
if (!$db_select) {
    echo "Server refused connection";
    die("Database selection failed: " . mysqli_error());
}

function exicute_query($query){
    $result = mysqli_query($query);
    if(!$result){
        echo "Server refused connection";
        die("database failed:".mysqli_error());
    }
    return $result;
}
?>