<?php 
include "header.php";
$_SESSION["Back"] = $_SERVER["HTTP_REFERER"];
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Formulaire d'inscription</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <form action="backend/subscribe.php" method="post">
  <div class="card">
    <fieldset>
      <legend>
        <h3>Formulaire d'inscription</h3>
      </legend>

      <label for="firstname">Prénom : </label>
      <input required id="firstname" name="firstname" type="text">

      <label for="lastname">Nom : </label>
      <input required id="lastname" name="lastname" type="text">

      <label for="mail">Email : </label>
      <input required id="mail" name="mail" type="email">

      <label for="password">Mot de passe : </label>
      <input required id="password" name="password" type="password" maxlength="10">

      <label for="confirm_password">Confirmation du mot de passe : </label>
      <input required id="confirm_password" name="confirm_password" type="password" maxlength="10">
      <input type="hidden" id="token" name="token" value="<?php echo $token; ?>">

      <button type="submit">Inscription</button>
    </fieldset>
  </div>
  </form>


</body>

</html>