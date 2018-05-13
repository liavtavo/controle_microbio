<html>
	<head>
		<title>Saisie des résultats</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>

<body>
<a href="accueil.html">Retour à l'accueil</a>
<h2>Sélection des résultats</h2>

<!-- connection à la bdd -->

<?php
$a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}

$datep=$_POST['datep'];
$rendu=$_POST['rendu'];

echo "<h3>Filtres sélectionnés</h3>";
echo "date des prélèvement : ".$datep."<br>";
echo "Type de rendu : ".$rendu."<br>";


echo "<p>";
echo "<a href=resultats_saisie.html>modifier les filtres</a><p>";

if($rendu=='téléphoné')
{
$question="SELECT prelevements.id AS \"No\", prelevements.date_prelev AS date, point, type, description, classe, limite FROM points_prelev, limites_classes WHERE prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id AND ;";
}
else
{
$question="SELECT classe, type, point, points_prelev.id, description FROM limites_classes, points_prelev WHERE points_prelev.id_class=limites_classes.id AND classe LIKE '$classe' AND type LIKE '$type' ORDER BY classe, type, description, point;";
}

$reponse=pg_query($a, $question);
if ($reponse==false)
{
	echo "problème de requête<br>";
}

echo "<p>";

$colonnes=pg_num_fields($reponse);
$lignes=pg_numrows($reponse);

echo '<form method=\"GET\" action="prelevements_saisie_confirm.php">';

echo '<input type="hidden" name="lignes" value="'.$lignes.'">';

echo '<h3>Date de prélèvement</h3>';
echo '<input type=date name=date_prelev required=required>';

echo "<p>";

echo '<table id="planning"><caption>Points de prélèvements sélectionnés</caption>';
echo "<tr>";
for ($i=0; $i<$colonnes;$i++)
{
	echo "<th>".pg_field_name($reponse, $i)."</th>";
}
echo "<th>Prélevé</th>";
echo"</tr>";

for ($j=0; $j<$lignes; $j++)
{
	echo "<tr>";
	$uneligne=pg_fetch_array($reponse,$j);
	echo "<td>".$uneligne['classe']."</td><td>".$uneligne['type']."</td><td>".$uneligne['point']."</td><td>".$uneligne['id']."</td><td>".$uneligne['description']."</td><td><input type=radio name=id_point".$j." value=".$uneligne['id'].">oui</td>";
	echo "</tr>";
}

echo "</table>";
echo "<p>";
echo '<input type=submit value="Enregistrer la sélection">';
echo "<p>";
echo '<input type=reset value="Décocher la sélection">';

echo "</form>";

?>


</body>
</html>
