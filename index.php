<?php include "header.php" ?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Whats Up Evaluation</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<body>

<section>
  <?php
  if (isset($_SESSION["id"])) {
    echo "<h1>Hello Bienvenue, \n <span style='color:black;' >" . htmlspecialchars($_SESSION["firstname"]) . "  ".  htmlspecialchars($_SESSION["lastname"]) . "</span> sur ce nouveau site </h1>";
  } else {
    echo "<h1>Bienvenue sur ce nouveau site </h1>";
  }
  ?>
  </section>

  <div>
    <h2>Ce site parlera de films, pour voir la liste de film veuillez cliquer sur l'onglet movie au dessus</h2>
    <h2>Afin de pouvoir rajouter ou supprimer du contenue veuillez vous <a href="subscribe.php">Inscrire</a> et vous <a href="login.php">Connecter</a></h2>
  </div>


  <?php include "footer.php" ?>
  <script type="text/javascript" src="js/script.js" async defer></script>
</body>

</html>
