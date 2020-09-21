<form method="post">

<?php 
$connect=mysqli_connect('localhost','root','','magasinscolaire') or die ("Erreur de connexion");
$select=mysqli_query($connect,"SELECT * FROM membre;") or die ("Erreur de select");

echo "<h3>Bienvenue sur la page admin? pour lister les locations regroupees par statut</h3>";

//select location.* 
//from location,membre
//where location.code=membre.code
//and membre.statut='$statutrecup'

//le statutrecup est soit admin soit membre
//mettre sa dans un selectbox


?>


<select name="statu">
<?php

$statutrecup = $_POST["statu"];

	echo "<option >membre</option>";
	echo "<option >admin</option>";	
					
?>
	
</select>

<input type="submit" name="confirmer" value="confirmer"></input>

<?php

	//$statutrecup = $_POST["statu"];

  if (isset ($_POST["confirmer"]))
  {
	  $select=mysqli_query($connect,"select location.* from location,membre where location.code=membre.code
          and membre.statut='$statutrecup';") or die ("Erreur de select");
	  


			echo "<table border=1> <th>Code</th> <th>No serie</th> <th>Date location</th> <th>Date retour</th>

				<th>Prix</th> ";

	while($reqresultat=mysqli_fetch_row($select))
	{
		$listecode=$reqresultat[0];
		$listenoserie=$reqresultat[1];
		$listedatelocation=$reqresultat[2];
		$listedateretour=$reqresultat[3];
		$listeprix=$reqresultat[4];

		echo "<tr> <td>$listecode</td> <td>$listenoserie</td> <td>$listedatelocation</td> <td>$listedateretour</td>
	
				<td>$listeprix</td>  </tr>";
		
	}
	

		echo "</table>";
  }


?>

</form>