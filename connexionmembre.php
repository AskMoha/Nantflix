<!doctype html>

<head>
  <meta charset="utf-8">
  <title>Accès membre</title>
</head>

<body>
<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
if(isset($_POST['Identifiant'])) $identifiant=$_POST['Identifiant'];
else $identifiant="";
if(isset($_POST['motdp'])) $mdp=$_POST['motdp'];
else $mdp="";
include("connexion.php");
global $conn;
If( empty($identifiant) OR empty($mdp))
{
echo 'Vous avez oublié d entrer votre identifiant ou votre mot de passe.';
}
else
{
	$query = "SELECT ID,prenom,nom,telephone,Annee,identifiant,mdp FROM membre";
	$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) >= 0) {
    while($row = mysqli_fetch_assoc($result)) 
	{
		$idcompar=$row["identifiant"];
		$mdpcompar=$row["mdp"];
	if($idcompar==$identifiant&&$mdp==$mdpcompar)
	{
session_start();
$_SESSION['pseudo'] = $identifiant;
$_SESSION['mdp'] = $mdp;
$_SESSION['prenom']= $row['prenom'];
$_SESSION['ID_utilisateur']=$row['ID'];
echo '<script>location.href="serie.php"</script>';
   exit();
	}
	}
echo '<script> alert("Il faut vous enregistrer avant");location.href="inscriptionmembre.php"</script>';
	
} else {
    echo "0 results";
}
}
?>
</body>
</html>