
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/form.css">
    <title>Document</title>
</head>
<body>
    <div class="cadre">
        <div class="image">
          <img src="../image/cyber-e-SI-optimized.jpg" alt="">
        </div>

        <div class="forme">
            <form action="validerindex.php" method="Post">
                <h2>Connectez-vous</h2><br>
                <div class="mb-4">
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">Votre email est toute securité avec nous...</div>
                </div>
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                  <input type="password" name="mdp" class="form-control" id="exampleInputPassword1">
                </div>
                <p class="bloc">
                  <button type="submit" class="btn btn-primary" name ="connecter">Se connecter</button>
                  <a href="inscription.php">S'inscrire</a>
              </p>
            </form>
        </div>
    </div>



</body>
</html>
