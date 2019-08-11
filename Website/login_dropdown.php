<?php
session_start();
?>
<html>
<style>
          .error {color: #FF0000;}
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