<style>
   .button {
    background-color:#E5EB00;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
	

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}

.active {
    background-color: red;
	

	
}

</style>

<script>

$( "#result" ).load( "images.php" );
$( "#mission" ).load( "mission.php" );

</script>

<!--<h1>The XMLHttpRequest Object</h1>

<button type="button" onclick="loadDoc()">Request data</button> 

<p id="demo"></p>-->
 
<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main").innerHTML = this.responseText;
    }
  };
//if (x=="images")
{
  	xhttp.open("POST", "images.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send("g_id=<?php echo $g_id; ?>");
}

//if (x=="mission")
{
	
}
}
</script>


<p id="demo"></p>
 


<link rel="stylesheet" type=text/css href=button.css>

<table bgcolor="#00880F" width="100%">
<tr>
<td width="65" height="32" align="center"><a href="game_details.php?id=<?php echo $g_id; ?>&page=main" style="text-decoration: none"><font color="white">Main</font></a></td>

<!-- call function loadDoc onclick of link for both images and mission -->
<td width="70" align="center"><a href="#images" onClick="loadDoc(images)" id="reslink" style="text-decoration: none"><font color="white">Images</font></a></td>

<td width="106" align="center"><a href="#mission" onClick="loadDoc(mission)" style="text-decoration: none"><font color="white">Missions</font></a></td>
<td></td>
	</tr>
</table>

<div id="main">
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect_db.php';

$uname=$_SESSION['username'];

$qry="select * from g_detail where g_id=$g_id";

$rs=mysqli_query($con,$qry) OR die(mysql_error($con));
$rw=mysqli_fetch_row($rs);

$date=date('d-m-Y',strtotime($rw[3]));

if($rw[5]=="18+")
{
	$age="esrb_m.png";
}

if($rw[5]=="E")
{
	$age="esrb_e.png";
}

if($rw[5]=="t")
{
	$age="esrb_t.png";
}

$qry1="select AVG(rating) from game_user where g_id=$g_id";
$rs2=mysqli_query($con,$qry1) OR die(mysqli_error($con));
if(mysqli_num_rows($rs2)==0)  echo "inside if";
$rw2=mysqli_fetch_row($rs2);
round($rw2[0],1)
?>

<table border="8" width="850" bordercolor="white">
<tr>

<td width="700px" valign="top">
Available on: <?php
					  //echo $rw[2]; 
					$pformqry="select * from g_pform where g_id=$g_id";
					$pformrs=mysqli_query($con,$pformqry) OR die(mysqli_error($con));
					$pformrow=mysqli_fetch_row($pformrs);
					//echo $pformrs[1]."halalalalala";
					if($pformrow[1]==1)$pc="PC, ";
					if($pformrow[2]==1)$ps3="PS3, ";
					if($pformrow[3]==1)$x360="Xbox 360, ";
					if($pformrow[4]==1)$ps4="PS4, ";
					if($pformrow[5]==1)$xone="Xbox One";
					
					echo $pc.$ps3.$x360.$ps4.$xone;
					
					?>
<br>
Release Date: <?php echo $date; ?>
<br>
Genre: <?php $gen_qry="select * from g_genre where g_id='$g_id'";
		$genrs=mysqli_query($con,$gen_qry) OR die(mysqli_error($con));
		$genrow=mysqli_fetch_row($genrs);
		
		if($genrow[1]==1)$action="Action, ";
		if($genrow[2]==1)$adventure="Adventure, ";
		if($genrow[3]==1)$first_person="First Person, ";
		if($genrow[4]==1)$multiplayer="Multiplayer, ";
		if($genrow[5]==1)$online="Online, ";
		if($genrow[6]==1)$puzzle="Puzzle, ";
		if($genrow[7]==1)$rpg="Role Playing, ";
		if($genrow[8]==1)$shooter="Shooter, ";
		if($genrow[9]==1)$third_person="	, ";
	
	echo $action.$adventure.$first_person.$multiplayer.$online.$puzzle.$rpg.$shooter;
	
	?>
	<br>
	Developer: <?php echo $rw[8]; ?>
</td>
<!-- display rating in grmsbox format -->
<td width="100px">
<table width="100px" border="5" height="100" bordercolor="#FFFFFF">
  <tbody>
    <tr>
      <td width="100" bgcolor="#00BFF0" align="center" valign="">
      <font color="white" size="+6">
      	  <?php echo round($rw2[0],5);   ?>
      	
      </font>
	  </td>
    </tr>
  </tbody>
</table>
	
</td>


</tr>
</table>



<!--<table>
<tr>
	<td width=80%>   </td>
    <td><!-- Grms Rating :   <?php //echo round($rw2[0],5);   ?> </td>
</tr>
</table> -->

<table width="100%" border="0">
  <tr>
    <td width="79%"><img width="60" height="70" src=" <?php echo "images/age_rating/".$age   ?>"  /></td>
    <td width="21%">
    <?php 
	//get the rating of the game for the user if logged in or else skip these actions

if($uname==""){}

else {
	

$query="select * from game_user where g_id=$g_id and u_name='$uname'";

						 
$result=mysqli_query($con,$query) OR die(mysqli_error($con));
	 ?>
    <!-- check that game is already in wishlist or not 
    Three conditions apply
    1. If played, show that you have played this game even though if it is not in wishlist.
    2. If in playlist but not played, show that it is in playlist.
    3. Neither in playlist nor played, show "Add to playlist".        -->
    <?php
		$wish_chk="select * from wishlist where g_id=$g_id and u_name='$uname'";
		$wish_rs=mysqli_query($con,$wish_chk) OR die(mysqli_error($con));
		
		if(mysqli_num_rows($result)!=0) {  ?>
			
			U have played this game
		 <?php }
		
		else {
			
			if (mysqli_num_rows($wish_rs) != 0) {
			?>   
			Already in Wishlist
			
			<?php }
			else {     // results not found ?> 
				
    <form method="post" action="add_wishlist_action.php">
   <!--<a href="add_wishlist_action.php"><button class="button"> -->
   <input type="hidden" name="g_id" value="<?php echo $g_id; ?>">
   <p align="right"><input type=submit value="Add to Wishlist" name="submit" id="wishbutton"/></p>
   
   </form>
  <?php  }} 
}?>
    </td>
  </tr>
  <tr>
    <td colspan="2">Summary : <?php echo $rw[10]; ?></td>
  </tr>
</table>

<?php
//get the rating of the game for the user
$query="select * from game_user where g_id=$g_id and u_name='$uname'";

$result=mysqli_query($con,$query) OR die(mysqli_error($con)); 

if($uname=="") {}

else
{
if(mysqli_num_rows($result)==0)
{
	//echo "inside if";
	$action="../user/insert_rat"
	?>
    
    <form method="post" action="user/insert_rat_comp.php">
    <table width="100%" border="0">
    <tr>
    <td>Rate this game (1-10) : <select name="rating">
						  <option value="0" selected="selected"></option>       					  <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          </select>
                          
    </td>
    <!-- display the only platforms in which game is available -->
    
    <?php
    	$pqry="select * from g_pform where g_id='$g_id'";
		$prs=mysqli_query($con,$pqry) OR die(mysqli_error($con));
	$prw=mysqli_fetch_row($prs);
		
	?>	
    <td>Platform: 
    <select name="p_form">
		 <option value="----" selected="selected"></option> 
            <?php if($prw[1]==1){ ?>  <option value="pc">PC</option><?php  }?>
            <?php if($prw[2]==1){ ?>   <option value="ps3">PS3</option><?php  }?>
            <?php if($prw[3]==1){ ?>   <option value="x360">Xbox 360</option><?php  }?>
            <?php if($prw[4]==1){ ?>   <option value="ps4">PS4</option><?php  }?>
            <?php if($prw[5]==1){ ?>   <option value="xone">Xbox One</option><?php  }?>
    </select>
    </td>
    <td>How much completed: <input type=number min="1" max="100" width="5" value="0" name="completion" /></td>
  </tr>
  <input type="hidden" name="g_id" value="<?php echo $g_id; ?>">
  <tr>
  <td colspan="2"> <input type="submit" valude="submit" /> </td>
  </tr>
</table>
</form>

    
    <?php
}

else
{
	//echo "inseide else";
	$query1="select * from game_user where g_id=$g_id and u_name='$uname'";
	
	$rs1=mysqli_query($con,$query1) OR die(mysqli_error($con));
	$rw1=mysqli_fetch_row($rs1);
	?>
    <table width="100%">
    <tr>
    <td>Your Completion of Game: <?php echo $rw1[3]; ?> </td>
	<td>Your Rating: <?php echo $rw1[4]; ?> </td>
    <td>Your Platform: <?php echo $rw1[1]; ?> </td>
    </tr>
	</table>
    <?php
}

}

?>
</div>