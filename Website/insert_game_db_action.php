<?php session_start(); 

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

include 'connect_db.php';
$g_name=$_POST['gname'];
//$ps3=$_POST["ps3"];

//check the box ticked for platforms
if(isset($_POST["ps3"])){
    $ps3=$_POST["ps3"];
}else{
    $ps3 = "0";#default value
}
//$xone=$_POST["xone"];
if(isset($_POST["xone"])){
    $xone=$_POST["xone"];
}else{
    $xone = "0";#default value
}
//$x360=$_POST["x360"];
if(isset($_POST["x360"])){
    $x360=$_POST["x360"];
}else{
    $x360 = "0";#default value
}
//$ps4=$_POST["ps4"];
if(isset($_POST["ps4"])){
    $ps4=$_POST["ps4"];
}else{
    $ps4 = "0";#default value
}
//$pc=$_POST["pc"];
if(isset($_POST["pc"])){
    $pc=$_POST["pc"];
}else{
    $pc = "0";#default value
}


//check the box ticked for geners
if(isset($_POST["action"])){
    $action=$_POST["action"];
}else{
    $action = "0";#default value
}
if(isset($_POST["adventure"])){
    $adventure=$_POST["adventure"];
}else{
    $adventure = "0";#default value
}
if(isset($_POST["fighting"])){
    $fighting=$_POST["fighting"];
}else{
    $fighting = "0";#default value
}
if(isset($_POST["first_person"])){
    $first_person=$_POST["first_person"];
}else{
    $first_person = "0";#default value
}
if(isset($_POST["horror"])){
    $horror=$_POST["horror"];
}else{
    $horror = "0";#default value
}
if(isset($_POST["multi_player"])){
    $multi_player=$_POST["multi_player"];
}else{
    $multi_player = "0";#default value
}
if(isset($_POST["online"])){
    $online=$_POST["online"];
}else{
    $online = "0";#default value
}
if(isset($_POST["open_world"])){
    $open_world=$_POST["open_world"];
}else{
    $open_world = "0";#default value
}
if(isset($_POST["party"])){
    $party=$_POST["party"];
}else{
    $party = "0";#default value
}
if(isset($_POST["platform"])){
    $platform=$_POST["platform"];
}else{
    $platform = "0";#default value
}
if(isset($_POST["puzzle"])){
    $puzzle=$_POST["puzzle"];
}else{
    $puzzle = "0";#default value
}
if(isset($_POST["racing"])){
    $racing=$_POST["racing"];
}else{
    $racing = "0";#default value
}
if(isset($_POST["rpg"])){
    $rpg=$_POST["rpg"];
}else{
    $rpg = "0";#default value
}
if(isset($_POST["shooters"])){
    $shooters=$_POST["shooters"];
}else{
    $shooters = "0";#default value
}
if(isset($_POST["sim"])){
    $sim=$_POST["sim"];
}else{
    $sim = "0";#default value
}
if(isset($_POST["sport"])){
    $sport=$_POST["sport"];
}else{
    $sport = "0";#default value
}
if(isset($_POST["strategy"])){
    $action=$_POST["strategy"];
}else{
    $strategy = "0";#default value
}
if(isset($_POST["survival"])){
    $survival=$_POST["survival"];
}else{
    $survival = "0";#default value
}
if(isset($_POST["third_person"])){
    $third_person=$_POST["third_person"];
}else{
    $third_person = "0";#default value
}
if(isset($_POST["wrestling"])){
    $wrestling=$_POST["wrestling"];
}else{
    $wrestling = "0";#default value
}


$reldate=$_POST["reldate"];
$genre=$_POST["genre"];
$esrb=$_POST["esrb"];
//echo $protype;
$images=$_POST["image"];
//$logo=$_POST["file"];
$devs=$_POST["devs"];
$publisher=$_POST["publisher"];
$summary=$_POST["summary"];
$file=$_FILES["file"]["name"];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

$ok=1;

$uploaded_size=$_FILES['file']['size'];

if ($uploaded_size > 350000) 
 { 
 echo "Your file is too large.<br>"; 
 $ok=0; 
 }
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png")))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	$ok=0;
    }
	
	
		$qry="select MAX(g_id) from g_detail";
		
		$res=mysqli_query($con,$qry) OR die(mysqli_error($con));
		
		$row=mysqli_fetch_row($res);
		
		$g_id=$row[0];
		$g_id=$g_id+1;
		//echo $g_id;
	$dir = $_SERVER['DOCUMENT_ROOT']."/grms/logos/".$g_id."/";
	$loc=$dir.$file;
	

    if (file_exists($loc))
      {
      echo $file . " already exists. ";
      }
    else
      {
        if (!is_dir($dir))
        {
        mkdir($dir);         
    	}
		if($ok==1)
		{
    
		
        if(move_uploaded_file($_FILES['file']['tmp_name'], $loc))
		{
		$query = "insert into g_detail values($g_id,'$g_name','$ps3','$reldate','$genre','$esrb','$images','$file','$devs','$publisher','$summary')";
mysqli_query($con,$query) OR die(mysqli_error($con));
		
		$query = "insert into g_pform values($g_id,$pc,'$ps3','$x360','$ps4','$xone','$reldate','$reldate','$reldate','$reldate','$reldate')";
mysqli_query($con,$query) OR die(mysqli_error($con));
		
		$genqry="insert into g_genre values('$g_id','$action','$adventure','$fighting','$first_person','$horror','$multi_player','$online','$open_world','$party','$platform','$puzzle','$racing','$rpg','$shooters','$sim','$sport','$strategy','$survival','$third_person','$wrestling')";
mysqli_query($con,$genqry) OR die(mysqli_error($con));
		

$_SESSION['success']="PROPERTY SUCCESSFULLY POSTED";

header('Location: insert_game_db.php');

		}
      }
    }
}
else
  {
  echo "Invalid file";
  }
?>