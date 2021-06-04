<?php
session_start();

try {
  require_once "../db/config.php";
  if(isset($_POST["title"]) AND isset($_POST["director"]) AND isset($_POST["genre"]) AND isset($_POST["description"]) AND isset($_POST["id"])) {
    if (isset($_POST['token']) AND hash_equals($_POST['token'], $_SESSION['token'])) {
      $title = $_POST["title"];
      $director = $_POST["director"];
      $genre = $_POST["genre"];
      $description = $_POST["description"];
      $id = $_POST['id'];

    $sqlUpdate = "UPDATE movies SET title=:title, director=:director, genre=:genre, description=:description where id=:id";
    $sqlSelectImg = "SELECT picture FROM movies where id=:id";
    $sqlNewImg = "UPDATE movies SET picture=:picture where id=:id";

    $req = $bdd->prepare($sqlUpdate);

    $req->bindValue(':title', $title);
    $req->bindValue(':director', $director);
    $req->bindValue(':genre', $genre);
    $req->bindValue(':description', $description);
    $req->bindValue(':id', $id);
    $req->execute();
    header("location: ../movies.php");

    if (isset($_FILES['picture']) and $_FILES['picture']['error'] == 0) {
      if ($_FILES['picture']['size'] <= 1000000) {
        $infos_files = pathinfo($_FILES['picture']['name']);
        $extension_file = $infos_files['extension'];
        $extensions_images = array('jpg', 'jpeg', 'png');

        if (in_array($extension_file, $extensions_images)) {
          $filename =uniqid(). str_replace(' ', '_', $_FILES['picture']['name']);
          $picture_path = "../images/$filename";
          if (move_uploaded_file($_FILES['picture']['tmp_name'], '../images/' . $filename)) {

            $delOlder = $bdd->prepare($sqlSelectImg);
            $delOlder->bindValue(":id", $id);
            $delOlder->execute();
            header('Location: ' . $_SESSION['Back']);
            $movie = $delOlder->fetch();
            if (isset($movie['picture'])) {
              unlink($movie['picture']);
            }
            $delOlder->closeCursor();

            $req = $bdd->prepare($sqlNewImg);
            $req->bindValue(':picture', $picture_path);
            $req->bindValue(':id', $id);
            $req->execute();
            $bdd = $bdd;
          } else {
            echo "Probleme lors du téléchargement de l'image";
          }
        } else {
          echo "Ce fichier n'est pas une image";
        }
      } else {
        echo "Fichier trop volumineux";
      }
    }

    } else echo "Une erreur est survenue";
  } else echo "Les champs de sont pas remplis";

} catch (PDOException $err) {
  echo "Error: " . $err->getMessage();
}
