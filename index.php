<?php
//Si la session n'est pas demarrer 
	if(!isset ($_SESSION))
	{
	session_start();
	}
?>

<head>
<link rel="stylesheet" type="text/css" href="style/styleindex.css">
<title>Magasin Scolaire</title>
</head>

<center>

<div id="logoup">

</div>
<h3 id="mag">Magasin Scolaire</h3>

<form method="post" >

<table>
  <tr><td>Code Acces</td><td><input type="text" name="codeCase" value=""></input></td></tr>

<tr><td>Mot de passe</td><td><input type="password" name="password" value=""></input></td></tr>

<tr><td><input type="submit" name="entrer" value="entrer"></input></td></tr>

</table>
</form>


<!-- Section PHP-->
<?php

//1--Connexion PHP avec la base de donnees Mysql
$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");

//2--Recuperation des donnees par la methode $_POST[]
//Verifier si enter cliquer

if (isset ($_POST["entrer"]))
{
	$login=$_POST["codeCase"];
	$password=$_POST["password"];

//3--Requete SQL select selon le login et le password
	$selection=mysqli_query($connect,"select * from membre where code='$login' and password='$password'") or die
	("Erreur de selection");

	$ligne = mysqli_fetch_row($selection);
	
	
	if ($ligne[3] == 'membre')
	{
		$_SESSION["code"]=$ligne[0];
		$_SESSION["nom"]=$ligne[1];
	    $_SESSION["prenom"]=$ligne[2];
		$_SESSION["password"]=$ligne[4];
			
			echo '<script>window.location.href="membre/indexmembre.php";</script>';
			
	}
	
	elseif($ligne[3] == 'admin')
	{
			$_SESSION["code"]=$ligne[0];
           	$_SESSION["nom"]=$ligne[1];
		    $_SESSION["prenom"]=$ligne[2];	
			$_SESSION["password"]=$ligne[4];
			echo '<script>window.location.href="admin/indexadmin.php";</script>';
	}
	
	else 
	{
		echo "Login et/ou mot de passe incorrect";
	}
}
?>

