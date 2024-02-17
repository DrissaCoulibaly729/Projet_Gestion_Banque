<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "gestionbanque";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();

  die("Vers la page d'erreur");
}

//echo"<br><br> Vers la page d'accueil";
?>