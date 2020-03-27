<?php
session_start();
$message="";
if(count($_POST)>0) 
{
	require 'connect.php';

	$query = "SELECT * FROM register WHERE username='$_POST[uname]' and password = '$_POST[psw]'";
	$result = pg_query($db,$query);  
	if(!pg_affected_rows($result))
	{
		$message = "! Invalid Username or Password";
	} 
	else
	{
		while($row = pg_fetch_row($result))
		{
    		//$_SESSION["id"] = $row[0];
			  $_SESSION["name"] = $row[0];
		}
		
	}
}	
if(isset($_SESSION["name"])) 
{
	header("Location:index.php");
}
?>
<html>
<head>
  <title>Sign-in</title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="icon" href="images/flight.png" type = "image/x-icon">

<style>
body{
    background: url(images/airline1.jpg);
    background-repeat: no-repeat;
    background-size: auto;
}
.body-in{
  margin: 0;
  height: auto;
  position: absolute;
  top:10%;
  bottom: auto;
  left: 25%;
  right: 25%;
}  
form {
  border: none;
  background: rgba(0, 0, 0, 0.7);
  border-radius: 6px;
  font-family: Arial, Helvetica, sans-serif;
  display: inline-block;
  width: auto;
  height: auto;
  margin: auto;
}
.form-control {
  background-color: #fff;
  height: 50px;
  color: #191a1e;
  border: none;
  font-size: 16px;
  font-weight: 400;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 40px;
  padding: 0px 25px;
}
.form-label {
  display: block;
  margin-left: 20px;
  margin-bottom: 5px;
  font-weight: 400;
  text-transform: uppercase;
  line-height: 24px;
  height: 24px;
  font-size: 12px;
  color: #fff;
}

* {
  box-sizing: border-box;
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}


/* Set a style for all buttons */

.submit-btn {
  color: #fff;
  background-color: #f23e3e;
  padding: 14px 20px;
  margin: 8px 0;
  font-weight: 400;
  cursor: pointer;
  height: 50px;
  font-size: 14px;
  border: none;
  width: 100%;
  border-radius: 40px;
  text-align: center;
  text-transform: uppercase;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
  opacity: 0.8;
}
/* Add a hover effect for buttons */
button:hover {
  opacity: 1.0;
}


/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 18%;
  border-radius: 50%;
  border: 2px solid white;
  background-color: white;  
}

/* Add padding to containers */
.container {
  padding: 10px;
}

.message{
	color: red;
}

.signup {
  padding: 5px; 
  text-align: center;
  color: white;
}

a:link {
  color: red;
}

/* visited link */
a:visited {
  color: red;
}

/* mouse over link */
a:hover {
  color: hotpink;
}

</style>


</head>
<body>
<div class="body-in">
  <form action="" method="post">
    <i class="fa fa-arrow-circle-left" style="color:white; font-size:25px; padding-left: 10px; padding-top: 10px;" onclick="goBack()"></i>
    <div class="imgcontainer">
      <img src="images/businessman.png" alt="Avatar" class="avatar">
    </div>
   <div class="signup"><h2>LOG IN </h2></div>
    <div class="container">
      <label for="uname" class="form-label"><b>Username</b></label>
      <input type="text" class="form-control" placeholder="Enter Username" name="uname" required>

      <label for="psw" class="form-label"><b>Password</b></label>
      <input type="password" class="form-control" placeholder="Enter Password" name="psw" required>
  	<div class="message"><strong><?php if($message!="") { echo $message; } ?></strong></div>
      <button type="submit" class="submit-btn">Login</button>
    </div>
  <div class="container signup">
        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
  </div>
  </form>
</div>

<script>
function goBack() {
  window.history.back();
}
</script>

</body>

</html>