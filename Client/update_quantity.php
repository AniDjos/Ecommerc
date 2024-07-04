<?php
session_start();

// Check if cart and product ID are provided
if (isset($_SESSION['cart']) && isset($_POST['product_id'])) {
    $cart = $_SESSION['cart'];
    $product_id = $_POST['product_id'];
    $new_quantity = (int) $_POST['quantity']; // Convert quantity to integer

    // Check if product ID exists in the cart
    if (isset($cart[$product_id])) {
        // Validate new quantity (minimum 1)
        if ($new_quantity >= 1) {
            // **Check stock before updating cart**
            $stock_available = check_stock($product_id); // Replace with your function to get stock
            if ($new_quantity <= $stock_available) {
                // Update quantity in the cart
                $cart[$product_id]['quantity'] = $new_quantity;

                // Update the session cart
                $_SESSION['cart'] = $cart;

                // Redirect back to the cart page with a success message
                header('Location: ajouterpanier.php?success=Quantité+mise+à+jour');
                exit;
            } else {
                // Insufficient stock
                header('Location: ajouterpanier.php?error=Stock+insuffisant');
                exit;
            }
        } else {
            // Invalid quantity (less than 1)
            header('Location: ajouterpanier.php?error=Quantité+invalide');
            exit;
        }
    } else {
        // Product ID not found in the cart
        header('Location: ajouterpanier.php?error=Produit+introuvable');
        exit;
    }
} else {
    // Invalid request (missing cart or product ID)
    header('Location: cart.php?error=Requête+invalide');
    exit;
}

// Function to check product stock (replace with your implementation)
function check_stock($product_id)
{
    // **Consider using environment variables or a separate configuration file for credentials**
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_vente";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection

    // **Consider using prepared statements for security**
    $sql = "SELECT stock FROM products WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $product_id); // Bind product ID as integer

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            return $row['stock'];
        } else {
            // Handle case where product not found in database
            return 0; // Or handle differently based on your needs
        }
    } else {
        // Handle database error (consider logging or displaying a generic error message)
        return 0; // Or handle differently based on your needs
    }

    // Close connection (optional, PHP might handle it automatically on script termination)
    mysqli_close($conn);
}
