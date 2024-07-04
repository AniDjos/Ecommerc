<?php
include 'connect.php';
$message = "";
$profil = "";

$email = $_POST['email'];
$mdp = $_POST['mdp'];

if (empty($email) || empty($mdp)) {
    $message = "champ vide";
} else {
    //verifier les donnees
    $requete = "SELECT * from client where email='$email' and mdp='$mdp'";
    $reponse = $bdd->query($requete);
    $donnees = $reponse->fetchAll();
    foreach ($donnees as $user) {
        $profil = $user['profil'];
        $id = $user['client_id'];
    }
    if (!$donnees) {
        $message = "parametre incorrect";
    } else {
        if ($profil == "ADMIN") {
            header('location:../Administrateur/menuAdmin.php');
        } else {
            header('location:acceuil.php?');
        }
    }
}
