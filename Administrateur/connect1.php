<?php
$hostname = "localhost";
$database = "db_vente";
$username = "root";
$password = "";

// Establish database connection
try {
  $dsn = "mysql:host=$hostname;dbname=$database;charset=utf8";
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}