<?php
include ('connect.php');
$code = $_GET['id'];
//Preparer la requete
$requete = "DELETE  from categories where category_id='$code'";
//Executer la requete
if ($bdd->query($requete) == true) {
    //message de supression
    echo '<script>alert("Donnée supprimé")</script>';
    header('refresh:0.5 url=categorieprod.php');
}

?>