<?php

global $con;
$con=mysqli_connect("localhost", "root", "");
mysqli_select_db($con,'game') OR die(mysqli_error());

?>