<?php

include 'connect_db.php';

$uname = $_POST['uname'];
$pass = $_POST['pass'];

$err= array();

$sql="SELECT * FROM user WHERE u_name='$uname' and pass='$pass'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
header('Content-type: application/json');
if($count==1)
{
	//successfull logged in
$_SESSION["username"]=$uname;
//$_SESSION["usertype"]=$usertype;
//session_register("pass"); 
//header("location: home.php");
	print_r(json_encode(['code'=>'success','uname'=>$uname]));
}
else 
{
	//wrong user or pass
//$_SESSION['error5']= " **Wrong Username or Password";
//header("location:home.php");
	print_r(json_encode(['code'=>'username and password mismatch']));
}

//$data = [ 'uname' => 'login success !!!!! Welcome $user', 'pass' => '$user' ];
//header('Content-type: application/json');
//print_r(json_encode( $data ));

?>
 