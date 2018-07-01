<html>
    <head>
        <title>enregistrement des prélèvements</title>
        <meta http-equiv="content-type" content="text/html, charset=utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <!-- Enregistrement des prélèvements sélectionnés dans prelevments_saisie.php dans la table prelevements -->
        <h2>Confirmation des enregistrements</h2>
        <?php
        $a=pg_connect("dbname=bacterio_upnp user=pharmacien host=127.0.0.1 password=zac");
        if ($a==false)
        {
            echo "problème de connexion<br>";
            exit;
        }

        $date_prelev=$_GET['date_prelev'];
        echo "Date de prélèvement : <font color=blue>".$date_prelev."</font><br>";
        //Parcours par une boucle for des lignes du tableau de sélection.
        //Chaque point sélectionné est enregistré dans la table prelevements.
        $lignes=$_GET['lignes'];
        echo "<p>";

        for ($j=0; $j<$lignes; $j++)
        {
            $id_point=$_GET['id_point'.$j.''];
            if ($id_point<>NULL)
            {
                $quel_nom = "SELECT point, id FROM points_prelev WHERE id=$id_point;";
                $nom = pg_query($a, $quel_nom);
                if ($nom==false)
                {
                    echo "problème de requête du nom<br>";
                }
                $point = pg_fetch_result($nom, 0);
                $question="INSERT INTO prelevements (date_prelev, id_point) VALUES ('$date_prelev', $id_point);";

                $reponse=pg_query($a, $question);
                if ($reponse==false)
                {
                    echo "Problème : le prélèvement du <font color=blue>".$point."</font> (id ".$id_point.") n'a pas été enregistré !<br>";
		            }
		            else
		            {
			              echo "Le prélèvement du <font color=blue>".$point."</font> (id ".$id_point.") est enregistré.<br>";
		            }

	          }
        }


        ?>

        <a href="accueil.html">Retour à l'accueil</a><br>
        <a href="prelevements_saisie.html">Saisir de nouveaux prélèvements</a>

    </body>
</html>
