<link rel="stylesheet" type=text/css href=fontdesign.css>


<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
error_reporting(0);

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

$my_account=$_SERVER['PATH_TRANSLATED']."my_account.php";

?>

<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
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




<table width="100%"><!-- border="0" bgcolor="#D2D2D2" bordercolor="#D2D2D2"> -->
  <tbody>
    <tr>
      <td width="214" valign="middle" style=" height: 40px;
  line-height: 40px;" height="40" class="myaccount">&nbsp;&nbsp;<?php echo "Welcome $fname"; ?></td>
      <td width="604">&nbsp;</td>
		<td width="168" class="myaccount"><headerfont><a href= <?php echo $my_account; ?> style="text-decoration:none">My Account</a></headerfont></td>
    </tr>
    <tr>
      <td colspan="2" valign="middle" height="40" style=" height: 40px;
  line-height: 40px;"> <!-- bgcolor="	#D2D2D2"> -->

      <table width="353" height="37" border="0">
  <tbody>
    <tr>
      <td width="140" align="center" class="myaccount"><headerfont><a style="text-decoration: none" href="my_played_games.php">My Played Games</a></headerfont></td>
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
