
<?php
include '../Client/connect.php'; // Assuming 'connect.php' establishes database connection

// Define the number of products per page
$productsPerPage = 6;

$lignecategory = "SELECT category_id FROM categories LIMIT 1 OFFSET 8";
$resultat = $bdd->query($lignecategory);
$resultatcategory = $resultat->fetchColumn();

// Get the total number of products
$totalProductsQuery = "SELECT COUNT(category_id) AS total_products FROM products where category_id = '$resultatcategory'";
$totalProductsResult = $bdd->query($totalProductsQuery);
$totalProducts = $totalProductsResult->fetchColumn(); // Get the total count

// Determine the current page (handle potential issues)
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}

// Calculate the offset for the current page
$offset = ($currentPage - 1) * $productsPerPage;

// Fetch products for the current page
$productQuery = "SELECT * FROM products WHERE category_id = '$resultatcategory' ORDER BY product_id DESC LIMIT $productsPerPage OFFSET $offset";
$productResult = $bdd->query($productQuery);
$products = $productResult->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total number of pages
$totalPages = ceil($totalProducts / $productsPerPage);

// Pagination links logic (replace with your desired presentation)
$paginationLinks = '';
if ($totalPages > 1) {
    // Previous page link (if not on first page)
    if ($currentPage > 1) {
        $previousPage = $currentPage - 1;
        $paginationLinks .= '<a href="?page=' . $previousPage . '">Retour</a> ';
    }

    // Page number links (display a limited range around current page)
    $startPage = max(1, $currentPage - 2); // Adjust range as needed
    $endPage = min($totalPages, $currentPage + 2);
    for ($i = $startPage; $i <= $endPage; $i++) {
        $isActive = $i === $currentPage ? ' class="active"' : '';
        $paginationLinks .= '<a href="?page=' . $i . '"' . $isActive . '>' . $i . '</a> ';
    }

    // Next page link (if not on last page)
    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        $paginationLinks .= '<a class="text-white text-dcoration-none" href="?page=' . $nextPage . '">Suivant</a>';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/acc.css">

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!--navbar-->
    <?php include 'interfaceclient1.php';?>
    <?php include 'menu2client.php';?>


  <div class="produit">
    <h2> Nos prduits les plus convoités</h2>
    <p><em>faites-vous plaisir avcec shopping-in-line</em></p>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($products as $produit) {?>
        <div class="col">
          <div class="card h-100 w-75">
            <img src="<?=$produit['image']?>" class="card-img-top h-75" alt="..." id="overflow">
            <div class="card-body">
              <h5 class="card-title"><?=$produit['name']?></h5>
              <p class="card-text text-start">Prix : <small class="text-body-secondary" style="margin-right: 25px;"><?=$produit['price']?> fcfa</small>
                <button type="button" class="btn btn-warning"><a class="text-white text-decoration-none" href="panier.php?id=<?=$produit['product_id']?>">Plus--></a></button>
              </p>
            </div>
          </div>
        </div>
      <?php }?>
    </div>

    <?php if ($totalPages > 1): ?>
        <br>
      <div class="pagination justify-content-center">
        <button type="button" class="btn btn-warning "><?=$paginationLinks?></button>
      </div><br>
    <?php endif;?>
  </div><br>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>