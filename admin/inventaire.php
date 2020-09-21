<form method="post">


<?php 

echo "<h3>Bienvenue sur la page admin? pour montrer la liste des materiels, ajouter ,
 modifier ou supprimer</h3>";  
  
/*Pour me connecter a la base de donnes et selectionner les donnes de la table materiel*/

$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");
  
  $select=mysqli_query($connect,"SELECT * FROM materiel;") or die ("Erreur de select");
  

?>

<div id="invent">

<select name="choix" >
		<?php
		
			$search = $_POST["choix"];
			/*Dans le select je fais une boucle while pour afficher les donnes de la premiere colonne de 
			la table materiel*/
				while($affiche= mysqli_fetch_row($select))
					{
						$numeroserie = $affiche[0];
						
							if($numeroserie==$search)
							{
						echo "<option value=$numeroserie selected> $numeroserie </option>";
							}
							
							else
							{
								echo "<option value=$numeroserie > $numeroserie </option>";
							}
					}

		?>

</select>

<input id="ok" type="submit" value="ok" name="boutonok"></input>

	<?php
  //Des le clic sur le bouton ok je recupere les donnes du materiel que j'affiche dans le input
  if (isset ($_POST["boutonok"]))
	{

		$search = $_POST["choix"];
		
		//Requete sql de selection selon le choix
		$resultat= mysqli_query ($connect,"select * from materiel where noserie ='$search'");
		
		//Analyse et affichage des resultats de la requete
		
		while ($ligne = mysqli_fetch_row($resultat))
		{
			$noser=$ligne[0];
			$nom = $ligne[1];
			$descrip = $ligne[2];
			$pri = $ligne[3];
			$dispo = $ligne[4];
			$foto  = $ligne[5];
			
		}		
		
	}
	else 
		{
			$noser=$nom=$descrip=$pri=$dispo=$foto= '';
			
		}
	
?>

<table>
	<tr><td>NoSerie</td> <td><input type="text" name="nose" value="<?php echo "$noser"; ?>"></td></tr>
	<tr><td>Nom</td> <td><input type="text" name="namemateriel" value="<?php echo "$nom"; ?>"></td></tr>
	<tr><td>Description</td><td><input type="text" name="description" value="<?php echo "$descrip"; ?>"></td></tr>
	<tr><td>Prix</td><td><input type="text" name="price" value="<?php echo "$pri"; ?>"></td></tr>
	<tr><td>Disponibilite</td><td><input type="text" name="disponibilite" value="<?php echo "$dispo"; ?>"></td></tr>
	<tr><td>Photo</td><td><input type="text" name="photo" value="<?php echo "$foto"; ?>"></td></tr>


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
		$numero = ($_POST['nose']);
		$nom =($_POST['namemateriel']);
		$describe =($_POST['description']);
		$prix =($_POST['price']);
		$disponibilite =($_POST['disponibilite']);
		$photo =($_POST['photo']);
	
	//La variable search contient ce qu'il ya dans le select
		$search =($_POST['choix']);
		
	switch($val)
	{
		//Recharger la page
		case 'Reset':
			echo "<script> window.location.href=''</script>";
		break;
	
		//Inserer des materiel
		case 'Insert':
			$insertion=mysqli_query($connect,"insert into materiel 
		VALUES ('$numero','$nom','$describe','$prix','$disponibilite','$photo.JPG')") or die ("Erreur d'insertion");
		
		$nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
				echo "L'insertion du materiel a ete effectuer";
			}
			else
			{
				echo "Pas marcher";
			}
		break;
		
		//Modifier des materiel
		case 'Update':
				$upd=mysqli_query($connect,"Update materiel set noserie='$numero', nom='$nom',
				description='$describe', prix='$prix', disponibilite='$disponibilite', photo='$photo.JPG' where noserie='$search'") or die ("Erreur de modification");
		
		$nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
				echo "La modification du materiel a ete effectuer";
			}
			else
			{
				echo "Pas marcher";
			}
		break;
		
		//Supprimer des materiel
		case 'Delete':
			$del=mysqli_query($connect,"Delete from materiel where noserie='$numero'") or die ("Erreur de suppression");
		
		$nbre= mysqli_affected_rows($connect);
			if ($nbre>0)
			{
				echo "La suppression  du materiel a ete effectuer";
			}
			else
			{
				echo "Pas marcher";
			}
		break;
	};
}

?>

</div>

<?php
//Liste de clients
//1--Connexion deja etablie
//2--

$reqlisteclient=mysqli_query($connect,"select * from materiel") or die ("Erreur de selection");

echo "<table border=1> <th>No serie</th> <th>Nom</th> <th><Description/th> <th>Prix</th>

<th>Disponibilite</th> <th>Photo</th>";

	while($reqresultat=mysqli_fetch_row($reqlisteclient))
	{
		$listenoserie=$reqresultat[0];
		$listenom=$reqresultat[1];
		$listedescription=$reqresultat[2];
		$listeprix=$reqresultat[3];
		$listedispo=$reqresultat[4];
		$listephoto=$reqresultat[5];
		
	echo "<tr> <td>$listenoserie</td> <td>$listenom</td> <td>$listedescription</td> <td>$listeprix</td> <td>$listedispo</td>
	
  <td><img src='../photo/materiel/$listephoto' style='width:50;height:50'></td>  </tr>";
		
	}
	

echo "</table>";
	
?>

</form>