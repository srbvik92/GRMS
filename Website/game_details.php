<link rel="stylesheet" type=text/css href=css/game_details.css>


<?php

error_reporting(0);

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


global $g_id;
global $mis_no;
$g_id=$_GET['id'];
//mission number variable
$mis_no=$_GET['mis_no'];

$qry="select g_name from g_detail where g_id='$g_id'";
$rs=mysqli_query($con,$qry) OR die(mysql_error($con));
$rw=mysqli_fetch_row($rs);

?>

<html>
<body>

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


<div class="header_container">
<div class="header">
	<?php include 'header.php'; ?>
</div>
</div>

<div class="menu">
	<?php include 'top_menu.php'; ?>
</div>


<div class="game_details">
	<div id="logo">
		<?php include 'game_detail/left.php'; ?>
	</div>
	<div id="details">
		<?php include 'game_detail/links.php';
				include 'game_detail/main_copy.php'; ?>
	</div>
</div>


<div class="main">
	<?php 
		  
		  $absolute_url = full_url( $_SERVER );

		  	$url=$_SERVER['REQUEST_URI'];
		  
		  if($url==$server_root."game_details.php?id=".$g_id) {
					include 'game_detail/page.php';
		  }
		  
		  if($url=="/grms/game_details.php?id=".$g_id."&page=main"){
    				include 'game_detail/page.php';
		  			//include 'game_detail/page.php';
			}
		  
		  if($url=="/grms/game_details.php?id=".$g_id."&page=image")
			  include 'game_detail/images.php';
		  
		  if($url=="/grms/game_details.php?id=".$g_id."&page=mission")
			      include 'game_detail/mission.php';
		  
		  if($url=="/grms/game_details.php?id=".$g_id."&mis_no=".$mis_no)
			      //echo "inside mission details";
			      include 'game_detail/mission_details.php';
		  
		  //include 'game_detail/page.php'; ?>
</div>

<div class="footer_container">
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>
</div>