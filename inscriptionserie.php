<!doctype html>

<head>
  <meta charset="utf-8">
  <title>Inscription</title>
</head>

<body>
<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
if(isset($_POST['titre'])) $titre=$_POST['titre'];
else $titre="";

if(isset($_POST['nbep'])) $nbep=$_POST['nbep'];
else $nbep="";

if(isset($_POST['Rea'])) $rea=$_POST['Rea'];
else $rea="";

if(isset($_POST['Date'])) $date=$_POST['Date'];
else $date="";

if(isset($_POST['acteur'])) $acteur=$_POST['acteur'];
else $acteur="";


include("connexion.php");
global $conn;

If( empty($titre) OR empty($nbep) OR empty($rea)OR empty($date)OR empty($acteur))
{
echo '<h1> Un champ est vide </h1><br>';
}
else {
$query = "INSERT INTO serie(ID_serie,act_princp,nom,annee,nbepisode,realisateur) VALUES(NULL,'$acteur','$titre',$date,$nbep,'$rea')";
	$requete = "SELECT ID_serie FROM serie";
	$result = mysqli_query($conn, $requete);
if (mysqli_num_rows($result) >= 0) {
    while($row = mysqli_fetch_assoc($result)) 
	{
		$dernier=$row['ID_serie'];
	}
	$dernier++;
}

for($i=1;$i<=$nbep;$i++)
{
$insertion= "INSERT into episode(id_ep,num_ep,id_serie) VALUES(NULL,$i,$dernier)";
mysqli_query($conn,$insertion);
}

if(mysqli_query($conn, $query))
{
echo '<script> alert("La serie a été ajoutée avec succès ");location.href="serie.php"</script>';
}
else
{ echo '<center><h2> Une erreur est intervenue lors de l introduction dans la base.</h2></center>';
}
}


?>
</body>
</html>