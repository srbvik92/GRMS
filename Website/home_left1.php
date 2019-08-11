<?php 

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$qry1="select * from stories order by id desc limit 10";
$rs1=mysqli_query($con,$qry1) OR die(mysqli_error($con));

$qry2="select * from stories where type='1'";
$rs2=mysqli_query($con,$qry2) OR die(mysqli_error($con));

$qry3="select * from stories where type='2'";
$rs3=mysqli_query($con,$qry3) OR die(mysqli_error($con));

?>
<!DOCTYPE html>
<html>
<head>
<style>
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color:#000000;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
	color: #FFFFFF;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color:#747474;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
	min-height: 270px;
}

/* Style the close button */
.topright {
    float: right;
    cursor: pointer;
    font-size: 20px;
}

.topright:hover {color: red;}
</style>
</head>
<body>

<!-- <p>Click on the x button in the top right corner to close the current tab:</p> -->

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Top Stories</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">News</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Featured</button>
</div>

<div id="London" class="tabcontent">
  
  <h3>
  <?php while ($rw1=mysqli_fetch_row($rs1)){
     // echo $rw1[0];
      
  ?>
	</h3>
 <h3><a href="stories.php?id=<?php echo $rw1[0]; ?>" style="text-decoration: none"><?php echo $rw1[5]."<br/>";
	}  ?>   </a>  </h3>
  <p></p>
  
</div>

<div id="Paris" class="tabcontent">
  
  <h3>News</h3>
  <p>Coming Soon.</p> 
</div>

<div id="Tokyo" class="tabcontent">
  
  <h3>Featured</h3>
  <p>Coming Soon</p>
</div>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
     
</body>
</html> 
