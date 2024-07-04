<?php
include ('../Client/connect.php');

$requete1 = "SELECT name FROM categories ";
$requete2 = $bdd->query($requete1);
$requete3 = $requete2->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/form.css">
  <title>Shopping-in-line</title>
</head>

<body>
  <div class="cadre2">
    <div class="image2">
      <img src="../image/logo.png" alt="">
    </div>
    <div class="forme2">
      <h2 class="text-center text-warning"> Ajouter de nouveau produit</h2>
      <form method="Post" action="validerproduit.php" enctype="multipart/form-data" class="row g-3 needs-validation"
        novalidate>
        <div class="fr1">
          <div class="md-4" style="margin-right: 20px;">
            <label for="validationDefault01" class="form-label">Nom :</label>
            <input type="text" name="nom" class="form-control" id="validationDefault01" required>
          </div>
          <div class="md-4">
            <label for="validationDefault02" class="form-label">Prix :</label>
            <input type="text" name="prix" class="form-control" id="validationDefault02" required>
          </div>
        </div>
        <div class="fr2">
          <div class="mb-3" style="margin-right: 20px;">
            <label for="formFile" class="form-label">Disponible en stock :</label>
            <input class="form-control" type="number" id="formFile" name="stock" required>
          </div>
          <div class="mb-3" style="margin-right: 20px;">
            <div class="mb-3" style="margin-right: 20px;">
              <label for="formFile" class="form-label">Photo du produit :</label>
              <input class="form-control" type="file" id="formFile" name="photo" accept="photo/*" required>
            </div>
          </div>
        </div>
        <label for="formFile" class="form-label">Catégorie de produit</label>
        <select class="form-select w-100" name="categorie" id="">
          <?php foreach ($requete3 as $categorie) { ?>
            <option value="<?= $categorie['name'] ?>"><?= $categorie['name'] ?></option>
          <?php } ?>
        </select>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea class="form-control" id="description" rows="3" name="description"></textarea>
        </div>
        <p class="bloc">
          <button type="submit" class="btn btn-warning" name="valider">Valider</button>
          <button type="reset" class="btn btn-emphasis" name="Annuler">Annuler</button>
        </p>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>
</body>
</html>