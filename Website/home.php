
<?php

error_reporting(0); 

session_start();

//include 'globals.php';

//echo Globals::$host;

?>

	<head><link rel="icon" type="image/png" href="logo.png">
<title>GRMS: Game Record Management System</title>

</head>

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

<div class="header2">
	<?php include 'header2.php'; ?>
</div>

<div class="main">
	<div class="left">
		<?php include 'home_left.php'; ?>
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