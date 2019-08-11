<?php
include 'connect_db.php';

$id = $_POST['id'];

//$id = 6;

$qry= "select * from stories where id=$id";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
$dir ="stories/top_image/";
$rw=mysqli_fetch_row($rs);

$data= array();

$image = "http://10.0.2.2:80/grms/stories/top_image/".$rw[0]."/".$rw[4];
$title = $rw[5];


//$content = $rw[6];

//echo $image;
//echo $title;
//echo $content;

array_push($data, array('image'=>$image,'title'=>$title));



print_r(json_encode($data));

?>