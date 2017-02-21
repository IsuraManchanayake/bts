<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/14/2016
 * Time: 12:20 AM
 */
include "includes/functions.php";

session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-4200,'/');
}
session_destroy();
redirect_to("login.php?logout=1");
?>