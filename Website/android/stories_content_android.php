<?php 

include 'connect_db.php';

$id= $_POST['id'];

error_log("\r\nnews id is :".$id,3,"error.log");


//$id=6;

$qry="select * from stories where id=$id";
$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));

$rw=mysqli_fetch_row($rs);

echo $rw[6];

?>