<?php

session_start();
$uname=$_SESSION['username'];
include 'connect_db.php';

//echo $uname;

$qry="select * from game_user where u_name='$uname'";

$rs=mysql_query($qry) OR die(mysql_error());

if(empty($rs)) echo "result empty";

?>

Games You have played
<table width="100%" border="0">
  <?php 
  $i=0;
  while($rw=mysql_fetch_row($rs))
  {	
     //echo $rw[0];
  	 if($i%3==0) ?> <tr>  <?php
	 
	 //else
	 
  ?>
    <td width="40%"> 
	<?php
	$query="select * from g_detail where g_id=$rw[0]";
	//echo $query;
	$result=mysql_query($query) OR die(mysql_error());
	$row=mysql_fetch_row($result);
	//echo $row[7];
	?>
    <a href="game_details.php?id=<?php echo $rw[0];  ?>">
	<img width="240" height="300" src=" <?php echo "logos/".$row[0]."/".$row[7];  ?>"  /></a>
	</td>
    <td width="30%" align="center">
    <?php 
		echo $rw[2];
	?>
    </td>
    <td width="30%" align="center">
    <?php 
		echo $rw[3];
	?> 
    </td>
  <?php
  
  if ($i%3==0) ?> </tr> <?php ;
  $i=$i+1;
  }
?>


  
</table>
