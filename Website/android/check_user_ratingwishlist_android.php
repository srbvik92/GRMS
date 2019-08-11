<?php

include 'connect_db.php';

error_reporting(0);


//$g_id = $_POST['gid'];
$uname = $_POST['username'];

$g_id = 1;
//$uname = "srbvik91";

$data = array();

//check whether user has played game or not
$query="select * from game_user where g_id=$g_id and u_name='$uname'";

$result=mysqli_query($con,$query) OR die(mysqli_error($con));

/*<!-- check that game is already in wishlist or not 
    Three conditions apply
    1. If played, show that you have played this game even though if it is not in wishlist.
    2. If in playlist but not played, show that it is in playlist.
    3. Neither in playlist nor played, show "Add to playlist".        --> */

//check that user has rated game of not, if played fetch related data and send to android
if(mysqli_num_rows($result)!=0) {
	$rwuser=mysqli_fetch_row($result);
	$completion=$rwuser[3];
	$rating=$rwuser[4];
	$platform=$rwuser[1];
	array_push($data, array('code'=>"played",'completion'=>$completion,'rating_user'=>$rating,'platform_user'=>$platform));
	
}

//not played, check if added to wishlist or not
else
{
	$wish_chk="select * from wishlist where g_id=$g_id and u_name='$uname'";
	$wish_rs=mysqli_query($con,$wish_chk) OR die(mysqli_error($con));
	
	//if in wishlist, send data that it is in wishlist
	if (mysqli_num_rows($wish_rs) != 0) {
		array_push($data, array('code'=>"wishlist"));
	}
	
	//if not in wishlist, then also tell to android
	else{
		array_push($data, array('code'=>"none")); //none means not in wishlist and not rated or played
	}
	
}

print_r(json_encode($data));



?>