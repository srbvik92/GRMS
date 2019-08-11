<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
?>

<!DOCTYPE html>
<html>
<style>
body {font-family: "Lato", sans-serif;}

ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
<body>

<p>Click on the links inside the tabbed menu:</p>


<ul class="tab">
  <li><a href="javascript:void(0)" class="tablinks" onclick="opentab(event, 'topstories')" id="defaultOpen">Top Stories</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="opentab(event, 'news')">News</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="opentab(event, 'featured')">Featured</a></li>
  
</ul>

<div id="topstories" class="tabcontent">
<?php
	$qry1="select * from stories";
	$rs1=mysqli_query($con,$qry) OR die(mysqli_error($con));
	while($rw1=mysql_fetch_row($rs1))	{
	
?>
  <h3><a href="stories.php?id=<?php echo $rw1[0]; ?>"><?php echo $rw1[5]."<br/>";
	}  ?>   </a>  </h3>
  <p></p>
</div>

<div id="news" class="tabcontent">
<?php
	$qry2="select * from stories where type='1'";
	$rs2=mysql_query($qry2) OR die(mysql_error());
	while($rw2=mysql_fetch_row($rs2))	{
	

?>
  <h3><a href="stories.php?id=<?php echo $rw2[0]; ?>"><?php echo $rw2[5]."<br/>";
	}  ?>   </a>  </h3>
  <p></p> 
</div>

<div id="featured" class="tabcontent">
<?php
	$qry3="select * from stories where type='2'";
	$rs3=mysql_query($qry3) OR die(mysql_error());
	while($rw3=mysql_fetch_row($rs3))	{
	

?>
  <h3><a href="stories.php?id=<?php echo $rw3[0]; ?>"><?php echo $rw3[5]."<br/>";
	}  ?>   </a>  </h3>
  <p></p>
</div>


<script>
function opentab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>


</body>
</html>



