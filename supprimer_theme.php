<head>
  <meta charset="utf-8">
  <title>supprimer thème</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Selection d'un thème à supprimer
    include 'connexion.php';

    date_default_timezone_set('Europe/Paris');
    $date = date("Ymd"); // date du jour
    //récupéreation du thème
    $idtheme = strtoupper($_POST['theme']);


    if(empty($idtheme)){//Vérification des champs
      echo"<p>Attention : Veuillez à bien sélectionner un thème.</p><br> ";
      exit;
      }
    //Update de la BDD themes
    $theme_update_query = "UPDATE themes SET supprime = 1 WHERE idtheme = $idtheme";
    $theme_update = mysqli_query($connect, $theme_update_query); // désactivation du thème

    echo <<< html
    <div class="form_eleve">
    Thème supprimé !
    </div>
    html;

    //On ne sup pas les séances du thème car il serait impossible de les récupérer

    //Sélection de toutes les séances futures qui correspondent au thème sup
    /*$result_seance_query = "SELECT * FROM seance WHERE DateSeance > $date ANd idtheme = $idtheme";
    $result_seance = mysqli_query ($connect, $result_seance_query);
    if (!$result_seance) { // TOUJOURS tester le resultat de la requete
      echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
      exit; }*/


    mysqli_close($connect);
  ?>
</body>
</html>
