<?php 

include 'connect_db.php';

//$uname=$_POST['uname'];
$uname = "srbvik91";

//array for json data to android
$array = array();



//total games played
$qry="select COUNT(g_id) from game_user where u_name='$uname'";
		$rs=mysqli_query($con,$qry);
		$rw=mysqli_fetch_row($rs);
$total_games = $rw[0];

array_push($array, array('game count'=> $total_games));


//highest rated game or games
$qry1 = "select g_id,rating from game_user where rating = (select MAX(rating) from game_user) and u_name='$uname'";
$rs1=mysqli_query($con,$qry1) OR die(mysqli_error($con));
$played_count = 0;
array_push($array, array('top rated count'=>$played_count));


$top_list = array();
	while($rw1=mysqli_fetch_row($rs1)){
		//echo "result";
		$played_count++;
		$qry2="select g_name from g_detail where g_id=$rw1[0]";
		$rs2=mysqli_query($con,$qry2) OR die(mysqli_error($con));
		$rw2=mysqli_fetch_row($rs2);
		//$top_list = array($rw1[0],$rw2[0]);
	
		array_push($array, array($rw1[0]=>$rw2[0]));
		$array[1]['top rated count'] = $played_count;
				
	}
//array_push($array, array('top rated count'=>$played_count));
//array_push($array, array($played_list));




//for most occuring genre, select all the games played by user, and then for each game, increase individual genre variable count by one in which there is 1 in g_genre table
$gen="select g_id from game_user where u_name='$uname'";
$genrs=mysqli_query($con,$gen) or die(mysqli_error($con));

$action=0;
$adventure=0;
$fighting=0;
$first_person=0;
$horror=0;
$multi_player=0;
$online=0;
$open_world=0;
$party=0;
$platform=0;
$puzzle=0;
$racing=0;
$rpg=0;
$shooters=0;
$sim=0;
$sports=0;
$strategy=0;
$survival=0;
$third_person=0;
$wrestling=0;

$gen_count= array_fill(1,19,0);

//for most favourite genre, calculate average rating for each genre and then genre with the highest avg rating will be favourite genre

$total_rating= array();
$total_rating= array_fill(1,19,0);

while($genrw=mysqli_fetch_row($genrs))
{
	$i=1;
	$gencountqry="select * from g_genre where g_id='$genrw[0]'";
	$gencountrs=(mysqli_query($con,$gencountqry)) OR die(mysqli_error($con));
	$gencountrw=mysqli_fetch_row($gencountrs);
	
	//check value in db field for each game and increment counters of each genre
	//get game rating of each game and add to the total rating array
	
	$get_rating_qry = "select rating from game_user where u_name='$uname'";
	$rating_rs = mysqli_query($con,$get_rating_qry) OR die(mysqli_error($con));
	
	$rating_rw = mysqli_fetch_row($rating_rs);
	
	
	
	if($gencountrw[1]==1){ 
		$action++;
		$gen_count[1]++;
		$total_rating[1]=$total_rating[1]+$rating_rw[0];
						 }
	if($gencountrw[2]==1){
		$adventure++;
		$gen_count[2]++;
		$total_rating[2]=$total_rating[2]+$rating_rw[0];
	} 
	if($gencountrw[3]==1){
		$fighting++;
		$gen_count[3]++;
		$total_rating[3]=$total_rating[3]+$rating_rw[0];
	} 
	if($gencountrw[4]==1){
		$first_person++;
		$gen_count[4]++;
		//echo "first person gen count ",$gen_count[4]; 
		$total_rating[4]=$total_rating[4]+$rating_rw[0];
	} 
	if($gencountrw[5]==1){
		$horror++;
		$gen_count[5]++;
		$total_rating[5]=$total_rating[5]+$rating_rw[0];
	} 
	
	if($gencountrw[6]==1){
		$multi_player++;
		$gen_count[6]++;
		$total_rating[6]=$total_rating[6]+$rating_rw[0];
	} 
	
	if($gencountrw[7]==1){
		$online++;
		$gen_count[7]++;
		$total_rating[7]=$total_rating[7]+$rating_rw[0];
	} 
	if($gencountrw[8]==1){
		$open_world++;
		$gen_count[8]++;
		$total_rating[8]=$total_rating[8]+$rating_rw[0];
	} 
	if($gencountrw[9]==1){
		$party++;
		$gen_count[9]++;
		$total_rating[9]=$total_rating[9]+$rating_rw[0];
	} 
	
	if($gencountrw[10]==1){
		$platform++;
		$gen_count[10]++;
		$total_rating[10]=$total_rating[10]+$rating_rw[0];
	}
	if($gencountrw[11]==1){
		$puzzle++;
		$gen_count[11]++;
		$total_rating[11]=$total_rating[11]+$rating_rw[0];
	} 
	if($gencountrw[12]==1){
		$racing++;
		$gen_count[12]++;
		$total_rating[12]=$total_rating[12]+$rating_rw[0];
	}
	if($gencountrw[13]==1){
		$rpg++;
		$gen_count[13]++;
		$total_rating[13]=$total_rating[13]+$rating_rw[0];
	}
	if($gencountrw[14]==1){
		$shooters++;
		$gen_count[14]++;
		$total_rating[14]=$total_rating[14]+$rating_rw[0];
	}
	if($gencountrw[15]==1){
		$sim++;
		$gen_count[15]++;
		$total_rating[15]=$total_rating[15]+$rating_rw[0];
	}
	if($gencountrw[16]==1){
		$sports++;
		$gen_count[16]++;
		$total_rating[16]=$total_rating[16]+$rating_rw[0];
	}
	if($gencountrw[17]==1){
		$strategy++;
		$gen_count[]++;
		$total_rating[17]=$total_rating[17]+$rating_rw[0];
	}
	if($gencountrw[18]==1){
		$third_person++;
		$gen_count[18]++;
		$total_rating[18]=$total_rating[18]+$rating_rw[0];
	}
	if($gencountrw[19]==1){
		$wrestling++;
		$gen_count[19]++;
		$total_rating[19]=$total_rating[19]+$rating_rw[0	];
	}
	
}

//get index of max occuring genre from the array and set the variable accordingly
$gen_max_index=0;
$gen_max_value=0;
for($i=1;$i<19;$i++){
	if($gen_count[$i]>$gen_max_value)
	{
		$gen_max_index=$i;
		$gen_max_value=$gen_count[$i];
	}
	
}

switch ($gen_max_index){
	case 1:  $mostgenre = "Action"; break;
	case 2:  $mostgenre = "Adventure"; break;
	case 3:  $mostgenre = "Fighting"; break;
	case 4:  $mostgenre = "First_person"; break;
	case 5:  $mostgenre = "Horror"; break;
	case 6:  $mostgenre = "Multi Player"; break;
	case 7:  $mostgenre = "Online"; break;
	case 8:  $mostgenre = "Open World"; break;
	case 9:  $mostgenre = "Party"; break;
	case 10:  $mostgenre = "Platform"; break;
	case 11:  $mostgenre = "Puzzle"; break;
	case 12:  $mostgenre = "Racing"; break;
	case 13:  $mostgenre = "Role Playing Game"; break;
	case 14:  $mostgenre = "Shooters"; break;
	case 15:  $mostgenre = "Simulation"; break;
	case 16:  $mostgenre = "Sports"; break;
	case 17:  $mostgenre = "Strategy"; break;
	case 18:  $mostgenre = "Third Person"; break;
	case 19:  $mostgenre = "Wrestling";  break;	
}

//sorted genre count
$gen_count_sorted=$gen_count;

sort($gen_count_sorted);

//calculate avg genre rating by dividing total_rating  array variable by avg_rating array variable indexwise

$avg_gen_rat=array();
$avg_gen_rat= array_fill(1,19,0);
$gen_count_for_division = array();
$gen_count_for_division = array_fill(1,19,0);
$gen_count_for_division = $gen_count;

//cannot divide by zero, hence replace zero gen count by 1
for($i=1;$i<19;$i++){
	if($gen_count_for_division[$i]==0) $gen_count_for_division[$i]=1;
}

//calculate avg genre rating
for($i=1;$i<19;$i++){

  // echo $total_rating[$i]."    ".$gen_count_for_division[$i]."<br>";
	if($gen_count[$i]==0)
	{}
	else{	$avg_gen_rat[$i]=$total_rating[$i]/$gen_count_for_division[$i];
	//echo $avg_gen_rat[$i]; echo "<br>";
		} 	
}

//for favourite genre, calculate genre with highest avg rating

$fav_gen_index=0;
$avg_rat_max_value=0;

for($i=1;$i<19;$i++){
	if($avg_gen_rat[$i]>$avg_rat_max_value){
		$fav_gen_index=$i;
		$avg_rat_max_value=$avg_gen_rat[$i];
		//echo $avg_rat_max_value."     ".$i; echo "<br>";
	}
}


switch ($fav_gen_index){
	case 1:  $fav_genre = "Action"; break;
	case 2:  $fav_genre = "Adventure"; break;
	case 3:  $fav_genre = "Fighting"; break;
	case 4:  $fav_genre = "First_person"; break;
	case 5:  $fav_genre = "Horror"; break;
	case 6:  $fav_genre = "Multi Player"; break;
	case 7:  $fav_genre = "Online"; break;
	case 8:  $fav_genre = "Open World"; break;
	case 9:  $fav_genre = "Party"; break;
	case 10:  $fav_genre = "Platform"; break;
	case 11:  $fav_genre = "Puzzle"; break;
	case 12:  $fav_genre = "Racing"; break;
	case 13:  $fav_genre = "Role Playing Game"; break;
	case 14:  $fav_genre = "Shooters"; break;
	case 15:  $fav_genre = "Simulation"; break;
	case 16:  $fav_genre = "Sports"; break;
	case 17:  $fav_genre = "Strategy"; break;
	case 18:  $fav_genre = "Third Person"; break;
	case 19:  $fav_genre = "Wrestling"; break;
}

//calculate avg completion for the user

$avg_qry= "select AVG(completion) from game_user where u_name='$uname'";

$avg_comp_rs = mysqli_query($con,$avg_qry) OR die(mysqli_error($con));

$avg_comp_rw = mysqli_fetch_row($avg_comp_rs);

//echo $avg_comp_rw[0];

//calculate avg rating for the user

$avg_rat_qry="select AVG(rating) from game_user where u_name='$uname'";

$avg_rat_rs = mysqli_query($con,$avg_rat_qry) OR die(mysqli_error($con));

$avg_rat_rw=mysqli_fetch_row($avg_rat_rs);

$game_count_qry="select count(u_name) from game_user where u_name='$uname'";

$game_count_rs=mysqli_query($con,$game_count_qry) OR die(mysqli_error($con));

$game_count_rw=mysqli_fetch_row($game_count_rs);



//push data into array
array_push($array, array('most occuring genre'=>$mostgenre, 'fav genre'=>$fav_genre, 'avg comp'=> $avg_comp_rw[0], 'total avg rating'=> $avg_rat_rw[0], 'total games played'=>$total_games));

print_r(json_encode($array));

?>