<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/9/2016
 * Time: 9:18 PM
 */
?>
<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
<?php if(isset($connection)){
    mysqli_close($connection);
}?>
</body>
</html>
