<?php

include_once 'connect.php';

$email = $_POST['email'];
//$email = 'shoaib.shaikh@somaiya.edu';

$result = pg_query($db,"SELECT username as email FROM register WHERE username = '$email'");

	 while($row = pg_fetch_row($result)) 
	 {
		if( $row[0]) {
			echo 1;
		}
		else {
			echo 0;
		}
	 }
pg_close($db);
?>