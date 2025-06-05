<?php
session_start();
//var_dump($_POST);
//exit;
require '../config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!$user) {
    error_log("Aucun utilisateur trouvé avec l'email : $email");
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Méthode non autorisée.");
}

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    exit("CSRF token invalide.");
}

$email = strtolower(trim($_POST['email']));
$password = $_POST['password'] ?? '';

// Vérifie si l’utilisateur existe
$stmt = $pdo->prepare("SELECT * FROM PERSONNE WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 🔍 Debug ici :
//var_dump($user['password']);
//exit;

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['error'] = "Identifiants incorrects.";
    header("Location: ../public/login.php");
    exit();
}

// Authentification réussie
$_SESSION['utilisateur'] = [
    'id' => $user['id_personne'],
    'prenom' => $user['prenom'],
    'nom' => $user['nom'],
    'email' => $user['email'],
    'id_entreprise' => $user['id_entreprise']
];

$_SESSION['success'] = "Bienvenue " . htmlspecialchars($user['prenom']) . " 👋";

error_log("Redirection vers dashboard.php");
header("Location: ../public/technicen/dashboard.php");
exit();
?>