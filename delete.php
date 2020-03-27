<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</html>
<?php
require 'connect.php';

$query = "DELETE FROM book where id = '$_POST[bookid]'";
$result = pg_query($query); 

    if(!$result) {
      echo pg_last_error($db);
   } else {
    	header('location: mycart.php');
   }
   pg_close($db);
?>