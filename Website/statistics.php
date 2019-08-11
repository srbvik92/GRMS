<head><link rel="icon" type="image/png" href="logo.png">
<title>GRMS: Game Record Management System</title>

</head>
<?php

session_start();

?>

<html>
<body>
<!--<link rel="stylesheet" type=text/css href=css/home_layout.css> -->


<table align="center" width="1000" border="0">
  <tbody>
    <tr>
      <td colspan=2 height="10px" bgcolor="#D2D2D2"><?php

include 'header.php';

?>
		</td>
      
    </tr>
    <tr>
      <td colspan=2 height="30px">
      <?php

include 'top_menu.php';

?>
		</td>
      
    </tr>
   
    <tr>
      <td height="auto" width="700px" valign="top"><?php

include 'statistics/user_statistics.php';

?>
		</td>
		
      <td height="auto" width="300px" valign="top">
      <?php

include 'home_right.php';

?>
		</td>
    </tr>
    <tr>
      <td colspan=2 height="100px" bgcolor="#6D6D6D"><?php

include 'footer.php';

?>
		</td>
      
    </tr>
  </tbody>
</table>

</body>
</html>