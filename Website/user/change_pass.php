<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$uname=$_SESSION['username'];
//echo $uname;

?>

<style>
          .error {color: #FF0000;}
        </style>



<table width="100%" border="0">
  <form method="post" action="user/update_pass.php">
  <tr>
  	<td></td>
  	<td><?php echo $_SESSION['success']; 
		unset($_SESSION['success']);
		?></td>
  </tr>
  <tr>
  	<td>Current Password: </td>
  	<td>
  	<input type="password" name="oldpass">
  	<span class="error">*<?php echo $_SESSION['error'][0] ;
 ?> 
</span>
  	</td>
  </tr>
  <tr>
  	<td>New Password: </td>
  	<td>
  	<input type="password" name="newpass1">
  	<span class="error">*<?php echo $_SESSION['error'][1]; ?> 
</span>
  	</td>
  </tr>
  
  <tr>
    <td>New Password: </td>
  	<td>
  	<input type="password" name="newpass2">
  	<span class="error">*<?php echo $_SESSION['error'][2] ; ?> </span>
  	</td>
  </tr>
  <tr>
  	<td>
  		
  	</td>
  	<td>
  	<input type="submit" value="Change Password">
  	<span class="error">*<?php echo $_SESSION['error'][3] ;
 ?> 
</span>
  	</td>
  	<?php unset($_SESSION['error']); ?>
  </tr>
  </form>
</table>
