
<?php
$message="";
if(!empty($_POST["email"]))
{
	require 'connect.php';

	if($_POST['password']==$_POST['confirm_password'])
	{
		$query   = "INSERT into register (username,password) VALUES('$_POST[email]','$_POST[password]')";
		$result = pg_query($query);
		if(!$result) 
		{
      		echo pg_last_error($db);
   		} 
   		else 
   		{
    		header('location: signin.php');
   		}
	}
	else
	{
		$message = "!Password & confirm password should be same";
	}
	pg_close($db);
}
?>
<html>
<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="css/formstyle.css" />

  <!-- for navbar -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="checkUser.js"></script>

<title>Sign-up</title></title>

<link rel="icon" href="images/flight.png" type = "image/x-icon">

<style>
body
    {
      background: url(images/airline1.jpg);
      background-repeat: no-repeat;
      background-size: auto;
    }  
    .message
    {
      color: red;
    }

    .title 
    {
        padding: 5px; 
        text-align: center;
        color: white;
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

.signin { 
  text-align: center;
  color: white;
}

</style>

</head>	
<body>

<div id="booking" class="section">
    <div class="section-center">
      <div class="container">
        <div class="row">
          <div class="booking-form">
              <i class="fa fa-arrow-circle-left" style="color:white; font-size:25px;" onclick="goBack()"></i>
              <form action="" method="post">
    	           
                  <div class="signin"><h1>Register</h1></div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <span class="form-label">Email</span>
                        <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required>
                      </div>
                    </div>

                      <!--Checking for username availability using ajax-->
                    <div class="col-md-3">
                      <div class="form-group">
                        <div>
                          <span class="form-label"></span>
                          <button  class="submit-btn1" id="check_username_availability" value="Check Availability">Check Availability</button>  
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="message" id="username_availability_result"></div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <span class="form-label">Password</span>
                          <input type="password" class="form-control" placeholder="Enter Password" name="password" value="" required>
                      </div>   
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group">
                        <span class="form-label">Confirm Password</span>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="message"><?php if($message!="") { echo $message; } ?></div>
                  <div class="row">
                    <div class="col-md-3">
                        <div class="form-btn">
                          <button type="submit-btn" class="submit-btn">Register</button>  
                        </div>
                    </div>
                  </div>
                    
                  <div class="signin">
                    <p>Already have an account? <a href="signin.php">Sign in</a>.</p>
                  </div>
            </form>
        </div>
    </div>
  </div>
</div>

<script>
function goBack() {
  window.history.back();
}
</script>


</body>
</html>
