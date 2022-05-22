<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Validation séance</title>
    <link rel="stylesheet" href="CSS/style.css">
  </head>

  <body>
    <?php
      //Page permettant de sélectionner une séance à noter
      include 'connexion.php';

      date_default_timezone_set('Europe/Paris');
      $date = date("Ymd"); // date du jour

      $result_query_seance = "SELECT * FROM seances INNER JOIN themes WHERE seances.idtheme=themes.idtheme and DateSeance <= $date";
      //On sélectionne toutes les séances effectuées
      $result_seance = mysqli_query ($connect, $result_query_seance);

      if (!$result_seance) { // TOUJOURS tester le resultat de la requete
        echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
        exit; }
        //Vérification qu'il existe des séances et des elèves'
        if (mysqli_num_rows($result_seance) == 0) {
          echo "Erreur, Aucunes séances définies.";
        }
        else {
          echo"<div class='form_eleve'>";
          echo"<FORM METHOD='POST' ACTION='valider_seance.php' >";
          echo"</br>Seances</br>";
          echo"<select name ='seance'>";
          //affichage des séances
          while ($response_seance = mysqli_fetch_array($result_seance)) {

              echo "<option value=".$response_seance['idseance'].">".$response_seance['DateSeance']." ".$response_seance['nom']."</option><br>";
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
