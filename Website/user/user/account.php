<?php

include 'connect_db.php';
session_start();
$uname=$_SESSION['username'];
//echo $uname;

?>

<table width="100%" border="0">
  <tr>
    <td><a href="change_password.php">Change Password</a></td>
    <td>
    	<a href="g_list.php">View list of your games</a>
    </td>
  </tr>
  <tr>
    <td><a href="update.php">Update other details</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="0">
  <tr>
  	<?php
		$qry="select COUNT(g_id) from game_user where u_name='$uname'";
		$rs=mysql_query($qry);
		$rw=mysql_fetch_row($rs);
	?>
    <td width="50%">Total No of Games Played:</td>
    <td><?php echo $rw[0]; ?></td>
  </tr>
  <tr>
  	<?php 
		$qry="select g_id,rating from game_user where u_name='$uname'";
		$rs=mysql_query($qry) OR die(mysql_error());
		
	?>
    <td>Highest rated: </td>
    <td><?php $rw=mysql_fetch_row($rs);
				//echo $rw[0]."id";
				//$qry1="select g_detail.g_name from g_detail where(game_user.rating) in (select MAX(rating) from game_user where u_name='$uname')";
				$qry1="select MAX(rating), g_id from game_user where u_name='$uname'";
				$rs1=mysql_query($qry1) OR die(mysql_error());
				while($rw1=mysql_fetch_row($rs1)){
					$qry2="select g_name from g_detail where g_id=$rw1[1]";
					$rs2=mysql_query($qry2) OR die(mysql_error());
					$rw2=mysql_fetch_row($rs2);
				$g_link=$_SERVER['PATH_TRANSLATED']."/grms/game_details.php";
				?>
                <a href="<?php echo $g_link."?id=".$rw[0]; ?>" ><?php echo $rw2[0]; ?></a> <?php echo $rw[1]; ?>
                <br />
	 	<?php
					}
     ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
