<style>
   .container {
    position: relative;
    text-align: center;
    color: white;
}

.bottom-left {
    position: absolute;
    bottom: 8px;
    left: 16px;
	background-color: white;
	color: black;
	font-size: 30px;
}

</style>
	
<?php

include 'connect_db.php';
session_start();

$qry="select * from stories where id='$id'";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
$dir ="stories/top_image/";
$rw=mysqli_fetch_row($rs);

?>

<div class="container">
<img src="<?php echo $dir.$rw[0]."/".$rw[4] ?>" style="width:100%" width="1000" height="400">

<div class="bottom-left"><?php echo $rw[5]; ?> </div>

</div>