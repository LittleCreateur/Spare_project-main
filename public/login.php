<?php
// Connexion de l'utilisateur (démarrage de session)
session_start();

ini_set('display_errors', 0); // Ne jamais afficher d'erreurs en production
ini_set('log_errors', 1);     // Loggue les erreurs dans un fichier
error_reporting(E_ALL);       // Capte toutes les erreurs

// Configuration des paramètres de cookie de session
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);
// Set content type
header('Content-Type: text/html; charset=utf-8');

// Inclusion du fichier de configuration
require_once '../inclus/config.php';

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<!--[if lt IE 7]>      <p class="recherche">Nous vous indiquons que vous utilisé un navigateur non <strong>supporté et voire même dépassé</strong>. Veuillez <a href="#">mettre à jour votre navigateur</a> pour améliorer votre éxpérience sur notre site internet.</p> <![endif]-->
<html>
    <head>
        <!--Codage de caractères informatiques - Norme internationale ISO/CEI 10646 (compatible avec Unicode & ASCII limitée à l'anglais de base).-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Auteur du développement des pages et du site internet-->
        <meta name="author" content="Enzo.C - INFO'MAINTENANCE">
        <!--Nom de l'onglet de la page suivante qui apparait dans le navigateur.-->
        <title>Se connecter - Matériel de prêt | INFO'MAINTENANCE</title>
        <!--Balise qui adapte la taille au maximum de la page à la taille du navigateur / de l'écran automatiquement.-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="frame-ancestors 'self'">
        <!--Description de la page.-->
        <meta name="description" content="« ~ Votre stock de prêt, toujours à portée de main. » ● Slogan_page.">
        <!--Mot clés associés à la page suivante. Permettant d'être mieux répertorié dans les bonnes pages de recherches et de navigation.-->
        <meta name="keywords" content="stock, matériel, prêt, gestion, technicien, entreprise">
        <!--Icône qui apparait dans l'onglet du navigateur.-->
        <link rel="shortcut icon" href="./img/apostrophe_double.svg" type="image/x-icon">
        <!--Insertion du design graphique grâce au fichier "styles.css" qui y fait référence dans la page.-->
        <link rel="stylesheet" href="../modeles/styles.css">
        <!--Balises - Utile lors du partage du lien du site internet dans une application ou il y a un outil de messagerie par exemple - métadonnées automatique ajouté sous l'image du lien insérer-->
        <meta property="og:title" content="Accueil - Matériel de prêt | INFO'MAINTENANCE">
        <meta property="og:description" content="« ~ Votre stock de prêt, toujours à portée de main. » ● Description.">
        <meta property="og:image" content="https://192.168.102.132.info-maintenance.fr/img/logo_pret.png">
        <meta property="og:url" content="https://192.168.102.132.info-maintenance.fr">
        <meta property="og:type" content="website">
    </head>
    <body>
    <!--Header - Haut de page-->
    <?php include '../inclus/header-template-public.php'; ?>
    <!-- Le contenu de la page commence ici -->
    <!--Coeur de la page-->
    <main class="main-content">
        <h1>Espace de connection</h1>
        <p class="subtitle">« ~  Accédez à votre espace en un clic. »</p>
        <p class="description">● Identifiez-vous et accèder rapidement à votre stock de prêt.</p>
    <!--Formulaire d'inscription - 1ère colonne-->
        <div class="form-section">
            <div class="login-container">
                <form class="form" method="POST" action="../traitement/traitement-login.php">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                    <h2>Se connecter :</h2>
                    <div class="form-group">
                        <div>
                            <label>Adresse électronique</label>
                            <input type="email" name="email" id="email" placeholder="email.exemple@exemple.com" required>
                        </div>
                    </div>
    <!--Formulaire d'inscription - 2ème colonne-->
                    <div class="form-group">
                        <div>
                            <label>Mot de passe</label>
                            <input type="password" name="password" id="password" placeholder="(9 caractères minimum)." required>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">S'identifier</button>
                </form>
            </div>
<!--Image - Illustration-->
        <div class="form-image">
            <img src="../img/apostrophe_double.svg" alt='Apostrophe' class="apostrophe" style="width: 100px" loading="lazy">
            <img src="../img/h1-background.jpg" alt="Matériel de prêt - illustration informatique">
        </div>
        </div>
    </main>
    <!--Footer - Bas de page-->
    <?php include '../modeles/footer-template.php'; ?>
    <!--Script - Responsive-->
    <script src="../modeles/responsive.js" async defer></script>
    <script src="../modeles/fade-n.js" async defer></script>
    </body>
</html>