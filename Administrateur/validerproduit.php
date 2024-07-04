<?php
// Define database credentials (consider using environment variables for security)
define("hostname", "localhost");
define("database", "db_vente");
define("username", "root");
define("password", ""); // **Avoid storing password directly in code!**

try {
  // Create PDO connection with exception handling
  $dsn = 'mysql:dbname=' . database . ';host=' . hostname . ';charset=utf8';
  $bdd = new PDO($dsn, username, password);

  // Set error reporting for PDO
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Set default fetch mode for SELECT queries
  $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  // Sanitize and validate user input
  $productName = htmlspecialchars(trim($_POST['nom']));
  $productPrice = filter_var($_POST['prix'], FILTER_SANITIZE_NUMBER_FLOAT);
  $productStock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
  $productCategory = htmlspecialchars(trim($_POST['categorie']));
  $productdescription = htmlspecialchars(trim($_POST['description']));

  // Validate file upload
  if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
    $errorMessage = "Error uploading product image.";
  } else {
    $productImage = basename($_FILES['photo']['name']);
    $imageDirectory = "../photo/"; // Directory for storing images with proper validation

    // Validate image directory and create it if necessary
    if (!is_dir($imageDirectory) && !mkdir($imageDirectory, 0755, true)) {
      $errorMessage = "Error creating image directory.";
    } else {
      $imagePath = $imageDirectory . $productImage;

      // Check if category exists in the database
      $categoryQuery = "SELECT category_id FROM categories WHERE name = '$productCategory'";
      $categoryResult = $bdd->query($categoryQuery);
      $categoryId = null;
      if ($categoryResult->rowCount() > 0) {
        $categoryId = $categoryResult->fetchColumn();
      } else {
        $errorMessage = "Invalid product category.";
      }

      // Check if all required data is present and valid
      if (empty($productName) || empty($productPrice) || empty($productStock) || empty($productCategory) || is_null($categoryId) || empty($productdescription)) {
        $errorMessage = "Please fill in all required fields.";
      } else {
        // Prepare a secure insert statement
        $insertQuery = "INSERT INTO products (name, price, stock, category_id, image,description) VALUES (:name, :price, :stock, :category_id, :image , :description)";
        $stmt = $bdd->prepare($insertQuery);

        // Bind sanitized data to prepared statement parameters
        $stmt->bindParam(':name', $productName);
        $stmt->bindParam(':price', $productPrice);
        $stmt->bindParam(':stock', $productStock);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':description', $productdescription );
        $stmt->bindParam(':image', $imagePath);

        try {
          // Execute the prepared statement
          if ($stmt->execute()) {
            // Upload product image if insertion was successful
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $imagePath)) {
              $successMessage = "Product added successfully.";
            } else {
              $errorMessage = "Error uploading product image.";
            }
          } else {
            $errorMessage = "Error adding product to the database.";
          }
        } catch (PDOException $e) {
          $errorMessage = "Database error: " . $e->getMessage();
        }
      }
    }
  }

  // Display appropriate message to the user
  if (isset($errorMessage)) {
    echo "<script>alert('$errorMessage')</script>";
  } elseif (isset($successMessage)) {
    echo "<script>alert('$successMessage')</script>";
    header('refresh:0.5 url=menuAdmin.php');
  }
} catch (PDOException $e) {
  // Handle connection errors
  echo "Connection failed: " . $e->getMessage();
}

$bdd = null; // Close the database connection (optional)
?>