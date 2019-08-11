
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


<table width="1000" border="0" align="center">
  <tbody>
    <tr>
      <td colspan=2 height="10px" bgcolor="#D2D2D2"><?php

include 'header.php';

?>
		</td>
    </tr>
    
<tr>
      <td colspan=2 height="10px"><?php

include 'top_menu.php';

?>
		</td>
 </tr>    
    
    <tr>
     

      <td colspan=2><?php

include 'user/links.php';

?>
		</td>
 </tr> 
     
      
      <td><?php
		  
include 'user/personal_details.php';
		  
?></td>
      <td><?php

include 'user/right.php';

?></td>
    </tr>
    <tr>
      <td colspan="3" height="100px" bgcolor="#6D6D6D"><?php

include 'footer.php';

?></td>
    </tr>
  </tbody>
</table>


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