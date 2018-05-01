<html>
	<head>
		<title>tables_brutes</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<a href="accueil.html">Retour à l'accueil</a>
<h2>Schéma relationnel des tables de la base de données</h2>

<img src="erd.png" width=100% height=auto>


<h2>Tables de la base de données bacterio_upnp</h2>

<a href="#jours">Table jours_prelev</a><br>
<a href="#disp">Table disp_prelev</a><br>
<a href="#classes">Table limites_classes</a><br>
<a href="#points">Table points_prelev</a><br>
<a href="#planning">Table planning_prelev</a><br>
<a href="#prelevements">Table prelevements</a><br>
<a href="#resultats">Table resultats</a><p>

<p>


<!-- connection à la bdd -->
<?php
$a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$question="select * from jours_prelev";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}
else

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo "<table border><caption>Table jours_prelev</caption>";
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
	echo "<td>".$uneligne['id']."</td><td>".$uneligne['jour']."</td>";
	echo "</tr>";
}

echo "</table>";
echo "<p>";

$a=pg_connect("dbname=bacterio_upnp user=thomas host=127.0.0.1 password=bacterio");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$question="select * from disp_prelev";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table id="disp"><caption>Table disp_prelev</caption>';
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
	echo "<td>".$uneligne['id']."</td><td>".$uneligne['dispositif']."</td>";
	echo "</tr>";
}

echo "</table>";
echo "<p>";

$question="select * from limites_classes";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table id="classes"><caption>Table limites_classes</caption>';
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
	echo "<td>".$uneligne['id']."</td><td>".$uneligne['classe']."</td><td>".$uneligne['type']."</td><td>".$uneligne['limite']."</td>";
	echo "</tr>";
}

echo "</table>";

echo "<p>";

$question="select * from points_prelev";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table id="points"><caption>Table points_prelev</caption>';
	
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
	echo "<td>".$uneligne['id']."</td><td>".$uneligne['point']."</td><td>".$uneligne['description']."</td><td>".$uneligne['id_disp']."</td><td>".$uneligne['id_class']."</td>";
	echo "</tr>";
}

echo "</table>";

echo "<p>";

$question="select * from planning_prelev";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table id="planning"></a><caption>Table planning_prelev</caption>';
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

echo "<p>";

$question="select * from prelevements limit 30";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}
else

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table id="prelevements"><caption>Table prelevements (limitée aux 30 premiers enregistrements)</captions>';
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
	echo "<td>".$uneligne['id']."</td><td>".$uneligne['date_prelev']."</td><td>".$uneligne['id_point']."</td>";
	echo "</tr>";
}

echo "</table>";
echo "<p>";

$question="select * from resultats limit 30";

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème<br>";
}
else

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<table id="resultats"><caption>Table resultats (limitée aux 30 premiers)</caption>';
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

?>


</body>
</html>
