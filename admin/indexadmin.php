<head>
<link rel="stylesheet" type="text/css" href="../style/styleadmin.css">
<title>Admin</title>
</head>

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: green;
  
}

li {
  float: left;
	display:inline;
	margin-right:100px;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: red;
}
</style>
<?php

	//Si la session n'est pas demarrer 
	if(!isset ($_SESSION))
	{
	session_start();
	}
	
	//Si la session est detruite, retourner a la page d'accueil
	if (!$_SESSION["code"] and !$_SESSION["password"])
	{
		echo "<script> window.location.href='../index.php';</script>";
	}
	
?>

<div id="haut">
</div>

<center>
<?php
	
	echo "Bienvenue ". $_SESSION["nom"] ." ". $_SESSION["prenom"];
?>
</center>

<h3 id="bienv">Bienvenue dans la page de admin </h3>

<div>
	<ul>
		<li><a href="indexadmin.php?lien=accueil">Accueil</a></li>
		<li><a href="indexadmin.php?lien=pret">Prets</a></li>
		<li><a href="indexadmin.php?lien=adminverif">Admin?</a></li>
		<li><a href="indexadmin.php?lien=inventaire">Inventaires</a></li>
		<li><a href="indexadmin.php?lien=membre">Membre</a></li>
		<li><a href="indexadmin.php?lien=historique">Historique</a></li>
	</ul>
</div>

<?php

//Recuperation du lien cliquer
	if (isset ($_GET["lien"]))
	{
		$lien=$_GET["lien"];

		
     //Selon le lien cliquer
			 //Selon le lien cliquer
		switch ($lien)
		{
		
			case "accueil":
				include("accueil.php");
			break;
			case "pret":
				include("pret.php");
			break;
			case "adminverif":
				include("adminverif.php");
			break;
			case "inventaire":
				include("inventaire.php");
			break;
			case "membre":
				include("membre.php");
			break;
			case "historique":
				include("historique.php");
			break;
		}
	

	
	}
	
?>
		