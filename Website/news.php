<?php

include 'connect_db.php';
session_start();

?>

<html>
<body>
<link rel="stylesheet" type=text/css href=css/news.css>

<div class="header">

<?php

include 'news/header.php';

?>

</div>


<div class="menu">
	
<?php

include 'news/top_menu.php';

?>

</div>


<div class="left">

<?php

include 'news/left.php';

?>

<div class="main">

<?php

include 'news/main.php';

?>

</div>

</div>
</body>
</html>