<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/9/2016
 * Time: 9:18 PM
 */
?>
<script src="../JS/jquery-3.1.1.slim.min.js"></script>
<script src="../JS/bootstrap.js"></script>
<script src="../JS/script.js?version=4"></script>
<?php if(isset($connection)){
    mysql_close($connection);
}?>
</body>
</html>
