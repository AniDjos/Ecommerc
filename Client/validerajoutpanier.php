<?php

// Function to retrieve product data from a database
function getProductById($product_id)
{
    // Replace with your actual database connection details
    $dbHost = "localhost";
    $dbName = "db_vente";
    $dbUsername = "root";
    $dbPassword = "";

    try {
        // Connect to the database
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the query to fetch product data
        $query = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $db->prepare($query);

        // Bind the product ID parameter to the prepared statement
        $stmt->bindParam(':product_id', $product_id);

        // Execute the query and fetch the result as an associative array
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Close the database connection
        $db = null;

        return $product;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null; // Or handle the error differently
    }
}
// Rest of your code remains the same...

session_start();

// Check if product ID is provided
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $product = getProductById($product_id);

    if ($product) {
        // Access cart session
        $cart = &$_SESSION['cart'];

        // Check if product is already in cart
        if (isset($cart[$product_id])) {
            // Increment quantity
            $cart[$product_id]['quantity']++;
        } else {
            // Add new item to cart
            $cart[$product_id] = [
                'product_id' => $product['product_id'],
                'name' => $product['name'],
                'image' => $product['image'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
        // Redirect to cart page
        header('Location: ajouterpanier.php');
        exit;
    } else {
        // Handle product not found error
        echo 'Produit introuvable.';
    }
} else {
    // Handle missing product ID error
    echo 'Identifiant de produit manquant.';
}
?>