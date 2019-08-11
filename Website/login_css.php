<?php
session_start();
error_reporting(0);
?>
<html>
<style>
          .error {color: #FF0000;}
	
.topbar
{
	overflow: hidden;
	float: none;
	background-color: #0080F0;
}

.login{
		
}	
	
.topbar a{
	float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
	
}
	
.dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

</style>
<form method="POST" action="login_action.php">

<table width="100%" border="0" bgcolor="#D2D2D2">
           <!--  <tr>
               <td width="24%">
             Login as:<br>
             </td>
               <td width="76%">
               <label>
               <input type="radio" name="usertype" value="individual" checked>Individual User</label><label>
               <input type="radio" name="usertype" value="builder" >Builder</label></td>
              
             </tr>    -->
             <tr>
               <td>User Name</td>
               <td><input type="text" name="uname" maxlength="15">
                
<span class="error">*<?php 
 echo $_SESSION['error4'][0] ;
 ?> 
</span>
             </tr>
             <tr>
               <td>Password:</td>
               <td><input type="password" name="pass" maxlength="10">
               <span class="error">*<?php 
 echo $_SESSION['error4'][1] ;
 unset ($_SESSION['error4']);
 
 ?> 
</span></td>
             </tr>
           
 <tr><td>         
<input type=submit value='Login'><span class="error"> 

<a href="register.php">Sign up</a>
</td>
	 </tr>
</table>

<?php echo $_SESSION['error5']; 
unset($_SESSION['error5']);
?></span>
</form>  
 
  </html>
  
<div class="topbar">
	<a href="register.php">Create Account</a><span class="error"><?php echo $_SESSION['error5']; 
unset($_SESSION['error5']);
?></span>
	<a>User Name</a>
               <a><input type="text" name="uname" maxlength="15"><span class="error">*<?php 
 echo $_SESSION['error4'][0] ;
 ?> 
</span></a>
	<a>Password</a>
               <a><input type="password" name="pass" maxlength="10"> <span class="error">*<?php 
 echo $_SESSION['error4'][1] ;
 unset ($_SESSION['error4']);
 
 ?> 
</span></a>
    <a><input type="submit" value="Login" ></a>
    
</div>