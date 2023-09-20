<?php

$host = "localhost";
$username = "root";
$password = "";
$dbName = "tp2";
$port = 3306;

/* $host = "localhost";
$username = "e2395387";
$password = "EXQirVZxt1N1Jp45h92p";
$dbName = "e2395387";
$port = 3306;
 */
$connex = mysqli_connect($host, $username, $password, $dbName, $port);

if(!$connex){
    die('Erreur de connexion: '. mysqli_connect_error());
}

mysqli_set_charset($connex, "utf8");

?>