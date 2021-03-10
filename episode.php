<html>
<head>
    <meta charset="utf-8">
    <title>  Nouvelle serie</title>
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
include("connexion.php");
global $conn;
session_start();
$id_ep=1;
$iduti=$_SESSION['ID_utilisateur'];
if(isset($_POST['id']))// si c'est un changement de serie
{
$id_serie=$_POST['id'];
$_SESSION['serie']=$id_serie;
$_SESSION['episode']=1;
$epchoisi=1;
$id_epquery="SELECT id_ep,id_serie,num_ep FROM episode";
$recup=mysqli_query($conn,$id_epquery);
if(isset($_POST['historique']))	// si la page d'avant on fait reprendre
{
	$histoep="SELECT id_episode,id_utilisateur,id_historique FROM historique"; 
	$reshisto=mysqli_query($conn,$histoep);
	
	while($reshistor=mysqli_fetch_assoc($reshisto))
	{
		if($reshistor['id_utilisateur']==$iduti) // recup toutes les series que l'utilisateur a regardé et les stocks dans un tableau
		{
		$acomparer[]=$reshistor['id_episode'];
		}
	}
}

while($tab=mysqli_fetch_assoc($recup)) 
{
if(isset($_POST['historique'])==false) // si on commence une nouvelle serie
{
if($tab['id_serie']==$id_serie&&$tab['num_ep']==1) //si c'est le même id 
{
	$id_ep=$tab['id_ep'];						// on recupere l'id de l'episode
	$touteslesid="SELECT id_ep,id_serie,num_ep FROM episode";
	$res=mysqli_query($conn,$touteslesid);
	
	$newlecture="INSERT into historique(id_episode,id_utilisateur) VALUES($id_ep,$iduti)"; // on insere dans l'historique l'id de l'episode et a quel utilisateur ça correspond
	
	while($restab=mysqli_fetch_assoc($res))
	{
		if($id_serie==$restab['id_serie'])
		{
		$asupr=$restab['id_ep'];
		$efface="DELETE FROM historique WHERE id_episode=".$asupr." AND id_utilisateur=$iduti"; // on supprime si il regardait deja la serie (j'aurai du faire un id_serie dans la table historique)
		mysqli_query($conn,$efface); // obligé de faire comme ça sinon quand on recommence une serie elle restera dans la bdd
		}
	}
	//$efface="DELETE FROM historique WHERE id_episode=$id_ep AND id_utilisateur=$iduti"; // on supprime si il regardait deja la serie (j'aurai du faire un id_serie dans la table historique)
	mysqli_query($conn,$newlecture);
	break;
}
}else // si on reprends une serie
{
if(in_array($tab['id_ep'],$acomparer)==true&&$id_serie==$tab['id_serie'])  // si l'utilisateur a déjà regardé l'episode (on regarde tout son historique)
{
	$id_ep=$tab['id_ep'];					// on recup l'id de cet episode
	$id_epquery2="SELECT id_ep,id_serie,num_ep FROM episode";
$recup2=mysqli_query($conn,$id_epquery2);
while($tab2=mysqli_fetch_assoc($recup2))// on va chercher a quel numero d'episode ça correspond
{
	if($tab2['id_ep']==$id_ep) // si ça correspond
	{
		$epchoisi=$tab2['num_ep'];
		break; // pour sortir de la deuxieme boucle 
	}
}

break;// pour sortir de la premiere boucle
}
}
}
}


if(isset($_POST['id'])==false)// si c'est un changement d'episode
{	
$epchoisi=$_POST['episode'];
$_SESSION['episode']=$epchoisi;
$id_serie=$_SESSION['serie'];
$ancienep=$_POST['ancienep'];
$id_epquery="SELECT id_ep,id_serie,num_ep FROM episode";
$recup=mysqli_query($conn,$id_epquery);
while($tab=mysqli_fetch_assoc($recup))
{
if($tab['id_serie']==$id_serie&&$tab['num_ep']==$epchoisi)
{
	$id_ep=$tab['id_ep'];
	break;
}
}
$efface="DELETE FROM historique WHERE id_episode=$ancienep AND id_utilisateur=$iduti";
$changementhisto="INSERT into historique(id_episode,id_utilisateur) VALUES($id_ep,$iduti)";
	mysqli_query($conn,$efface);
	mysqli_query($conn,$changementhisto);
}




$query = "SELECT act_princp,annee,ID_serie,nbepisode,nom,realisateur FROM serie";
$result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) 
	{
		if($row['ID_serie']==$id_serie)
		{
			break;
		}
	}
	echo "<center> <h1> Vous regardez l'épisode ".$epchoisi." de la serie " .$row['nom']."</h1> ";
	
	
	
	

?>
<form action="episode.php" method="post">
<label>episode :</label><SELECT name="episode" size="1" >
<?php                                                                                          
for($i=1;$i<=$row['nbepisode'];$i++)
{
	echo "<option";
	if($i==$epchoisi)
	{ echo " selected";}
	echo "> $i";

	echo "</option>";
}
?>
</select>
<?php
echo "<input type='hidden' name='ancienep' value='$id_ep'> </input>";
?>
 <input type="submit" value="confirmer" style="length:150px;width:150px;">
</form>
<video controls width="560" height="320">
<?php
echo " <source src='".$_SESSION['serie']."/".$epchoisi.".mp4' type='video/webm'>";
?>
</video><br>
<?php echo "Bon visionnage ".$_SESSION['prenom']. "!"; ?>
</center>
</body>

</html>