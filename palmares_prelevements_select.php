<html>
	  <head>
		    <title>Palmarès des points de prélèvements</title>
		    <meta http-equiv="content-type" content="text/html, charset=utf-8" />
		    <link rel="stylesheet" href="style.css" />
	  </head>

    <body>
        <!-- Affichage du tableau du nombre de prélèvements par point filtrer par palamres_prelevements_select.html -->
        <a href="accueil.html">Retour à l'accueil</a>
        <h2>Palmarès des points de prélèvements</h2>

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

        echo "<h3>Filtres</h3>";

        echo "classe : ".$classe."<br>";
        echo "type : ".$type."<br>";
        echo "<p>";

        echo "<a href=palmares_prelevements_select.html>Modifier les filtres</a><br>";
        echo "<p>";
        echo "<a href=points_details.php>Description des points de prélèvement</a>";

        $colonnes=pg_num_fields($reponse);
        $lignes=pg_numrows($reponse);

        //utilisation des filtres pour extraire les données de la table prelevement.
        //Les données sont classées par ordre décroissant sur le nombre de points prélevés.
        $question="SELECT point, type, description, classe, COUNT(prelevements.id) AS nb FROM points_prelev, prelevements, limites_classes WHERE prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id AND type LIKE '$type' AND classe LIKE '$classe'GROUP BY point, type, description, classe ORDER BY nb DESC;";

        $reponse=pg_query($a, $question);
        if ($reponse==false)
        {
	          echo "problème<br>";
        }

        echo "<p>";

        $colonnes=pg_num_fields($reponse);
        $lignes=pg_numrows($reponse);

        echo "<table border id=#prelevements><caption>Nombre de prélèvements par point</caption>";
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
	          echo "<td>".$uneligne['point']."</td>
                  <td>".$uneligne['type']."</td>
                  <td>".$uneligne['description']."</td>
                  <td>".$uneligne['classe']."</td>
                  <td>".$uneligne['nb']."</td>";
	          echo "</tr>";
        }

        echo "</table>";

        ?>


    </body>
</html>
