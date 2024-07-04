<?php

// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=db_vente;charset=utf8', 'root', '');

// Validate and sanitize input
$nouveauNom = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_STRING);
$idCat = filter_input(INPUT_GET, 'MD', FILTER_SANITIZE_NUMBER_INT);

// Check if input is valid (non-empty and numeric for ID)
if (empty($nouveauNom) || !is_numeric($idCat)) {
    echo "Invalid input. Please provide a category name and ID.";
    exit;
}

// Prepare the UPDATE statement
$sql = "UPDATE categories 
        SET name = :categorie
        WHERE category_id = :id;";
$stmt = $db->prepare($sql);

// Bind sanitized values to parameters
$stmt->bindParam(':categorie', $nouveauNom);
$stmt->bindParam(':id', $idCat);

// Try executing the UPDATE statement
try {
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        echo "Category updated successfully!";
        header('refresh:0.5 url=categorieprod.php');
    } else {
        echo "No records were updated.";
    }
} catch (PDOException $e) {
    // Handle database errors
    echo "Error updating category: " . $e->getMessage();
}

?>