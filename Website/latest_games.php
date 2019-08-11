<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
error_reporting(1);
?>


<style>


.top_bar{
	height: 40px;
	background-color: #FFD600;
	max-width: 1000px;
	padding-top: 10px;
	padding-left: 10px;
	font-size: 20px;
	box-shadow: 2px;
	
}
.latest_div{
	float: left;
	margin: 50px;
	width: 150px;
	height: 200px;
	
	
}

.latest_name{
	height: 50px;
	background-color: black;
	text-align: center;
	width: 150px;
	text-decoration: none;
	
}

.game_name{
	width: 130px;
	height: 100px;
		
}

</style>
<html>
<body>
<?php

//$qry="select * from g_detail where rel_date between DATE_SUB(NOW(), INTERVAL 100 DAY) AND NOW()";

?>

<div class="top_bar">
	<font color="white">Latest Top Rated</font>
</div>
<?php
$qry="select * from g_detail order by g_id limit 4";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
while($rw=mysqli_fetch_row($rs))
{
	//echo "inside while";

?>


<div class="latest_div">
	<div class="game_name">
		<?php
		$logo="logos/".$rw[0]."/".$rw[7];
		$g_id=$rw[0];
		//echo $logo;
		?>
		<!-- display latest game image and name as link to game page -->
		<a href="game_details.php?id=<?php echo $rw[0] ?>" style="text-decoration: none;">
		
		<img height="200" width="150" src="<?php  echo $logo; ?>"/>
		
		<div class="latest_name">
			<font color="white"><?php echo $rw[1]; ?></font>
		</div>
		</a>
		
	</div>
	
</div> 

<?php
}
?>


</body>
</html>