<?php
include "header.php";
$_SESSION["Back"] = $_SERVER["HTTP_REFERER"];
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Formulaire de modification</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
  if (isset($_GET["id"])) {
    require_once "./db/config.php";
    $id = $_GET["id"];
    $sqlGetInfo = "SELECT * FROM movies where id=:id";

    $req = $bdd->prepare($sqlGetInfo);
    $req->bindValue(':id', $id);

    $req->execute();
    if (isset($movie['picture'])) {
      unlink($movie['picture']);
    }
    $movie = $req->fetch();
    $req->closeCursor();
    $req = $bdd;
  } else {
    echo "nothing";
  }
?>
<?php
  if(isset($_SESSION["id"]) != 0 ) {
  ?>
  <form action="backend/updateMovie.php" method="post" enctype="multipart/form-data">
  <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
  <div class="card">
    <fieldset>
      <legend>
        <h3>Modifier le film</h3>
      </legend>

      <label for="title">Titre : </label>
      <input required id="title" name="title" type="text" value="<?php echo htmlspecialchars($movie["title"]) ?>">

      <label for="director">Réalisateur : </label>
      <input required id="director" name="director" type="text" value="<?php echo htmlspecialchars($movie["director"]) ?>">

      <label for="picture">Affiche : </label>
      <input id="picture" name="picture" type="file">
      <div class="preview" id="preview">
        <div class="div-img">
          <?php
          if ($movie['picture'] == null) {
            echo "<p> Pas d'image sur cette article </p><br/>";
          } else {
          ?>
            <img src="<?php echo htmlspecialchars($movie["picture"]) ?>" alt="<?php echo htmlspecialchars($movie["titre"]) ?>">
          <?php
            echo "<a title='Delete picture' class='remove-image' href='backend/deleteMovieImg.php?id=" . htmlspecialchars($movie['id']) . "' style='display: inline;'>&#215;</a>";
          }
          ?>
        </div>
      </div>

      <label for="genre">Genre : </label>
      <select name="genre" id="genre" name="genre" required>
        <option value="<?php echo htmlspecialchars($movie["genre"]) ?>"><?php echo htmlspecialchars($movie["genre"]) ?></option>
        <option value="fantastique">Fantastique</option>
        <option value="action">Action</option>
        <option value="comédie">Comédie</option>
        <option value="horreur">Horreur</option>
        <option value="manga">Manga</option>
      </select>

      <label for="description">Description : </label>
      <textarea required id="description" name="description" type="text"><?php echo htmlspecialchars($movie["description"]) ?></textarea>

      <button type="submit">Modifier</button>
    </fieldset>
  </div>
  </form>
  <?php
} else echo "<h1>Merci de vous connecter afin d'accéder à cette page</h1>";
?>
  <script type="text/javascript" src="js/script.js" async defer></script>
</body>

</html>