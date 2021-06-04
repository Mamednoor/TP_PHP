<?php 
session_start();

require_once "../db/config.php";
  if (isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['mail']) and isset($_POST['password']) and isset($_POST['confirm_password'])) {

    if (isset($_POST['token']) AND hash_equals($_POST['token'], $_SESSION['token'])) {
      
      unset($_SESSION['token']);
      $firstname  = htmlspecialchars($_POST["firstname"]);
      $lastname  = htmlspecialchars($_POST["lastname"]);
      $mail = htmlspecialchars($_POST["mail"]);
      $password = htmlspecialchars($_POST['password']);
      $confirmPass = htmlspecialchars($_POST['confirm_password']);

      if (strcmp($password, $confirmPass) === 0) {
        $pass_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        try {
          $sqlSignup = "INSERT INTO users(firstname, lastname, mail, password) VALUES (:firstname, :lastname, :mail, :password)";
          $req = $bdd->prepare($sqlSignup);
          $req->bindValue(':firstname', $firstname);
          $req->bindValue(':lastname', $lastname);
          $req->bindValue(':mail', $mail);
          $req->bindValue(':password', $pass_hash);
          $req->execute();
          $bdd = $bdd;
          echo "Inscription réussis";
          header("location: ../index.php");
        } catch (PDOException $err) {
          if ($err->getCode() == 23000) {
            die("Cet email est déjà utilisé");
          } else echo 'Error : ' . $err->getMessage();
        }
      } else echo "Les deux mots de passe sont différents";
      
    } else echo "Une Erreur est survenue";
  }
  ?>