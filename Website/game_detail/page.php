<?php



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect_db.php';

//echo "game page";

$qry="select * from g_page where g_id='$g_id'";

$rs=mysqli_query($con,$qry) OR die(mysql_error($con));
$rw=mysqli_fetch_row($rs);
?>
<html>
<table width="1200" border="0">
  <tbody>
    <tr>
      <td width="900px"><?php
Echo $rw[1];
?></td>
      <td width="300px" valign="top"><?php include 'right.php'; ?></td>
    </tr>
  </tbody>
</table>

</html>