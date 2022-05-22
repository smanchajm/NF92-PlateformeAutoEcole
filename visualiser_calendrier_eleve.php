<head>
  <meta charset="utf-8">
  <title>Calendrier élève</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Calendrier d'un élève donné
    include 'connexion.php';
    date_default_timezone_set('Europe/Paris');
    $date = date("Ymd"); // date du jour

    $ideleve = $_POST['eleve'];

    if(empty($ideleve)){//vérif des champs
      echo"<p>Attention : Veuillez à bien sélectionner un élève.</p><br> ";
      exit;
      }
    else {//selection des information de l'inscritpion avec les infos de la séance et le theme
      $inscription_futur_query = "SELECT * FROM inscription INNER JOIN seances
            ON inscription.idseance = seances.idseance
            INNER JOIN themes
            ON themes.idtheme = seances.idtheme
            WHERE inscription.ideleve = $ideleve
            AND seances.DateSeance > $date";
      $inscription_futur = mysqli_query ($connect, $inscription_futur_query);
      if (!$inscription_futur) { // TOUJOURS tester le resultat de la requete
        echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
        exit; }
      echo "<div class='form_eleve'>";
      if (mysqli_num_rows($inscription_futur)==0) {
        echo"Erreur l'élève n'a aucune séances de prévues !";
      }
      else {
        echo "<h2>Inscriptions</h2>";
        echo "<br>";
        while ($inscription = mysqli_fetch_array($inscription_futur)) {
          echo "Séance de ".$inscription['nom']." le ".$inscription['DateSeance']." ";
          echo "<br>";

        echo "</div>";
        }
      }

    }



    mysqli_close($connect);
  ?>
</body>
</html>
