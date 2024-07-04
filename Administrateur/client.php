<?php
include ('connect1.php');

$requete1 = "SELECT first_name,last_name FROM client where profil='ADMIN' ";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM client order by client_id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$client = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) FROM client";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$productCount = $stmt->fetchColumn();



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

    <div class="cadre">
        <table>
            <div class="menuproduit">
                <button class="btn btn-warning">Nouveau</button>
                <strong>Total Client : <?= $productCount; ?> </strong>
            </div><br>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prenon</th>
                    <th>Sexe</th>
                    <th>Photo</th>
                    <th>Age</th>
                    <th>Ville</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php foreach ($client as $ligne): ?>
                <tbody>
                    <tr>
                        <td><?= $ligne['client_id'] ?></td>
                        <td><?= $ligne['first_name'] ?></td>
                        <td><?= $ligne['last_name'] ?></td>
                        <td><?= $ligne['sexe'] ?></td>
                        <td> <img src="<?= $ligne['photo'] ?>" alt=""></td>
                        <td><?= $ligne['age'] ?></td>
                        <td><?= $ligne['ville'] ?></td>
                        <td>
                            <p class="bloc">
                                <li class="nav-item  bg-warning text-center " style="list-style-type: none;">
                                    <a class="nav-link  text-white" href="detailclient.php?id=<?= $ligne['client_id'] ?>" role="button" >
                                        Détails
                                    </a>
                                </li>
                            <p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>