

<!DOCTYPE html>



<!DOCTYPE html>
<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    
    
}

li {
	display: inline;
    float: left;
}

li a,b {
    height: 30px;
	width: 140px;
	font-size: 18px;
	text-align: center;
	text-decoration: none;
	color: white;
	display: block;
	padding: 6px;
	margin: auto;
	text-align: center;
	line-height: 32px;
	
}

li a:hover {
    background-color: #555555;
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

      <li><a style="text-decoration: none
      " href="home.php">Home</a></li>
      <li><a style="text-decoration: none
      " href="pc.php">PC</a></li>
      <li><a style="text-decoration: none
      " href="ps4.php">PS4</a></li>
      <li><a style="text-decoration: none
      " href="xone.php">Xbox One</a></li>
      <!--<td width="70" valign="middle" align="center"><li><a style="text-decoration: none
      " href="ps3.php">PS3</a></li></td>
      <td width="110" valign="middle" align="center"><li><a style="text-decoration: none
      " href="x360.php">Xbox 360</a></li></td> -->
      <li><a style="width: 250px;">
      <form method="get" action="search.php">
      <input type="text" name="g_name">
      <input type="submit" value="Search">
      </form></a></li>
</ul>

</body>
</html>
