<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect_db.php';

$uname=$_SESSION['username'];
$g_id=$_POST['g_id'];
$p_form=$_POST['p_form'];
//echo $p_form;
$rating=$_POST['rating'];
$comp=$_POST['completion'];

$qry="insert into game_user values($g_id,'$p_form','$uname',$comp,$rating)";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));


$header=$_SERVER['DOCUMENT_ROOT']."/grms/game_details.php?id=".$g_id;


//$wish_qry="insert into wishlist values($g_id,'$uname')";

//$rs=mysqli_query($con,$wish_qry) OR die(mysqli_error($con));

//delete game from wishlist if it is in wishlist
if($rs)
{
	$del_qry="delete from wishlist where g_id='$g_id'";
	$rs=mysqli_query($con,$del_qry) OR die(mysqli_error($con));
}

header("location:$header");

?>