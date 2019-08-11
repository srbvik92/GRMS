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

<div class="main">
	<div class="left">
		<?php include 'my_played_games/played_list.php'; ?>
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

