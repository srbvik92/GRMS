<?php

session_start();

include 'connect_db.php';

$qry="select g_id, g_name from g_detail ORDER BY g_name";

$rs=mysql_query($qry) OR die(mysql_error());


?>

<table width="100%" border="0">
  <tr>
    <td width="8%">S.No.</td>
    <td width="92%">Name</td>
  </tr>
<?php while($rw=mysql_fetch_row($rs))
   {
   ?>
   <tr>
   <td><?php $i=1; echo $i; $i=$i+1; ?></td>
   <td><a href="game_details.php?id=<?php echo $rw[0];  ?>"> <?php echo $rw[1];  } ?></a></td>
   
   </tr>
</table>
