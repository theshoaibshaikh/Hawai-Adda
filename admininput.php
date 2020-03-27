<!--PHP CODE TO INSERT DATA-->
<?php
if(!empty($_POST["aid"]))
{
  $flightnum=123;

  require 'connect.php';

  $query = "INSERT INTO flights (air_id,source,destination,d_time,a_time) VALUES ('$_POST[aid]','$_POST[src]','$_POST[dest]','$_POST[depttime]','$_POST[arrtime]')";
  $result = pg_query($query); 
  if(!$result) {
        echo pg_last_error($db);
  } 

  $sql = "SELECT fnum from flights where air_id='$_POST[aid]' and source='$_POST[src]' and destination='$_POST[dest]' and d_time='$_POST[depttime]'";
  $ret = pg_query($db, $sql);
     if(!$ret) {
        echo pg_last_error($db);
    }
  $myrow = pg_fetch_assoc($ret); 
  $flightnum=$myrow[fnum];

  $query1 = "INSERT INTO price (fnum,name,capacity,cost) VALUES ($flightnum,'Economy','$_POST[ecap]','$_POST[eprice]')";
  $query2 = "INSERT INTO price (fnum,name,capacity,cost) VALUES ($flightnum,'Business','$_POST[bcap]','$_POST[bprice]')";     

  $result1 = pg_query($query1); 
      if(!$result1) {
        echo pg_last_error($db);
     }

  $result2 = pg_query($query2); 
     if(!$result2) {
        echo pg_last_error($db);
     } 
     else {
      echo "Flight Added Successfully...";
      header("location: display.php");
     }
     pg_close($db);
}
?>
<?php
session_start();
//****
if($_SESSION["name"] == 'ADMIN') {
?>

<html>
<title>Add Flights</title></title>
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
  background-color: #008CBA; 
  color: white; 
  border: 2px solid #008CBA;
  border-radius: 8px;
  padding: 8px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  position: absolute; 
  left:50%;
}

.submit-btn:hover {
  border: 2px solid red;
  opacity: 1;
  color: white;
  background-color:red ; 
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);    
}

.add-flight {
    border: none;
    padding: 80px;
    margin-bottom: 60px;
}
.add-flight form label {
    font-size: 15px;
    text-transform: capitalize;
    margin-bottom: 8px;
    color: #000;
    margin-top: 10px;
    display: BLOCK;
    font-weight: 400;
    float: left;
    width: 16%;
    text-align: right;
    margin-right: 4%;
}

.add-flight form select {
    border: 1px solid #008CBA;
    background-color: #fff;
    padding: 8px;
    width: 30%;
    margin-bottom: 25px;
}
.add-flight form input {
    border: 1px solid #008CBA;
    background-color: #fff;
    padding: 8px;
    width: 30%;
    margin-bottom: 25px;
}
.layout{
  margin: 2%;
}
.title {
  padding: 5px; 
  text-align: center;
  color: black;
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
          <li class="active"><a href="admininput.php"><i class="fas fa-plus"></i> ADD FLIGHT</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="signout.php"><span class="fa fa-sign-out"></span> SIGN OUT</a></li>
        </ul>
      </div>
  </nav>

<!--<p id="demo"></p>-->


<!--<h3>Add Flight </h3>-->
<div class="add-flight">
<form action="" method="post">
	    
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
    <br>
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
		<br>
		<label>Departure Time<span>*</span></label>
		 <input type="time" value="dateTime" name="depttime" required></input>
		 <br>
		<label>Arrival Time<span>*</span></label>
		 <input type="time" name="arrtime" required></input>
      <br>
    <label>Economy Capacity<span>*</span></label>
     <input type="text" name="ecap" required></input>
      <br>
    <label>Economy Price<span>*</span></label>
     <input type="text" name="eprice" required></input>
      <br>
    <label>Business Capacity<span></span></label>
     <input type="text" name="bcap"></input>
      <br>
    <label>Business Price<span></span></label>
     <input type="text" name="bprice"></input>
      <br>  
      <br>
      <button type="submit" class="submit-btn">Submit</button>
</form>
</div>  
<script>
	function dt()
	{
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