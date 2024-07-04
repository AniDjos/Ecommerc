<?php

// Sanitize and validate user input
$catName = filter_input(INPUT_POST, 'catName');

// Check if required data is present and valid
$isValid = true;
$errorMessage = "";

if (empty($catName)) {
    $isValid = false;
    $errorMessage .= "Please enter a category name. ";
} else if (strlen($catName) < 3) {
    $isValid = false;
    $errorMessage .= "Category name must be at least 3 characters long. ";
} else if (strlen($catName) > 50) {
    $isValid = false;
    $errorMessage .= "Category name cannot exceed 50 characters. ";
}

// Check for duplicate category name
if ($isValid) {
    // Connect to the database (replace with your credentials)
    $db = new PDO('mysql:host=localhost;dbname=db_vente;charset=utf8', 'root', '');

    // Prepare and execute the query to check for duplicate name
    $checkQuery = "SELECT COUNT(*) FROM categories WHERE name = :name";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindParam(':name', $catName);
    $checkStmt->execute();

    $duplicateCount = $checkStmt->fetchColumn();

    // If duplicate found, add error message
    if ($duplicateCount > 0) {
        $isValid = false;
        $errorMessage .= "Category name already exists. Please choose a unique name. ";
    }
}

// If validation passes (including duplicate check), proceed with database operation
if ($isValid) {
    // Prepare and execute the query to insert the category (replace with your actual query)
    $insertQuery = "INSERT INTO categories (name) VALUES (:name)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bindParam(':name', $catName);
    $insertStmt->execute();

    // Handle success or error
    if ($insertStmt->rowCount() > 0) {
        echo "Category added successfully!";
    } else {
        echo "Error adding category.";
    }

    // Close the database connection
    $db = null;
} else {
    // Display error message
    echo $errorMessage;
}

?>
