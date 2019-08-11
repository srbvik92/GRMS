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



<link rel="stylesheet" type=text/css href=button.css>



<div style="width: 1020px; margin: 10px; height: 250px;">
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

	
//age rating logo variable
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


//get rating of the game
$qry1="select AVG(rating) from game_user where g_id=$g_id";
$rs2=mysqli_query($con,$qry1) OR die(mysqli_error($con));
if(mysqli_num_rows($rs2)==0)  echo "inside if";
$rw2=mysqli_fetch_row($rs2);
round($rw2[0],1);
?>





<div style="width: 400px; height: 120px; float: left; margin: 20px;">

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
<!-- display generes of the game-->
Genre(s): <?php $gen_qry="select * from g_genre where g_id='$g_id'";
		$genrs=mysqli_query($con,$gen_qry) OR die(mysqli_error($con));
		$genrow=mysqli_fetch_row($genrs);
		
		if($genrow[1]==1)$action="Action, ";
		if($genrow[2]==1)$adventure="Adventure, ";
		if($genrow[3]==1)$fighting="Fighting,";
		if($genrow[4]==1)$first_person="First Person, ";
		if($genrow[5]==1)$horror="Horror, ";
		if($genrow[6]==1)$multi_player="Multiplayer, ";
		if($genrow[7]==1)$online="Online, ";
		if($genrow[8]==1)$open_world="Open World, ";
		if($genrow[9]==1)$party="Party, ";
		if($genrow[10]==1)$platform="Platform, ";
		if($genrow[11]==1)$puzzle="Puzzle, ";
		if($genrow[12]==1)$racing="Racing, ";
		if($genrow[13]==1)$rpg="Role Playing, ";
		if($genrow[14]==1)$shooters="Shooters, ";
		if($genrow[15]==1)$sim="Simulation, ";
		if($genrow[16]==1)$sports="Sports, ";
		if($genrow[17]==1)$strategy="Strategy, ";
		if($genrow[18]==1)$survival="Survival, ";
		if($genrow[19]==1)$third_person="Third Person, ";
		if($genrow[20]==1)$wrestling="Wrestling, ";
	
	echo $action.$adventure.$fighting.$first_person.$horror.$multi_player.$online.$open_world.$party.$platform.$puzzle.$racing.$rpg.$shooters.$sim.$sports.$strategy.$survival.$third_person.$wrestling;
	
	?>
	<br>
	Developer: <?php echo $rw[8]; ?>
</div>	






<div style="width: 300px; height: 120px; float: left;">
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
		$rwuser=mysqli_fetch_row($result);
	
		if(mysqli_num_rows($result)!=0) {  ?>
			
			U have played this game
			
	<br>Your Completion of Game: <?php echo $rwuser[3]; ?> 
	<br>Your Rating: <?php echo $rwuser[4]; ?> 
    <br>Your Platform: <?php echo $rwuser[1]; ?> 
	
		 <?php }
		//if it is in wishlist, display options to rate the game
		else {
			
			if (mysqli_num_rows($wish_rs) != 0) {
			?>   
			Already in Wishlist, if you have played it please rate it.  
			<form method="post" action="user/insert_rat_comp.php">
    <table width="100%" border="0">
    <tr>
    <td width="37%">Your Rating (1-10) : </td>
					  <td width="63%"><select name="rating">
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
   <tr><td>	
    Platform: </td>
    <td>
    <select name="p_form">
		 <option value="----" selected="selected"></option> 
            <?php if($prw[1]==1){ ?>  <option value="pc">PC</option><?php  }?>
            <?php if($prw[2]==1){ ?>   <option value="ps3">PS3</option><?php  }?>
            <?php if($prw[3]==1){ ?>   <option value="x360">Xbox 360</option><?php  }?>
            <?php if($prw[4]==1){ ?>   <option value="ps4">PS4</option><?php  }?>
            <?php if($prw[5]==1){ ?>   <option value="xone">Xbox One</option><?php  }?>
    </select>
    </td></tr>
    <tr>
      <td>Completion: </td>
       <td>
        <input type=number min="1" max="100" width="5" value="0" name="completion" /></td>
  </tr>
  <input type="hidden" name="g_id" value="<?php echo $g_id; ?>">
  <tr>
  <td colspan="2"> <input type="submit" valude="submit" /> </td>
  </tr>
</table>
</form>	
			
			<?php }
			else {     // results not found ?> 
	    
    <table width="100%" border="0">
    <form method="post" action="user/insert_rat_comp.php">
    <tr>
    <td width="37%">Your Rating (1-10) : </td>
					  <td width="63%"><select name="rating">
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
   <tr><td>	
    Platform: </td>
    <td>
    <select name="p_form">
		 <option value="----" selected="selected"></option> 
            <?php if($prw[1]==1){ ?>  <option value="pc">PC</option><?php  }?>
            <?php if($prw[2]==1){ ?>   <option value="ps3">PS3</option><?php  }?>
            <?php if($prw[3]==1){ ?>   <option value="x360">Xbox 360</option><?php  }?>
            <?php if($prw[4]==1){ ?>   <option value="ps4">PS4</option><?php  }?>
            <?php if($prw[5]==1){ ?>   <option value="xone">Xbox One</option><?php  }?>
    </select>
    </td></tr>
    <tr>
      <td>Completion: </td>
       <td>
        <input type=number min="1" max="100" width="5" value="0" name="completion" /></td>
  </tr>
  <input type="hidden" name="g_id" value="<?php echo $g_id; ?>">
  <tr>
  <td colspan="2"> <input type="submit" valude="submit" />
   
   
   
   </td>
  </tr>
  </form>	
</table>
		
    <form method="post" action="add_wishlist_action.php">
   <!--<a href="add_wishlist_action.php"><button class="button"> -->
   <input type="hidden" name="g_id" value="<?php echo $g_id; ?>">
   <p align="right"><input type=submit value="Add to Wishlist" name="submit" id="wishbutton"/></p>
   
   </form>
  <?php  }} 
}?>
</div>

<!-- display rating in grmsbox format -->

<div style="width: 150px; height: 120px; float: left; margin: 10px;">
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
</div>	







<!--<table>
<tr>
	<td width=80%>   </td>
    <td><!-- Grms Rating :   <?php //echo round($rw2[0],5);   ?> </td>
</tr>
</table> -->
<div style="margin: 10px;">
<table width="100%" border="0">
  <tr>
    <td width="65"><img width="60" height="70" src=" <?php echo "images/age_rating/".$age   ?>"  /></td>
    <td width="89%" valign="top">
  		Summary : <?php echo $rw[10]; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
</table>
</div>

</div>