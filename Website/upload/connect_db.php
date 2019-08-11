<?php

global $con;
$con=mysqli_connect("localhost", "srbvik", "dellsung");
mysqli_select_db($con,'grms') OR die(mysqli_error());

?>