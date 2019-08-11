<?php

session_start();
include 'connect_db.php';

?>

<html>
<body>
<link rel="stylesheet" type=text/css href=css/user_page.css>

<div class="header">

<?php

include 'header.php';

?>

</div>


<div class="menu">
<?php

include 'user/top_menu.php';

?>
</div>


<div class="left">

<?php

include 'user/left.php';

?>

</div>

<div class="main">
<?php
include 'user/main.php';
?>
</div>

<div class="right">

<?php

include 'user/right.php';

?>

</div>




</body>
</html>