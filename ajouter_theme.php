<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter thème</title>
    <link rel="stylesheet" href="CSS/style.css"
  </head>
  <body>
    <?php

      include 'connexion.php';

      $nom = strtoupper($_POST['nom']);
      $descriptif = $_POST['description'];

      //code de vérification si le nom n'existe pas déjà dans la BDD
      $result_theme = mysqli_query($connect,"SELECT * FROM themes WHERE nom='$nom'");
      if (!$result_theme) { // TOUJOURS tester le resultat de la requete
       echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
       exit; }

      if (empty($nom) or empty($descriptif)) {//vérif des champs
        echo "Erreur, <br /> un champ n'est pas rempli.";
      }

      if (!empty(mysqli_fetch_array($result_theme))) {
        $query = 'UPDATE themes SET supprime = 0 WHERE nom = "'.$nom.'"';
        echo "Thème Actif !";
        $result = mysqli_query($connect, $query);
      }

      else {//insertion dans la BDD themes
        $query = "insert into themes values ( NULL, '$nom', 0, '$descriptif')";

        // Récapitulatif
        echo "</br><p>Récapitulatif du nouveau thème</p></br>";
        echo "<p>Nom : ".$nom."</p></br>";
        echo "<p>Description ".$descriptif."</p>";

        echo "<br><p>$query</p>";
        // important echo a faire systematiquement, c'est impose !
        $result = mysqli_query($connect, $query);
        // $query utilise comme parametre de mysqli_query
        // le test ci-dessous est desormais impose pour chaque appel de :
        // mysqli_query($connect, $query);
        if (!$result)
        {
        echo "<br>pas bon".mysqli_error($connect);
        }

      }
      mysqli_close($connect);

    ?>
  </body>
</html>
