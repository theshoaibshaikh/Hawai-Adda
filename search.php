<?php
	error_reporting(0); 
	session_start();
	$message="";
	$source      = $_SESSION['ffrom'];
	$destination = $_SESSION['fto'];
	$class       = $_SESSION['class'];
	$date        = $_SESSION['date'];
?>
<html>
<title>search</title>
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
	<link type="text/css" rel="stylesheet" href="css/searchstyle.css" />

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
		      <li><a href="index.php">Home</a></li>
		      <li><a href="contactus.php"><i img></i> Contact</a></li>
		     
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
	
	<!--Searching for flights-->
	<?php
	require 'connect.php';

	global $availableNumber;

	$query1 = "select f.fnum,f.d_time,f.a_time,p.name,p.cost,f.air_id FROM flights f natural join price p WHERE f.source='$source' and f.destination = '$destination' and p.name='$class'";
	$query2 = "select name as source from airport where code='$source' limit 1"; 
	$query3 = "select name as destination from airport where code='$destination' limit 1"; 

	$result1 = pg_query($db,$query1); 
	$result2 = pg_query($db,$query2); 
	$result3 = pg_query($db,$query3);  
	
	
	if(!pg_affected_rows($result1))
	{
		echo "<div class='alert alert-info'><strong>Sorry, No flights available...</strong></div>";
	} 
	else
	{
		$row2 = pg_fetch_row($result2); //source
		$row3 = pg_fetch_row($result3); //destination
		
		//echo "<form action='mycart.php' method='post'>";
		echo "<div class='flex-container'>";

		while($row1 = pg_fetch_row($result1))
		{
    		//$_SESSION["id"] = $row[0];
    		$query4 = "select airline from airplane where id='$row1[5]'";
    		$result4 = pg_query($db,$query4);  
    		$row4 = pg_fetch_row($result4);	
   				
   			
	    	echo "<div class='flex-container-div'>";
			echo "<span class='f-title'>Flight No:</span>".$row1[0]."<span class='f-title'> Departure:</span>" . $row1[1]. "<span class='f-title'> Arrival:</span>" . $row1[2]."<span class='f-title'> Class:</span>" . $row1[3];
			echo "<br>";
			echo "<img src='images/$row4[0].jpg' alt='Avatar' class='image'>";
			echo "<span class='f-title'> Source:</span>".$row2[0]."<span class='f-title'> Destination:</span>" . $row3[0];
			echo "<span class='f-price'>Rs." . $row1[4]."</span>";


			//calculate number of remain seats
	        $seatreserved = "SELECT fnum, classtype, COUNT(*)
	                    FROM book B
	                    WHERE B.date = '".$date."' AND B.fnum = '".$row1[0]."'AND B.classtype ='".$row1[3]."' AND paid=1
	                    GROUP BY fnum, classtype";
	        $reserved = pg_query($db,$seatreserved);   
	        $reservedNumber = pg_fetch_row($reserved);
	        
	        $capacity = pg_query($db, "SELECT capacity FROM price C WHERE C.fnum='".$row1[0]."' AND C.name= '".$row1[3]."'");
	        $capacityNumber = pg_fetch_row($capacity);


	        if(pg_affected_rows($reserved)>0){            
	            $availableNumber = $capacityNumber[0] - $reservedNumber[2];
	        }else{
	            $availableNumber = $capacityNumber[0];
	        }

	        echo "<span class='f-title'> Seats available:</span>".$availableNumber;

	        if($availableNumber>0)
	        {
		    	echo '<form action="insertcart.php" method="post">
		        <input type="hidden" name="flightno" value="'.$row1[0].'">
		        <input type="hidden" name="classtype" value="'.$row1[3].'">
		        <input type="hidden" name="price" value="'.$row1[4].'">
		        <input type="hidden" name="date" value="'.$date.'">
		        <input type="hidden" name="dtime" value="'.$row1[1].'">
		        <input type="hidden" name="type" value="all">
		        

		        <div class="container">
				  <!-- Trigger the modal with a button -->
				  <button type="button" class="submit-btn" data-toggle="modal" data-target="#myModal">Book</button>
				  <!-- Modal -->
				  <div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Enter Passenger Details</h4>
				        </div>
				        <div class="modal-body">
				          
							<div class="input-container">
							    <label>Full Name</label>
							    <input class="input-field" type="text" placeholder="As per ID proof" name="fnm" required>
							</div>

						  	<div class="input-container">
						    	<label>Age</label>
						    	<input class="input-field" type="text" placeholder="age" name="age" required>
						  	</div>
						  
						  	<div class="input-container">
						  		<label>Gender</label>
						  		<div>
						    		<label class="radio-inline"><input type="radio" name="gender" value="Male" checked>Male</label>
						    		<label class="radio-inline"><input type="radio" name="gender" value="Female" checked>Female</label>
						    		<label class="radio-inline"><input type="radio" name="gender" value="Other" checked>Other</label>
						    	</div>
						  	</div>

				        </div>

				        <div class="modal-footer">
				          <button type="submit" class="submit-btn">Book</button>
				          <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
				        </div>
				      </div>
				      
				    </div>
				  </div>
				  
				</div>


		        </form>';
		    }else{

		    }
			echo "</div>";
			
		}
		echo "</div>";
	}
		
	?>
</body>
</html>