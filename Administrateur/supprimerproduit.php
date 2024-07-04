<?php
include ('../Client/connect.php');
$code = $_GET['id'];
//Preparer la requete
$requete = "DELETE  from products where product_id='$code'";
//Executer la requete
if ($bdd->query($requete) == true) {
    //message de supression
    echo '<script>alert("Donnée supprimé")</script>';
    header('refresh:0.5 url=menuAdmin.php');
}

?>