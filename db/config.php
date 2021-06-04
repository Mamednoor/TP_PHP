<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', ''); // add your Username
define('DB_PASSWORD', ''); // add your Password
define('DB_NAME', 'eval_charly');
define('DB_PORT', '3306');

 
try{
    $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $err){
    die("ERROR: Could not connect. " . $err->getMessage());
}
