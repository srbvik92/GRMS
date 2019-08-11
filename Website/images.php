<?php

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$g_id=$_POST['g_id'];


//error_reporting(1);
//echo $g_id."fdkjsa";

include 'connect_db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//echo "game Image";
//$url=$_SERVER['REQUEST_URI'];
//echo $url;
$dir="game_detail/images/game_images/".$g_id;
//echo $dir;

// open this directory
$myDirectory = opendir($dir);

// get each entry
while($entryName = readdir($myDirectory)) {
    $dirArray[] = $entryName;
}

// close directory
closedir($myDirectory);

//	count elements in array
$indexCount	= count($dirArray);



// loop through the array of files and print them all in a list
for($index=0; $index < $indexCount; $index++) {
    $extension = substr($dirArray[$index], -3);
    if ($extension == 'jpg'){ // list only jpgs
        echo '<img src="'.$dir.'/' . $dirArray[$index] . '" alt="Image" height=150px width=200px />';
    }
}



//echo getcwd() ;

    /* $files = glob($dir."*.*");
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
         );

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         if (in_array($ext, $supported_file)) {
            echo basename($image)."<br />"; // show only image name if you want to show full path then use this code // echo $image."<br />";
             echo '<img src="'.$image .'" alt="Random image" />'."<br /><br />";
            } else {
                continue;
            }
          }   */
?>