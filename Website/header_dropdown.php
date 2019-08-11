<head><link rel="icon" type="image/png" href="logo.png"></head>
<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
  
error_reporting(0);
		
		$uname=$_SESSION['username'];
		
		if(!(strcmp($uname,"")))
		{
			include 'login_dropdown.php';
		}
		else
		{
			include 'user_details_dropdown.php';
		}
		?>
      
