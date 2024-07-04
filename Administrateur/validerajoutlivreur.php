<?php

// Sanitize and validate user input
$name = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING); // Use lowercase for consistency
$prenom = htmlspecialchars(trim($_POST['prenom']));
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT); // Sanitize phone number as integer
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validate email format
$vehicule = filter_input(INPUT_POST, 'deplacement', FILTER_SANITIZE_STRING); // Assuming 'deplacement' refers to vehicle

// Check for empty fields and invalid email
$isValid = true;
$errorMessage = "";

if (empty($name) || empty($prenom) || empty($phone) || empty($email) || empty($vehicule)) {
    $isValid = false;
    $errorMessage = "Please fill in all required fields.";
} else if (!$email) { // Check if email validation failed
    $isValid = false;
    $errorMessage = "Please enter a valid email address.";
}

// Insert delivery person only if validation is successful
if ($isValid) {
    // Connect to the database (replace with your credentials)
    $db = new PDO('mysql:host=localhost;dbname=db_vente;charset=utf8', 'root', '');

    // Use prepared statements for secure insertion
    $insertQuery = "INSERT INTO livreur (nom, prenom, telephone, email, vehicule) VALUES (:nom, :prenom, :phone, :email, :vehicule)";
    $insertStmt = $db->prepare($insertQuery);

    $insertStmt->bindParam(':nom', $name);
    $insertStmt->bindParam(':prenom', $prenom);
    $insertStmt->bindParam(':phone', $phone);
    $insertStmt->bindParam(':email', $email);
    $insertStmt->bindParam(':vehicule', $vehicule);

    $insertStmt->execute();

    // Handle success or error
    if ($insertStmt->rowCount() > 0) {
        echo "Delivery person added successfully!";
        header("location:livreur.php?message=ok");
    } else {
        echo "Error adding delivery person.";
    }

    // Close the database connection
    $db = null;
} else {
    // Display error message if validation fails
    echo $errorMessage;
}

?>
