<?php
include ('connect1.php');

include ('../Client/connect.php');


$requete1 = "SELECT first_name,last_name FROM client where profil='ADMIN' ";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$idCat = filter_input(INPUT_GET, 'MD', FILTER_SANITIZE_NUMBER_INT);

$requete2 = "SELECT * FROM categories where category_id = '$code' ";
$stmt2 = $pdo->prepare($requete2);
$stmt2->execute();
$cat = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$requete1 = "SELECT name FROM categories ";
$requete2 = $bdd->query($requete1);
$requete3 = $requete2->fetchAll();



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

<div data-bs-spy="scroll" data-bs-target=".navbar">
    <?php include ('adminmenu.php'); ?>

    <div class="mod_cat">
    <?php foreach ($cat as  $afficher) : ?>
        <form method="Post" action="validermodifiercat.php"  class="row g-3 needs-validation" novalidate>
                <div class="mb-3" >
                    <label for="formFile" class="form-label">Identifiant :</label>
                    <input class="form-control" type="text" id="formFile" name="id"  value="<?= $afficher['category_id'] ?>"
                    >
                </div>
                <div class="mb-3" >
                    <label for="formFile" class="form-label">Ancien :</label>
                    <input class="form-control" type="text" id="formFile"  value="<?= $afficher['name'] ?>"
                    readonly>
                </div>
                <div class="md-4">
                    <label for="formFile" class="form-label">Nouveau :</label>
                    <select class="form-select " name="categorie" id="">
                        <?php foreach ($requete3 as $categories) { ?>
                        <option value="<?= $categories['name'] ?>"><?= $categories['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <p class="bloc">
                    <button type="submit" class="btn btn-warning" name="valider">Valider</button>
                    <button type="reset" class="btn btn-emphasis" name="Annuler">Annuler</button>
                </p>
          </div>
        </form>
    <?php endforeach ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>