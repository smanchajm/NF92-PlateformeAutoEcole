<head>
  <meta charset="utf-8">
  <title>supprimer thème</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Selection d'un thème à supprimer
    include 'connexion.php';

    $result_theme_query = "SELECT * FROM themes WHERE supprime ='0' ";
    // si supprime = 0 alors le thème est actif
    $result_theme = mysqli_query ($connect, $result_theme_query);
    if (!$result_theme) { // TOUJOURS tester le resultat de la requete
      echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
      exit; }
    //fomrulaire pour sélectionner le thème
    echo <<< html
    <form method="post" action="supprimer_theme.php">
    <div class="form_eleve">
    <h2>Supprimer un thème</h2>
    <br>
    sélectionner un thème :<br>
    <select name="theme">
    html;

    while ($liste_theme = mysqli_fetch_array($result_theme)) {
      echo "<option value=".$liste_theme['idtheme'].">".$liste_theme['nom']."</option>";
    }

    echo"</select>";
    echo "<input class='send_clear' type='submit' name='Send' value='Send'>";
    echo "<input class='send_clear' type='reset' name='clear' value='Clear'>";
    echo"</form>";
    echo"</div>";




    mysqli_close($connect);
  ?>
</body>
</html>
