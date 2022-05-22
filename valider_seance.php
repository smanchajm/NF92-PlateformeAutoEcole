<head>
  <meta charset="utf-8">
  <title>Valider séance</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Page permettant de noter les élèves
    include 'connexion.php';

    $seance =strtoupper($_POST['seance']);

    $result_query_seance = "SELECT * FROM inscription INNER JOIN eleves WHERE inscription.idseance=$seance and inscription.ideleve=eleves.ideleve ";
    //On sélectionne les élèves inscrits à cette séance
    $result_seance = mysqli_query ($connect, $result_query_seance);

    if (!$result_seance) { // TOUJOURS tester le resultat de la requete
      echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
      exit; }

    if (empty($seance)) { //vérification qu'une séance est séléctionnée
      echo "Erreur, aucune séance n'est séléctionnée";
    }
    elseif (mysqli_num_rows($result_seance) == 0) {
      echo "Erreur, aucun élève n'est inscrit.";
    }
    else {
      echo"<div class='form_eleve'>";
      echo"<FORM METHOD='POST' ACTION='noter_eleves.php' >";
      echo"<h2>Notation séance</h2>";

      while ($response_seance = mysqli_fetch_array($result_seance)) { //affichage d'une interface de notation pour chaque élève

        $note = $response_seance['note'];
        $ideleve = $response_seance['ideleve'];

        echo "".$response_seance['Nom']." ".$response_seance['prenom']."<br>";
        echo "<input type='hidden' name='seance' value='".$seance."'>";
        if($note == -1){//Pas de note enregistrée
            echo " pas encore de note enregistrée. Fautes :";
            echo "<input type='number' min='0' max='40' name='".$response_seance['ideleve']."'>";
            echo "<br>";
          }
          else{//note déja enregistrée
            echo " note actuelle ".$note."/40. Fautes : ";
            echo "<input type='number' min='0' max='40' name='".$response_seance['ideleve']."' placeholder='".$note."'>";
            echo "<br>";

          }
      }

      echo "<input class='send_clear' type='submit' name='Send' value='Send'>";
      echo "<input class='send_clear' type='reset' name='clear' value='Clear'>";
      echo"</form>";
      echo"</div>";
    }




    mysqli_close($connect);
  ?>
</body>
</html>
