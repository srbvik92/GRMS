<table width="100%" border="0">
  <tr></tr>
</table>


<!DOCTYPE html>



<!DOCTYPE html>
<html>
<head>
<style>
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
</head>
<body>
<!--
<ul>
  <li><a href="home.php" class="active">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><input type="text"></li>
  <li><a href="search.php">Search a Game</a></li>
  
</ul>  -->


<ul>
<table width="1000" height="30" border="0">
  <tbody>
    <tr>
      <td width="80" valign="middle" align="center"><li><a style="text-decoration: none
      " href="home.php">Home</a></li></td>
      <td width="60" valign="middle" align="center"><li><a style="text-decoration: none
      " href="pc.php">PC</a></li></td>
      <td width="70" valign="middle" align="center"><li><a style="text-decoration: none
      " href="ps4.php">PS4</a></li></td>
      <td width="110" valign="middle" align="center"><li><a style="text-decoration: none
      " href="xone.php">Xbox One</a></li></td>
      <!--<td width="70" valign="middle" align="center"><li><a style="text-decoration: none
      " href="ps3.php">PS3</a></li></td>
      <td width="110" valign="middle" align="center"><li><a style="text-decoration: none
      " href="x360.php">Xbox 360</a></li></td> -->
      
      <form method="get" action="search.php"><td width=" 490" align="right" style="vertical-align: middle"><input type="text" name="g_name">&nbsp;<input type="submit" value="Search"></td></form>
      <td width="10"></td>
    </tr>
  </tbody>
</table>
</ul>

</body>
</html>
