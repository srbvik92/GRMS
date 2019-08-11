<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$uname=$_SESSION['username'];
//echo $uname;

?>

<table width="100%" border="0" bgcolor="#177EDD">
  <tr height="40">
    <td align="center"><a href="change_pass.php" style="text-decoration: none"><font color="white">Change Password</font></a></td>
    <td align="center">
    	<a href="my_account.php?s=1&e=10" style="text-decoration: none"><font color="white">View list of your games</font></a>
    </td>
  
    <td align="center"><a href="personal_details.php" style="text-decoration: none"><font color="white">Personal details</font></a></td>
    <td align="center"><a href="hw_details.php" style="text-decoration: none"><font color="white">Hardware Owned</font></a></td>
		
  </tr>
  
</table>