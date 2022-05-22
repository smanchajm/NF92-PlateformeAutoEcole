<?php
  // Code me permettant de me connecter à la BDD pour chaque autre code

  date_default_timezone_set('Europe/Paris');
  $date = date("Y-m-d");

  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p057';
  // remplacer les SXXX avec le semestre et le numero de votre compte
  // exemples nf92p014 ou nf92a078
  $dbpass = 'Nz6qWsvN';
  // remplacer votremotdepasse par votre mot de passe
  $dbname = 'nf92p057'; // remplacer les  comme indiqué ci-dessus
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error
  connecting to mysql');
  //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe
  //et le serveur mysql
  mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont
  //encodées en UTF-8
  ?>
