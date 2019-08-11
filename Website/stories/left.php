<?php

session_start();
include 'connect_db.php';

$qry="select * from stories where id=$id";
$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));

$rw=mysqli_fetch_row($rs);

?>

<html>

<table width="100%" border="0">
  <tr>
    <td><?php echo $rw[5]; ?></td>
    <td></td>
  </tr>
  <tr>
    <td><?php echo $rw[6]; ?></td>
    <td>&nbsp;</td>
  </tr>
</table>


</html>