<html>
    <head>
        <title>Prélèvements</title>
        <meta http-equiv="content-type" content="text/html, charset=utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <a href="accueil.html">Retour à l'accueil</a>
        <h2>Prélèvements réalisés et résultats</h2>

        <a href=points_details.php>Description des points de prélèvement</a><br>
        <a href=palmares_prelevements.php>Palmarès du nombre de prélèvements par point</a><br>
        <a href=palmares_resultats.php>Palmarès du nombre de résultats par point</a><br>
        <a href=palmares_germes.php>Palmarès du nombre de résultats par germe</a><br>
        <a href=prelevements_select.html>Filtrer</a>

        <!-- connection à la bdd -->
        <?php
        $a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
        if ($a==false)
        {
            echo "problème de connexion<br>";
            exit;
        }

        $question='SELECT prelevements.id AS "No", prelevements.date_prelev AS date, point, type, description, classe, ufc, limite, CASE WHEN ufc<limite THEN \'oui\' WHEN ufc>=limite THEN \'non\' ELSE NULL END AS conformité, germe, type_rendu FROM prelevements LEFT OUTER JOIN resultats ON (resultats.id_prelev=prelevements.id), points_prelev, limites_classes WHERE prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id  ORDER BY prelevements.id DESC;';

        $reponse=pg_query($a, $question);
        if ($reponse==false)
        {
            echo "problème de requête<br>";
        }

        echo "<p>";

        $colonnes=pg_num_fields($reponse);
        $lignes=pg_numrows($reponse);

        echo "<table border id=#prelevements><caption>Table des prélèvements réalisés (du plus recent au plus ancien) et des résultats</caption>";
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
            echo "<td>".$uneligne['No']."</td><td>".$uneligne['date']."</td><td>".$uneligne['point']."</td><td>".$uneligne['type']."</td><td>".$uneligne['description']."</td><td>".$uneligne['classe']."</td><td>".$uneligne['ufc']."</td><td>".$uneligne['limite']."</td><td>".$uneligne['conformité']."</td><td>".$uneligne['germe']."</td><td>".$uneligne['type_rendu']."</td>";
	          echo "</tr>";
        }

        echo "</table>";

        ?>


    </body>
</html>
