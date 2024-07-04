<?php

// Connect to the database (replace with your credentials)
$db = new PDO('mysql:host=localhost;dbname=db_vente;charset=utf8', 'root', '');

// Get all product IDs and corresponding stock from the 'produit' table
$query = "SELECT product_id, stock FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize an empty array to store updated stock information
$updatedStocks = [];

// Iterate through each product
foreach ($products as $product) {
    $productId = $product['product_id'];
    $currentStock = $product['stock'];

    // Initialize the updated stock as the current stock
    $updatedStock = $currentStock;

    // Check for orders related to this product
    $query = "SELECT SUM(quantity) AS total_ordered FROM order_lines WHERE product_id = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
    $totalOrdered = $stmt->fetchColumn();

    if ($totalOrdered->rowCount() > 0) {
        echo" $currentStock";
    }else{
        
        if ($totalOrdered > 0) {
            $updatedStock = $currentStock - $totalOrdered;
        }
        echo "$updatedStock" ;
    }
    }
    
?>
