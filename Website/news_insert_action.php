<?php session_start();

include 'connect_db.php';

$title=$_POST["title"];
$type=$_POST["type"];
$rel_to=$_POST["rel_to"];
$date=$_POST["date"];
$page=$_POST["page"];
$file=$_FILES["file"]["name"];
//echo $file;

$uploaded_size=$_FILES["file"]["size"];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

$ok=1;

if ($uploaded_size > 350000) 
 { 
 echo "Your file is too large.<br>"; 
 $ok=0; 
 }
 
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))) 
/*if ((mime_content_type($_FILES['file']['type']) == "image/gif")||(mime_content_type($_FILES['file']['type']) == "image/jpeg") ||
(mime_content_type($_FILES['file']['type']) == "image/jpg") ||
(mime_content_type($_FILES['file']['type']) == "image/pjpeg") ||
(mime_content_type($_FILES['file']['type']) == "image/x-png") ||
(mime_content_type($_FILES['file']['type']) == "image/png")) */

/*$f_type=$_FILES['file']['type'];
if ($f_type== "image/gif" OR $f_type== "image/png" OR $f_type== "image/jpeg" OR $f_type== "image/jpg" OR $f_type== "image/PNG" OR $f_type== "image/GIF")
  
   echo "inside first if"; */
   {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	$ok=0;
    }
		$qry="select MAX(id) from stories";
		$rs=mysqli_query($con,$qry) OR die(mysqli_error());
		$rw=mysqli_fetch_row($rs);
		$id=$rw[0];
		$id=$id+1;
		$dir = $_SERVER['DOCUMENT_ROOT']."/grms/stories/top_image/".$id."/";
	$loc=$dir.$file;
	//echo $dir;

    if (file_exists($loc))
      {
      echo $file . " already exists. ";
      }
    else
      {
        if (!is_dir($dir))
        {
        mkdir($dir);         
    	}
		if($ok==1)
		{
    
		
        if(move_uploaded_file($_FILES['file']['tmp_name'], $loc))
		{
			$qry="insert into stories values($id,'$type','$rel_to','$date','$file','$title','$page')";
			mysqli_query($con,$qry) OR die(mysqli_error($con));
			
header('Location: news_insert.php');
		
		
		}
		}
	  }
  } 
 
  

else
  {
  echo "Invalid file";
  } 
