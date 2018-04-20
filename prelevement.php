<html>
	<head>
		<title>prelevement</title>
		<meta http-equiv="content-type" content="text/html, charset=utf-8" />
	</head>

<body>

<?php

echo "<h2>Prélèvements</h2><br>";

$a=pg_connect("dbname=bacterio_upnp user=thomas host=127.0.0.1 password=bacterio");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}
else
{
	echo $a;
}

echo "<p>";

$reponse=pg_exec($a,"select * from prelevements");
if ($reponse==false)
{
	echo "problème de select";
}
else
{
	echo $reponse;
}
?>
</body>
</html>
