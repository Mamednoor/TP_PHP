<?php
include "header.php";
$_SESSION["Back"] = $_SERVER["HTTP_REFERER"];
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Formulaire de création</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
if(isset($_SESSION["id"]) != 0 ) {
  ?>
  <form action="backend/addMovie.php" method="post" enctype="multipart/form-data">
  <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
  <div class="card">
    <fieldset>
      <legend>
        <h3>Ajouter une film</h3>
      </legend>

      <label for="title">Titre : </label>
      <input required id="title" name="title" type="text">

      <label for="director">Réalisateur : </label>
      <input required id="director" name="director" type="text">

      <label for="picture">Affiche : </label>
      <input required id="picture" class="form-input" name="picture" type="file">
      <div class="preview" id="preview"></div>


      <label for="genre">Genre : </label>
      <select name="genre" id="genre" name="genre" required>
        <option value="">--Choisir le genre--</option>
        <option value="fantastique">Fantastique</option>
        <option value="action">Action</option>
        <option value="comédie">Comédie</option>
        <option value="horreur">Horreur</option>
        <option value="manga">Manga</option>
      </select>

      <label for="description">Description : </label>
      <textarea required id="description" name="description" type="text"></textarea>

      <button type="submit">Ajouter</button>
    </fieldset>
  </div>
  </form>
  <?php 
  } else echo "<h1>Merci de vous connecter afin d'accéder à cette page</h1>";
  ?>
  <script type="text/javascript" src="js/script.js" async defer></script>

</body>

</html>