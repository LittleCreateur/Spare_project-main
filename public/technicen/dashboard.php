<?php
session_start();

ini_set('display_errors', 0); // Ne jamais afficher d'erreurs en production
ini_set('log_errors', 1);     // Loggue les erreurs dans un fichier
error_reporting(E_ALL);       // Capte toutes les erreurs
// Inclusion du fichier de configuration
require_once '../../config/config.php';

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if (!isset($_SESSION['utilisateur'])) {
    header('Location: ../public/login.php');
    exit();
}

session_start();

// if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['role'] !== '2') {
//     header('Location: ../../public/login.php');
//     exit();
// }

// Set content type
header('Content-Type: text/html; charset=utf-8');
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
        <title>Dashboard Tech - Matériel de prêt | INFO'MAINTENANCE</title>
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
        <link rel="stylesheet" href="../../modeles/styles.css">
        <!--Balises - Utile lors du partage du lien du site internet dans une application ou il y a un outil de messagerie par exemple - métadonnées automatique ajouté sous l'image du lien insérer-->
        <meta property="og:title" content="Accueil - Matériel de prêt | INFO'MAINTENANCE">
        <meta property="og:description" content="« ~ Votre stock de prêt, toujours à portée de main. » ● Description.">
        <meta property="og:image" content="https://192.168.102.132.info-maintenance.fr/img/logo_pret.png">
        <meta property="og:url" content="https://192.168.102.132.info-maintenance.fr">
        <meta property="og:type" content="website">
    </head>
    <body>
    <!--Header - Haut de page-->
    <?php include '../../inclus/header-template-tech.php'; ?>
    <!-- Le contenu de la page commence ici -->
    <!--Coeur de la page-->
    <main class="main-content">
    <h1>Catalogue des catégories de matériels proposés</h1>
        <p class="subtitle">« ~ Catalogue de ce que l'on peut vous proposé en prêt via ce site internet. »</p>
        <p class="description">● Consulter.</p>
    <!--Coeur de la page-->
    <div class="grid">
    <div class="item">
        <a href="./creer_mat.php">
            <img src="../../img/create.png" alt="Créer">
            <h3>Créer un matériel</h3>
            <p>Ajouter un nouvel équipement</p>
        </a>
    </div>
    <div class="item">
        <a href="stock_mat.php">
            <img src="../../img/stock.png" alt="Stock">
            <h3>Stock de matériel</h3>
            <p>Voir tout le matériel enregistré</p>
        </a>
    </div>
    <div class="item">
        <a href="deplacer_mat.php">
            <img src="../../img/moove.png" alt="Déplacement">
            <h3>Déplacer du matériel</h3>
            <p>Changer son emplacement</p>
        </a>
    </div>
    <div class="item">
        <a href="inventorier.php">
            <img src="../../img/inventory.png" alt="Inventaire">
            <h3>Inventorier</h3>
            <p>Faire l'inventaire par étiquette</p>
        </a>
    </div>
    <div class="item">
        <a href="etiquette.php">
            <img src="../../img/edit.png" alt="Étiquette">
            <h3>Éditer une étiquette</h3>
            <p>Re-générer le QR Code</p>
        </a>
    </div>
    <div class="item">
        <a href="ajouter_entreprise.php">
            <img src="../../img/add.png" alt="Entreprise">
            <h3>Nouvelle entreprise</h3>
            <p>Ajouter un client</p>
        </a>
    </div>
    </div>
    </main>
    <!--Footer - Bas de page-->
    <?php include '../../inclus/footer-tech-template.php'; ?>
    <!--Script - Responsive-->
    <script src="../modeles/responsive.js" async defer></script>
    <script src="../modeles/fade-n.js" async defer></script>
    </body>
</html>

