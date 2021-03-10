<!doctype html>

<head>
  <meta charset="utf-8">
  <title>Inscription</title>
</head>

<body>
<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
if(isset($_POST['Nom'])) $nom=$_POST['Nom'];
else $nom="";
if(isset($_POST['Prenom'])) $prenom=$_POST['Prenom'];
else $prenom="";
if(isset($_POST['Date'])) $date=$_POST['Date'];
else $date="";
if(isset($_POST['Identifiant'])) $uti=$_POST['Identifiant'];
else $uti="";
if(isset($_POST['Mdp'])) $motdp=$_POST['Mdp'];
else $motdp="";
if(isset($_POST['num'])) $tel=$_POST['num'];
else $tel="";
include("connexion.php");
global $conn;

If( empty($prenom) OR empty($date) OR empty($nom)OR empty($tel)OR empty($uti)OR empty($motdp))
{
echo '<h1>Le champ nom, prénom, date, numero de telephone, nom d utiliateur ou mot de passe est vide </h1><br>';
}
else {
$query = "INSERT INTO membre(prenom,nom,annee,identifiant,mdp,telephone) VALUES('$prenom','$nom',$date,'$uti','$motdp',$tel)";
if(mysqli_query($conn, $query))
{
echo '<script> alert("Vous pouvez désormais vous connecter avec vos identifiants !");location.href="pageco.html"</script>';

}
else
{ echo '<center><h2> Une erreur est intervenue lors de l introduction dans la base.</h2></center>';
}
}


?>
</body>
</html>