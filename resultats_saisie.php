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

echo "<p>";
echo "<a href=resultats_saisie.html>modifier les filtres</a><p>";

$question="select prelevements.id as \"No de prélèvement\", point, description, classe, type, limite from limites_classes, points_prelev, prelevements where prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id AND date_prelev='$datep' order by prelevements.id desc;";

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
echo "<p>";
echo '<h3>Date des résultats</h3>';
echo '<input type=date name=date_res required=required>';

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
	echo "<td>".$uneligne['No de prélèvement']."</td><td>".$uneligne['point']."</td><td>".$uneligne['description']."</td><td>".$uneligne['classe']."</td><td>".$uneligne['type']."</td><td>".$uneligne['limite']."</td><td><input type=radio name=id_point".$j." value=".$uneligne['id'].">oui</td>";
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
