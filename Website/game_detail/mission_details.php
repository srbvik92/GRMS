<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$qry="select * from g_main_mission where g_id='$g_id' and mission_no='$mis_no'";

$rs=mysqli_query($con, $qry) OR die(mysqli_error($con));

$rw=mysqli_fetch_row($rs);

$objectives = explode("\n", $rw[4]);

$count = count($objectives);
$i=0;

?>
<table width="800" border="0">
  <tbody>
    <tr>
      <td><?php echo $rw[2]; ?></td>
    </tr>
    <tr>
      <td><?php echo $rw[3]; ?></td>
    </tr>
    <tr>
      <td>Objectives <br><?php while($i<=$count) { echo $objectives[$i]; $i++; echo "<br>"; } ?></td>
    </tr>
  </tbody>
</table>

<?php 


echo $rw[5];


?>