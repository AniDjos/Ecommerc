<?php
include ('connect1.php');

$requete1 = "SELECT first_name,last_name FROM client where profil='ADMIN' ";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) FROM categories";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$productCount = $stmt->fetchColumn();

include 'paginationcat.php';
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
                <button class="btn btn-warning"><a href="ajoutercat.php">Nouveau</a></button>
                <strong>Total Categorie Disponible : <?= $productCount; ?> </strong>
            </div><br>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th style="padding-left: 35px;">Action</th>
                </tr>
            </thead>
            <?php foreach ($categorie as $ligne): ?>
                <tbody>
                    <tr>
                        <td><?= $ligne['category_id'] ?></td>
                        <td><?= $ligne['name'] ?></td>
                        <td style="padding-left: 35px;">
                            <p class="bloc">
                                <li class="nav-item dropdown bg-warning text-center " style="list-style-type: none;">
                                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item "
                                                href="modifiercategorie.php?MD=<?= $ligne['category_id'] ?>">Modifier</a></li>
                                        <li><a class="dropdown-item"
                                                href="supprimercategorie.php?id=<?= $ligne['category_id'] ?>"
                                                onclick="return confirm('voulez-vous supprimer ?')">Supprimer</a></li>
                                    </ul>
                                </li>
                            <p>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($totalPages > 1): ?>
                <div class="pagination justify-content-center">
                    <button type="button" class="btn btn-warning text-dark "><?=$paginationLinks?></button>
                </div><br>
        <?php endif;?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>