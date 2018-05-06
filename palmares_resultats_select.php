<html>
	<head>
		<title>Palmarès résultats</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<a href="accueil.html">Retour à l'accueil</a>
<h2>Palmarès des résultats</h2>

<!-- connection à la bdd -->
<?php
$a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$classe=$_POST['classe'];
$type=$_POST['type'];
$conf=$_POST['conf'];

echo "<h3>Filtres</h3>";

echo "classe : ".$classe."<br>";
echo "type : ".$type."<br>";
echo "Conformité : ".$conf."<br>";
echo "<p>";

echo "<a href=resultats_select.html>Modifier les filtres</a><br>";
echo "<p>";
echo "<a href=points_details.php>Description des points de prélèvement</a>";

$question="SELECT point, type, description, classe, COUNT(idp) AS nb FROM (SELECT prelevements.id AS idp, point, type, description, classe, ufc, limite, CASE WHEN ufc<limite THEN 'oui' WHEN ufc>=limite THEN 'non' ELSE NULL END AS conformité FROM prelevements, points_prelev, limites_classes, resultats WHERE prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id AND resultats.id_prelev=prelevements.id) AS x WHERE x.classe LIKE '$classe' AND x.type LIKE '$type' AND x.conformité LIKE '$conf' GROUP BY point, type, description, classe ORDER BY nb DESC;";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo "<table border id=#prelevements><caption>Nombre de résultats par points</caption>";
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
	echo "<td>".$uneligne['point']."</td><td>".$uneligne['type']."</td><td>".$uneligne['description']."</td><td>".$uneligne['classe']."</td><td>".$uneligne['nb']."</td>";
	echo "</tr>";
}

echo "</table>";

?>


</body>
</html>
