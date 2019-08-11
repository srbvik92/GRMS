<?php

include 'connect_db.php';
session_start();
$uname=$_SESSION['username'];
//echo $uname;

?>

<form method="post" action="update_action.php" enctype="multipart/form-data">
<table width="100%">

<tr>
	<td>Date of Birth:</td>
    <td><input type="date" name="dob" /></td>
</tr>

</table>
<input type="submit" name="submit" value="SUBMIT">


</form>