<link rel="stylesheet" type=text/css href=fontdesign.css>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//include 'function.php';

error_reporting(1);
//select games according to platform sorted by date i.e. latest
$qry="select g_id from g_pform where pc=1 order by pc_date desc limit 5";

$rs=mysqli_query($con,$qry) or die(mysql_error($con));
?>


<div style="width: 870px; height: 20px; padding: 15px; background-color: black;">
	<font color="white" style="font-size: 16px;">&nbsp;Latest PC Releases</font>
</div>




<?php
while($rw=mysqli_fetch_row($rs))
{
	//for each g_id fetch game details
	$g_id=$rw[0];
	
	$g_qry="select * from g_detail where g_id='$g_id'";
	
	$g_rs=mysqli_query($con,$g_qry) or die(mysqli_error($con));
	
	$g_rw=mysqli_fetch_row($g_rs);

?>
<table width="900" border="0">
  <tbody>
    <tr>

      <td width="500">&nbsp;
      	
      	<fdesign><a href="<?php echo $_SERVER['PATH_TRANSLATED']."/grms/game_details.php?id=".$g_rw[0] ?>" style="text-decoration: none"><?php echo $g_rw[1]; ?></a></fdesign>
      	
      </td>
      <td>
      	<!--<table width="50px" border="5" height="50" bordercolor="#FFFFFF">
  		<tbody>
    	<tr>
     	 <td width="45" bgcolor="#00BFF0" align="center" valign="">
      	 <font color="white" size="+1"> -->
      	  <?php //$rat = get_avg_rat($g_rw[0]);
			 //echo $rat."raring";
			//echo get_avg_rat($g_rw[0]);
			 ?>
     	<!-- display rating of the game too -->
    <?php
    $ratqry="select AVG(rating) from game_user where g_id=$g_id";
    $ratrs=mysqli_query($con,$ratqry) OR die(mysqli_error($con));
	if(mysqli_num_rows($ratrs)==0)  echo "inside if";
	$ratrw=mysqli_fetch_row($ratrs);
	//round($ratrw[0],1)
    ?>
	<td width="200">
   		<table width="50px" border="5" height="50" bordercolor="#FFFFFF">
  		<tbody>
    	<tr>
     	 <td width="45" bgcolor="#00BFF0" align="center" valign="">
      	 <font color="white" size="+1">
      	  <?php echo round($ratrw[0],5);   ?>
      	
      	  </font>
	     </td>
    
      	
      	  </font>
	     </td>
        </tr>
        </tbody>
        </table>
      	
      </td>
    </tr>
  </tbody>
</table>




<?php
}


?>