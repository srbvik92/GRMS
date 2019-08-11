<?php
 //error_reporting(E_ALL); ini_set('display_errors', TRUE); ini_set('display_startup_errors', TRUE);
error_reporting(0);
include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }

$qry="select id, top_image,title from stories order by id desc limit 5";
$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
$dir ="http://10.0.2.2:80/grms/stories/top_image/";

$data= array();

//send data to android 
while($rw=mysqli_fetch_row($rs)){
	$image=$dir.$rw[0]."/".$rw[1];
	array_push($data,array('nid'=>$rw[0],'top_image'=>$image,'title'=>$rw[2]));
}

//echo json_encode($data);

print_r(json_encode($data));

//print_r(json_encode(['code'=>'username and password mismatch']));
?>