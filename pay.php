<?php
error_reporting(0); 
session_start();
$message="";
$user = $_SESSION["name"];

include_once 'connect.php';
 
    $sql = pg_query($db,"UPDATE book
            SET paid = 1
            WHERE username = '$user'");
pg_close($db);
header('location: bookings.php');
?>