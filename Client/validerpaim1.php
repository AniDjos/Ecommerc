<?php
include "connect.php";

// Récupération des données du formulaire
$produitnom = $_POST['nomprod'];
$prix = $_POST['prix'];
$quantite = $_POST['quantite'];
$nom = $_POST["nom1"];
$prenom = $_POST['prenom1'];
$montant = $_POST['montant'];

// Vérification des champs vides
if (empty($nom) || empty($prenom) || empty($montant) || empty($quantite) || empty($produitnom) || empty($prix)) {
    echo "Veuillez remplir tous les champs";
    header('refresh:0.5;url=paiement.php');
    exit;
} else {
    // Préparation de la requête SQL
    $requete = $bdd->prepare("INSERT INTO order_lines (product_id, quantity, unit_price, total_price) VALUES (?, ?, ?, ?)");
    $requete->bind_param("sidd", $produitnom, $quantite, $prix, $montant);

    // Exécution de la requête et gestion des erreurs
    if ($requete->execute()) {
        echo '<script>alert("Donnée ajoutée"); window.location.href="acceuil.php";</script>';
    } else {
        echo '<script>alert("Donnée non ajoutée"); window.location.href="ajouterpanier.php";</script>';
    }

    // Fermeture de la requête
    $requete->close();
}

// Fermeture de la connexion à la base de données
$bdd->close();
