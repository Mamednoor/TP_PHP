<?php
include "header.php";
$_SESSION["Back"] = $_SERVER["HTTP_REFERER"];
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Movies liste</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php

  if (isset($_GET["id"])) {
    try {
      require_once "db/config.php";
      $id = $_GET["id"];
      $sqlInfo = "SELECT * FROM movies where id=:id";
      $req = $bdd->prepare($sqlInfo);
      $req->bindValue(':id', $id);
      $req->execute();
      $movie = $req->fetch();
      $req->closeCursor();
      $req = $bdd;
    } catch (PDOException $err) {
      echo "Error: " . $err->getMessage();
    }

  ?>
  <div class="card">
    <fieldset>
      <legend align="left">
        <h3><?php echo "<h1>" . htmlspecialchars($movie["title"]) . "</h1>" ?> </h3>
      </legend>
      
      <?php
      if ($movie['picture'] == null) {
        echo "<p> Pas d'image sur cette article </p><br/>";
      } else {
        ?>
        <div class="div-img">
          <img alt="Image de <?php htmlspecialchars($movie['titre']) ?>" class="image" src=<?php echo htmlspecialchars($movie['picture']); ?> />
        </div>
        <?php
      }
      ?>
        <p><?php echo "<p> <strong> Description : </strong> " . htmlspecialchars($movie["description"]) . "</p> " ?></p>
        <p><?php echo "<p> <strong> Genre : </strong> " . htmlspecialchars($movie["genre"]) . "</p> " ?></p>
        <?php
      if (isset($_SESSION["id"]) != 0) {
        echo "<a title='Modifier film' href='updateMovie.php?id=" . htmlspecialchars($movie['id']) . "'>Modifier<a>";
        ?>
      <?php
        echo "<a title='Supprimer film' href='backend/deleteMovie.php?id=" . htmlspecialchars($movie['id']) . "'>Supprimer<a>";
      } else return;
      ?>
    </fieldset>
  </div>
    <?php

  } else {
    require_once "db/config.php";
    $response = $bdd->query('SELECT * FROM movies');
    while ($data = $response->fetch()) {
    ?>
      <div class="card">
      <fieldset>
        <legend align="left">
          <h3><?php echo "<h1>" . htmlspecialchars($data["title"]) . "</h1>" ?> </h3>
        </legend>
        <?php
        if ($data['picture'] == null) {
          echo "<p> Pas d'image sur cette article </p><br/>";
        } else {
        ?>
          <div class="div-img">
            <img alt="Image de <?php htmlspecialchars($data['titre']) ?>" class="image" src=<?php echo htmlspecialchars($data['picture']); ?> />
          </div>
        <?php
        }
        ?>
        <p><?php echo "<p> <strong> Description : </strong> " . htmlspecialchars($data["description"]) . "</p> " ?></p>
        <p><?php echo "<p> <strong> Genre : </strong> " . htmlspecialchars($data["genre"]) . "</p> " ?></p>
        <?php
          echo "<a title='information supplémentaire' href='movies.php?id=" . htmlspecialchars($data['id']) . "'>Plus d'information<a>"
        ?>
        <?php
        if (isset($_SESSION["id"]) != 0) {
          echo "<a title='Modifier film' href='updateMovie.php?id=" . htmlspecialchars($data['id']) . "'>Modifier<a>";
        ?>
        <?php
          echo "<a title='Supprimer film' href='backend/deleteMovie.php?id=" . htmlspecialchars($data['id']) . "'>Supprimer<a>";
        }
        ?>
      </fieldset>
      </div>
  <?php
    }
    $response->closeCursor();
    $bdd = $bdd;
  } 

?>


</body>

</html>