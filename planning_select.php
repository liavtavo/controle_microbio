<html>
	<head>
		<title>Planning</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<a href="accueil.html">Retour à l'accueil</a>
<h2>Planning des points de prélèvements sélectionnés</h2>

<!-- <a href=#planning>Planning des points de prélèvements</a> --!>

<!-- connection à la bdd -->

<?php
$a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$jour=$_POST['jour'];
$classe=$_POST['classe'];
$type=$_POST['type'];

echo "Jour : ".$jour."<br>";
echo "classe : ".$classe."<br>";
echo "type : ".$type."<br>";

echo "<p>";
echo "<a href=planning_select.html>modifier les filtres</a><p>";

$question="select * from planning_prelev";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème de connection à la vue<br>";
}

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

$question="SELECT jour, classe, type, point, description FROM planning_prelev, limites_classes, points_prelev, jours_prelev WHERE jours_prelev.id=planning_prelev.id_jour AND points_prelev.id=planning_prelev.id_point AND points_prelev.id_class=limites_classes.id AND jour LIKE '$jour' AND classe LIKE '$classe' AND type LIKE '$type';";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème de requête<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table id="planning"><caption>Planning des points de prélèvements<br>
					Jour : '.$jour.' - Classe : '.$classe.' - Type : '.$type.'</caption>';
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
	echo "<td>".$uneligne['jour']."</td><td>".$uneligne['classe']."</td><td>".$uneligne['type']."</td><td>".$uneligne['point']."</td><td>".$uneligne['description']."</td>";
	echo "</tr>";
}

echo "</table>";

?>


</body>
</html>
