<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>

<table bgcolor="#00880F" width="100%">
<tr>
<td width="65" height="32" align="center"><a href="game_details.php?id=<?php echo $g_id; ?>&page=main" style="text-decoration: none"><font color="white">Main</font></a></td>
<td width="70" align="center"><a href="game_details.php?id=<?php echo $g_id; ?>&page=image" style="text-decoration: none"><font color="white">Images</font></a></td>
<td width="106" align="center"><a href="game_details.php?id=<?php echo $g_id; ?>&page=mission" style="text-decoration: none"><font color="white">Missions</font></a></td>
<td></td>
	</tr>
</table>

</html>