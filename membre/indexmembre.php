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


<head>
<link rel="stylesheet" type="text/css" href="../style/styleadmin.css">
<title>Membre</title>
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
  background-color: orange;
}
</style>
<div id="haut">
</div>

<center>
<?php
	
	echo "Bienvenue ". $_SESSION["nom"] ." ". $_SESSION["prenom"];
?>
</center>

<center>

<h3>Bienvenue dans la page de membre

</center>


<div>
	<ul>
		<li><a href="indexmembre.php?lien=accueil">Accueil</a></li>
		<li><a href="indexmembre.php?lien=pret">Prets</a></li>
		<li><a href="indexmembre.php?lien=membre">Membre</a></li>
		<li><a href="indexmembre.php?lien=recherche">Recherche</a></li>
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
			case "membre":
				include("membre.php");
			break;
			case "recherche":
				include("recherche.php");
			break;
		}
	}
	
?>
		