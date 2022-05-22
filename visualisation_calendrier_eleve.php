<head>
  <meta charset="utf-8">
  <title>Calendrier élève</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Page permettant de voir les inscription d'un élève
    include 'connexion.php';
    //Selection d'un eleve
    $result_eleve_query = "SELECT * FROM eleves";
    $result_eleve = mysqli_query ($connect, $result_eleve_query);
    if (!$result_eleve) { // TOUJOURS tester le resultat de la requete
      echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
      exit; }

    echo <<< html
    <form method="post" action="visualiser_calendrier_eleve.php">
    <div class="form_eleve">
    <h2>Calendrier élève</h2>
    <br>
    sélectionner un élève :<br>
    <select name="eleve">
    html;
    //affichage des élèves
    while ($liste_eleve = mysqli_fetch_array($result_eleve)) {
      echo "<option value=".$liste_eleve['ideleve'].">".$liste_eleve['Nom']." ".$liste_eleve['prenom']."</option>";
    }

    echo"</select>";
    echo "<br>";
    echo "<input class='send_clear' type='submit' name='Send' value='Send'>";
    echo "<input class='send_clear' type='reset' name='clear' value='Clear'>";
    echo"</form>";
    echo"</div>";




    mysqli_close($connect);
  ?>
</body>
</html>
