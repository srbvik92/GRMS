<?php

include 'connect_db.php';

$g_name=$_POST['g_name'];
$pform=$_POST['pform'];
$comp=$_POST['completed'];

$qry="select * from game_detail where name='$g_name' and platform='$pform'";

$rs=mysql_query($qry) OR die(mysql_error());

if (empty($rs))
{
	echo "not fetched";
}

$rw=mysql_fetch_row($rs);

echo $rw[0]+"wqdwd";

$qry="insert into game_user values('$rw[0]','$uname','$comp')";


//$qry="insert into game_user values()";

mysql_query($qry) OR die(mysql_error());

?>