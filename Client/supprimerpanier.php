<?php
session_start();

// Check if cart and product ID are provided
if (isset($_SESSION['cart']) && isset($_GET['id'])) {
  $cart = $_SESSION['cart'];
  $product_id = (int) $_GET['id']; // Convert ID to integer

  // Check if product ID exists in the cart
  if (isset($cart[$product_id])) {
    // Remove the product from the cart
    unset($cart[$product_id]);

    // Update the session cart
    $_SESSION['cart'] = $cart;

    // Redirect back to the cart page with a success message
    header('Location: ajouterpanier.php?success=Produit+supprimé');
    exit;
  } else {
    // Product ID not found in the cart
    header('Location: ajouterpanier.php?error=Produit+introuvable');
    exit;
  }
} else {
  // Invalid request (missing cart or product ID)
  header('Location: ajouterpanier.php?error=Requête+invalide');
  exit;
}
