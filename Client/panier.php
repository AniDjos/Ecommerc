<?php
include 'connect.php';

$code = $_GET['id'];

$requete1 = "SELECT * FROM products where product_id = '$code '";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/panier2.css">
    <title>Shopping-in-line</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

<?php include 'interfaceclient1.php';?>
<br><br><br>
    <?php foreach ($requete3 as $info): ?>
        <div class="consult1">
            <div class="consult2">
                <img src="<?=$info['image'];?>" alt="">
            </div>
            <div class="consult3">
                <h3><?=$info['name'];?></h3>
                <p class="info"> Coût : <span class="text-danger"><?=$info['price'];?> fcfa</span></p>
                <h3>Détails sur le produit</h3>
                <h6><?=$info['description'];?></h6>
                <br>
                <ul>
                    <li><i class="bi bi-check-lg"></i>Expédition partout au Bénin</li>
                    <li><i class="bi bi-check-lg"></i>Livraison un jour ou deux après paiement</li>
                    <li><i class="bi bi-check-lg"></i>Remboursement non garantir</li>
                </ul><br>
                <form action="validerajoutpanier.php" method="post">
                    <input type="hidden" name="product_id" value="<?=$info['product_id'];?>">
                    <button type="submit" class="btn btn-warning">Ajouter au panier</button>
                </form>
            </div>
        </div>
    <?php endforeach?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>