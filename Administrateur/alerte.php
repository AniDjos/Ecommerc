<?php

// Connect to the database (replace with your credentials)
$db = new PDO('mysql:host=localhost;dbname=db_vente;charset=utf8', 'root', '');

// Function to count alerts
function countAlerts($stockAlerts) {
  return count($stockAlerts);
}

// Get all product IDs, quantities, and names from the tables
$query = "SELECT order_lines.product_id, order_lines.quantity, products.name 
          FROM order_lines 
          INNER JOIN products ON order_lines.product_id = products.product_id";
$stmt = $db->prepare($query);
$stmt->execute();
$productQuantities = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize an empty array to store updated stock values and alert messages
$stockAlerts = [];

// Iterate through each product ID, quantity, and name
foreach ($productQuantities as $productQuantity) {
    $productId = $productQuantity['product_id'];
    $quantity = $productQuantity['quantity'];
    $name = $productQuantity['name'];

    // Get the current stock for the product
    $query = "SELECT stock FROM products WHERE product_id = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
    $currentStock = $stmt->fetchColumn();

    // Calculate the updated stock
    $updatedStock = $currentStock - $quantity;

    // Check if the updated stock is low or zero
    if ($updatedStock <= 5) {
        // Add an alert message for the low-stock product
        $stockAlerts[$productId] = [
            'productId' => $productId,
            'name' => $name,
            'alertMessage' => "**Attention!  produit en rupture de stock.**"
        ];
    }else{
        
        //echo'<div class="alert alert-danger alert-center w-75 mx-auto" role="alert">  A simple danger alert—check it out!</div>';
         
    }  
}
// Count the number of alerts
    $alertCount = countAlerts($stockAlerts);

    if($alertCount > 0) {

        $alerts = $alertCount;
    } 

?>
