
<?php
include('../Client/connect.php'); // Assuming 'connect.php' establishes database connection

// Define the number of products per page
$productsPerPage = 4;


// Get the total number of products
$totalProductsQuery = "SELECT COUNT(product_id) AS total_products FROM products ";
$totalProductsResult = $bdd->query($totalProductsQuery);
$totalProducts = $totalProductsResult->fetchColumn(); // Get the total count

// Determine the current page (handle potential issues)
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
  $currentPage = 1;
}
 
// Calculate the offset for the current page
$offset = ($currentPage - 1) * $productsPerPage;

// Fetch products for the current page
$productQuery = "SELECT * FROM products LIMIT $productsPerPage OFFSET $offset";
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
    $paginationLinks .= '<a class="text-dark text-dcoration-none" href="?page=' . $previousPage . '">Retour</a> ';
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
    $paginationLinks .= '<a class="text-dark text-dcoration-none" href="?page=' . $nextPage . '">Suivant</a>';
  }
}