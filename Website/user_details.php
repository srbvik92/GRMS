<link rel="stylesheet" type=text/css href=fontdesign.css>


<?php

//error_reporting(E_ALL); ini_set('display_errors', TRUE); ini_set('display_startup_errors', TRUE);
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
//error_reporting(0);

include 'connect_db.php';

$uname=$_SESSION['username'];
//$usertype=$_SESSION["usertype"];

//echo "$mobile";
//echo $usertype;

$qry="select name from user where u_name='$uname'";

$rs=mysqli_query($con,$qry);

$rw=mysqli_fetch_row($rs);

$fname=$rw[0];

//echo "Welcome $fname";

$my_account=$server_root."my_account.php";

?>






<table  border="0" bgcolor="#D2D2D2" bordercolor="#D2D2D2">
  <tbody>
    <tr>
      <td width="214" valign="middle" height="37">&nbsp;&nbsp;<?php echo "Welcome $fname"; ?></td>
      <td width="604">&nbsp;</td>
		<td width="168"><headerfont><a href= <?php echo $my_account; ?> style="text-decoration:none">My Account</a></headerfont></td>
    </tr>
    <tr>
      <td height="37" colspan="2" bgcolor="	#D2D2D2">
      <table width="353" height="37" border="0">
  <tbody>
    <tr>
      <td width="140" align="center"><headerfont><a style="text-decoration: none" href="my_played_games.php">My Played Games</a></headerfont></td>
      <td width="72" align="center"><headerfont><a style="text-decoration: none" href="wishlist.php">Wishlist</a></headerfont></td>
      <td width="127" align="center"><headerfont><a style="text-decoration:none" href="my_top_rated.php">My top rated</a></headerfont></td>
    </tr>
  </tbody>
</table>
</td>
    
      
      <td><headerfont><a href="logout.php" style="text-decoration: none">Logout</a></headerfont>  </td>
    </tr>
  </tbody>
</table>


