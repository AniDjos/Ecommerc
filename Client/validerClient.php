<?php

// Vérification si des données sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données (à adapter selon vos paramètres)
    $bdd = new PDO('mysql:host=localhost;dbname=db_vente;charset=utf8', 'root', '');

    // Vérification de la connexion à la base de données
    if (!$bdd) {
        die("Erreur de connexion à la base de données");
    }

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $age = $_POST['age'];
    $ville = $_POST['ville'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $profil = 'CLIENT';

    // Vérification de l'existence du fichier image
    if (empty($_FILES["photo"]["tmp_name"])) {
        header("location:client.php?message=er");
        exit(); // Arrêter le script si le fichier image est manquant
    }

    // Gestion du nom du fichier image avec date et heure actuelle
    $file_basename = pathinfo($_FILES["photo"]["name"], PATHINFO_FILENAME);
    $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $new_image_name = $file_basename . '_' . date("Ymd_His") . '_' . $file_extension;

    // Requête SQL pour insérer les données dans la base de données
    $insertion = $bdd->prepare('INSERT INTO client (first_name, last_name, photo, age,ville,sexe,email, mdp, profil) VALUES (?, ?, ?, ?, ? ,?,?, ?, ?)');
    $insertion->execute(array($nom, $prenom, $new_image_name, $age, $ville, $sexe,$email, $mdp, $profil));
    // Vérification de l'insertion et traitement du fichier image
    if ($insertion) {
        // Déplacement du fichier image vers le répertoire approprié
        $target_directory = "photo/";
        $target_path = $target_directory . $new_image_name;

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_path)) {
            // Redirection en cas de succès
            header("location:index.php?message=ok");
            exit();
        } else {
            // Redirection en cas d'échec du déplacement du fichier
            header("location:index.php?message=er");
            exit();
        }
    } else {
        // Redirection en cas d'échec de l'insertion dans la base de données
        header("location:index.php?message=er");
        exit();
    }
}
?>