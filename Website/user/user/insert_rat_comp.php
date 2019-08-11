<?php

session_start();
include 'connect_db.php';

$uname=$_SESSION['username'];
$g_id=$_POST['g_id'];
$p_form=$_POST['p_form'];
$rating=$_POST['rating'];
$comp=$_POST['completion'];

$qry="insert into game_user values($g_id,'$p_form','$uname',$comp,$rating)";

$rs=mysql_query($qry) OR die(mysql_error());


$header=$_SERVER['DOCUMENT_ROOT']."/grms/game_details,php?id=".$g_id;

header("location:$header");

?>