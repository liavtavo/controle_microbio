<html>
	<head>
		<title>confirmation</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<!-- connection à la bdd -->

<?php
$a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$date_prelev=$_GET['date_prelev'];
echo "Date de prélèvement : ".$date_prelev."<br>";

$id_point=$_GET['id_point'];
echo "Point : ".$id_point."<br>";

$question="INSERT INTO prelevements (date_prelev, id_point) VALUES ('$date_prelev', $id_point);";

$reponse=pg_query($a, $question);
if ($reponse==false)
	{
	echo "problème de requête<br>";
	}
else
	{
	echo "Enregistrement du prélèvement réussi!<br>";
	}


?>
<p>
Cliquer sur précédent pour revenir à la sélection.

</body>
</html>
