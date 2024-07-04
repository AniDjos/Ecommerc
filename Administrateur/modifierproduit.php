<?php
include ('connect1.php');

include ('../Client/connect.php');

$requete1 = "SELECT name FROM categories ";
$requete2 = $bdd->query($requete1);
$requete3 = $requete2->fetchAll();

$requete1 = "SELECT first_name,last_name FROM client where profil='ADMIN' ";
$stmt1 = $pdo->prepare($requete1);
$stmt1->execute();
$identite = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$code = $_GET['MD'];

$requete2 = "SELECT * FROM products where product_id = '$code' ";
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

  <div class="GR_detail">
    <?php foreach ($detail as $afficher) { ?>
      <div class="MY_detail">
        <img src="<?= $afficher['image'] ?>" alt="">
      </div>
      <div class="PT_detail">
        <h2 class="text-center text-warning"> <i class="bi bi-boxes"></i> Modification du produit</h2><br>
        <form method="Post" action="validermodifierproduit.php" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
          <div class="fr1">
            <div class="md-4" style="margin-right: 20px;">
              <label for="validationDefault01" class="form-label">Nom :</label>
              <input type="text" name="nom" class="form-control" id="validationDefault01" value="<?= $afficher['name'] ?>"
                required>
            </div>
            <div class="md-4">
              <label for="validationDefault02" class="form-label">Prix :</label>
              <input type="text" name="prix" class="form-control" id="validationDefault02"
                value="<?= $afficher['price'] ?>" required>
            </div>
          </div>
          <div class="fr2">
            <div class="mb-3" style="margin-right: 20px;">
              <label for="formFile" class="form-label">Disponible en stock :</label>
              <input class="form-control" type="number" id="formFile" name="stock" value="<?= $afficher['stock'] ?>"
                required>
            </div>
            <div class="mb-3" style="margin-right: 20px;">
              <label for="formFile" class="form-label">Catégorie de produit</label>
              <select class="form-select " name="categorie" id="">
                <?php foreach ($requete3 as $categorie) { ?>
                  <option value="<?= $categorie['name'] ?>"><?= $categorie['name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="fr7">
            <div>
              <label for="formFile" class="form-label">Photo du produit :</label>
              <input class="form-control" type="file" id="formFile" name="photo" value="<?= $afficher['image'] ?>"
                required>
            </div>
            <div class="porter">
              <p class="bloc">
                <button type="submit" class="btn btn-warning" name="valider">Valider</button>
                <button type="reset" class="btn btn-emphasis" name="Annuler">Annuler</button>
              </p>
            </div>
          </div>
        </form>
      </div>
    <?php } ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>