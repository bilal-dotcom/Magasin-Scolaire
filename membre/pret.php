<form method="post">

<?php 

  $numerocode= $_SESSION["code"];

echo "<h3>Bienvenue sur la page pret</h3>";

$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");
  
 $select=mysqli_query($connect,"SELECT * FROM location where code=$numerocode;") or die ("Erreur de select");
  
?>



<table>
	<tr>
		<td><input type="submit" name="valid" value="Afficher les prets">
	
			<select name="choix">
        <?php
		
			           $search = $_POST["choix"];
			/*Dans le select je fais une boucle while pour afficher les code de la premiere colonne de 
			la table location*/
				while($affiche= mysqli_fetch_row($select))
					{
						$numeroserie = $affiche[1];
						$nommm=$affiche[0];
						
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
		</td>
	</tr>
</table>

<?php
  //Des le clic sur le bouton ok je recupere les donnes du location que j'affiche dans le input
  if (isset ($_POST["valid"]))
	{
		
		//Requete sql de selection selon le choix
		$resultat= mysqli_query ($connect,"select * from location where code='$nommm'") or die ("Erreur de select");
		
		$nbre=mysqli_num_rows($resultat);
		if($nbre>0)
		{
			echo "Voici les prets de " .  $_SESSION["nom"] ." ". $_SESSION["prenom"];
			
			echo "<table> <th>Code</th>  <th>No serie</th> <th>Date location</th> <th>Date retour</th> <th>Prix</th>";
			
		
		//Analyse et affichage des resultats de la requete
		
		while ($ligne = mysqli_fetch_row($resultat))
		{
			$code=$ligne[0];
			$noserie = $ligne[1];
			$datelocation = $ligne[2];
			$dateretour = $ligne[3];
			$prixlocation = $ligne[4];
			
			echo"<tr> <td>$code</td>  <td>$noserie</td> <td>$datelocation</td> <td>$dateretour</td> <td>$prixlocation</td></tr>";
		}

		echo "</table>";
		
		}
		
		else
		{
			$nomm='ok';
			echo"Ce client na pas de pret";
			
			
		}
	}
	 
	
?>


</form>