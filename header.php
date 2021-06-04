<?php
session_start();
if(!isset($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token=$_SESSION['token'];
?>
<header>
  <nav class="navbar">
      <div class="nav-links">
        <a href="index.php">Accueil</a>
        <a href="movies.php">Movies</a>
        <?php
        if (!isset($_SESSION['id'])==true) {
          ?>
          <a href="subscribe.php">Inscription</a>
            <a href="login.php">Connexion</a>
          <?php
        } else {
          ?>
          <a href="addMovie.php">Add Movie</a>
          <a href="backend/logout.php">Déconnexion</a>
        <?php 
        }
        ?>
      </div>
  </nav>
</header>
