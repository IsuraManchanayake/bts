<?php session_start();?>
<?php include "includes/header.php";
include "includes/beforenav.php";
include "includes/Conect.php.php";

if(isset($_SESSION["id"])){
    header("Location: Main.php");
    exit();
}
$usernae=$_POST["username"];
$password = $_POST["password"];
$query='select ID,Name from busowner WHERE name={$username} AND password={$password} limit 1'
$result = mysql_query($query);
if(!$result){
    die("database failed:".mysql_error());
}
$user=mysql_fetch_array($result);
$result2;
if(mysql_num_rows($result)>0){
    $query="select RegNumber from bus where id={$user["ID"]}";
    $result2 = mysql_query($query);
}

?>

<div class="row rowedit">

    <div class="col-sm-12 main2 " >

        <?php include "login_form.php"?>

    </div><!--end of main -->

</div><!--end of row-->
<!--</div><!-- end of container-->

<?php include "includes/footer.php";?>
