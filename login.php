<?php
include "header.php";
$_SESSION["Back"] = $_SERVER["HTTP_REFERER"];
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Formulaire de Connexion</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <form action="backend/login.php" method="post">
  <div class="card">
    <fieldset>
      <legend>
        <h3>Formulaire de connexion </h3>
      </legend>

      <label for="mail">Email : </label>
      <input required id="mail" name="mail" type="text">

      <label for="password">Mot de passe : </label>
      <input required id="password" name="password" type="password">
      <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">

      <button type="submit">Connexion</button>
    </fieldset>
  </div>
  </form>

</body>

</html>