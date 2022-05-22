<head>
  <meta charset="utf-8">
  <title>Valider séance</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <?php
    //Update des notes dans la BDD
    include 'connexion.php';
    $seance =strtoupper($_POST['seance']);

    //séléction de tous les élèves de la séance
    $result_eleve_query = "SELECT * FROM inscription WHERE idseance = $seance";
    $result_eleve = mysqli_query ($connect, $result_eleve_query);
    if (!$result_eleve) { // TOUJOURS tester le resultat de la requete
      echo 'Impossible d\'exécuter la requête : ' . mysqli_error($connect);
      exit; }

      echo"<div class='form_eleve'>";
      echo "<h2>Récapitulatif</h2>";
      while ($id_eleve = mysqli_fetch_array($result_eleve))
  		{
        //Selection des données d'un élève
  			$eleve = $id_eleve[1];
  			$erreur = $_POST[$eleve];
  			$note = 40 - $erreur;

        $result_nom_query = "SELECT * FROM eleves WHERE ideleve = $eleve";
        $result_nom = mysqli_query ($connect, $result_nom_query);

        while ($eleve = mysqli_fetch_array($result_nom)){
          $nom = $eleve['Nom'];
          $prenom = $eleve['prenom'];
        }

  			if ($erreur <= 40 && $erreur >= 0) // On vérifie que la note est comprise entre 0 et 40
  			{
  				$changer_note = mysqli_query($connect, "UPDATE `inscription` SET note = $note WHERE ideleve = $id_eleve[1] and idseance = $seance;"); // On entre la note si c'est le cas
  				if(!$changer_note)
  				{
  					echo "<br> Erreur :".mysqli_error($connect);
  				}
          echo"".$nom." ".$prenom." : ".$note."";
          echo "<br>";
  			}
  			else
  				echo "Vous avez spécifié un nombre d'erreurs supérieur à 40 ou inférieur à 0. Les notes de ces élèves ne seront pas changées."; // Sinon on ne rentre rien
  		}



    mysqli_close($connect);
  ?>
</body>
</html>
