<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/9/2016
 * Time: 9:17 PM
 */
$_POST = array(); //workaround for broken PHPstorm
parse_str(file_get_contents('php://input'), $_POST);
date_default_timezone_set("Asia/Colombo");
include "Classes/Bus.php";
include "Classes/Jurney.php";
include "Classes/Route.php";
include "Classes/Location.php";
include "Classes/Schedule.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
<!--    <link rel="stylesheet" href="../css/styles.css">-->
    <link rel="stylesheet" href="../CSS/styles.css?version=3">
    <title>Title</title>
</head>
<body>
