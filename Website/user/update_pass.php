<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$uname=$_SESSION['username'];

$oldpass=$_POST['oldpass'];
$newpass1=$_POST['newpass1'];
$newpass2=$_POST['newpass2'];


//get the old pass from database and compare with the one entered into form
$oldpasqry="select pass from user where u_name='$uname'";

$oldpasres=mysqli_query($con,$oldpasqry) or die(mysqli_error($con));

$oldpasrow=mysqli_fetch_row($oldpasres);



$err = array() ;

if (empty($oldpass))
     $err[0] = "current password is required"; 
else if($oldpasrow[0]!=$oldpass)
	$err[0] = "password is not correct";
if (empty($newpass1))
     $err[1] = "new password is required"; 

if (empty($newpass2))
     $err[2] = "new password is required"; 
$uname=$_SESSION['username'];
//echo $uname;

if($newpass1!=$newpass2)
	$err[3] = "both password should be same";


if(!empty($err))
{
	echo 'inside if';
$_SESSION['error']=$err;
header('Location: ../change_pass.php');
}

$updpasqry="update user set pass='$newpass1' where u_name='$uname'";
	$updpasres=mysqli_query($con,$updpasqry) or die(mysqli_errno($con));
if($updpasres==1){
	$success="Password changed successfully";
	$_SESSION['success']=$success;
} 
header('Location: ../change_pass.php');

?>