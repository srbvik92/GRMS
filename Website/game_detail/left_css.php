<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect_db.php';

$qry="select logo,g_name from g_detail where g_id=$g_id";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
$rw=mysqli_fetch_row($rs);

//echo $_SERVER['REQUEST_URI'];

$logo="logos/".$g_id."/".$rw[0];

//echo $logo;

?>

<img height="240" width="160" src="<?php  echo $logo; ?>" />


<font size="+2"><?php echo $rw[1]; ?></font>