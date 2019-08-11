<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

error_reporting(0);

$p_form=$_POST['p_form'];
$genre=$_POST['genre'];
$rel_year=$_POST['rel_year'];
$rating=$_POST[''];
$esrb=$_POST['esrb'];
$sort="order by g_id desc limit 10 offset ". $s*10;

if($p_form=="all" && $rel_year=="" && $rating=="" && $esrb=="all")
{
	$where="";
}
else $where="where";

$and="";

// if platform is all then there is no need to search in p_form database
if($p_form=="all")
{ 
	$p_form=""; $and=""; 
	
	if($rel_year=="") $rel_year=="";
else { $rel_year=$and." rel_year='$rel_year' "; }
//echo $rel_year;

if($rating=="") $rating=="";
else $rating="and rating='$rating' ";
//echo $rating;

if($esrb=="all"){   $esrb="";}
else $esrb="and esrb='$esrb'";
//echo $esrb;

$qry="select g_id from g_detail ".$where." ".$p_form.$rel_year.$rating.$esrb;
echo $qry;
echo $_SERVER['PATH_TRANSLATED'];
				  
}

//else select platform data from g_form table
else
{
	if($p_form==ps3) {$pfqry= "ps3='1'";}
	if($p_form==x360) {$pfqry= "x360='1'";}
	if($p_form==pc) {$pfqry= "pc='1'";}
	if($p_form==ps4) {$pfqry= "ps4='1'";}
	if($p_form==xone) {$pfqry= "xone='1'";}
	
	$pformmqry="select g_id from g_pform where ".$pfqry;
	
	//$qry="(select g_id from g_detail ".$where." ".$p_form.$rel_year.$rating.$esrb.") INTERSECT (".$pformqry.")";
	
	$qry= "select g_detail.g_id from g_detail where g_detail.g_id IN (".$pformmqry.")";
	
}
//echo $p_form;


//if all genre is selected then no modifications in query
if($genre=="all") $genre="";


//remove genre temporarily
//else if genre is selected then
//else 
//{ 
	//$genqry="select * from";
	//$genre=$and." genre='$genre' "; $and="and"; 

//}
//echo $genre;


?>
<table>
<?php
	
$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
while($row=mysqli_fetch_row($rs))
{
	
	$g_qry="select * from g_detail where g_id='$row[0]'";
	$res=mysqli_query($con,$g_qry) OR die(mysqli_error($con));
	$rw=mysqli_fetch_row($res);
	
	
	$logo="logos/".$rw[0]."/".$rw[7];
	$g_id=$rw[0];
	?>
    <tr>
    <!-- Display logo of the game -->
    <td width="65" height="100"><img height="100" width="65" src="<?php  echo $logo; ?>"/></td>
    
    
    <!--link to the game and some details like developer, release date etc -->
    <td valign="top">
    
	<a href="<?php echo $_SERVER['PATH_TRANSLATED']."/grms/game_details.php?id=".$rw[0] ?>"><?php echo $rw[1]; ?></a>
  	<br> Producer: 
  	<?php echo $rw[9]; ?>
   	<br> Developer: 
   	<?php echo $rw[8]; ?>
   	<br>
   	
    </td>
    
    
    <!-- display rating of the game too -->
    <?php
    $ratqry="select AVG(rating) from game_user where g_id=$g_id";
    $ratrs=mysqli_query($con,$ratqry) OR die(mysqli_error($con));
	if(mysqli_num_rows($ratrs)==0)  echo "inside if";
	$ratrw=mysqli_fetch_row($ratrs);
	//round($ratrw[0],1)
    ?>
	<td>
   		<table width="50px" border="5" height="50" bordercolor="#FFFFFF">
  		<tbody>
    	<tr>
     	 <td width="45" bgcolor="#00BFF0" align="center" valign="">
      	 <font color="white" size="+1">
      	  <?php echo round($ratrw[0],5);   ?>
      	
      	  </font>
	     </td>
        </tr>
        </tbody>
        </table>
    	
    	
    </td>
    </tr>


	<?php
}
?>
</table>

