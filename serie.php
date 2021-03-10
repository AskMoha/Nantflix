<!doctype html>

<head>
  <meta charset="utf-8">
  <title>Series</title>
    <link rel="stylesheet" type="text/css" href="base.css">

</head>

<body>

<div id="menu">
<ul id="liste">
<li> <a href="base.html" id="liens"> Accueil </a> </li>
<li> <a href="serie.php" id="liens"> Séries </a> </li>
<li> <a href="pageco.html" id="liens"> Connexion </a> </li>
<li> <a href="inscriptionmembre.php" id="liens"> Inscription </a> </li>
</ul>
<hr>
</div><center>
<?php

session_start();
if(empty($_SESSION['pseudo'])||empty($_SESSION['mdp']))
{
echo '<script> alert("Il faut vous connecter avant");location.href="pageco.html"</script>';
}
echo '<center> <h1>Bienvenue ' . $_SESSION['pseudo'] ." " .'<br></h1></center>';

$i=1;
include("connexion.php");
global $conn;
$query = "SELECT act_princp,annee,ID_serie,nbepisode,nom,realisateur FROM serie";
	$result = mysqli_query($conn, $query);	
	echo "<table border='1'>";
	echo "<tr> <td> nom </td> <td> année </td> <td> acteurs principaux </td> <td> nombre d'episodes </td> <td> realisateur </td> <td> commencer </td> <td> reprendre </td></tr>";
    while($resultat = mysqli_fetch_assoc($result)) 
	{
		echo "<tr> <td>".$resultat['nom']."</td> <td>".$resultat['annee']."</td> <td>".$resultat['act_princp']."</td> <td>".$resultat['nbepisode']."</td> <td>".$resultat['realisateur']."</td> <td><form action='episode.php' method='POST'><input name='id' type='hidden'value=".$resultat['ID_serie']."><input type='image'src='play.png' style='length:30px;width:30px;'alt='Submit'> </form> </td> <td><form action='episode.php' method='POST'><input name='id' type='hidden'value=".$resultat['ID_serie']."> <input name ='historique' type='hidden' value = '1'> <input type='image'src='play2.png' style='length:30px;width:30px;'alt='Submit'> </form> </td> </tr>"; 
	$i++;
	}
	echo "</table>";
	

?>
<br>
<form action="inscriserie.php">
<input type="submit" value="Ajouter une série" /><br>
</form>

</center>
</body>
</html>