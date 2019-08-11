<?php

error_reporting(E_ALL); ini_set('display_errors', TRUE); ini_set('display_startup_errors', TRUE);

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$genre = $_POST['genre'];
$platform = $_POST['platform'];
$rel_year = $_POST['rel_year'];
echo $platform;
echo $genre;
$qry="select g_detail.g_id from g_detail ";
$count="select COUNT(g_detail.g_id) from g_detail ";
$where = "";
$gen_qry="";
$pform_qry="";
$and="";

if ($rel_year=="all"){
	$rel_year_qry="";
}
else{
	$where=" where ";
	$rel_year_qry=" EXTRACT(YEAR from rel_date)=".$rel_year;
}

if($genre=="all"){
	$gen_qry="";
}
else{
	if($rel_year!="all")  $and=" and ";
	$where=" where ";
	$gen_qry="g_detail.g_id IN (select g_id from g_genre where ".$genre."='1')";
}

if($platform=="all"){
	$pform_qry="";
}
else{
	if($rel_year!="all"){
		if($genre!="all"){
			$pform_qry="and g_detail.g_id IN (select g_id from g_pform where ".$platform."='1')";
		}
	}
		
}

$fin_qry=$qry.$where.$rel_year_qry.$and.$gen_qry.$pform_qry;
echo $fin_qry;
$count_qry= $count.$where.$rel_year_qry.$and.$gen_qry.$pform_qry;
$rs=mysqli_query($con,$fin_qry) or die(mysqli_error($con));

?>
<table>

<?php

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
    <?php //echo $_SERVER['PATH_TRANSLATED']; ?>
    
	<a href="<?php echo "../grms/game_details.php?id=".$rw[0] ?>"><?php echo $rw[1]; ?></a>
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
<?php
echo "Page";

$count_rs=mysqli_query($con,$count_qry) or die(mysqli_error($con));

$count_row=mysqli_fetch_row($count_rs);
$count_total = $count_row[0];
echo $count_total;
while($count_total > 0 ){
	echo "inside while";
	$i=1;
	?>
	<a href="search.php?s=<?php echo $i; ?>"><?php echo $i; ?></a>
	<?php 
	$count_total=$count_total-10;
	$i=$i+10;
}

?>

