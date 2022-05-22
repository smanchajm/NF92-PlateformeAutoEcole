<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajout séance</title>
    <link rel="stylesheet" href="CSS/style.css"
  </head>

  <body>
    <?php
      include 'connexion.php';
      //selection de tous les thèmes
      $result = mysqli_query($connect,'SELECT * FROM themes');

      //formulaire intéractif php pour créer une séance
      // ATTENTION il manque les affichages et tests de debugage !!!!
        echo "<div class='form_eleve'>";
        echo "<h2>Séances</h2>";
        echo "<form action='ajouter_seance.php' method='post'>";
        echo "<label for='dateinscription'>Date</label><br>";
              //echo "<br>";
        echo "<input type='date' name='dateinscription' min=''$date' required><br>";
              //echo "<br>";
        echo "<label for='effmax'>Effectif Max</label><br>";
              //echo "<br>";
        echo "<input type='number'  name='effmax' id='effmax' min='0' required><br>";
              //echo "<br>";
        echo "<label for='theme'> Thème </label><br>";
        echo "<select name='theme' size='1'><br>";
      //Affichage des thèmes sans les thèmes désactivés
      while($response = mysqli_fetch_array($result)){
        if ($response[supprime] =='0') {
          echo "<option value={$response['idtheme']} >{$response['nom']}</option>";
        }
      }

      echo "</select><br>";
      //echo "<br>";
      echo "<input class='send_clear' type='submit' name='Send' value='Send'>";
      echo "<input class='send_clear' type='reset' name='clear' value='Clear'>";
      echo "</form>";
      echo "</div>";



      mysqli_close($connect);

    ?>

  </body>
</html>
