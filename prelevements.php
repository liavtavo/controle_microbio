<html>
	<head>
		<title>Prélèvements</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<a href="accueil.html">Retour à l'accueil</a>
<h2>Prélèvements réalisés</h2>
<a href=#prelevements>Table des prélèvements réalisés</a><br>
<a href=prelevements_select.html>Filtrer</a>

<!-- connection à la bdd -->
<?php
$a=pg_connect("dbname=bacterio_upnp user=thomas host=127.0.0.1 password=bacterio");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$question="select * from prelevements";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);


$question='SELECT prelevements.id AS "No", prelevements.date_prelev AS date, point, description, classe FROM prelevements, points_prelev, limites_classes WHERE prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id;';

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo "<table border id=#prelevements><caption>Table des prélèvements réalisés</caption>";
echo "<tr>";
for ($i=0; $i<$colonnes;$i++)
{
	echo "<th>".pg_field_name($reponse, $i)."</th>";
}
echo"</tr>";

for ($j=0; $j<$lignes; $j++)
{
	echo "<tr>";
	$uneligne=pg_fetch_array($reponse,$j);
	echo "<td>".$uneligne['No']."</td><td>".$uneligne['date']."</td><td>".$uneligne['point']."</td><td>".$uneligne['description']."</td><td>".$uneligne['classe']."</td>";
	echo "</tr>";
}

echo "</table>";

?>


</body>
</html>
