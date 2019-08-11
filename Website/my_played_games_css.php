<?php
ini_set('display_errors', 1); ini_set('error_reporting', E_ALL); error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }

global $page_no;

//$page_no=$_GET[pno];



$uname=$_SESSION['username'];

?>


<style>

.header{
	position: static;
	height: 45px;
	background-color: aqua;
	
}
	
.topmenu{
	width:1000px;
	height:55px;
	margin:auto;
	alignment-adjust:central;
	
}
	
.header2
{
	width:1000px;
	height:400px;
	margin:auto;
	alignment-adjust:central;
}
	
.latest_games{
	width: 1000px;
	height: 400px;
	margin:auto;
	alignment-adjust:central;
	background-color: antiquewhite;
		
}

.main
{
	width: 1000px;
	height: 600px;
	alignment-adjust:central;
	margin: auto;
	position: relative;
}

#leftmain
{
	position: absolute;	
	width: 700px;
	height: auto;
}

#rightmain
{
	left: 700px;
	position: absolute;
	width: 300px;
	border-radius: 5px;
	border: thin;
	
	padding-left: 5px;
}
	
.footer
{
	position: static;
	width:1000px;
	height:100px;
	alignment-adjust:central;
	background-color:#c0c0c0;
	margin: auto;
	padding-top: 15px;
}
	
</style>

<html>
<body>
<link rel="stylesheet" type=text/css href=css/home_layout.css>


<table align="center" width="1000" border="0">
  <tbody>
    <tr>
      <td colspan=2 height="10px" bgcolor="#D2D2D2"><?php

include 'header.php';

?>
		</td>
      
    </tr>
    <tr>
      <td colspan=2 height="30px"><?php

include 'top_menu.php';

?>
		</td>
      
    </tr>
    
    <tr>
      <td height="auto" width="700px" valign="top"><?php

include 'my_played_games/played_list.php';

?>
		</td>
		
      <td height="auto" width="300px" valign="top"><?php

include 'home_right.php';

?>
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

<div class="header">
	<?php
	include 'header_dropdown_self.php';
	?>
</div>


<div class="topmenu">
	<?php
		include 'top_menu.php';
	?>
	
</div>

<div class="main">
	
	<div id="leftmain">
		<?php
			include 'my_played_games/played_list.php';
		?>
	</div>
	
	<div id="rightmain">
		<?php
			include 'home_right.php';
		?>
	</div>
	
</div>

</body>
</html>

