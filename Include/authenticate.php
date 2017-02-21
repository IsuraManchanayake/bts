<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/14/2016
 * Time: 12:16 AM
 */


if(isset($_SESSION["userID"])){
    redirect_to("Main.php");
}
if(isset($_GET["logout"]) && $_GET["logout"]==1){
    redirect_to("login.php");
}
if(isset($_GET["failed"]) && $_GET["failed"]==1){
    echo ("<script type='text/javascript'>alert('Invalid username password combination!')</script>");

}

if(isset($_POST["submitbtn"])){

    $username=$_POST["name"];
    $password = $_POST["pass"];
    $user;
    $result = exicute_query("select ID,Name from busowner WHERE name='$username' AND password='$password' limit 1");
    $result2;
    $bus=array();

    if(!$user=mysql_fetch_array($result)) {
        redirect_to("login.php?failed=1");
    }

    if(mysql_num_rows($result)>0){
        $result2=exicute_query("select RegNumber from bus where id='{$user["ID"]}'");
    }

    while($reg=mysql_fetch_array($result2)){
        array_push($bus,$reg["RegNumber"]);
    }

    $_SESSION["userID"]=$user["ID"];
    $_SESSION["userName"]=$user["Name"];
    $_SESSION["buses"]=$bus;
    redirect_to("Main.php");
}

?>
