<?php
session_start();
ini_set('display_errors', 0); // Ne jamais afficher d'erreurs en production
ini_set('log_errors', 1);     // Loggue les erreurs dans un fichier
error_reporting(E_ALL);       // Capte toutes les erreurs

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Inclut le fichier de configuration
require_once './config/config.php';

// Vérifie si le token CSRF est défini, sinon le crée
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

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
        <title>Accueil - Matériel de prêt | INFO'MAINTENANCE</title>
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
        <link rel="stylesheet" href="./modeles/styles.css">
        <!--Balises - Utile lors du partage du lien du site internet dans une application ou il y a un outil de messagerie par exemple - métadonnées automatique ajouté sous l'image du lien insérer-->
        <meta property="og:title" content="Accueil - Matériel de prêt | INFO'MAINTENANCE">
        <meta property="og:description" content="« ~ Votre stock de prêt, toujours à portée de main. » ● Description.">
        <meta property="og:image" content="https://192.168.102.132.info-maintenance.fr/img/logo_pret.png">
        <meta property="og:url" content="https://192.168.102.132.info-maintenance.fr">
        <meta property="og:type" content="website">
    </head>
    <!-- Le contenu de la page commence ici -->
    <body>
    <!--Header - Haut de page-->
    <!--Template - Header-->
    <header class="header" id="head">
        <div class="logo">
            <a href="./index.php"><img src="./img/logo_pret.png" alt="Logo - Matériel de prêt | INFO'MAINTENANCE"></a>
        </div>
        <nav class="nav">
            <button class="burger" aria-label="Menu">&#9776;</button>
            <ul class="nav-links">
                <li><a href="./public/presentation.php">Présentation</a></li>
                <li><a href="./public/documentations.php">Documentations</a></li>
                <li><a href="./public/a_propos.php">À propos</a></li>
                <li class="dropdown"><a href="#" class="btn">S’identifier</a>
                    <ul class="dropdown-content">
                        <li><a href="./public/signup.php">S’inscrire</a></li>
                        <li><a href="./public/login.php">Se connecter</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Hero section -->
    <section class="hero">
      <div class="hero-overlay">
          <h1 class="shake">La gestion de<br>matériel de prêt</h1>
          <p>Retrouvez nos stocks de matériel de prêt en quelques clics<br>et ayez un suivi précis en temps réel.</p>
          <a href="./public/signup.php" class="btn">Commencer</a>
      </div>
    </section>
    <div class="bar-cyan"></div>

    <!-- Section prêt de matériel -->
    <section class="section" style="padding: 4rem 2rem;">
        <h2 style="color: #00A5B5;">Prêt de matériel <span style="border-bottom: 4px solid #0f2b3c;"></span></h2>
    <div class="grid">
      <div>
        <h3>Prêt à l’utilisation...</h3>
        <p>● Un large choix de matériel de prêt accessible pour nos clients.</p>
        <a class="btn dark" href="./public/presentation.php">Présentation ’</a>
        <a class="btn light" href="#">→ Voir plus</a>
      </div>
      <div>
        <img src="./img/h2-background.jpg" alt="Stock matériel" style="width: 100%; border: 1px solid #000;">
      </div>
    </div>
  </section>

  <!-- Interface personnalisée -->
  <section class="section" style="padding: 4rem 2rem;">
    <div class="grid">
      <div>
        <img src="./img/verif_icon.png" alt="Checklist" style="width: 80%;">
      </div>
      <div>
        <h3>Une interface personnalisée pour chaque entreprise...</h3>
        <p>● Vous avez le contrôle sur votre matériel.</p>
        <a class="btn dark" href="./public/signup.php">Nouveau ’</a>
        <a class="btn light" href="./public/documentations.php">→ Voir plus</a>
      </div>
    </div>
  </section>

  <!-- Logo section -->
  <section class="section" style="background: #0f2b3c; padding: 3rem; color: white; text-align: center;">
    <img src="./img/logo_pret.png" alt="INFO'MAINTENANCE" style="max-width: 250px;">
    <br>
    <a class="btn" href="#" style="margin-top: 1rem;">Site internet ’</a>
  </section>
  <div class="bar-cyan"></div>
  <div class="bar-dark"></div>

  <!-- Section De plus -->
    <div class="bar-dark"></div>
    <section class="section oblique-top" style="padding: 4rem 2rem;">
    <h2 style="color: #00A5B5;">De plus <span style="border-bottom: 4px solid #0f2b3c;"></span></h2>
    <div class="grid-4">
      <div>
        <h4>🗺 Aide</h4>
        <p>Retrouvez toute la documentation et tutos.</p>
      </div>
      <div>
        <h4>👤 Profil</h4>
        <p>Un espace pour chaque entreprise.</p>
      </div>
      <div>
        <h4>🔒 Sécurité & Confidentialité</h4>
        <p>Un site conforme RGPD.</p>
      </div>
      <div>
        <h4>📅 Gestion</h4>
        <p>Une base de données avec un suivi précis.</p>
      </div>
    </div>
    </section>

    <!--Footer - Bas de page-->
    <?php include './inclus/footer-template.php'; ?>
    <!--Script - Responsive-->
    <script src="./inclus/responsive.js" async defer></script>
    <script src="./inclus/fade-n.js" async defer></script>
    </body>
</html>