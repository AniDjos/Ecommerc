<?php
include ('connect1.php');

include ('connect.php');


$requete1 = "SELECT identite FROM user where profil='ADMIN' ";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="css/menu.css">
    <title>Shopping-in-line</title>
</head>

<div data-bs-spy="scroll" data-bs-target=".navbar">
    <?php include ('adminmenu.php'); ?>

    <div class="mod_cat">
        <h2 class="text-center text-warning">Ajouter une nouvelle categorie de produit</h2>
        <br>
        <form method="Post" action="validerajoutcat.php"  class="row g-3 needs-validation" novalidate>
                <div class="mb-3" >
                    <label for="formFile" class="form-label">Categorie :</label><br>
                    <input class="form-control" type="text" id="formFile" name="cat" >
                </div>
                <p class="bloc">
                    <button type="submit" class="btn btn-warning" name="valider">Valider</button>
                    <button type="reset" class="btn btn-emphasis" name="Annuler">Annuler</button>
                </p>
          </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>