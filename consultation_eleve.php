<head>
  <meta charset="utf-8">
  <title>Consultation élève</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Selection d'un eleve
    include 'connexion.php';

    $result_eleve_query = "SELECT * FROM eleves";
    $result_eleve = mysqli_query ($connect, $result_eleve_query);
    if (!$result_eleve) { // TOUJOURS tester le resultat de la requete
      echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
      exit; }

    echo <<< html
    <form method="post" action="consulter_eleve.php">
    <div class="form_eleve">
    <h2>Consulter élève</h2>
    <br>
    sélectionner un élève :<br>
    <select name="eleve">
    html;

    while ($liste_eleve = mysqli_fetch_array($result_eleve)) { //Affichage de tous les élèves
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
