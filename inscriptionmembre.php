<html>
<head>
  <link rel="stylesheet" type="text/css" href="coetinscri.css">
    <meta charset="utf-8">
    <title>  Inscription Nantflix</title>
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
    <center><h1> Inscription Nantflix</h1></center>
<div id="entree">
<form action="membre.php" method="post">
<label>Identifiant:</label> <input type="email" name="Identifiant" /><br><br>
<label>Mot de passe:</label> <input type="password" name="Mdp" pattern ="(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,}" /><br><br>
<label>Prénom: </label><input type="text" name="Prenom" autocomplete="on" /><br> <br>
<label>Nom: </label><input type="text" name="Nom" autocomplete	="on" /> <br><br>
<label>Date de naissance :</label><SELECT name="Date" size="1">
<?php                                                                                          
for($i=2005;$i>1900;$i--)
{
	echo "<option> $i";
}
?>
</SELECT><br><br>
<label>Numéro de telephone: </label><input type ="tel" name="num" pattern="[0-9]{10}"/><br><br>
<center>
 <input type="image" src="bouton.png" style="length:150px;width:150px;"alt="Submit">
</center>
</form>
</div>                                                              
</body>
</html>