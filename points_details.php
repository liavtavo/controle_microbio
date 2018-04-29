<html>
	<head>
		<title>Points de prélèvement</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>

<h2>Points de prélèvement</h2>

<!-- connection à la bdd -->
<?php
$a=pg_connect("dbname=bacterio_upnp user=thomas host=127.0.0.1 password=bacterio");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

echo "<h3>Isolateur classe A</h3>";

echo "<h4>Gants (boîte de Petri)</h4>";

$question="SELECT point AS Points FROM disp_prelev, limites_classes, points_prelev WHERE points_prelev.id_disp=disp_prelev.id AND points_prelev.id_class=limites_classes.id AND classe LIKE 'A' AND type LIKE 'Gants';";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo "<table>";

for ($j=0; $j<$lignes; $j++)
{
	echo "<tr>";
	$uneligne=pg_fetch_array($reponse,$j);
	echo "<td>".$uneligne['points']."</td>";
	echo "</tr>";
}

echo "</table>";

echo "<h4>Contrôle de l'air (boîte de Petri)</h4>";

$question="SELECT point, description FROM disp_prelev, limites_classes, points_prelev WHERE points_prelev.id_disp=disp_prelev.id AND points_prelev.id_class=limites_classes.id AND classe LIKE 'A' AND type LIKE 'Air';";

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
	echo "<td>".$uneligne['point']."</td><td>".$uneligne['description']."</td>";
	echo "</tr>";
}

echo "</table>";

echo "<h4>Contrôle des surfaces (écouvillon)</h4>";

$question="SELECT point, description FROM disp_prelev, limites_classes, points_prelev WHERE points_prelev.id_disp=disp_prelev.id AND points_prelev.id_class=limites_classes.id AND classe LIKE 'A' AND type LIKE 'Surface';";

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
	echo "<td>".$uneligne['point']."</td><td>".$uneligne['description']."</td>";
	echo "</tr>";
}

echo "</table>";

echo "<h3>Salle classe D</h3>";

$question="SELECT type, dispositif, point, description FROM disp_prelev, limites_classes, points_prelev WHERE points_prelev.id_disp=disp_prelev.id AND points_prelev.id_class=limites_classes.id AND classe LIKE 'D';";

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
	echo "<td>".$uneligne['type']."</td><td>".$uneligne['dispositif']."</td><td>".$uneligne['point']."</td><td>".$uneligne['description']."</td>";
	echo "</tr>";
}

echo "</table>";

?>


</body>
</html>
