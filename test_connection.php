<?php
session_cache_limiter('private_no_expire, must-revalidate');
session_start(); ?>
<html>
    <head>
        <title>Test connexion</title>
        <meta http-equiv="content-type" content="text/html, charset=utf-8"/>
	<link rel="stylesheet" href="style.css" />
    </head>
    <bodyl>


<?php

if(isset($_SESSION["user"]))
{
	echo "Re-bonjour ".$_SESSION['user']." ça marche!<br>";
}
else
{
echo "Problème";
}


?>

</body>
</html>
