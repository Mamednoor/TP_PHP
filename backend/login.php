<?php
session_start();

try {
  require_once "../db/config.php";
  if (isset($_POST['mail']) and isset($_POST['password'])) {

    $mail  = htmlspecialchars($_POST["mail"]);
    $pass_hash = $_POST["password"];
    $token = htmlspecialchars($_POST['token']);

    if (isset($_POST['token']) AND hash_equals($_POST['token'], $_SESSION['token'])) {
      unset($_SESSION['token']);
      $sql = "SELECT * FROM users WHERE mail = :mail";
      $req = $bdd->prepare($sql);
      $req->bindValue(":mail", $mail);
      $req->execute();
      $data = $req->fetch();
      
      if ($data and password_verify($pass_hash, $data["password"])) {
        $_SESSION["firstname"] = $data["firstname"];
        $_SESSION["lastname"] = $data["lastname"];
        $_SESSION["mail"] = $data["mail"];
        $_SESSION["id"] = $data["id"];
        $bdd = null;
        header("location: ../index.php");
      } else echo "Les informations sont incorrectes<br/>";

    } else echo "Une Erreur est survenue";
    $req->closeCursor();
    $bdd = null;
  } else echo "Les champs ne sont pas remplis";
  
} catch (PDOException $err) {
  echo 'Error :' . $err->getMessage();
}