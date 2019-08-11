<?php

$con=mysqli_connect("localhost", "root", "");
mysqli_select_db($con,'test') OR die(mysqli_error());


$rawdate = htmlentities($_POST['date']);

echo $rawdate;

$date = date('Y-m-d', strtotime($rawdate));

echo $date;

$qry="insert into date (date) values('$date')";

mysqli_query($con,$qry) or die(mysqli_error($con));



?>