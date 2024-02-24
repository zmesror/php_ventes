<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $loginPagePath = '/views/auth/login.php';

    if ($_SERVER['REQUEST_URI'] !== $loginPagePath) {
        header('Location: ' . $router->generate('login'));
        exit;
    }
}

if (strpos($_SERVER['REQUEST_URI'], '/admin') !== false && $_SESSION['role'] !== 'admin') {
    header('Location: ' . $router->generate('login'));
    exit;
}
?>
