<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }





$uname=$_SESSION['username'];

//select games rated by user which we assume he has already played it
$qry="select * from game_user where u_name='$uname' order by g_id limit 10 offset 0";

$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));

//display details of each game in table format
while($rw=mysqli_fetch_row($rs))
{
	$g_id=$rw[0];
	
	//for each id select that game from database
	$qry_g_detail="select * from g_detail where g_id=$g_id";
	$rs_g_detail=mysqli_query($con,$qry_g_detail) OR die(mysqli_error($con));
	$rw_g_detail=mysqli_fetch_row($rs_g_detail);
	
	//name of the game
	$g_name=$rw_g_detail[1];
	
	//set logo variable to display
	$logo="logos/".$rw_g_detail[0]."/".$rw_g_detail[7];
	
	//name variable to display
	$name=$rw_g_detail[1];
	
	//getting platforms to display
	$pformqry="select * from g_pform where g_id=$g_id";
					$pformrs=mysqli_query($con,$pformqry) OR die(mysqli_error($con));
					$pformrow=mysqli_fetch_row($pformrs);
					//echo $pformrs[1]."halalalalala";
					//echo $pformrow[1];
					if($pformrow[1]==1)$pc="PC, "; else $pc="";
					//echo $pc;
	
					//echo $pformrow[2];
					if($pformrow[2]==1)$ps3="PS3, "; else $ps3="";
					//echo $ps3;
					if($pformrow[3]==1)$x360="Xbox 360, "; else $x360="";
					if($pformrow[4]==1)$ps4="PS4, "; else $ps4="";
					if($pformrow[5]==1)$xone="Xbox One"; else $xone="";
					
					$pform=$pc.$ps3.$x360.$ps4.$xone;
	
					//echo $pc.$ps3.$ps4.$x360.$xone;
					//echo $pform;
?>

<!-- Display results of played games in table format with logo, name, platform and first few words of summary -->
<table width="100%" border="0">
  <tbody>
    <tr>
      <td height="90px" width="60px"><img height="85" width="55" src="<?php  echo $logo; ?>"/></td>
      <td valign="top">
      <a style="text-decoration: none" href="<?php echo "/grms/game_details.php?id=".$rw[0] ?>"><?php echo $g_name; ?></a> <br> <?php echo $pform; ?>
      <br>
      <?php  $summary= substr($rw_g_detail[10], 0, 185)."...";
		//echo $rw_g_detail[10];
	  	echo $summary;
	  ?>
      
      </td>
      <td>&nbsp;</td>
    </tr>
    
  </tbody>
</table>

<?php }
?>
