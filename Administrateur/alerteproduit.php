<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="icon" href="logo.php" type="image/x-icon" >
    <title>Shopping-in-line</title>
</head>
<body>

<nav class="navbar bg-body-tertiary " style="margin-bottom:15px">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Shopping-in-line</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="menuAdmin.php">Acceuil</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<?php include('alerte.php'); ?>
<?php
if (!empty($stockAlerts)) {
    echo '<div class="alert">';
    foreach ($stockAlerts as $alertData) {
        echo "<div class='card w-50 mx-auto '> ";
        echo "<div class='card-header alert-message text-center text-white bg-danger'><i class='bi bi-exclamation-triangle'></i>";
        echo "{$alertData['alertMessage']}";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>PRODUIT ID [{$alertData['productId']}] : {$alertData['name']}</h5>";
        echo "<p class='card-text'>Veuillez-vous approvisionner ! Vous ne disposez plus de produit en stock.</p>";
        echo "<p class='card-text'> Voulez-vous contacter votre fournisseur ?  Rejoindre au <span class='text-primary' style='cursor:pointer;'>'+229 66-45-77-09'</span></p>";
        echo "</div>";
        echo "</div><br><br>";
    }
    echo '</div>';
}
?>



</body>
</html>