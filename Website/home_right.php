<link rel="stylesheet" type=text/css href=fontdesign.css>
<style>
	
.righttopbar
{
	overflow: hidden;
	float: left;
	background-color: #FFFFFF;

	margin: 0px;
	
	height: 20px;
	padding: 15px;
	
}

	
.righttopbar a{
	vertical-align: middle;
	font-size: 16px;
	
	
	
}


</style>

<div class="righttopbar" style="width: 220px;">
	<a>Latest Additions</a>
</div>

<div class="righttopbar" style="width: 120px">
	<a>Release Date</a>
</div>

<head>
<body>


<table border="0">
<!--<tr bgcolor="#7E7D00" height="50" class="righttopbar">
<td width="70%">
<font color="white">Latest Additions</font></td>
<td><font color="white">Release Date</font></td>
</tr> -->

<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }

$qry="select * from g_detail order by rel_date desc limit 10";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));

?>

<?php
//$rs=mysql_query($qry) OR die(mysql_error());
while($rw=mysqli_fetch_row($rs))
{
	?>
    <tr height="40">
    <td width="250">
	<fdesign>&nbsp;&nbsp;<a href="<?php echo $server_root."game_details.php?id=".$rw[0] ?>" style="text-decoration: none; font-size: 14px;"><?php echo $rw[1]; ?></a></fdesign>
    </td>
    <td width="150" style="font-size: 14px;">&nbsp;&nbsp;
    <?php echo $rw[3];  ?>
    </td>
    </tr>
	<?php
}
?>
</table>
</body>
</head>
