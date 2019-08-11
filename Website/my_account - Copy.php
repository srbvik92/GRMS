
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


<table width="1100" border="1" align="center">
  <tbody>
    <tr>
      <td colspan="3" height="250px">
		<?php

		  include 'header.php';

		  ?>
   </td>
    </tr>
    <tr>
  		<td colspan="3" height="30px">
  		<?php

			include 'user/top_menu.php';

			?></td>
    </tr>
    <tr>
      <td><?php

		  include 'user/left.php';

		  ?></td>
      <td><?php
$absolute_url = full_url( $_SERVER );
//echo $absolute_url;
if ($absolute_url=="http://localhost/grms/my_account.php")
{
	echo "1";
	include 'user/account.php';
}
else if ($absolute_url=="http://localhost/grms/my_account.php?s=".$start."&e=".$end)
{
	echo "2";
	include 'user/g_list.php';	
}
?></td>
      <td><?php

include 'user/right.php';

?></td>
    </tr>
    <tr>
      <td colspan="3" height="250px">&nbsp;</td>
    </tr>
  </tbody>
</table>

/* <div class="header">

<?php

include 'header.php';

?>  */

</div>


<div class="menu">
<?php

include 'user/top_menu.php';

?>
</div>


<div class="left_menu">

<?php

include 'user/left.php';

?>

</div>

<div class="main">
<?php
$absolute_url = full_url( $_SERVER );
//echo $absolute_url;
if ($absolute_url=="http://localhost/grms/my_account.php")
{
	echo "1";
	include 'user/account.php';
}
else if ($absolute_url=="http://localhost/grms/my_account.php?s=".$start."&e=".$end)
{
	echo "2";
	include 'user/g_list.php';	
}
?>
</div>

<div class="right_menu">

<?php

include 'user/right.php';

?>

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