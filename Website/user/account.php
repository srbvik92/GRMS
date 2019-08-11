<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$uname=$_SESSION['username'];
//echo $uname;

?>
	

<table width="100%" border="0">
  <tr>
  	<?php
	  //total no of games played
		$qry="select COUNT(g_id) from game_user where u_name='$uname'";
		$rs=mysqli_query($con,$qry);
		$rw=mysqli_fetch_row($rs);
	?>
    <td width="50%">Total No of Games Played:</td>
    <td><?php echo $rw[0]; ?></td>
  </tr>
  <tr>
  	<?php 
		$qry="select g_id,rating from game_user where u_name='$uname'";
		$rs=mysqli_query($con,$qry) OR die(mysql_error($con));
		
	?>
    <td>Highest rated: </td>
    <td><?php $rw=mysqli_fetch_row($rs);
				//echo $rw[0]."id";
				//$qry1="select g_detail.g_name from g_detail where(game_user.rating) in (select MAX(rating) from game_user where u_name='$uname')";
				$qry1 = "select g_id,rating from game_user where rating = (select MAX(rating) from game_user) and u_name='$uname'";
				//$qry1="select MAX(rating), g_id from game_user where u_name='$uname'";
				//echo "query";
				//$qry1="select g_id from game_user where u_name='$uname' order by rating desc limit 1";
				$rs1=mysqli_query($con,$qry1) OR die(mysqli_error($con));
				while($rw1=mysqli_fetch_row($rs1)){
					//echo "result";
					$qry2="select g_name from g_detail where g_id=$rw1[0]";
					$rs2=mysqli_query($con,$qry2) OR die(mysqli_error($con));
					$rw2=mysqli_fetch_row($rs2);
				$g_link=$_SERVER['PATH_TRANSLATED']."/grms/game_details.php";
				?>
                <a href="<?php echo $g_link."?id=".$rw[0]; ?>" ><?php echo $rw2[0]; ?></a> <?php echo $rw1[1]; ?>
                <br />
	 	<?php
					}
     ?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
