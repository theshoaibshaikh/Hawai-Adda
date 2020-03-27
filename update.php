<?php
error_reporting(0);
session_start();
$fnum=$_SESSION["fnum"];
//****
if($_SESSION["name"] == 'ADMIN') {
?>

<html>
<title>Update Flight</title></title>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- for navbar -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!--ICONS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--ICONS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link rel="icon" href="images/flight.png" type = "image/x-icon">

<style>
body
{
	background: url(images/airline1.jpg);
  background-repeat: no-repeat;
  background-size: auto;
}
span{
	padding-left: 10px;
}

.submit-btn {
	color: #fff;
	background-color: #f23e3e;
	font-size: 16px;
	padding: 4px;
	border: none;
	border-radius: 40px;
	-webkit-transition: 0.2s all;
	transition: 0.2s all;
}

.submit-btn:hover,
.submit-btn:focus {
	opacity: 0.9;
}

.add-flight {
    border: none;  
}
.add-flight label {
    font-size: 15px;
    text-transform: capitalize;
    margin-bottom: 8px;
    color: white;
    margin-top: 10px;
    display: block;
    font-weight: 400;
    float: left;
    width: 16%;
    text-align: right;
    margin-right: 4%;
}

.add-flight select {
    border: 1px solid #008CBA;
    background-color: #fff;
    padding: 8px;
    width: 30%;
    margin-bottom: 25px;
}
.add-flight input {
    border: 1px solid #008CBA;
    background-color: #fff;
    padding: 8px;
    width: 30%;
    margin-bottom: 25px;
}
.title {
  padding: 5px; 
  text-align: center;
  color: black;
}
.layout{
  margin: 2%;
}


* {
  box-sizing: border-box;
}

.row {
  	display: flex;
  	background: rgba(0, 0, 0, 0.7);
	border-radius: 6px;
}


/* Create two equal columns that sits next to each other */
.column {
  flex: 50%;
  padding: 10px;
  height: auto; 
}

</style>

</head>
<body>

  <div class="title"><h2 style="color:white;">HAWAI ADDA</h2></div>
  <!--navbar-default-->
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!--<div class="navbar-header">
            <a class="navbar-brand" href="#"><div class="title">Hawai Adda</div></a>
        </div>  -->
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="display.php"><i class="fas fa-columns"></i> DISPLAY</a></li>
          <li><a href="admininput.php"><i class="fas fa-plus"></i> ADD FLIGHT</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="signout.php"><span class="fa fa-sign-out"></span> SIGN OUT</a></li>
        </ul>
      </div>
  </nav>

<div class="layout">
<h3 style="color:white;">Update Flight : <?php echo $fnum;?></h3>
<div class="add-flight">
	<div class="row">
	  <div class="column">
	  	<form method="post" action="updateflight.php">
			<label>Airplane ID<span>*</span></label>
		    <select name="aid" class="title" required>
		      <option value="" disabled selected hidden>Select aircraft-airline</option>
		      <option value="1100">A320-Air India</option>
		      <option value="1101">A321-Air India</option>
		      <option value="1102">A321-IndiGO</option>
		      <option value="1103">ATR72-IndiGO</option>
		      <option value="1104">B737-Spice Jet</option>
		      <option value="1105">BQ400-Spice Jet</option>
		    </select>
		    <input type="hidden" name="up1" value="up1"></input>
		    <button class="submit-btn" style="margin: 2%;">Update</button>
		</form>
	   </div>
	</div>
	<br>
	<div class="row">
	  	<div class="column">
	  		<form method="post" action="updateflight.php">
			<label>Select Source<span>*</span></label>
			<select name="src" class="title" required>
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
			<br>
			<label>Select Destination<span>*</span></label>
			<select name="dest" class="title" required>
			  <option value="" disabled selected hidden>Select Destinations</option>
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
		   </div>
		   <div class="column">
			<label>Departure Time<span>*</span></label>
			 <input type="time" value="dateTime" name="depttime" required></input>
			 <br>
			<label>Arrival Time<span>*</span></label>
			 <input type="time" name="arrtime" required></input>
			 <input type="hidden" name="up2" value="up2"></input>
			 <button class="submit-btn" style="margin: 2%;">Update</button>
	      </form>
	      </div>
      <br>
    </div>
    <br>
    <div class="row">
    	<div class="column">
    	<form method="post" action="updateflight.php">
		    <label>Economy Capacity<span>*</span></label>
		     <input type="text" name="ecap" placeholder="enter total seats" required></input>
		</div>
		<div class="column">
		    <label>Economy Price<span>*</span></label>
		     <input type="text" name="eprice" placeholder="enter price" required></input>
		     <input type="hidden" name="up3" value="up3"></input>
		     <button class="submit-btn" style="margin: 2%;">Update</button>
	    </form>
	    </div>
	</div>

	<br>
	<div class="row">
    	<div class="column">
		<form method="post" action="updateflight.php">
    		<label>Business Capacity<span>*</span></label>
		     <input type="text" name="bcap" placeholder="enter total seats" required></input>
		</div>
    	<div class="column">
		    <label>Business Price<span></span>*</label>
		    <input type="text" name="bprice" placeholder="enter price" required></input>
		    <input type="hidden" name="up4" value="up4"></input>
		    <button class="submit-btn" style="margin: 2%;">Update</button>
		</form>
		</div>
	</div>
</div>  
</div>
<script>
	function dt(){
	var today = new Date();
var date = today.getFullYear()+'-'+today.getMonth()+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+'T'+time;
return dateTime;
}
var x = dt();
document.getElementById("demo").innerHTML = x;
</script>

<!--FOR AUTHENTICATION-->
<?php
}
else
{
  echo "<h3>404 Page Not Found</h3>";
}
?>
</body>
</html>