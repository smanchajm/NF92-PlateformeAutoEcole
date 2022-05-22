<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter séance</title>
    <link rel="stylesheet" href="CSS/style.css"
  </head>

  <body>
    <?php
      include 'connexion.php';


      $dateinscription = strtoupper($_POST['dateinscription']);
      $effmax = strtoupper($_POST['effmax']);
      $idtheme = $_POST['theme'];

      $doublon = "SELECT * FROM seances WHERE Dateseance = '$dateinscription' and idtheme = '$idtheme'"; //requête SQL pour les doublons de séances
      $verif = mysqli_query($connect, $doublon);


      if (!$verif) { // TOUJOURS tester le resultat de la requete
       echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
       exit; }

      if (!empty(mysqli_fetch_array($verif))){ // Vérification qu'il n'y a pas le même thème le même jour
        echo "Il est impossible d'ajouter deux fois le même thême le même jour";
      }

      else {//Insertion dans la BDD seances
        $query = "insert into seances values ( NULL, '$dateinscription', '$effmax', '$idtheme' )";
        echo "La séance est ajoutée !";
        echo "<br><p>$query</p>";
        $result = mysqli_query($connect, $query);
        if (!$result)
        {
        echo "<br>pas bon".mysqli_error($connect);
        }

      }

      mysqli_close($connect);
    ?>
  </body>
</html>
