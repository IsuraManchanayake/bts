<!DOCTYPE html>
<html>
<body>

<?php
$str = 'one,two,three,four';

// zero limit
echo (explode(' ','3026-01-32 22:32',2))[1];
print "<br>";

// positive limit
print_r(explode(',',$str,2));
print "<br>";

// negative limit 
print_r(explode(',',$str,-1));
?>  

</body>
</html>