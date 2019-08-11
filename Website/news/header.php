<?php

session_start();
		
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
      
