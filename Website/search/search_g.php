<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//echo "haakkakak";

?>


<form method="post" action="search.php?s=1&e=10">
<table width="100%" border="0">
  <tr>
    <td>Platform:</td>
    <td><select name="p_form">
    	<option value="all" selected="selected">All</option>
    	<option value="ps3">PS3</option>
        <option value="x360">X360</option>
        <option value="pc">PC</option>
        <option value="ps4">PS4</option>
        <option value="xone">XONE</option>
        </select>
    </td>
  </tr>
  <!--<tr>
    <td>Genre:</td>
    <td><select name="genre">
    	<option value="all" selected="selected">All</option>
    	<option value="fps">fps</option>
        <option value="3ps">3ps</option>
        <option value="pc">PC</option>
        </select>
    </td>
  </tr> -->
  <tr>
    <td>Release Year:</td>
    <td><input type="text" name="rel_year"/></td>
  </tr>
  <tr>
    <td>Rating: </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ESRB: </td>
    <td><select name="esrb">
    	<option value="all" selected="selected">All</option>
    	<option value="18+">18+</option>
        <option value="e">Everyone</option>
        <option value="t">Teen</option>
        </select>
    </td>
  </tr>
</table>
<input type="submit" value="search" />
</form>