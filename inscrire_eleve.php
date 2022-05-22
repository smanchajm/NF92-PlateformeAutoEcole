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

      $idseance =strtoupper($_POST['seance']);
      $ideleve =strtoupper($_POST['eleve']);

      // La vérification que la séance n'est pas complète a déja été faite dans inscription_eleve

      $query = 'SELECT * FROM inscription WHERE idseance = "'.$_POST['seance'].'" and ideleve = "'.$_POST['eleve'].'"';
      $verif = mysqli_query($connect, $query);
      // Vérification que l'élève n'est pas déja inscrit
      if (!empty(mysqli_fetch_array($verif))) {
        echo "Erreur";
        echo "<br>";
        echo "L'élève est déja inscrit à cette séance";
      }
      else {//Insertion dans la BDD inscription
        $query_result = "INSERT INTO inscription VALUES("."'$idseance'".","."'$ideleve'".","."'-1'".")";

        $result = mysqli_query($connect, $query_result); //Insertion dans la BDD
        // $query utilise comme parametre de mysqli_query
        // le test ci-dessous est desormais impose pour chaque appel de : mysqli_query($connect, $query);
          echo "<br><p>$query_result</p>";

        if (!$result)
        {
        echo "<br>pas bon".mysqli_error($connect);
        }
      }

      mysqli_close($connect);

    ?>



  </body>
</html>
