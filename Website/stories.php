<?php
include 'connect_db.php';

error_reporting(E_ALL); ini_set('display_errors', TRUE); ini_set('display_startup_errors', TRUE);

error_reporting(1);
session_start();

global $id;

$id=$_GET['id'];

?>

<html>
<body>
<link rel="stylesheet" type=text/css href=css/stories.css>

<div class="header_container">
<div class="header">
	<?php include 'header.php'; ?>
</div>
</div>

<div class="menu">
	<?php include 'top_menu.php'; ?>
</div>

<div class="header2">
	<?php include 'stories/main.php'; ?>
</div>

<div class="main">
	<div class="left">
		<?php include 'stories/left.php'; ?>
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