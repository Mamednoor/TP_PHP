<?php
session_start();


if (isset($_GET["id"])) {
  try {
    require_once "../db/config.php";
    $id = $_GET["id"];
    $sqlSelectImg = "SELECT picture FROM movies where id=:id";
    $sqlDeleteImage = "UPDATE movies SET picture=null where id=:id";
    $req = $bdd->prepare($sqlSelectImg);
    $req->bindValue(':id', $id);
    $req->execute();
    $movie = $req->fetch();
    if (isset($movie['picture'])) {
      unlink($movie['picture']);
    }
    $reqVal = $bdd->prepare($sqlDeleteImage);
    $reqVal->bindValue(':id', $id);
    $reqVal->execute();
    $reqVal->closeCursor();
    $reqVal = $bdd;
    echo "L'image à été correctement supprimer";
  } catch (PDOException $err) {
    echo "Error: " . $err->getMessage();
  }
}
