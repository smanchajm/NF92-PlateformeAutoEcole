<head>
  <meta charset="utf-8">
  <title>Consulter élève</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Affichage des infos d'un élève
    include 'connexion.php';
    $ideleve = $_POST['eleve'];

    if(empty($ideleve)){//vérification des champs
      echo"<p>Attention : Veuillez à bien sélectionner un élève.</p><br> ";
      exit;
      }
    else {
      //sélection de l'élève dans la BDD
      $query = "SELECT * FROM eleves WHERE ideleve = $ideleve";
      $result=mysqli_query ($connect, $query);
      if (!$result) { // TOUJOURS tester le resultat de la requete
        echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
        exit; }

      $info = mysqli_fetch_array($result);

      echo "<div class='form_eleve'>";
      echo "<h2>Récapitulatif</h2>";
      echo "<table>";

      echo "<tr><td>Nom : </td><td>".$info['Nom']."</td></tr>";
      echo "<tr><td>Prénom : </td><td>".$info['prenom']."</td></tr>";
      echo "<tr><td>Date de Naissance : </td><td>".$info['dateNaiss']."</td></tr>";

      $result = mysqli_query($connect,"SELECT * FROM inscription WHERE ideleve = $ideleve");
      //sélection des inscriptions de l'élève séléctionné

		    while ($recap = mysqli_fetch_array($result)){
          //info des séance de l'élève
          $seance_query = "SELECT * FROM seances WHERE idseance = $recap[0]";
    			$detail_seance_query = mysqli_query ($connect, $seance_query);
          if (!$detail_seance_query) { // TOUJOURS tester le resultat de la requete
            echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
            exit; }

          //Selection des infos de la séance
    			$detail_seance = mysqli_fetch_array($detail_seance_query);
          //theme des séances
    			$detail_theme_query = mysqli_query($connect,"SELECT * FROM themes WHERE idtheme = $detail_seance[3]");
          if (!$detail_theme_query) { // TOUJOURS tester le resultat de la requete
            echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
            exit; }
          //Theme de la séance
    			$detail_theme = mysqli_fetch_array($detail_theme_query);

    			if ($recap[2] < 50 and $recap[2]>= 0) //Si la séance est notée (note qui vaut 50), on l'affiche 
    			{
    				echo "<br><br><tr><td> Séance de ".$detail_theme[1]." le ".$detail_seance[1]." : </td><td><b>".$recap[2]."</b></td></tr>";
    			}
		}

      echo"</form>";
      echo "</table>";
      echo"</div>";

    }
    mysqli_close($connect);
  ?>
</body>
</html>
