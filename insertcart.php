<?php
// Start the session
session_start();

include_once 'connect.php';

$type = $_POST["type"];
date_default_timezone_set("America/Chicago");
$t=time();
$time = date("Y-m-d h:i:s");


if(!isset($_SESSION["name"]))
{
    header("Location: signin.php");
}
else
{
    $user = $_SESSION["name"];


	$flightno = $_POST["flightno"];
	$class = $_POST["classtype"];
	$price = $_POST["price"];
	$date = $_POST["date"];
	$depttime= $_POST["dtime"];
	$sql = "INSERT INTO book (time, date, fnum, username, classtype, paid) 
			VALUES ('$time', '$date', '$flightno', '$user', '$class', '0')";;

	$result = pg_query($db,$sql);

	$bid = pg_query($db,"SELECT id FROM book B WHERE B.username = '$user' AND time='$time'");

	$pnr = pg_fetch_row($bid);
	//echo $pnr[0];

	$fname = $_POST["fnm"];
	$gender = $_POST["gender"];
	$age = $_POST["age"];

	$sql = "INSERT INTO passenger (pnr,fname,gender,age) 
			VALUES ('$pnr[0]', '$fname', '$gender', '$age')";;

	$result = pg_query($db,$sql);
	
    header("Location: mycart.php");
}

pg_close($db);

?>



