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

    <div class="livreur">
    <h2 class="text-center text-warning"></i> Ajouter un nouveau livreur</h2><br><br>
    <p style="border: 0.5px solid  gray; width:95%; margin-right:auto;margin-left:auto;"></p>
            <form method="Post" action="validerajoutlivreur.php" enctype="multipart/form-data"
                class="row g-3 needs-validation" novalidate>
                    <div class="mb-3" style="margin-right: 20px;">
                        <label for="formFile" class="form-label">Téléphone:</label>
                        <input class="form-control" type="tel" id="formFile" name="phone"  required>
                    </div>
                    <div class="md-4" style="margin-right: 20px;">
                        <label for="validationDefault01" class="form-label">Nom:</label>
                        <input type="text" name="nom" class="form-control" id="validationDefault01" required>
                    </div>
                    <div class="md-4">
                        <label for="validationDefault02" class="form-label">Prenom:</label>
                        <input type="text" name="prenom" class="form-control" id="validationDefault02" required>
                    </div>
                    <div class="mb-4">
                        <label for="ageInput" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="ageInput" required>
                    </div>
                    <div class="md-4" style="margin-right: 20px;">
                        <label for="validationDefault03" class="form-label">Déplacement:</label>
                        <select class="form-select w-100" name="deplacement" id="">
                            <option value="moto">moto</option>
                            <option value="Vehicule">Vehicule</option>
                            <option value="velo">velo</option>
                            <option value="tricycle">tricycle</option>
                            <option value="camion">camion</option>
                        </select>
                    </div>

                <p class="bloc text-center">
                    <button type="submit" class="btn btn-warning" name="valider">Valider</button>
                    <button type="reset" class="btn btn-emphasis" name="Annuler">Annuler</button>
                </p>
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>