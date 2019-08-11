<head><link rel="icon" type="image/png" href="logo.png">
<title>GRMS: Game Record Management System</title>

</head>

<?php

session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);
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

<div class="header2">
	<?php include 'header2.php'; ?>
</div>

<div class="main">
	<div class="left">
		<?php include 'pc/left.php'; ?>
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