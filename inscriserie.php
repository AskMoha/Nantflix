<html>
<head>
    <meta charset="utf-8">
    <title>  Nouvelle serie</title>
	    <link rel="stylesheet" type="text/css" href="coetinscri.css">
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
</div>

   <center> <h1>  Inscription d'une nouvelle serie dans le catalogue</h1></center>
<form action="inscriptionserie.php" method="post">
<label>Titre: </label><input type="text" name="titre" /><br><br>
<label>nombre d'episodes:</label> <input type="text" name="nbep" /><br><br>
<label>acteur principal:</label> <input type="text" name="acteur" /><br><br>
<label>Realisateur: </label><input type="text" name="Rea" autocomplete	="on" /> <br><br>
<label>année de sortie:</label><SELECT name="Date" size="1">
<?php                                                                                          
for($i=2020;$i>1900;$i--)
{
	echo "<option> $i";
}
?>
</SELECT><br><center><br>
 <input type="submit" style="length:150px;width:150px;">
</form></center>
    </form>                                                              
</body>
</html>