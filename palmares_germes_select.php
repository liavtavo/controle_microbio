<html>
    <head>
	<title>Palmarès germes</title>
	<meta http-equiv="content-type" content="text/html, charset=utf-8" />
	<link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <!-- Utilisation des filtres de germes_select.html pour afficher le palmares du nombre de résulats par germe. -->
        <a href="accueil.html">Retour à l'accueil</a>
        <h2>Palmarès du nombre de résultats par germe</h2>
        
        <a href=germes_select.html>Filtrer</a>

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
        //Décompte du nombre de résulats groupés par germe.
        $question="SELECT germe, COUNT(resultats.id) AS nb FROM resultats, prelevements, limites_classes, points_prelev WHERE resultats.id_prelev=prelevements.id AND prelevements.id_point=points_prelev.id AND points_prelev.id_class=limites_classes.id AND germe NOT LIKE 'NA' AND germe NOT LIKE '' AND classe LIKE '$classe' AND type LIKE '$type' GROUP BY germe, type, description, classe ORDER BY nb DESC;";

        $reponse=pg_query($a, $question);
        if ($reponse==false)
        {
	    echo "problème<br>";
        }

        echo "<p>"; 

        $colonnes=pg_num_fields($reponse);
        $lignes=pg_numrows($reponse);

        echo "<table border id=#prelevements><caption>Nombre de résultats par germe</caption>";
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
	    echo "<td>".$uneligne['germe']."</td>
            <td>".$uneligne['nb']."</td>";
	    echo "</tr>";
        }

        echo "</table>";

        ?>


    </body>
</html>
