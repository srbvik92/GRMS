<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);

global $g_id;
global $mis_no;
$g_id=$_GET['id'];
$mis_no=$_GET['mis_no'];

$qry="select g_name from g_detail where g_id='$g_id'";
$rs=mysqli_query($con,$qry) OR die(mysql_error($con));
$rw=mysqli_fetch_row($rs);

?>

<html>
<body>
<link rel="stylesheet" type=text/css href=css/game_details.css>

<table width="1000" border="0" align="center">
  <tbody>
    <tr bgcolor="#D2D2D2">
      <td colspan="2" height="10px">
		<?php

		  	include 'header.php';

		  ?>
      </td>
    </tr>
    <tr>
     <td colspan="2" height="30px">
		<?php

		  	include 'top_menu.php';

		  ?>
		  </td>
    </tr>
    <tr>
      <td width="100px" valign="top">
		<?php

		  	include 'game_detail/left.php';

		  ?>
     	</td>
      <td width="900px" valign="top">
		<?php

		  	include 'game_detail/links.php';

		  	$absolute_url = full_url( $_SERVER );

		  	$url=$_SERVER['REQUEST_URI'];

		  	//if($absolute_url=="http://localhost/grms/game_details.php?id=".$g_id)
		  	if($url=="/grms/game_details.php?id=".$g_id) {
					include 'game_detail/main.php';
    				//include 'game_detail/page.php';
				}

		  	if($url=="/grms/game_details.php?id=".$g_id."&page=main"){
    				include 'game_detail/main.php';
		  			//include 'game_detail/page.php';
			}
		  /*else if($absolute_url=="http://localhost/grms/game_details.php?<?php echo $g_id; ?>&page=image") */
		  if($url=="/grms/game_details.php?id=".$g_id."&page=image")
			  include 'game_detail/images.php';
			  
		  if($url=="/grms/game_details.php?id=".$g_id."&page=mission")
			      include 'game_detail/mission.php';
		  
	      if($url=="/grms/game_details.php?id=".$g_id."&mis_no=".$mis_no)
			      //echo "inside mission details";
			      include 'game_detail/mission_details.php';
		  	?>
     	</td>
      
    </tr>
    
    <tr>
      <td colspan="2">
      <?php include 'game_detail/page.php'; ?>
		</td>
  
    </tr> 
    
    <tr>
      <td colspan=2 height="100px" bgcolor="#6D6D6D"><?php

include 'footer.php';

?>
		</td>
    </tr>
  </tbody>
</table>





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