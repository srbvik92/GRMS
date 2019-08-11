<?php /* session_start();
if(!session_is_registered(usermobile))
{
$_SESSION['login_error']="YOU MUST BE LOGGED IN BEFORE POSTING OR SEARCHING...!";
header("location: first.php");
} 
include 'header.php';
include 'menu.php';
 */
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
        <title>post property</title>
            <style>
                .error {color: #FF0000;}
                .error2{color: #CC6600;}
            </style>
    </head>
        <body>
            <p>
         <?php
	    
        $arr = array();
		$arr[] = "Bhilai";
        $arr[] = "Bilaspur";
        $arr[] = "Durg";
        $arr[] = "Raipur";
        $position = array();
        $position['Bhilai'][] = "Vaisali Nagar";
		$position['Bhilai'][] = "Nehru Nagar";
		$position['Bhilai'][] = "Supela";
		$position['Bhilai'][] = "Smriti Nagar";
        $position['Bilaspur'][] = "Usalpur";
		$position['Bilaspur'][] = "Railway Station";
		$position['Bilaspur'][] = "Ratanpur road";
		$position['Bilaspur'][] = "Vidya Nagar";
        $position['Durg'][] = "Indra Market";
		$position['Durg'][] = "Aditya Nagar";
		$position['Durg'][] = "Schindhia Nagar";
		$position['Durg'][] = "Padmanabpur";
        $position['Raipur'][] = "Tatibandh";
		$position['Raipur'][] = "Telibandha";
		$position['Raipur'][] = "ShankarNagar";
		$position['Raipur'][] = "KabirNagar";
		$position['Raipur'][] = "Sundar Nagar";
       ?>
            
         <b><font size="+1">Post Your Property Details</font><b>
            
        <b></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>Basic Details<b>
            </p>
        <hr>
            
            <form name="post_property" action="insert_game_db_action.php" method="post" enctype="multipart/form-data">
              <p>
			  </p>
             <table width="100%" border="0">
               <tr>
                 <td height="33">Game Name :</td>
                 <td><input type="text" id="gname" name="gname"/>
                 </td>
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td height="35">Platform :</td>
                 <td><!--<select id="pform" name="pform">
                   <option value="pc">PC</option>
                   <option value="xone">XBOX ONE </option>
                   <option value="ps4">PS4</option>
                   </select>
                 <span class="error">*</span>-->
                 <input type="checkbox" name="ps3" value="1">PS3<br>
                 <input type="checkbox" name="ps4" value="1">PS4<br>
                 <input type="checkbox" name="x360" value="1">Xbox 360<br>
  				 <input type="checkbox" name="xone" value="1">Xbox One<br>
                 <input type="checkbox" name="pc" value="1">Microsoft Windows<br>
                 </td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td height="33">Release date :</td>
                 <td><input type="date" name="reldate">
                 
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
               <tr> 
                 <td>Genre Name:</td>
                 <td><input type="text" name="genre"></td>
                 <td></td>
               </tr>
               </tr>
               <tr>
                 <td height="32">Genre :</td>
                 <td><!--<select name="genre">
                   <option value="">--select Genre--</option>
                   <option value="fps">FPS</option>
                   <option value="action">Action</option>
                   <option value="adventure">Adventure</option>
                   <option value="rpg">RPG</option>
                   <option value="3ps">3PS</option>
                   <option value="sports">SPORTS</option>
                   <option value="misc">Miscellaneous</option> -->
                   <input type="checkbox" name="action" value="1">Action<br>
                   <input type="checkbox" name="adventure" value="1">Adventure<br>
                   <input type="checkbox" name="fighting" value="1">Fighting Games<br>
                   <input type="checkbox" name="fp" value="1">First Person<br>
                   <input type="checkbox" name="horror" value="1">Horror<br>
                   <input type="checkbox" name="multi_player" value="1">Multi Player<br>
                   <input type="checkbox" name="online" value="1">Online<br>
                   <input type="checkbox" name="open_world" value="1">Open World<br>
                   <input type="checkbox" name="party" value="1">Party<br>
                   <input type="checkbox" name="platform" value="1">Platform<br>
                   <input type="checkbox" name="puzzle" value="1">Puzzle<br>
                   <input type="checkbox" name="racing" value="1">Racing<br>
                   <input type="checkbox" name="rpg" value="1">Role Playing<br>
                   <input type="checkbox" name="shooters" value="1">Shooters<br>
                   <input type="checkbox" name="sim" value="1">Simualation<br>
                   <input type="checkbox" name="sports" value="1">Sports<br>
                   <input type="checkbox" name="strategy" value="1">Strategy<br>
                   <input type="checkbox" name="survival" value="1">Survival<br>
                   <input type="checkbox" name="3p" value="1">Third Person<br>
                   <input type="checkbox" name="wrestling" value="1">Wrestling<br>
                   <input type="checkbox" name="" value="1"><br>
                 </select>
                   
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td height="34">ESRB Rating :</td>
                 <td><select name="esrb">
                   <option value="">---ESRB Rating---</option>
                   <option value="T">Teen</option>
                   <option value="18+">18+</option>
                   <option value="E">everyone</option>
                 </select>
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td height="33">Images :</td>
                 <td><input type="text" name="image">
                 
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
                 </tr>
                <tr>
                 <td height="33">Logo :</td>
                 <td><input type="file" name="file" id="file">
                 
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td height="33">Developer :</td>
                 <td><input type="text" name="devs">
                 
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td height="33">Publisher :</td>
                 <td><input type="text" name="publisher">
                 
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
                </tr>
               <tr>
                 <td height="33">Summary :</td>
                 <td><input type="textarea" name="summary">
                 
                 <span class="error">*</span></td>
                 <td>&nbsp;</td>
                </tr>
               
             </table>
             <p><br/>
              
               
               <input type="submit" name="submit" value="SUBMIT">
             </p>
        </form>
</body>
</html>

<br>
<hr />
<br />
<?php
include 'footer.php';
?>

