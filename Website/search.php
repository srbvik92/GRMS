<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

error_reporting(0);

include 'connect_db.php';


global $p_form;
global $genre;
global $rel_year;
global $rating;
global $esrb;
global $s;

$p_form=$_POST['p_form'];
$genre=$_POST['genre'];
$rel_year=$_POST['rel_year'];
$rating=$_POST[''];
$esrb=$_POST['esrb'];
$s=$_GET['s'];

$string=$_GET["g_name"];

?>

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

?>



<html>
<body>
 <link rel="stylesheet" type=text/css href=css/home_layout.css>
 
 

<div class="header_container">
<div class="header">
	<?php include 'header.php'; ?>
</div>
</div>

<div class="menu">
	<?php include 'top_menu.php'; ?>
</div>

<div class="main">
	<div class="left">
		<?php

$absolute_url = full_url( $_SERVER );
$url=$_SERVER['REQUEST_URI'];


//if($p_form=="")
//include different pages as per requirements
//1. basic page with search form
if ($url=="http://localhost/grms/search.php")
{
	//echo "search";
	//echo $absolute_url;
	include 'search/search_g.php';
}

//include results of text result
		  
else if ($url==$server_root."search.php?g_name=".$string)
{
	
	include 'search/search_text.php';
	
}
		  
//include search results based on form
else {
    echo "search action";
	include 'search/search_action.php';
    $p_form="";
}
?>	
	</div>
	<div class="right">
		<?php include 'home_right.php'; ?>
	</div>
	
</div>

<div class="footer_container">
	<div class="footer">
		<?php include 'footer.php'; ?>
	</div>
</div>
</body>

</html>