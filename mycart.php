<?php
error_reporting(0); 
session_start();
?>
<html>
<title>make payment</title>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <style type="text/css">
    
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
       		<ul class="nav navbar-nav">
		      <li><a href="index.php">Home</a></li>
		      <li><a href="contactus.php"><i class="fa fa-fw fa-envelope"></i> Contact</a></li>
		     
		    	<?php
					if($_SESSION["name"]) 
					{
				?>
            <li class="active"><a href="mycart.php"><i class="glyphicon glyphicon-shopping-cart"></i> Cart</a></li>
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

<?php

include_once 'connect.php';

$total=0;

if(!isset($_SESSION["name"])){
    header("Location: signin.php");
}else{
    $user = $_SESSION["name"];  


$sql = "SELECT ALL FL.fnum, B.ID, time, B.date,  source, d_time, destination, a_time, C.name , capacity, cost, type
            FROM flights FL,  price C, airplane AP , book B
            WHERE (FL.fnum = C.fnum) AND (B.fnum = c.fnum) AND (classtype = C.name) AND (FL.air_id = AP.id) 
            AND  B.username = '$user' AND paid = 0
            ORDER BY time";


$result = pg_query($db,$sql);
$rowcount = pg_fetch_row($result);
$result = pg_query($db,$sql);
    if($rowcount == 0)
    {
        echo "<div class='alert alert-info'><strong>Nothing in the shopping cart.</strong></div>";
    }
    else
    {
      echo "<div class='alert alert-info'>In the shopping cart:</div>";

      echo "<table class='table table-bordered table-striped table-hover'>
          <thead>
          <tr>
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
        
       
            //calculate number of remain seats
            $seatreserved = "SELECT fnum, classtype, COUNT(*)
                        FROM book B
                        WHERE B.date = '".$row[3]."' AND B.fnum = '".$row[0]."'AND B.classtype ='".$row[8]."' AND paid=1
                        GROUP BY fnum, classtype";
            $reserved = pg_query($db, $seatreserved);   
            $reservedNumber = pg_fetch_row($reserved);
            
            $capacity = pg_query($db, "SELECT capacity FROM price C WHERE C.fnum='".$row[0]."' AND C.name= '".$row[8]."'");
            $capacityNumber = pg_fetch_row($capacity);


            if(pg_fetch_row($reserved)>0){            
                $availableNumber = $capacityNumber[0] - $reservedNumber[2];
            }else{
                $availableNumber = $capacityNumber[0];
            }
        
     
        
        if($availableNumber>0){
        echo '<td>
            <form action="delete.php" method="post">
            <input type="hidden" name="bookid" value="'.$row[1].'" >
            <button type="submit" class="btn btn-danger">Delete</button></div>
            </form>        
            </td>';
        }
        else
        {
            echo "<td><button type='button' class='btn btn-warning' onclick='myFunction()'>No seat Available now</button></td>";
        }
        
        $sum = pg_query($db,"SELECT SUM(cost) as tot FROM book B, price C WHERE B.username = '$user' AND paid = '0' AND classtype=C.name AND B.fnum = C.fnum");

        $t = pg_fetch_row($sum);
        $total = $t[0];
        echo "</tr>";
    }
    echo " </tbody></table>";
    echo " <form action='payment.php' method='post'>";
    echo "<div class='row'>
        <div class='col-sm-4'></div>
        <div class='col-sm-4'><p class='lead'>Total: <span id='total'>Rs.".$total."</span></p></div>
        <input type='hidden' name='price' value='".$total."'>
        <div class='col-sm-4'><button type='submit' class='btn btn-primary'>Pay</button></div>
      </div>";
    
    echo "</form>";
    echo "<br>";

    }

}
pg_close($db);
?>
</body>
</html>