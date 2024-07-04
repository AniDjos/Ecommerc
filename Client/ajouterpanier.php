<?php
function encryptLink($data, $key)
{
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decryptLink($data, $key)
{
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}

$encryptionKey = 'your-secret-key'; // Change this to your actual key
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

    <!--navbar-->
<?php include'interfaceclient1.php'; ?><br><br>


    <?php
session_start();

// Check if cart exists in session
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    if (!empty($cart)):
    ?>

            <div class="panierajouter">
                <table>
                    <thead class="text-warning">
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Valider</th>
                        </tr>
                    </thead>
                    <?php foreach ($cart as $ligne): ?>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="bloc">
                                        <div class="image">
                                            <img src="<?=$ligne['image'];?>" alt="">
                                        </div>
                                        <div class="paragraphe">
                                            <p id="nom"><?=$ligne['name'];?></p>
                                            <p class="text-danger"><span>Aucune réduction disponible</span></p>
                                            <p><a href="supprimerpanier.php?id=<?=$ligne['product_id'];?>"><i class="bi bi-trash3"></i></a></p>
                                        </div>
                                    </div>
                                </td>
                                <td><?=$ligne['price'];?> fcfa</td>
                                <td>
                                    <form action="update_quantity.php" method="post"> <input type="hidden" name="product_id" value="<?=$ligne['product_id'];?>">
                                        <input type="number" name="quantity" value="<?=$ligne['quantity'];?>" min="1">
                                        <button type="submit" class="btn btn-sm"><i class="bi bi-highlighter text-warning"></i></button>
                                        <?php $message?>
                                    </form>
                                </td>
                                <td><?=number_format($ligne['price'] * $ligne['quantity'], 2, '.', ',');?> fcfa</td>
                                <td><button type="button" class="btn btn-warning "><a href="paiement.php?id=<?=urlencode(encryptLink($ligne['product_id'], $encryptionKey));?>" class="text-decoration-none text-white">Acheter</a></button></td>
                                </tr>
                        <?php endforeach;?>
                        </tbody>
                </table>
            </div>

        <?php else: ?>
            <div class="alert alert-info w-50 mt-4 m-auto text-center" role="alert">
                <i class="bi bi-basket2 fs-1"></i>
                <p>Vous ne diposez d'un produit dans votre panier !</p>
            </div>
        <?php endif;?>

    <?php
} else {
    echo " <div class='alert alert-info w-50 mt-4 m-auto text-center' role='alert'>";
    echo "<i class='bi bi-basket2 fs-1'></i>";
    echo " <p>Vous ne diposez d'un produit dans votre panier !</p>";
    echo " </div>";
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>