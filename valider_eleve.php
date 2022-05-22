<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter séance</title>
    <link rel="stylesheet" href="CSS/style.css">
  </head>

  <body>
    <?php
      //Page permettant de véifier toutes les caractérisriques de l'élève
      //Certaines vérif sont faites dans ajouter_eleve
      include 'connexion.php';

      $nom =strtoupper($_POST['nom']);
      $prenom = strtoupper($_POST['prénom']);
      $datenaissance = strtoupper($_POST['datenaissance']);
      $age = date_diff(date_create($datenaissance), date_create($date)); //calcul de l'âge


      $doublon = "SELECT * FROM eleves WHERE nom = '$nom' and prenom = '$prenom'"; // requête pour voir si un élève ayant déjà ce nom et prénom existe déjà
      $verif = mysqli_query($connect, $doublon);

      if (!$verif) { // TOUJOURS tester le resultat de la requete
       echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
       exit; }

      if (!empty(mysqli_fetch_array($verif))){ //Demande à l'utilisateur si il veut ajouter un élève en doublon
        echo"<div class='form_eleve'>";
        echo "Voulez vous quand-même l'ajouter";

        echo"<FORM METHOD='POST' ACTION='ajouter_eleve.php' >";
        /*echo"<label for='oui'>Oui</label><br>";
  			echo"<INPUT TYPE='radio' VALUE='1' NAME='choix' ID='oui'><br>";
        echo"<label for='non'>Non</label><br>";
        echo"<INPUT TYPE='radio' VALUE='0' NAME='choix' ID='non'>";*/

        echo "<input type='hidden' name='nom' value='".$nom."'>";
  			echo "<input type='hidden' name='prenom' value='".$prenom."'>";
  			echo "<input type='hidden' name='datenaissance' value='".$datenaissance."'>";
        echo "<br><INPUT class='send_clear' TYPE='submit' VALUE='Oui'>";
        echo "<a href='ajout_eleve.html' class='menu_button'>Non</a>";
  			echo "</form>";
        echo "</div>";
      }

      else { //Confirmation de l'envoi du nouvel élève
        echo"<div class='form_eleve'>";
        echo"</br>Confirmer votre envoi ?</br>";
  			echo"<FORM METHOD='POST' ACTION='ajouter_eleve.php' >";
  			echo "<input type='hidden' name='nom' value='".$nom."'>";
  			echo "<input type='hidden' name='prenom' value='".$prenom."'>";
  			echo "<input type='hidden' name='datenaissance' value='".$datenaissance."'>";
  			echo "<br><INPUT class='send_clear' TYPE='submit' VALUE='Oui'>";
        echo "<a href='ajout_eleve.html' class='menu_button'>Non</a>";
  			echo "</form>";
        echo "</div>";
      }


    mysqli_close($connect);

  ?>



  </body>
</html>
