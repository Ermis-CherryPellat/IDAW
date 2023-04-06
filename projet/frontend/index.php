<?php
// Vérifier si l'utilisateur est déjà connecté
session_start();
if(isset($_SESSION["utilisateur_connecte"]) && $_SESSION["utilisateur_connecte"] === true){
    header("Location: pages-analyse.php");
    exit;
}

// Rediriger vers la page de connexion
header("Location: pages-login.php");
exit;
?>