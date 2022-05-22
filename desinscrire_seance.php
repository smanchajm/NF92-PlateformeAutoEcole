<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscrire élève</title>
    <link rel="stylesheet" href="CSS/style.css">
  </head>

  <body>
    <?php

      include 'connexion.php';

      if(empty($_POST['seance']) or empty($_POST['eleve'])){ //vérification des champs
          echo "<div class='form_eleve'>";
          echo"<p>Attention : Veuillez à bien selectionner une séance ainsi qu'un élève.</p>";
        }
      else{//récupération des informations
          $ideleve = $_POST['eleve'];
          $idseance = $_POST['seance'];
          //Récupération dans la table inscription de l'inscription qui correspond aux infos
          $inscription_query = "SELECT * FROM inscription WHERE ideleve = $ideleve and idseance = $idseance";
          $result_inscription = mysqli_query($connect, $inscription_query);

          echo "<div class='form_eleve'>";
          if (!$result_inscription) { // TOUJOURS tester le resultat de la requete
            echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
            exit; }

          if (empty(mysqli_fetch_array($result_inscription))) { //vérif que l'élève est bien inscrit à cette séance
            echo "Erreur";
            echo "<br>";
            echo "L'élève sélectionné n'est pas inscrit à cette séance !";
          }
          else { //si l'élève est inscrit on le supprime
            $supprime = mysqli_query($connect,"DELETE FROM inscription WHERE ideleve = $ideleve AND idseance = $idseance ");
            if (!$supprime){
              echo "<br>erreur ".mysqli_error($connect);
              exit;
              }

            echo "L'élève est bien désinscrit de la séance !";
            echo "<br>";
            echo "".$supprime."";
            }
          }

          echo "</div>";






      mysqli_close($connect);

    ?>
  </body>
</html>
