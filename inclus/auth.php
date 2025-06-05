<?php
require_once 'functions.php';
session_start();

if (!isLoggedIn()) {
    header('Location: /public/login.php');
    exit;
}

// Rediriger selon le rôle si besoin
switch ($_SESSION['utilisateur']['role_id']) {
    case 1: // Admin
        break; // autorisé
    case 2: // Technicien
        if (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) {
            header('Location: /public/technicien/dashboard.php');
            exit;
        }
        break;
    case 3: // Client
        if (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false || strpos($_SERVER['SCRIPT_NAME'], '/technicien/') !== false) {
            header('Location: /public/client/dashboard.php');
            exit;
        }
        break;
    default:
        // Rôle inconnu
        session_destroy();
        header('Location: /public/login.php');
        exit;
}
?>