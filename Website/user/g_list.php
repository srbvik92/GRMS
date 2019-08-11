<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect_db.php';

$uname=$_SESSION["username"];
echo $uname;

//select games from game_user and the select the same games from g_detail order by release date
$qry="SELECT game_user.*
FROM  game_user
JOIN g_detail
ON g_detail.g_id = game_user.g_id
where game_user.u_name='$uname' ORDER BY g_detail.rel_date desc limit 10";

$rs=mysqli_query($con,$qry) OR die(mysql_error($con));

//echo $_SERVER['SERVER_NAME'];
//$linktogame=$_SERVER['SERVER_NAME']."/grms/game_details.php";
$linktogame="game_details.php";
echo $linktogame;
  
?>

<table width="100%" border="0">
  <tr>
    <td>Title</td>
    <td>Platform</td>
    <td>Overall Rating</td>
    <td>Your Rating</td>
    <td>Completion</td>
  </tr>
  <?php
  while($rw=mysqli_fetch_row($rs)) {
  	
	$game="select * from g_detail where g_id='$rw[0]'"; 
	$gamers=mysqli_query($con,$game) OR die(mysql_error($con));
	$gamerw=mysqli_fetch_row($gamers);
  ?>
  <?php
  
  //echo "safasdf".$linktogame;
  $g_id=$rw[0];
  //echo $g_id;
  $grating="select AVG(rating) from game_user where g_id='$g_id'";
  $gratrs=mysqli_query($con,$grating) OR die(mysql_error($con));
  $gratrow=mysqli_fetch_row($gratrs);
  ?>
  <tr>
    <td><a href="<?php echo $linktogame."?id=".$rw[0] ?>"><?php echo $gamerw[1]; ?></a></td>
    <td><?php echo $rw[1]; ?></td>
    <td><?php echo $gratrow[0]; ?></td>
    <td><?php echo $rw[4];  ?></td>
    <td><?php echo $rw[3];  ?></td>
  </tr>
  <?php
  }
  ?>
</table>

