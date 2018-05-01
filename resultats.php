<html>
	<head>
		<title>Résultats</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>

<h2>Résultats</h2>

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

$question="select * from resultats";

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

echo "<h3>Table resultats</h3>";

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
	echo "<td>".$uneligne['id']."</td><td>".$uneligne['id_prelev']."</td><td>".$uneligne['date_res']."</td><td>".$uneligne['tel']."</td><td>".$uneligne['sign']."</td><td>".$uneligne['ufc']."</td><td>".$uneligne['germe']."</td>";
	echo "</tr>";
}

echo "</table>";

echo "<h3>Table resultats avec liens vers prelevements, points_prelev, limites_classes</h3>";
$question="SELECT resultats.id, prelevements.date_prelev, point, description, classe, date_res, tel, sign, ufc, germe  FROM resultats, prelevements, points_prelev, limites_classes WHERE resultats.id_prelev=prelevements.id AND prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id;";

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
	echo "<td>".$uneligne['id']."</td><td>".$uneligne['date_prelev']."</td><td>".$uneligne['point']."</td><td>".$uneligne['description']."</td><td>".$uneligne['classe']."</td><td>".$uneligne['date_res']."</td><td>".$uneligne['tel']."</td><td>".$uneligne['sign']."</td><td>".$uneligne['ufc']."</td><td>".$uneligne['germe']."</td>";
	echo "</tr>";
}

echo "</table>";


?>


</body>
</html>
