<?php
error_reporting(0); 
session_start();
$message="";
if(count($_POST)>0)
{
	if($_POST['ffrom']==$_POST['fto'])
	{
		$message = "!From and To cannot be same";
	}
	else	
	{
		$_SESSION['ffrom'] = $_POST['ffrom'];
		$_SESSION['fto'] = $_POST['fto'];
		$_SESSION['class'] = $_POST['class'];
		$_SESSION['date'] = $_POST['deptdate'];
		header("Location:search.php");
	}
}
?>
<html>
<title>
Hawai Adda
</title>

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
	
	<!--Java script to disable previous dates in calender-->
	<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    
	<script language="javascript">
        $(document).ready(function () {
            $("#txtdate").datepicker({
                minDate: 0
            });
        });
        $(document).ready(function () {
            $("#txtdate1").datepicker({
                minDate: 0
            });
        });
    </script>
    
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
	</style>
</head>

<body>
	<div class="title"><h2>HAWAI ADDA</h2></div>
	<!--Navbar-->
	<nav class="navbar navbar-default">
  		<div class="container-fluid">
    		<!--<div class="navbar-header">
      			<a class="navbar-brand" href="#"><div class="title">Hawai Adda</div></a>
    		</div>	-->
    		<ul class="nav navbar-nav">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="contactus.php"><i class="fa fa-fw fa-envelope"></i> Contact</a></li>
		     
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
				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fw fa-user"></i>	Login<span class="caret"></span></a>
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

	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<form method="post">
							<!--
							<div class="form-group">
								<div class="form-checkbox">
									<label for="roundtrip">
										<input type="radio" id="roundtrip" name="flight-type">
										<span></span>Roundtrip
									</label>
									<label for="one-way">
										<input type="radio" id="one-way" name="flight-type" checked>
										<span></span>One way
									</label>
								</div>
							</div>
							-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Flying from</span>
										<select class="form-control" name="ffrom" required>
											<option value="" disabled selected hidden>Select Source</option>
											<option value="BOM">Mumbai Chattrapathi Shivaji International Airport</option>
											<option value="BLR">Bangalore Bengaluru International Airport</option>
											<option value="HYD">Hyderabad Rajiv Gandhi International Airport</option>
									      	<option value="MAA">Chennai Meenambarkkam International Airport</option>
									      	<option value="CCU">Kolkata Netaji Subhash Chandra Bose</option>
									      	<option value="DEL">New Delhi Indira Gandhi International Airport</option>
									      	<option value="AMD">Ahmedabad SD Vallabhbhai Patel International Airport</option>
									      	<option value="GOI">Dabolim Goa International Airport</option>
									      	<option value="COK">Cochin Airport, Kerala Cochin International Airport</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Flyning to</span>
										<select class="form-control" name="fto" required>
											<option value="" disabled selected hidden>Select Destination</option>
											<option value="BOM">Mumbai Chattrapathi Shivaji International Airport</option>
											<option value="BLR">Bangalore Bengaluru International Airport</option>
											<option value="HYD">Hyderabad Rajiv Gandhi International Airport</option>
									      	<option value="MAA">Chennai Meenambarkkam International Airport</option>
									      	<option value="CCU">Kolkata Netaji Subhash Chandra Bose</option>
									      	<option value="DEL">New Delhi Indira Gandhi International Airport</option>
									      	<option value="AMD">Ahmedabad SD Vallabhbhai Patel International Airport</option>
									      	<option value="GOI">Dabolim Goa International Airport</option>
									      	<option value="COK">Cochin Airport, Kerala Cochin International Airport</option>>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Departing</span>
										<input id="txtdate" class="form-control" type="text" name="deptdate" placeholder="MM/DD/YYYY" required>
									</div>
								</div>

								<!--
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Returning</span>
										<input id="txtdate1" class="form-control" type="text" name="retdate" placeholder="MM/DD/YYYY" required>
									</div>
								</div>
								-->
								
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Travel class</span>
										<select class="form-control" name="class">
											<option value="" disabled selected hidden>Select Class</option>
											<option value="Economy">Economy class</option>
											<option value="Business">Business class</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="message"><strong><?php if($message!="") { echo $message; } ?></strong></div>
									<div class="form-btn">
										<button class="submit-btn">Show flights</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>