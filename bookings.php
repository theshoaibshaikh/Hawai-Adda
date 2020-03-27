<?php
//error_reporting(0); 
session_start();
$message="";
$user = $_SESSION["name"];
?>
<html>
<title>my bookings</title>
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
		      <li class=""><a href="index.php">Home</a></li>

		      <li><a href="contactus.php"><i class="fa fa-fw fa-envelope"></i> Contact</a></li>
		     
		    	<?php
					if($_SESSION["name"]) 
					{
				?>
						<li><a href="mycart.php"><i class="glyphicon glyphicon-shopping-cart"></i> Cart</a></li>
		      			<li class="active"><a href="bookings.php"><i class="glyphicon glyphicon-check"></i> My Bookings</a></li>
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

	<?php

	include_once 'connect.php';



	$sql = "SELECT ALL FL.fnum, B.ID, time, B.date,  source, d_time, destination, a_time, C.name , capacity, cost, type, paid,fname  
            FROM flights FL,  price C, airplane AP , book B, passenger P
            WHERE (FL.fnum = C.fnum) AND (B.fnum = c.fnum) AND (classtype = C.name) AND (FL.air_id = AP.id) AND (B.ID = P.pnr)
            AND  B.username = '$user' AND paid = 1
            ORDER BY time";


	$result = pg_query($db,$sql);
	$rowcount = pg_fetch_row($result);
	$result = pg_query($db,$sql);

	if($rowcount == 0){
	    echo "<div class='alert alert-info'><strong>Nothing in the history.</strong></div>";
	}
	else
	{
	    echo "<div class='alert alert-info'>My Bookings:</div>";
   
	    echo "<table class='table table-bordered table-striped table-hover'>
	          <thead>
	          <tr>
	            <th>PNR</th>
	            <th>Passenger</th>
	            <th>Time</th>
	            <th>Flight</th>
	            <th>Aircraft</th>
	            <th>Date</th>
	            <th>Departure</th>
	            <th>Departure Time</th>
	            <th>Arrival</th>
	            <th>Arrival Time</th>
	            <th>Class</th>

	            <th>Price</th>

	            <th>Pay</th>
	          </tr>
	          </thead>";
	    while($row = pg_fetch_row($result)) 
        {
	        echo "<tbody><tr>";
	        echo "<td>" . $row[1] . "</td>"; //pnr
	        echo "<td>" . $row[13] . "</td>"; //passenger

	        echo "<td>" . $row[2] . "</td>"; //time
	        echo "<td>" . $row[0] . "</td>"; //fnum
	        echo "<td>" .$row[11]. "</td>";
	        echo "<td>" . $row[3] . "</td>"; //date
	        echo "<td>" . $row[4] . "</td>"; //source
	        echo "<td>" . $row[5] . "</td>"; //dtime
	        echo "<td>" . $row[6] . "</td>"; //destination
	        echo "<td>" . $row[7] . "</td>"; //atime
	        echo "<td>" . $row[8] . "</td>"; //class name

	        echo "<td>" . $row[10] . "</td>"; //cost

	        if($row[12] == 1){
	            echo "<td>YES</td>";
	        }
	       
	        echo "</tr>";
	    }
	    echo " </tbody></table>";
	  
	}

	pg_close($db);
	?>

	
</body>
</html>