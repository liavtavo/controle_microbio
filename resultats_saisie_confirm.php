<html>
	<head>
		<title>confirmation</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<!-- connection à la bdd -->
<h2>Confirmation des enregistrements</h2>
<?php
$a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$date_res=$_GET['date_res'];
$type_rendu=$_GET['type'];
echo "Date des résultats : <font color=blue>".$date_res."</font><br>";
$lignes=$_GET['lignes'];
echo "<p>";

for ($j=0; $j<$lignes; $j++)
{
$no_prelev=$_GET['no_prelev'.$j.''];
$ufc=$_GET['ufc'.$j.''];
$germe=$_GET['germe'.$j.''];
	if ($no_prelev<>NULL)
	{
	$question="INSERT INTO resultats (id_prelev, date_res, ufc, germe, type_rendu) VALUES ($no_prelev, '$date_res', $ufc, '$germe', '$type_rendu');";

	$reponse=pg_query($a, $question);
		if ($reponse==false)
		{
			echo "Problème : le résultat du prélèvement <font color=blue>".$no_prelev."</font> n'a pas été enregistré !<br>";
		}
		else
		{
			echo "Le résultat du prélèvement <font color=blue>".$no_prelev."</font> est enregistré.<br>";
		}
		
	}
}


?>

<a href="accueil.html">Retour à l'accueil</a><br>
<a href="resultats_saisie.html">Saisir de nouveaux résultats</a>

</body>
</html>
