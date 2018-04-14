<html>
	<head>
		<title>prelevement</title>
		<meta http-equiv="content-type" content="text/html, charset="utf-8" />
	</head>

<body>

<?php
$a=pg_connect("dbname=bacterio_upnp user=thomas host=pilule password=furax@postgres");
if ($a==false)
{
	echo "problème de connexion<br>";
	exit;
}
else
{
	echo $a;
}


$reponse=pg_exec($a,"select * from prelevements");
if ($reponse==false)
{
	echo "problème";
}
else
{
	echo $reponse;
}
?>
</body>
</html>
