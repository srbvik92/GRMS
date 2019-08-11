<?php

include 'connect_db.php';
session_start();

$news_id=$_GET['id'];

$qry="select * from news where news_id=$news_id";
$rs=mysql_query($qry) OR die(mysql_error());
$rw=mysql_fetch_row($rs);

?>

<table>
<tr>
<td>
	<font size="+2"><b><?php echo $rw[1];  ?> </b></font>
</td>
</tr>
<tr>
<td>
	<?php echo $rw[2];  ?>
</td>
</tr>
<tr>
<td>
	<br /> <font size="+2"><b><?php echo $rw[3];  ?></b> </font>
</td>
</tr>
<tr>
<td>
	<br /> <br /> <?php echo $rw[4];  ?>
</td>
</tr>
</table>