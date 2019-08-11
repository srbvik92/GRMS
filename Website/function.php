<?php

include 'connect_db.php';
error_reporting(1);

function get_avg_rat($game_id)
{
	//echo "safdsadf";
	echo $game_id;
	$ratqry="select AVG(rating) from game_user where g_id=$game_id";
    $ratrs=mysqli_query($con,$ratqry);
	//if(mysqli_num_rows($ratrs)==0)  echo "inside if";
	$ratrw=mysqli_fetch_row($ratrs);
	
	echo round($ratrw[0],5);
	
	$rating=$ratrw[0];
	
	echo $rating;
	
	return $rating;
}

?>