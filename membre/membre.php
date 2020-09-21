<form method="post">

<?php 
 $memberprenom = $_SESSION["prenom"];

echo "<h3>Bienvenue sur la page membre " .$memberprenom . " pour modifier votre mot de passe </h3>";

 $connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");
    
?>

<table>
	<tr><td>Mot de passe actuel</td><td><input type="password" name="oldpasswd" value=""></td></tr>
	<tr><td>Nouveau mot de passe</td><td><input type="password" name="newpasswd" value=""></td></tr>
</table>

<input type="submit" name="change" value="Changer mot de passe">

<?php

	if (isset($_POST["change"]))
	{  
		$ancienpass=$_POST["oldpasswd"];
	
	 //	Stocker le mdp du membre dans la variable $passwordbda	
	 $resultat = mysqli_query($connect,"SELECT * FROM membre WHERE prenom= '$memberprenom';");
	
	 $ligne = mysqli_fetch_row($resultat);	
	 $passwordbda= $ligne[4];
		
	   if($passwordbda== $ancienpass)
	   {
	     $newpass=$_POST["newpasswd"];
		
		 $select=mysqli_query($connect,"Update membre set password='$newpass' where prenom='$memberprenom'")
		 or die ("Erreur de modification");

	
	
		 $nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
			   echo "La modification du mot de passe de " .$memberprenom . " a ete effectuer";
			}
			else
			{
			   echo "Echec de mise a jour.";
			}
			
			//Les meme mdp doivent pas etre entrees
			if($newpass==$passwordbda)
			{
				echo"Le nouveau mot de passe doit etre different de l'ancien";
			}
	   }
	   
	   
	   
	   else
	   {
		   echo "Ce n'est pas votre ancien mot de passe";
	   }
	}
?>

</form>