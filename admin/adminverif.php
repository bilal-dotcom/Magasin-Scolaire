<?php 

echo "<h3>Bienvenue sur la page admin? pour modifier les informations</h3>";

//Je stocke le code, le nom puis le prenom de celuis qui a la session connecter
	$nomsession = $_SESSION["nom"];
	$prenomsession = $_SESSION["prenom"];
	
	
	//	Stocker le nom et le prenom du membre dans la variable $passwordbda	
   	$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");
	 $resultat = mysqli_query($connect,"SELECT * FROM membre WHERE prenom= '$prenomsession';");
	
	 $ligne = mysqli_fetch_row($resultat);	
	 
	 $codeadminverif= $ligne[0];
	 $nomadminverif = $ligne[1];
	 $prenomadminverif = $ligne[2];
	 $passwordbda= $ligne[4];
    

?>

<table>
	<form method="post">
<table>
	<tr><td>Code</td> <td><input type="text" name="codeadmin" value="<?php echo "$codeadminverif" ?>"></td></tr>
	<tr><td>Nom</td> <td><input type="text" name="nomadmin" value="<?php echo "$nomadminverif" ?>"></td></tr>
	<tr><td>Prenom</td> <td><input type="text" name="prenomadmin" value="<?php echo "$prenomadminverif" ?>"></td></tr>
	<tr><td>Statut</td> <td><input type="text" name="statutadmin" value="admin"></td></tr>
	<tr><td>Mot de passe actuel</td> <td><input type="password" name="mdpadmin" value=""></td></tr>
	<tr><td>Nouveau Mot de passe</td> <td><input type="password" name="newmdpadmin" value=""></td></tr>
</table>


<table>
	<tr> 
		<td colspan=2>
			<input type="submit" name=valider value=Reset>
			<input type="submit" name=valider value=Update>
			<input type="submit" name=valider value=Password>
		</td>
	</tr>
</table>

<?php 
//Connexion a la base de donnees
$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");

	if(isset($_POST["valider"]))
	{
		$val = $_POST["valider"];
		
			$name = ($_POST['nomadmin']);
			$prenom = ($_POST['prenomadmin']);
			$newstatut = ($_POST['statutadmin']);
			$newpassword =($_POST['newmdpadmin']);
		
		switch($val)
		{
			case 'Reset':
				echo "<script> window.location.href=''</script>";
			break;
			
			//Juste modifier le nom et le prenom
			case 'Update':
	
				$select4=mysqli_query($connect,"UPDATE membre SET nom='$name',prenom ='$prenom'
				WHERE code='$codeadminverif';")  or die ("Erreur de update");
				
				$nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
				echo "La modification du compte " .$nomadminverif . " a ete effectuer";
			}
			else
			{
				echo "Modification pas effectuer (On ne peut que modifier le nom et le prenom)";
			}
			break;
			
			//Pour modifier le mdp
			case 'Password';
				
	
		    $ancienpass=$_POST["mdpadmin"];
			
	   if($passwordbda== $ancienpass)
	   {
	     $newpass=$_POST["newmdpadmin"];
		
		 $select=mysqli_query($connect,"Update membre set password='$newpass' where prenom='$prenomadminverif'")
		 or die ("Erreur de modification");

		 $nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
			   echo "La modification du mot de passe de " .$prenomadminverif . " a ete effectuer";
			}
			else
			{
			   echo "Echec de modification du mdp.";
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
	
				
			break;
		}
	}

?>

</table>
</form>

  