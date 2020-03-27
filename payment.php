<?php
error_reporting(0); 
session_start();
$message="";
//$flight = $_POST['flight'];
//$class=$_SESSION['class'];
//require 'connect.php';
//$query1 = "select cost FROM price WHERE fnum='$flight' and name='$class'";
//$result1 = pg_query($db,$query1); 
//$row1 = pg_fetch_row($result1);
$price=$_POST['price'];
$user = $_SESSION["name"];

include_once 'connect.php';

 
    $sql = mysqli_query($db,"UPDATE book
            SET paid = 1
            WHERE username = '$user'");

pg_close($db);
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
	<link type="text/css" rel="stylesheet" href="css/formstyle.css" />

	<!-- for navbar -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  	<!-- for icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="icon" href="images/flight.png" type = "image/x-icon">
<style type="text/css">
.message{
	color: red;
}

.title 
{
  	padding: 5px; 
  	text-align: center;
  	color: white;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  background: rgba(0, 0, 0, 0.7);
  border-radius: 6px;
  padding: 5px 20px 15px 20px;
}


input[type=text] 
{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

label {
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

.form-control{
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

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

body {
  background: url(images/airline1.jpg);
  background-repeat: no-repeat;
  background-size: auto;
  padding: 8px;
}

h3 {
  color:white;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: white;
  font-size: 18px; 
  margin: 10px;
}

.submit-btn {
color: #fff;
background-color: #f23e3e;
font-weight: 400;
height: 50px;
font-size: 14px;
border: none;
width: 100%;
border-radius: 40px;
text-transform: uppercase;
-webkit-transition: 0.2s all;
transition: 0.2s all;
}

.submit-btn:hover,
.submit-btn:focus {
opacity: 0.9;
}

.pay-form {
border: none;
background: rgba(0, 0, 0, 0.7);
border-radius: 6px;
font-family: Arial, Helvetica, sans-serif;
display: inline-block;
width: auto;
height: auto;
margin: auto;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
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


<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="pay.php">
      
        <div class="row">
          
          <div class="col-50">
            <h3>Payment</h3> 
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:green;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" class="form-control" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" class="form-control" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" class="form-control" name="expmonth" placeholder="January">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" class="form-control" name="expyear" placeholder="2023">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
        </div>
		<span class="price">Amount total : Rs.<?php echo $price?></span>
        <button type="submit" value="" class="submit-btn">Continue to checkout</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>