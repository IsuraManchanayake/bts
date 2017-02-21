<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/7/2016
 * Time: 8:53 PM
 */

define("SERVER","localhost");
define("USER","Admin");
define("PASS","123");
define("DATABASE","bus");
$user="root";
$pass=null;
function setConductor(){
    global $user;
    $user ="Public_User";
    global $pass;
    $pass="Public";
}
function setAdmin(){
    global $user;
    $user ="Admin_User";
    global $pass;
    $pass="Admin";
}
function setOwner(){
    global $user;
    $user ="BusOwner_User";
    global $pass;
    $pass="BusOwner";
}

?>