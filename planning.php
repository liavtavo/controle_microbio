<html>
	<head>
		<title>Planning</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
	</head>

<body>

<h2>Planning des prélèvements</h2>

<!-- connection à la bdd -->
<?php
$a=pg_connect("dbname=bacterio_upnp user=thomas host=127.0.0.1 password=bacterio");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}
else
{
	echo "Connexion à la BDD OK !<br>";
}

$question="select * from planning_prelev";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}
else
{
	echo "Select OK !<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);
echo "Nombre de colonnes : ".$colonnes."<br>";
echo "Nombre de lignes : ".$lignes."<br>";
echo "<p>";

echo "<h3>Nom des champs</h3>";

for ($i=0; $i<$colonnes;$i++)
{
	echo pg_field_name($reponse, $i)."<br>";
}

echo "<p>";

echo "<h3>Table planning_prelev</h3>";

echo "<table border='1'>";
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
	echo "<td>".$uneligne['id_jour']."</td><td>".$uneligne['id_point']."</td>";
	echo "</tr>";
}

echo "</table>";

echo "<h3>Table planning_prelev avec liens vers limites_classes, disp_prelev et jours_prelev</h3>";

$question="SELECT jour, classe, type, point, description FROM planning_prelev, limites_classes, points_prelev, jours_prelev WHERE jours_prelev.id=planning_prelev.id_jour AND points_prelev.id=planning_prelev.id_point AND points_prelev.id_class=limites_classes.id;";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo "<table border='1'>";
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
