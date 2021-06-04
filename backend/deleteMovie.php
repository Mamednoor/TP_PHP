<?php
session_start();

if (isset($_GET["id"])) {
  try {
    require_once "../db/config.php";
    $id = $_GET["id"];
    $sqlSelectImg = "SELECT picture FROM movies where id=:id";
    $sqlDelete = "DELETE FROM movies where id=:id";

    $req = $bdd->prepare($sqlSelectImg);
    $req->bindValue(':id', $id);
    $req->execute();
    $movie = $req->fetch();
    if (isset($movie['picture'])) {
      unlink($movie['picture']);
    }
    
    $reqVal = $bdd->prepare($sqlDelete);
    $reqVal->bindValue(':id', $id);
    $reqVal->execute();
    header("location:" .$_SESSION['Back']);
    $reqVal->closeCursor();
    $reqVal = $bdd;
    echo "suppression réussis";
  } catch (PDOException $err) {
    echo "Error: " . $err->getMessage();
  }
}
