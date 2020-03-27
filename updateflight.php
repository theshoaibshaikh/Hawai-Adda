<!--PHP CODE TO UPDATE DATA-->
<?php

session_start();
$fnum = $_SESSION["fnum"];

require 'connect.php';


if($_POST)
{
  if(isset($_POST['up1']))
  {
    up1();
  }
  elseif(isset($_POST['up2']))
  {
    up2(); 
  }
  elseif(isset($_POST['up3']))
  {
    up3(); 
  }
  elseif(isset($_POST['up4']))
  {
    up4(); 
  }
}


function up1()
{
  $query = "UPDATE flights set air_id='$_POST[aid]' where fnum=$GLOBALS[fnum]";
  $result = pg_query($query);
  if(!$result) 
  {
      echo pg_last_error($db);
  } 
  else 
  {
    echo "Flight Details Updated Successfully...";
  }
}
function up2()
{
  $query = "UPDATE flights set source='$_POST[src]',destination='$_POST[dest]',d_time='$_POST[depttime]',a_time='$_POST[arrtime]' where fnum=$GLOBALS[fnum]";
  $result = pg_query($query);
  if(!$result) 
  {
      echo pg_last_error($db);
  } 
  else 
  {
    echo "Flight Details Updated Successfully...";
  }
}
function up3()
{
  $query = "UPDATE price set capacity='$_POST[ecap]',cost='$_POST[eprice]' where fnum=$GLOBALS[fnum] and name='Economy'";
  $result = pg_query($query);
  if(!$result) 
  {
      echo pg_last_error($db);
  } 
  else 
  {
    echo "Flight Details Updated Successfully...";
  }
}
function up4()
{
  $query = "UPDATE price set capacity='$_POST[bcap]',cost='$_POST[bprice]' where fnum=$GLOBALS[fnum] and name='Business'";
  $result = pg_query($query);
  if(!$result) 
  {
      echo pg_last_error($db);
  } 
  else 
  {
    echo "Flight Details Updated Successfully...";
  }
}

pg_close($db);

header('location: update.php');

?>