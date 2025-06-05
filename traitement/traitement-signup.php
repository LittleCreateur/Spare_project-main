<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Traitement de l'inscription

// Inclusion du fichier de configuration
require '../config/config.php';

// Vérification de la méthode de requête
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Méthode de requête non autorisée.");
}

// Vérification de la présence du token CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    exit("Token CSRF invalide.");
}

// Récupération des données du formulaire
$prenom = trim($_POST['prenom'] ?? '');
$nom = trim($_POST['nom'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$id_entreprise = intval($_POST['id_entreprise'] ?? 0);
$id_role = 3; // Rôle par défaut pour les nouveaux utilisateurs (clients)
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm'] ?? '';

    echo "Formulaire soumis.<br>";

    // Vérification des champs requis
    if (empty($prenom) || empty($nom) || empty($email) || $id_entreprise <= 0 || empty($password) || empty($confirm)) {
        exit("Veuillez remplir tous les champs.");
    }
    
    echo "Champs remplis.<br>";

    // Vérification si l'utilisateur est déjà connecté
    if (isset($_SESSION['utilisateur'])) {
        header('Location: ../public/dashboard.php'); // Redirige vers le tableau de bord si déjà connecté
        exit();
    }

    // Vérification du format de l’email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    // Vérifie si le mot de passe est assez long
    if (strlen($password) < 9) {
        die("Le mot de passe doit contenir au moins 9 caractères.");
    }

    // Vérifie la confirmation du mot de passe
    if ($password !== $confirm) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Vérifie si l’email existe déjà
    $stmt = $pdo->prepare("SELECT id_personne FROM PERSONNE WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        exit("Un compte avec cet email existe déjà.");
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
    if ($hashedPassword === false) {
        exit("Erreur lors du hachage du mot de passe.");
    }

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO PERSONNE (prenom, nom, email, id_entreprise, id_role, password) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        exit("Erreur de préparation de la requête : " . $pdo->errorInfo()[2]);
    }
    // Exécution de la requête
    if (!$stmt->execute([$prenom, $nom, $email, $id_entreprise, $id_role, $hashedPassword])) {
        exit("Erreur lors de l'exécution de la requête : " . implode(", ", $stmt->errorInfo()));
    }

$user = ['id_role' => $id_role];
    switch ($user['id_role']) {
    case 1:
        header('Location: ../public/admin/dashboard.php');
        break;
    case 2:
        header('Location: ../public/technicien/dashboard.php');
        break;
    case 3:
        header('Location: ../public/client/dashboard.php');
        break;
    default:
        $_SESSION['error'] = "Rôle non reconnu.";
        header('Location: ../public/login.php');
    }
    exit();

$_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";

// Redirection vers la page de connexion après l'inscription réussie
header('Location: ../public/login.php');
exit();
?>