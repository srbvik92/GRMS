<?php

include 'connect_db.php';

//$qry="select game_id and game";

?>

<form method="post" action="user_game_info.php" >

<table width="100%" border="0">
  <tr>
    <td>Game name</td>
    <td><select name="g_name" >
    		<option value="a" >a</option>
            <option value="FPS" >FPS</option>
            <option value="MMO" >MMO</option>
            <option value="3PS" >3PS</option>
            
   	</select>&nbsp;</td>
  </tr>
  <tr>
<!--    <td>Played</td>
    <td><select name="played" >
    		<option value="1" >YES</option>
            <option value="0" >NO</option>
   	</select>&nbsp;</td>
-->
  </tr>
  <tr>
    <td>How much completed</td>
    <td><input type="text" name="completed" /></td>
  </tr>
  <tr>
    <td>Platform</td>
    <td><select name="pform" >
    		<option value="PS4" >PS4</option>
            <option value="XONE" >XONE</option>
            <option value="PC" >PC</option>    
    	</select></td>
  </tr>
  <tr>
    <td><input type="submit" value="Submit"  />&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>