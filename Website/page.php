<script type="text/javascript">
function reload() {
	//alert("3");
 	var x = document.getElementById("genre");
	var genre = x.options[x.selectedIndex].value;
	var x = document.getElementById("platform");
	var platform = x.options[x.selectedIndex].value;
	var x = document.getElementById("rel_year");
	var rel_year = x.options[x.selectedIndex].value;
	//alert (rel_year);
	var info = "genre="+genre+"&platform="+platform+"&rel_year="+rel_year;
	//alert(info);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main").innerHTML = this.responseText;
    }
  };
//if (x=="images")
{
  	xhttp.open("POST", "search/search_game1.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send(info);
}
}
</script>





	<input type="text" name="name" id="name">
	<select name="genre" id="genre" onchange="reload()">
		<option value="all" selected>All</option>
		<option value="first_person">First Person</option>
		<option value="third_person">Third person</option>
	</select>
	<select name="platform" id="platform" onchange="reload()">
		<option value="all" selected>All</option>
		<option value="pc">PC</option>
		<option value="ps4">PS4</option>
	</select>
	<select name="rel_year" id="rel_year" onchange="reload()">
		<option value="all" selected>All</option>
		<option value="2018">2018</option>
		<option value="2017">2017</option>
	</select>	





<div id="main">

<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }

$string=$_GET["g_name"];

//echo $string."bubi";

$qry="select g_id from g_detail where g_name like '%".$string."%'";

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


</div>