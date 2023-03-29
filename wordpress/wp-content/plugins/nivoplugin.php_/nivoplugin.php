<?php
/*
Plugin Name: Bonjour Heure
Description: Ce plugin affiche un message de bonjour et l'heure actuelle.
Version: 1.0
Author: Ermis
*/

function bonjour_heure_shortcode() {
    date_default_timezone_set('Europe/Paris'); // Définit le fuseau horaire à Paris, vous pouvez le modifier pour le vôtre
    $heure = date('H:i:s'); // Récupère l'heure actuelle
    $message = "Bonjour ! Il est actuellement $heure."; // Construit le message à afficher
    return $message; // Renvoie le message
}
add_shortcode('bonjour_heure', 'bonjour_heure_shortcode'); // Crée un shortcode pour afficher le message
?>
