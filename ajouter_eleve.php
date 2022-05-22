<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter élève</title>
    <link rel="stylesheet" href="CSS/style.css" />
  </head>

  <body>
    <?php

      include 'connexion.php';

      $nom =strtoupper($_POST['nom']);
      $prenom = strtoupper($_POST['prenom']);
      $datenaissance = strtoupper($_POST['datenaissance']);
      $age = date_diff(date_create($datenaissance), date_create($date)); //calcul de l'âge



      // On vérifie que tous les champs sont remplis
      if (empty($nom) or empty($prenom) or empty($datenaissance)) {
        echo "Erreur, <br /> un champ n'est pas rempli.";
      }

      elseif ($datenaissance>$date){    //Vérifications de l'âge
        echo "Erreur, <br/> L'éleve n'est pas né !";
      }

      elseif (($age->format('%y')) < 15){
        echo "Erreur, <br/> L'éleve est trop jeune !";
      }

      else {//Insertion de l'élève dans la BDD eleves
        $query = "insert into eleves values ( NULL, '$nom', '$prenom', '$datenaissance', '$date' )";
        // Récapitulatif
        echo "</br><p>Récapitulatif de votre inscritption</p></br>";
  			echo "<p>Nom : ".$nom."</p></br>";
  			echo "<p>Prénom : ".$prenom."</p></br>";
  			echo "<p>Date de naissance : ".$datenaissance."</p></br>";
  			echo "<p>Inscription faite le ".$date."</p>";

        echo "<br><p>$query</p>";
        //Affichage de la requête

        $result = mysqli_query($connect, $query); //Insertion dans la BDD
        // $query utilise comme parametre de mysqli_query
        // le test ci-dessous est desormais impose pour chaque appel de : mysqli_query($connect, $query);

        if (!$result)
        {
        echo "<br>pas bon".mysqli_error($connect);
        }

      }
      mysqli_close($connect);

    ?>
  </body>
</html>
