<?php
session_start();

// Function to decrypt the link
function decryptLink($data, $key)
{
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}

$encryptionKey = 'your-secret-key'; // Same key as in the cart page

// Récupérer et décrypter l'ID du produit
if (isset($_GET['id'])) {
    $productId = decryptLink($_GET['id'], $encryptionKey);
    
    // Vérifier si le produit existe dans le panier de la session
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        $productFound = false;

        foreach ($cart as $product) {
            if ($product['product_id'] == $productId) {
                $productFound = true;
                $productName = htmlspecialchars($product['name']);
                $productImage = htmlspecialchars($product['image']);
                $productPrice = htmlspecialchars($product['price']);
                $productQuantity = htmlspecialchars($product['quantity']);
                $productTotal = number_format($product['price'] * $product['quantity'], 2, '.', ',');
                break;
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Formulaire Dynamique</title>
    <style>
        .form-container {
            display: none;
        }
    </style>
</head>

<body>
    <?php include 'interfaceclient1.php';?><br><br><br>
    <div class="d-flex card w-50 mt-5 m-auto p-5">
        <div class="container">
            <div class="text-center mb-2">
                <button id="btnForm1" class="btn bg-white">
                    <img src="../image/logo_moov.jpg" alt="" style="width:6rem;">
                </button>
                <button id="btnForm2" class="btn bg-white">
                    <img src="../image/Mtn-logo.png" alt="" style="width:6rem">
                </button>
                <p><em>Cliquez sur les logos pour choisir votre moyen de payement</em></p>
            </div>

            <div id="form1" class="form-container">
                <h2 class="text-center mb-2">Paiement par Moov Money</h2>
                <form action="validerpaim1.php" method="post">
                    <div class="mb-3">
                        <label for="nom1" class="form-label">Nom Produit</label>
                        <input type="text" class="form-control" id="nom1" value="<?php echo htmlspecialchars($productName); ?>" name="nomprod" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nom1" class="form-label">Prix</label>
                        <input type="text" class="form-control" id="nom1" value="<?php echo htmlspecialchars($productPrice); ?>" name="prix" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nom1" class="form-label">Quantité</label>
                        <input type="text" class="form-control" id="nom1" value="<?php echo htmlspecialchars($productQuantity); ?>" name="quantite" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nom1" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom1" name="nom1" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom1" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom1" name="prenom1" required>
                    </div>
                    <div class="mb-3">
                        <label for="montant1" class="form-label">Montant</label>
                        <input type="text" class="form-control" id="montant1" value="<?php echo htmlspecialchars($productTotal); ?>" name="montant1" readonly>
                    </div>
                    <button type="submit" class="btn btn-success">Valider</button>
                </form>
            </div>

            <div id="form2" class="form-container">
                <h2 class="text-center mb-2">Paiement par Money MTN</h2>
                <form action="submit_form2.php" method="post">
                    <div class="mb-3">
                        <label for="nom2" class="form-label">Numéro</label>
                        <input type="tel" class="form-control" id="nom2" name="tel" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom2" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom2" name="nom2" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom2" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom2" name="prenom2" required>
                    </div>
                    <div class="mb-3">
                        <label for="montant2" class="form-label">Montant</label>
                        <input type="text" class="form-control" id="montant1" value="<?php echo htmlspecialchars($productTotal); ?>" name="montant1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="montant2" class="form-label">Code </label>
                        <input type="text" class="form-control" id="montant1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Valider</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Show the first form and hide the second form by default
        document.getElementById('form1').style.display = 'block';

        document.getElementById('btnForm1').addEventListener('click', function () {
            document.getElementById('form1').style.display = 'block';
            document.getElementById('form2').style.display = 'none';
        });

        document.getElementById('btnForm2').addEventListener('click', function () {
            document.getElementById('form1').style.display = 'none';
            document.getElementById('form2').style.display = 'block';
        });
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
