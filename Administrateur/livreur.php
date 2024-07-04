<?php
include ('connect1.php');

$requete1 = "SELECT first_name,last_name FROM client where profil='ADMIN'";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM livreur order by livreur_id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$livreur = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) FROM livreur";
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
                <button class="btn btn-warning"><a href="ajouterlivreur.php">Nouveau</a></button>
                <strong>Total Livreur : <?= $productCount; ?> </strong>
            </div><br><br>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prenon</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Déplacement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php foreach ($livreur as $ligne): ?>
                <tbody>
                    <tr>
                        <td><?= $ligne['livreur_id'] ?></td>
                        <td><?= $ligne['nom'] ?></td>
                        <td><?= $ligne['prenom'] ?></td>
                        <td><?= $ligne['telephone'] ?></td>
                        <td><?= $ligne['email'] ?></td>
                        <td><?= $ligne['vehicule'] ?></td>
                        <td>
                            <p class="bloc">
                                <li class="nav-item dropdown bg-warning text-center " style="list-style-type: none;">
                                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item "
                                                href="modifierlivreur.php?MD=<?= $ligne['livreur_id'] ?>">Modifier</a></li>
                                        <li><a class="dropdown-item"
                                                href="supprimerlivreur.php?id=<?= $ligne['livreur_id'] ?>"
                                                onclick="return confirm('voulez-vous supprimer ?')">Supprimer</a></li>
                                    </ul>
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