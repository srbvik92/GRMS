<?php

include 'connect_db.php';

$name=$_POST['name'];
$type=$_POST['type'];
$game_id=1;

$qry="insert into game_detail values('$game_id','$name','$type')";

mysql_query($qry) OR die(mysql_error());

header('Location: first.php');

?>