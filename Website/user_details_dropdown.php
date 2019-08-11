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






<table width="100%" border="0" bgcolor="#D2D2D2" bordercolor="#D2D2D2">
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


<meta name="viewport" content="width=device-width, initial-scale=1">


<style>
.navbar {
    overflow: hidden;
    background-color: #333;
    font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>

<body>

<div class="navbar">
  <a href="#home">My Played Games</a>
  <a href="#news">Wishlist</a>
  <div class="dropdown">
    <button class="dropbtn">Dropdown 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div> 
</div>


</body>
</html>
