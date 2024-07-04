
<?php
include 'connect.php';

$requete1 = "SELECT * FROM products ORDER BY product_id DESC LIMIT 6";
$requete2 = $bdd->query($requete1);
$products = $requete2->fetchALL();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/acc.css">
    <link rel="stylesheet" href="../css/footer.css">

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!--navbar-->
    <?php include 'interfaceclient.php';?>
    <?php include 'menu2client.php';?>
<section id="acceuil">
<div class="image_acc">
    <img src="../image/acceuil.jpg" alt="" style="width:75rem;margin-left:10rem">
  </div>
</section>

<section id="produit">
<div class="produit">
    <h2>Mettez à jour votre garde robe avec nos nouveaux produits</h2>
    <p><em>faites-vous plaisir avcec shopping-in-line</em></p><br>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($products as $produit) {?>
        <div class="col">
          <div class="card h-100 w-75">
            <img src="<?=$produit['image']?>" class="card-img-top h-75" alt="..." id="overflow">
            <div class="card-body">
              <h5 class="card-title"><?=$produit['name']?></h5>
              <p class="card-text text-start">Prix : <small class="text-body-secondary" style="margin-right: 2rem;"><?=$produit['price']?> fcfa</small>
                <button type="button" class="btn btn-warning"><a class="text-white text-decoration-none" href="panier.php?id=<?=$produit['product_id']?>">Plus--></a></button>
              </p>
            </div>
          </div>
        </div>
      <?php }?>
    </div><br><br>
    <h2 class="text-center text-warning fs-2">SERVICES</h2>
    <p class="text-center fs-4">Shopping-in-line offrons des service maison en cosmétique ainsi que dans la vente de vêtement</p><br><br>
  </section>

<section id="service">
  <div class="service1">
    <i class="bi bi-flower1"></i><br><br>
    <h3>Makeup</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
  </div>
  <div class="service2">
    <i class="bi bi-truck"></i><br><br>
    <h3>Livraison</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
  </div>
  <div class="service3">
    <i class="bi bi-boxes"></i><br><br>
    <h3>Vente</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
  </div>
</section><br><br><br><br>

<section id="contact">
<h2 class="text-center text-warning fs-2">CONTACTEZ-NOUS</h2>
<p class="text-center">Pour vos interrogations n'hésitez pas à nous contacter</p><br><br>
<div class="contact1">
      <form action="message.php" method="post">
          <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Email address</label>
            <input type="text" name="nom" class="form-control" id="exampleInputName1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1">
          </div>
          <div class="mb-3">
          <label for="exampleInputName1" class="form-label">Message</label>
          <textarea class="form-control" name="message"  id="floatingTextarea"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Contacter</button>
    </form>
  </div><br><br><br>
</section>
<?php include 'footer.php'?>
<script src="scripte.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>