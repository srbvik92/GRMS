<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$qry="select * from g_main_mission where g_id='$g_id'";

$rs=mysqli_query($con, $qry) OR die(mysqli_error($con));

while($rw=mysqli_fetch_row($rs))
{
?>

<html>

<a href="game_details.php?id=<?php echo $rw[0]; ?>&mis_no=<?php echo $rw[1]?>"><?php echo $rw[2]; ?></a>
<br>
</html>

<?php 

}

?>