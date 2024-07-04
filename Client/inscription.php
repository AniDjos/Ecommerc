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
  <title>Shoppin-in-line</title>
</head>

<body>
  <div class="cadre1">
    <div class="image1">
      <img src="../image/cyber-e-SI-optimized.jpg" alt="">
    </div>
    <div class="forme1">
      <h2> <i class="bi bi-layout-text-window-reverse"></i> Veuillez creer votre compte</h2><br><br>
      <form method="Post" action="validerClient.php" enctype="multipart/form-data" class="row g-3 needs-validation"
        novalidate>
        <div class="fr1">
          <div class="md-4" style="margin-right: 20px;">
            <label for="validationDefault01" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" id="validationDefault01" required>
          </div>
          <div class="md-4">
            <label for="validationDefault02" class="form-label">Prenom:</label>
            <input type="text" name="prenom" class="form-control" id="validationDefault02" required>
          </div>
        </div>
        <div class="fr2">
          <div class="mb-3" style="margin-right: 20px;">
            <label for="formFile" class="form-label">Photo:</label>
            <input class="form-control" type="file" id="formFile" name="photo" accept="photo/*" required>
          </div>
          <div class="mb-4">
            <label for="ageInput" class="form-label">Âge:</label>
            <input type="number" name="age" class="form-control" id="ageInput" required>
          </div>
        </div>
        <div class="fr3">
          <div class="md-4" style="margin-right: 20px;">
            <label for="validationDefault03" class="form-label">Ville:</label>
            <input type="text" name="ville" class="form-control" id="validationDefault03" required>
          </div>
          <div class="md-3">
            <label for="sexCheckbox" class="form-label">Sexe:</label><br>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" id="maleCheckbox" name="sexe" value="Male" required>
              <label class="form-check-label" for="maleCheckbox" style="text-decoration: none;">Masculin</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" id="femaleCheckbox" name="sexe" value="Female" required>
              <label class="form-check-label" for="femaleCheckbox" style="text-decoration: none;">Féminin</label>
            </div>
          </div>
        </div>
        <div class="fr4">
          <div class="md-4" style="margin-right: 20px;">
            <label for="exampleInputEmail1" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="md-4">
            <label for="exampleInputPassword1" class="form-label">Mot de passe:</label>
            <input type="password" name="mdp" class="form-control" id="exampleInputPassword1">
          </div>
        </div>
        <p class="bloc">
          <button type="submit" class="btn btn-primary" name="valider">Valider</button>
          <button type="reset" class="btn btn-emphasis" name="Annuler">Annuler</button>
        </p>
      </form>
    </div>
  </div>




</body>

</html>