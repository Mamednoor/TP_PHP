<?php 
session_start();
require_once "../db/config.php";

try {
    if(isset($_POST["title"]) AND isset($_POST["director"]) AND isset($_POST["genre"]) AND isset($_POST["description"]) AND isset($_FILES["picture"]) AND $_FILES["picture"]["error"] == 0) {
      if (isset($_POST['token']) AND hash_equals($_POST['token'], $_SESSION['token'])) {
      if ($_FILES['picture']['size'] <= 1000000) {
        $infos_files = pathinfo($_FILES['picture']['name']);
        $extension_file = $infos_files['extension'];
        $extensions_images = array('jpg', 'jpeg', 'png');
        $title = $_POST["title"];
        $director = $_POST["director"];
        $genre = $_POST["genre"];
        $description = $_POST["description"];

        if (in_array($extension_file, $extensions_images)) {
          $filename =uniqid(). str_replace(' ', '_', $_FILES['picture']['name']);
          $picture_path = "../images/$filename";
          if (move_uploaded_file($_FILES['picture']['tmp_name'], '../images/' . $filename)) {

            $sqlCreate = "INSERT INTO movies(title, director, genre, description, picture) VALUES (:title, :director, :genre, :description, :picture)";
            
            $req = $bdd->prepare($sqlCreate);
            $req->bindValue(':title', $title);
            $req->bindValue(':director', $director);
            $req->bindValue(':genre', $genre);
            $req->bindValue(':description', $description);
            $req->bindValue(':picture', $picture_path);
            $req->execute();
            $req->closeCursor();
            header("location: ../movies.php");
            $bdd = null;
          } else echo "Probleme lors du téléchargement de l'image";
        } else echo "Ce fichier n'est pas une image";
      } else echo "Fichier trop volumineux";
    } else echo "Une Erreur est survenue";
  } else echo "Vous n'avez pas remplis tous les champs";

} catch(PDOException $err) {
  echo "Error: " . $err->getMessage();
}
