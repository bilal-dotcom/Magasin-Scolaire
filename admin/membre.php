
<form method="post">

<?php 

echo "<h3>Bienvenue sur la page admin? pour lister les membres, les ajouter, les modifier ou les supprimer</h3>";  
  
/*Pour me connecter a la base de donnes et selectionner les donnes de la table membre*/

$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");
  
  $select=mysqli_query($connect,"SELECT * FROM membre where statut='membre';") or die ("Erreur de select");
  

?>


<select name="choix" >
		<?php
		
			$search = $_POST["choix"];
			/*Dans le select je fais une boucle while pour afficher les donnes de la premiere colonne de 
			la table membre*/
				while($affiche= mysqli_fetch_row($select))
					{
						$codeselect = $affiche[0];
						$nomselect = $affiche[1];
						$prenonomselect = $affiche[2];
						$statutselect = $affiche[3];
						$passwdselect = $affiche[4];
					
							if($codeselect==$search)
							{
						echo "<option value=$codeselect selected> $codeselect </option>";
							}
							
							else
							{
								echo "<option value=$codeselect > $codeselect </option>";
							}
					}

		?>

</select>

<input id="ok" type="submit" value="ok" name="boutonok"></input>

	<?php
  //Des le clic sur le bouton ok je recupere les donnes du materiel que j'affiche dans le input
  if (isset ($_POST["boutonok"]))
	{

		//Requete sql de selection selon le choix
		$resultat= mysqli_query ($connect,"select * from membre where code ='$search'");
		
		//Analyse et affichage des resultats de la requete
		
		while ($ligne = mysqli_fetch_row($resultat))
		{
			$code=$ligne[0];
			$nom = $ligne[1];
			$prenom = $ligne[2];
			$statut = $ligne[3];
			$password = $ligne[4];
		}		
		
	}
	else 
		{
			$code=$nom=$prenom=$statut=$password='';
			
		}
	
?>


<table>
	<tr><td>Code</td> <td><input type="text" name="codee" value="<?php echo "$code"; ?>"></td></tr>
	<tr><td>Nom</td> <td><input type="text" name="name" value="<?php echo "$nom"; ?>"></td></tr>
	<tr><td>Prenom</td><td><input type="text" name="prename" value="<?php echo "$prenom"; ?>"></td></tr>
	<tr><td>Statut</td><td><input type="text" name="statuuut" value="<?php echo "$statut"; ?>"></td></tr>
	<tr><td>Password</td><td><input type="password" name="passw" value="<?php echo "$password"; ?>"></td></tr>
	
<tr>
	<td colspan=2>
		<input type="submit" name="valider" value="Reset">
		<input type="submit" name="valider" value="Insert">
		<input type="submit" name="valider" value="Update">
		<input type="submit" name="valider" value="Delete">
	</td>
</tr>

</table>


	<?php 
if (isset($_POST['valider']))
{
	$val = $_POST['valider'];
	
	//Je cree des variables qui recupere les caracteristiques desmateriaux a ajouter
		$cod = ($_POST['codee']);
		$name =($_POST['name']);
		$pren =($_POST['prename']);
		$statut =($_POST['statuuut']);
		$password =($_POST['passw']);
	
	switch($val)
	{
		//Recharger la page
		case 'Reset':
			echo "<script> window.location.href=''</script>";
		break;
	
		//Inserer des membre
		case 'Insert':
			$insertion=mysqli_query($connect,"insert into membre 
		VALUES ('$cod','$name','$pren','$statut','$password')") or die ("Erreur d'insertion");
		
		$nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
				echo "L'insertion du membre a ete effectuer";
			}
			else
			{
				echo "Pas marcher";
			}
		break;
		
		//Modifier des membres
		case 'Update':
				$upd=mysqli_query($connect,"Update membre set code='$cod', nom='$name',
				prenom='$pren', statut='$statut' where code='$search'") or die ("Erreur de modification");
		
		$nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
				echo "La modification du membre a ete effectuer";
			}
			else
			{
				echo "Pas marcher";
			}
		break;
		
		//Supprimer des materiel
		case 'Delete':
			$del=mysqli_query($connect,"Delete from membre where code='$search'") or die ("Erreur de suppression");
		
		$nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
				echo "La suppression  du membre a ete effectuer";
			}
			else
			{
				echo "Pas marcher";
			}
		break;
	};
}

?>

</form>