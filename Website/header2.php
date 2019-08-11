<?php
 //error_reporting(E_ALL); ini_set('display_errors', TRUE); ini_set('display_startup_errors', TRUE);
error_reporting(0);
include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }

$qry="select id, top_image,title from stories order by id desc limit 5";
$rs=mysqli_query($con,$qry) OR die(mysqli_error($con));
$dir ="stories/top_image/";
//echo $dir;
//$rw=mysqli_fetch_row($rs) or die(mysqli_error($con));
//$img1=$dir.$rw[0]."/".$rw[1]; $id1=$rw[0];
//$title1=$rw[2];
//$rw=mysqli_fetch_row($rs) or die(mysqli_error($con));
//$img2=$dir.$rw[0]."/".$rw[1];  $id2=$rw[0];
//$title2=$rw[2];

?>

<style>

#sliderbox{
	position: relative;
	width: 6000px;
	animation-name: slideranimation;
	animation-duration: 10s;
	animation-iteration-count: infinite;
}
	
#sliderbox img{
	float: left;
}
	
/* Bottom left text */
.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 16px;
}
	
.container {
  position: relative;
  text-align: center;
  color: white;
}
	
@keyframes slideranimation{
	0%{
		left: 0px; 
	}
	15%{
		left: 0px;
	}
	20%{
		left: -1200px;
	}
	35%{
		left: -1200px;
	}
	40%{
		left: -2400px;
	}
	55%{
		left: -2400px;
	}
	60%{
		left: -3600px;
	}
	75%{
		left: -3600px;
	}
	80%{
		left: -4800px;
	}
	95%{
		left: -4800px;
	}
	
}
	
</style>

<!DOCTYPE html>
<html>

<div id="container">
	<div id="sliderbox">
		<?php 
				while($rw=mysqli_fetch_row($rs)){
				?>
				<div class="container">
                 <a href="stories.php?id=<?php echo $rw[0];  ?> " ><img width="1200" height="400" data-u="image" src=" <?php echo $dir.$rw[0]."/".$rw[1];  ?>"/></a>
                <div class="bottom-left"><?php echo $rw[2]; ?></div>
           		 </div>	
            <?php }?>
    
	</div>
</div>


</html>