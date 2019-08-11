<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$uname=$_SESSION['username'];

$name=$_POST['name'];
$dob=$_POST['dob'];
$nation=$_POST['nation'];
$sex=$_POST['sex'];

$updqry="update user set name='$name', dob=$'dob', country='$nation', sex='$sex' where u_name='$uname'";

$updres=mysqli_query($con,$updqry) or die(mysqli_errno($con));

header('Location: ../personal details.php')

?>