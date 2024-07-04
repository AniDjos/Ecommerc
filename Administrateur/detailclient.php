<?php
include('../Client/connect.php');

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

$requete1 = "SELECT first_name,last_name FROM client where profil='ADMIN' ";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$code=$_GET['id'];

$requete2 = "SELECT * FROM client where client_id = '$code'  ";
$stmt2 = $pdo->prepare($requete2);
$stmt2->execute();
$detail = $stmt2->fetchAll(PDO::FETCH_ASSOC);

 ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/menu.css">

    <title>Shopping-in-line</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">
    <?php include ('adminmenu.php'); ?>

    <div class="GR_detail1">
        <?php foreach( $detail as $afficher){ ?>
        <div class="MY_detail1">
            <img src="../<?=$afficher['photo'] ?>" alt="">
        </div>
        <div class="PT_detail1">
            <h1 class="text-center" style="font-family:Aria">Informations Personnelles</h1><br>
            <h3> <Strong>Identifiant du client :</Strong> <?=$afficher['client_id'] ?></h3>
            <h3> <Strong>Nom du client :</Strong> <?=$afficher['first_name'] ?></h3>
            <h3> <Strong>Prenom du client :</Strong> <?=$afficher['last_name'] ?></h3>
            <h3> <Strong>Sexe :</Strong> <?=$afficher['sexe'] ?></h3>
            <h3> <Strong>Âge :</Strong> <?=$afficher['age'] ?></h3>
            <h3> <Strong>Ville :</Strong> <?=$afficher['ville'] ?></h3>
            <h3> <Strong>Date de création :</Strong> <?=$afficher['created_at'] ?></h3>
            <h3> <Strong>Dernier mise à jour :</Strong> <?=$afficher['updated_at'] ?></h3>
        </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>