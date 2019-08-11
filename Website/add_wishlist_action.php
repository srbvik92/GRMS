<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect_db.php';

// get g_id and username values

$g_id=$_POST["g_id"];
$u_name=$_SESSION["username"];

//prepare insert query

$qry="insert into wishlist values('$g_id','$u_name')";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));

header("location:game_details.php?id=$g_id");

?>