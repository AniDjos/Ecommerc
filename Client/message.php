<?php

// Sanitize and validate user input
$name = filter_input(INPUT_POST, 'nom'); // Sanitize phone number as integer
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validate email format
$message = filter_input(INPUT_POST, 'message'); // Assuming 'deplacement' refers to vehicle

// Check for empty fields and invalid email
$isValid = true;
$errorMessage = "";

if (empty($name) || empty($email) || empty($message)) {
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
    $insertQuery = "INSERT INTO messages (nom,  email, message) VALUES (:nom, :email, :message)";
    $insertStmt = $db->prepare($insertQuery);

    $insertStmt->bindParam(':nom', $name);
    $insertStmt->bindParam(':email', $email);
    $insertStmt->bindParam(':message', $message);

    $insertStmt->execute();

    // Handle success or error
    if ($insertStmt->rowCount() > 0) {
        echo '<script>alert("Message envoyé avec success. Vous recevrez une reponse dans les plus bref délais")</script>';
        header("location:acceuil.php?message=ok");
    } else {
        echo "Error adding delivery person.";
    }

    // Close the database connection
    $db = null;
} else {
    // Display error message if validation fails
    echo $errorMessage;
}
