<?php

include 'connect_db.php';
$string= $_POST['search_text'];
//$string = "battlefield";

error_log("\r\nsearch text is :".$string, 3, "error.log");

//search for the game as per the search text
$qry="select g_id from g_detail  where g_name like '%".$string."%' ORDER BY g_id DESC limit 10 offset 1";

$i=0;
$data= array();

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
while($row=mysqli_fetch_row($rs)){
	
	$g_qry="select * from g_detail where g_id='$row[0]'";
	$res=mysqli_query($con,$g_qry) OR die(mysqli_error($con));
	$rw=mysqli_fetch_row($res);
	
	//get the game id
	$g_id[$i]=$rw[0];
	
	//location to game logo
	$logo[$i]="http://10.0.2.2:80/grms/logos/".$g_id[$i]."/".$rw[7];
	
	//title of game
	$title[$i]=$rw[1];
	
	//get rating of the game
	$qry1="select AVG(rating) from game_user where g_id=$g_id[$i]";
	$rs2=mysqli_query($con,$qry1) OR die(mysqli_error($con));
	if(mysqli_num_rows($rs2)==0)  echo "inside if";
	$rw2=mysqli_fetch_row($rs2);
	round($rw2[0],1);
	$rating[$i] = round($rw2[0],1);
	
	//get developer
	$developer[$i]=$rw[8];
	
	//get producer
	$producer[$i]=$rw[9];
	
	array_push ($data,array('g_id'=>$g_id[$i],'logo'=>$logo[$i],'title'=>$title[$i], 'developer'=>$developer[$i], 'producer'=>$producer[$i], 'avg_rating'=>$rating[$i]));
	
}

print_r(json_encode($data));



?>