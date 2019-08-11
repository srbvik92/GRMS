<?php

session_start();
include 'connect_db.php';

?>

<html>
<body>
<link rel="stylesheet" type=text/css href=css/register.css>

<table align="center" width="1000" border="0">
  <tbody>
    <tr>
      <td colspan=2 height="10px" bgcolor="#D2D2D2"><?php

include 'header.php';

?>
		</td>
      
    </tr>


<tr>
      <td colspan=2 height="30px"><?php

include 'top_menu.php';

?>
		</td>
      
    </tr>
    
<tr>
      <td colspan=2 height="auto" width="700px" valign="top"><?php

include 'register/main.php';

?>
		</td>
	  </tr>

 </tr>
    <tr>
      <td colspan=2 height="100px" bgcolor="#6D6D6D"><?php

include 'footer.php';

?>
		</td>
      
    </tr>