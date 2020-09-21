<form method="post">

<?php 

echo "<h3>Bienvenue sur la page recherche " .$_SESSION ["prenom"] . " pour rechercher un materiel</h3>";

  /*Pour me connecter a la base de donnes et selectionner les donnes de la table materiel*/

$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");
  
  $select=mysqli_query($connect,"SELECT * FROM materiel;") or die ("Erreur de select");
  
?>

<select name="choix" >
		<?php
		
			$search = $_POST["choix"];
			/*Dans le select je fais une boucle while pour afficher les donnees de la premiere colonne de 
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
  //Des le clic sur le bouton ok je recupere les donnes du location que j'affiche dans le input
  if (isset ($_POST["boutonok"]))
	{
		
		//Requete sql de selection selon le choix
		$resultat= mysqli_query ($connect,"select * from materiel where noserie='$search'") or die ("Erreur de select");
		
		$nbre=mysqli_num_rows($resultat);
		if($nbre>0)
		{
			
			
			echo "<table> <th>No serie</th>  <th>Nom</th> <th>	Description</th> <th>Prix</th> <th>Disponibilite</th> <th>Photo</th>";
			
		
		//Analyse et affichage des resultats de la requete
		
		while ($ligne = mysqli_fetch_row($resultat))
		{
			$noserie=$ligne[0];
			$nom = $ligne[1];
			$description = $ligne[2];
			$prix = $ligne[3];
			$disponibile = $ligne[4];
			$photo=$ligne[5];
			
			echo"<tr> <td>$noserie</td>  <td>$nom</td> <td>$description</td> <td>$prix</td> <td>$disponibile</td> 
			 <td> <img src='../photo/materiel/$photo' style='width:50;height:50'></td></tr>";
		}

		echo "</table>";
		
		}
		
		else
		{
		
			echo"Ce client na pas de pret";
			
		}
	}
	 
	
?>




</form>