<head><link rel="icon" type="image/png" href="logo.png">
<title>GRMS: Game Record Management System</title>

</head>
<?php

session_start();
include 'connect_db.php';

global $start, $end;
error_reporting(0);
$start=$_GET["s"]; $end=$_GET["e"];


//echo $start;

?>

<html>
<body>
<link rel="stylesheet" type=text/css href=css/user_page.css>

<div class="header_container">
<div class="header">
	<?php include 'header.php'; ?>
</div>
</div>

<div class="menu">
	<?php include 'top_menu.php'; ?>
</div>

<div class="user_links">
	<?php include 'user/links.php'; ?>
</div>

<div class="main">
	<?php
//$absolute_url = full_url( $_SERVER );
$url=$_SERVER['REQUEST_URI'];
//echo $absolute_url;
if ($url==$server_root."my_account.php")
{
	//echo "1";
	include 'user/account.php';
}
else if ($url==$server_root."my_account.php?s=".$start."&e=".$end)
{
	//echo "2";
	include 'user/g_list.php';	
}
?>
</div>

<div class="footer_container">
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>
</div>


</body>
</html>

<?php


function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

//$absolute_url = full_url( $_SERVER );
//echo $absolute_url;

?>