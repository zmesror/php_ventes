<?php
session_start();

// Vérifier si la session existe ou si le cookie est défini
if (!isset($_SESSION['loggedin']) && !isset($_COOKIE['remember_user'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté et le cookie n'est pas présent
    header('Location: connexion.php');
    exit;
}

// Si l'utilisateur est connecté, afficher les informations du profil, etc.
// ...
