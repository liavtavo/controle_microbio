<?php
session_cache_limiter('private_no_expire, must-revalidate');
session_start(); ?>
<html>
    <head>
        <title>Identifiants</title>
        <meta http-equiv="content-type" content="text/html, charset=utf-8"/>
	<link rel="stylesheet" href="style.css" />
    </head>
    <bodyl>


<?php

if(isset($_POST["user"]))
{
	$_SESSION['user']=$_POST['user'];
	echo "Bonjour ".$_SESSION['user']." rdv sur une page de test.<br>";
	echo '<a href="test_connection.php">Test connexion</a>';
}
else
{
echo "Problème";
}
echo "<p>";
if(isset($_POST["password"]))
{
	$_SESSION['password']=$_POST['password'];
}
else
{
echo "Problème";
}

$user=$_SESSION['user'];
$pass=$_SESSION['password'];
echo "identifiant : ".$user.", mot de passe : ".$pass."<br>";

$a=pg_connect("dbname=bacterio_upnp user=$user host=127.0.0.1 password=$pass");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}
else
{
	echo "Connexion à la BDD OK !<br>";
}

$question="select * from jours_prelev";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}
else
{
	echo "Select OK !<br>";
}
?>

</body>
</html>
