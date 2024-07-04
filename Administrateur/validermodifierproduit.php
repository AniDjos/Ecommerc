<?php
include ('connect.php');
// Récupération des données
$code = $_GET['MD'];
$nom = $_POST['nom'];
$price = $_POST['prix'];
$stock = $_POST['stock'];
$categorie = $_POST['categorie'];

$photo = basename($_FILES['photo']['name']);
$dossier = "photo/"; //dossier des photos
$chemin = $dossier . $photo;//le chemin d'acces a la photo
//contrôle de la saisie
if (empty($nom) || empty($price) || empty($stock) || empty($categorie)) {
    //message d'erreur
    echo '<script>alert("Veuillez entrer les données")</script>';
    header('refresh:0.5 url=modifierproduit.php');
} else {
    //preparer la req de modification
    $requete = "UPDATE products set name='$nom' , price='$price' , stock='$stock' , category_id='$categorie' , image='$chemin' where product_id = '$code'";
    //test d'execution de la req
    if ($bdd->query($requete) == true) {
        move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
        //message de succes
        echo '<script>alert("Modification effectuée avec succes")</script>';
        header('refresh:0.5 url=menuAdmin.php');
    }
}
?>