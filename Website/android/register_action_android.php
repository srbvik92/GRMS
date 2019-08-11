<?php

include 'connect_db.php';

$uname = $_POST['uname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$country = $_POST['country'];
$dispname = $_POST['dispname']; 

/*$uname = "b";
$email = "b@c.com";
$pass = "b";
$name = "b";
$dob = "22-02-2000";
$country = "b";
$dispname = "b"; */

$sex="";

$err = array();

//check if username already exists
$erqry1="select u_name from user where u_name='$uname'";

$errs1=mysqli_query($con,$erqry1) OR die(mysqli_error($con));

$exist1=mysqli_fetch_row($errs1);

if(!empty($exist1))
{
	array_push($err, array('code'=>'Username has already been taken'));
}

//check if email already exists
$erqry2="select email from user where email='$email'";

$errs2=mysqli_query($con,$erqry2) OR die(mysqli_error($con));

$exist2=mysqli_fetch_row($errs2);

if(!empty($exist2))
{
	array_push($err, array('code'=>'Email has been taken, please try other'));
}

//if one of the above condition occurs, then send following info
if(empty($exist1) and empty($exist2))
{
	$qry="insert into user values('$uname','$email','$pass','$name','$country','$dispname',$dob,'$sex')";

	//$result = 1;
	$result = mysqli_query($con,$qry) OR die(mysqli_error($con));
	
	if($result){
	array_push($err, array('code'=>'registered successfully'));
	}
	else {
		array_push($err, array('code'=>'unknown error occured, please try again later'));
	}
}

print_r(json_encode($err));



