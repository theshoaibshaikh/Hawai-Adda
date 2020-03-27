<?php
error_reporting(0); 
session_start();
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
  <link type="text/css" rel="stylesheet" href="css/style.css" />

  <!-- for navbar -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="icon" href="images/flight.png" type = "image/x-icon">
	
<style>
	
body{
  background: url(images/airline1.jpg);
  background-repeat: no-repeat;
  background-size: auto;
}
  
form {
  border: none;
  background: rgba(0, 0, 0, 0.7);
  border-radius: 6px;
  font-family: Arial, Helvetica, sans-serif;
  display: inline-block;
  width: 50%;
  height: auto;
  margin-left:25%;
}

.form-control {
  background-color: #fff;
  height: 50px;
  color: #191a1e;
  border: none;
  font-size: 14px;
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
  width: 50%;
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
  width: auto;
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
}

/* Avatar image */
img.avatar {
  width: 8%;
  border-radius: 50%;
  border: 2px solid white;
  background-color: white;  
}

/* Add padding to containers */
.container {
  padding: 16px;
}

.signup {
  padding: 5px; 
  text-align: left;
  color: white;
}

.title 
{
  padding: 5px; 
  text-align: center;
  color: white;
}

</style>
</head>
<body>

<div class="title"><h2>HAWAI ADDA</h2></div>
  <!--Navbar-->
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!--<div class="navbar-header">
            <a class="navbar-brand" href="#"><div class="title">Hawai Adda</div></a>
        </div>  -->
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="contactus.php"><i class="fa fa-fw fa-envelope"></i> Contact</a></li>
         
          <?php
          if($_SESSION["name"]) 
          {
        ?>
            <li><a href="mycart.php"><i class="glyphicon glyphicon-shopping-cart"></i> Cart</a></li>
                  <li><a href="bookings.php"><i class="glyphicon glyphicon-check"></i> My Bookings</a></li>
            </ul>
            <p class="navbar-text">Welcome, <?php echo $_SESSION["name"]; ?></p>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="signout.php"><span class="fa fa-sign-out"></span> SIGN OUT</a></li>
                </ul>
        <?php
          }
          else
          {
        ?>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fw fa-user"></i>  Login<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="signin.php">User</a></li>
                <li><a href="adminlogin.php">Admin</a></li>
              </ul>
            </li>
          </ul>
        <?php
          }
        ?> 
        
      </div>
  </nav>



<form action="#">
	<div class="container">

          <div class="signup"><h2>Contact Us</h2></div>
      	  <label for="nm"  class="form-label">Name</label>
          <input type="text" class="form-control" id="nm" name="name" placeholder="Enter Your name.." required>
      	
      	  <label for="mail"  class="form-label">Email</label>
          <input type="text" class="form-control" id="mail" name="email" placeholder="Enter Your E-mail.."required>

          <label for="city_nm"  class="form-label">City Name</label>
          <input type="text" class="form-control" id="city_nm" name="cityname" placeholder="Enter Your City.."required>
      	
      	  <label for="subject"  class="form-label"> Subject </label>
          <input type="text" class="form-control" id="city_nm" name="subject" placeholder="Enter Subject"required>

      	  <label for="subject"  class="form-label"> Description   </label>
      	  <textarea id="subject" class="form-control" name="subject" style="border-radius: 10px; width:50%; height:60px;"placeholder="Give your Feedback.." required></textarea>
      	   
      	  <button type="submit" class="submit-btn">Submit</button>
      </div>
</form>


</body>
</html>