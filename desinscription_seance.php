<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Désinscription élève</title>
    <link rel="stylesheet" href="CSS/style.css">
  </head>

  <body>
    <?php

      include 'connexion.php';
      date_default_timezone_set('Europe/Paris');
      $date = date("Ymd");


      $result_query_seance = "SELECT * FROM seances INNER JOIN themes WHERE seances.idtheme=themes.idtheme and DateSeance >= $date";
      //On sélectionne toutes les séances dans le futur
      $result_seance = mysqli_query ($connect, $result_query_seance);

      $result_query_eleve = "SELECT * FROM eleves";
      //On sélectionne tous les eleves
      $result_eleve = mysqli_query ($connect, $result_query_eleve);

      if (!$result_seance) { // TOUJOURS tester le resultat de la requete
        echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
        exit; }

      if (!$result_eleve) { // TOUJOURS tester le resultat de la requete
        echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
        exit; }

      if ((mysqli_num_rows($result_seance) or mysqli_num_rows($result_eleve)) == 0) {
        //Vérification que des séances et les élèves soit définis
        echo "Erreur aucun élève ou aucune séance ne sont dans la BDD";
      }
      else {//Formulaire de sélection pour la désinscription
        echo "<div class='form_eleve'>";
        echo "<h2>Désinscription</h2>";
        echo "<FORM METHOD='POST' ACTION='desinscrire_seance.php' >";
        echo "Elève</br>";
        echo "<select name ='eleve'>";
        //Affichage de tous les eleves
        while ($response_eleve = mysqli_fetch_array($result_eleve)) {
          echo "<option value=".$response_eleve['ideleve'].">".$response_eleve['Nom'].' '.$response_eleve['prenom']."</option>";
        }
        echo"</select>";

        echo"</br>Seances</br>";
        echo"<select name ='seance'>";
        //affichage des séances futures
        while ($response_seance = mysqli_fetch_array($result_seance)) {
          // Calcul des places restantes
          $selected_seance = $response_seance['idseance'];
          $effectif_query = "SELECT * FROM inscription WHERE idseance = $selected_seance";
          $effectif  = mysqli_query($connect, $effectif_query);
          $effectif_nombre = mysqli_num_rows($effectif);
          if (!$effectif) { // TOUJOURS tester le resultat de la requete
            echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
            exit; }


          if (!$effectif_nombre = '0'){ //vérif qu'il existe des élèves inscrit à la séance
            echo "<option value=".$response_seance['idseance'].">".$response_seance['DateSeance'].' '.$response_seance[nom]."</option><br>";

          }
        }

        echo"</select>";
        echo "<br>";
        echo "<input class='send_clear' type='submit' name='Send' value='Send'>";
        echo "<input class='send_clear' type='reset' name='clear' value='Clear'>";
        echo"</form>";
        echo"</div>";
      }


      mysqli_close($connect);

    ?>
  </body>
</html>
