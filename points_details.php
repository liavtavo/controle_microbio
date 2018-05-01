<html>
	<head>
		<title>Points de prélèvement</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<a href="accueil.html">Retour à l'accueil</a>
<h1>Points de prélèvement</h1>
     <a href=#classeA>Points de l'isolateur en classe A</a><br>
<a href=#auto>Points de l'automate et de la balance en classe A</a><br>
     <a href=#classeD>Points de la salle en classe D</a><br>

<h2 id=classeA>Isolateur en classe A</h2>

<img src="points_iso.png" width=70% height=auto>

<!-- connection à la bdd -->
<?php
$a=pg_connect("dbname=bacterio_upnp user=thomas host=127.0.0.1 password=bacterio");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$question="SELECT point, dispositif, type, description FROM disp_prelev, limites_classes, points_prelev WHERE points_prelev.id_disp=disp_prelev.id AND points_prelev.id_class=limites_classes.id AND classe LIKE 'A' AND DESCRIPTION NOT LIKE 'automate%' AND DESCRIPTION NOT LIKE 'balance%';";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table><caption>Points de l\'isolateur en classe A</caption>';
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
	echo "<td>".$uneligne['point']."</td><td>".$uneligne['dispositif']."</td><td>".$uneligne['type']."</td><td>".$uneligne['description']."</td>";
	echo "</tr>";
}

echo "</table>";
?>
<h2  id=auto>Automate et balance en classe A</h2>

<img src="points_auto.png" width=70% height=auto>

<?php
$a=pg_connect("dbname=bacterio_upnp user=thomas host=127.0.0.1 password=bacterio");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$question="SELECT point, dispositif, type, description FROM disp_prelev, limites_classes, points_prelev WHERE points_prelev.id_disp=disp_prelev.id AND points_prelev.id_class=limites_classes.id AND (description LIKE 'automate%' OR description LIKE 'balance%');";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table><caption>Points de l\'automate et de la balance en classe A</caption>';
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
	echo "<td>".$uneligne['point']."</td><td>".$uneligne['dispositif']."</td><td>".$uneligne['type']."</td><td>".$uneligne['description']."</td>";
	echo "</tr>";
}

echo "</table>";
?>
<h2 id=classeD>Salle en classe D</h2>

<img src="points_zac.png" width=70% height=auto>

<?php


$question="SELECT point, dispositif, type, description FROM disp_prelev, limites_classes, points_prelev WHERE points_prelev.id_disp=disp_prelev.id AND points_prelev.id_class=limites_classes.id AND classe LIKE 'D';";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table><caption>Points de la salle en classe D</caption>';
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
	echo "<td>".$uneligne['point']."</td><td>".$uneligne['dispositif']."</td><td>".$uneligne['type']."</td><td>".$uneligne['description']."</td>";
	echo "</tr>";
}

echo "</table>";

?>


</body>
</html>
