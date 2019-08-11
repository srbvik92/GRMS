<?php

include 'connect_db.php';

$qry="select * from g_detail order by rel_date desc limit 10";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));

$data= array();

$gid;
$gname;
$reldate;

while($rw=mysqli_fetch_row($rs)){
	$gid=$rw[0];
	$gname=$rw[1];
	$reldate=$rw[3];
	array_push($data, array('gid'=>$gid, 'gname'=>$gname, 'reldate'=>$reldate));
}

print_r(json_encode($data));

?>