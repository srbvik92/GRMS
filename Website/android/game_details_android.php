<?php

include 'connect_db.php';

error_reporting(0);

$g_id = $_POST['gid'];

//$g_id = 12;

$qry="select * from g_detail where g_id=$g_id";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
$rw=mysqli_fetch_row($rs);

//set title
$title = $rw[1];

//set logo image
$logo="http://10.0.2.2:80/grms/logos/".$g_id."/".$rw[7];

//set available platforms
$pformqry="select * from g_pform where g_id=$g_id";
					$pformrs=mysqli_query($con,$pformqry) OR die(mysqli_error($con));
					$pformrow=mysqli_fetch_row($pformrs);
					//echo $pformrs[1]."halalalalala";
					if($pformrow[1]==1)$pc="PC, ";
					if($pformrow[2]==1)$ps3="PS3, ";
					if($pformrow[3]==1)$x360="Xbox 360, ";
					if($pformrow[4]==1)$ps4="PS4, ";
					if($pformrow[5]==1)$xone="Xbox One";
					
					$platform = $pc.$ps3.$x360.$ps4.$xone;

//release date
$date=date('d-m-Y',strtotime($rw[3]));

//age rating logo variable
$age = $rw[5];
//developser
$developer=$rw[8];

//genre
$gen_qry="select * from g_genre where g_id='$g_id'";
		$genrs=mysqli_query($con,$gen_qry) OR die(mysqli_error($con));
		$genrow=mysqli_fetch_row($genrs);
		
		if($genrow[1]==1)$action="Action, ";
		if($genrow[2]==1)$adventure="Adventure, ";
		if($genrow[3]==1)$fighting="Fighting,";
		if($genrow[4]==1)$first_person="First Person, ";
		if($genrow[5]==1)$horror="Horror, ";
		if($genrow[6]==1)$multi_player="Multiplayer, ";
		if($genrow[7]==1)$online="Online, ";
		if($genrow[8]==1)$open_world="Open World, ";
		if($genrow[9]==1)$party="Party, ";
		if($genrow[10]==1)$platform_game="Platform, ";
		if($genrow[11]==1)$puzzle="Puzzle, ";
		if($genrow[12]==1)$racing="Racing, ";
		if($genrow[13]==1)$rpg="Role Playing, ";
		if($genrow[14]==1)$shooters="Shooters, ";
		if($genrow[15]==1)$sim="Simulation, ";
		if($genrow[16]==1)$sports="Sports, ";
		if($genrow[17]==1)$strategy="Strategy, ";
		if($genrow[18]==1)$survival="Survival, ";
		if($genrow[19]==1)$third_person="Third Person, ";
		if($genrow[20]==1)$wrestling="Wrestling, ";
	
	$genre = $action.$adventure.$fighting.$first_person.$horror.$multi_player.$online.$open_world.$party.$platform_game.$puzzle.$racing.$rpg.$shooters.$sim.$sports.$strategy.$survival.$third_person.$wrestling;

//echo $genre;

//summary
$summary=$rw[10];

//get rating of the game
$qry1="select AVG(rating) from game_user where g_id=$g_id";
$rs2=mysqli_query($con,$qry1) OR die(mysqli_error($con));
if(mysqli_num_rows($rs2)==0)  echo "inside if";
$rw2=mysqli_fetch_row($rs2);
round($rw2[0],1);
$rating = round($rw2[0],1);

//prepare json data
$data = array();

array_push($data, array('title'=>$title,'logo'=>$logo, 'platform'=>$platform, 'date'=>$date, 'developer'=>$developer, 'genre'=>$genre, 'summary'=>$summary, 'agerating'=>$age, 'rating'=>$rating));

print_r(json_encode($data));

?>