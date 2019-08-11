<head><link rel="icon" type="image/png" href="logo.png"></head>
<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }

//ini_set('display_startup_errors', 1);
//ini_set('display_errors', 1);
//error_reporting(-1);
  
error_reporting(0);
		
		$uname=$_SESSION['username'];
		
		if(!(strcmp($uname,"")))
		{
			include 'login.php';
		}
		else
		{
			include 'user_details.php';
		}
		?>
      
