<link rel="stylesheet" type=text/css href=fontdesign.css>


<table border="0">
<tr bgcolor="#7E7D00" height="50">
<td width="70%">
<font color="white">Latest Additions</font></td>
<td><font color="white">Release Date</font></td>
</tr>

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
    <td width="70%">
	<fdesign><a href="<?php echo "../grms/game_details.php?id=".$rw[0] ?>" style="text-decoration: none"><?php echo $rw[1]; ?></a></fdesign>
    </td>
    <td>
    <?php echo $rw[3];  ?>
    </td>
    </tr>
	<?php
}
?>
</table>