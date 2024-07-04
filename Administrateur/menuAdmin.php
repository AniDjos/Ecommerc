<?php
include 'connect1.php';

$requete1 = "SELECT first_name,last_name FROM client where profil='ADMIN' ";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) FROM products";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$productCount = $stmt->fetchColumn();

include 'Pagination.php';
?>

<?php ?>

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


    <?php include 'adminmenu.php';?>



    <div class="cadre">
        <table>
            <div class="menuproduit">
                <button class="btn btn-warning"><a href="ajouterproduit.php">Nouveau</a></button>
                <strong>Total Produit Disponible : <?=$productCount;?> </strong><br>
            </div>
            </div><br>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Catégorie</th>
                    <th>image</th>
                    <th style="padding-left: 35px;">Action</th>
                </tr>
            </thead>
            <?php foreach ($products as $ligne): ?>
                <tbody>
                    <tr>
                        <td><?=$ligne['product_id']?></td>
                        <td><?=$ligne['name']?></td>
                        <td><?=$ligne['price']?></td>
                        <td><?=$ligne['stock']?></td>
                        <td><?=$ligne['category_id']?></td>
                        <td><img src="<?=$ligne['image']?>" alt=""></td>
                        <td style="padding-left: 35px;">
                            <p class="bloc">
                                <li class="nav-item dropdown bg-warning text-center " style="list-style-type: none;">
                                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item "
                                                href="modifierproduit.php?MD=<?=$ligne['product_id']?>">Modifier</a></li>
                                        <li><a class="dropdown-item"
                                                href="supprimerproduit.php?id=<?=$ligne['product_id']?>"
                                                onclick="return confirm('voulez-vous supprimer ?')">Supprimer</a></li>
                                        <li><a class="dropdown-item"
                                                href="detailproduit.php?id=<?=$ligne['product_id']?>">Détails</a></li>
                                    </ul>
                                </li>
                            <p>
                        </td>
                    </tr>
                <?php endforeach;?>
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