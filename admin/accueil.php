<?php 

echo "<h3>Bienvenue sur la page accueil</h3>";
 
session_destroy();
session_unset();
mysqli_close($connect);
echo "<script>window.location.href='../index.php'; </script>";


?>

