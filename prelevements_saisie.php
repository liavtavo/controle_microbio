<html>
    <head>
        <title>Saisie des prélèvements</title>
        <meta http-equiv="content-type" content="text/html, charset=utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <!-- Affichage des points à prélever selon les filtres sélectionnés dans prelevements_saisie.html -->
        <a href="accueil.html">Retour à l'accueil</a>
        <h2>Sélection des prélèvements réalisés</h2>

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

        echo "<h3>Filtres sélectionnés</h3>";
        echo "Jour : ".$jour."<br>";
        echo "classe : ".$classe."<br>";
        echo "type : ".$type."<br>";

        echo "<p>";
        echo "<a href=prelevements_saisie.html>modifier les filtres</a><p>";
        //sélection des points à afficher dans le tableau de prélèvements.
        //clause if else pour afficher tous les jours, car la requête SQL avec % n'affiche pas les prélèvements.
        if($jour<>'%')
        {
            $question="SELECT classe, type, point, points_prelev.id, description FROM planning_prelev, limites_classes, points_prelev, jours_prelev WHERE jours_prelev.id=planning_prelev.id_jour AND points_prelev.id=planning_prelev.id_point AND points_prelev.id_class=limites_classes.id AND jour LIKE '$jour' AND classe LIKE '$classe' AND type LIKE '$type' ORDER BY classe, type, description, point;";
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

        //Utilsation d'une méthode form dans un tableau pour sélectionner les points prélevés.
        echo '<form method=\"GET\" action="prelevements_saisie_confirm.php">';

        //Enregistrement de nombre de lignes pour extraire la ligne par une boucle for dans la requête d'enregistrement.
        echo '<input type="hidden" name="lignes" value="'.$lignes.'">';

        echo '<h3>Date de prélèvement</h3>';
        echo '<input type=date name=date_prelev required=required>';

        echo "<p>";

        //Affichage du tableau des points sélectionnés avec une colonne supplémentaire avec un bouton radio permettatn d'enregistrer l'id du point concatén avec le numéro de ligne.
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
	          echo "<td>".$uneligne['classe']."</td>
                  <td>".$uneligne['type']."</td>
                  <td>".$uneligne['point']."</td>
                  <td>".$uneligne['id']."</td>
                  <td>".$uneligne['description']."</td>
                  <td><input type=radio name=id_point".$j." value=".$uneligne['id'].">oui</td>";
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
