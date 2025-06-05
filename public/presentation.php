<?php
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
        <title>Présentation - Matériel de prêt | INFO'MAINTENANCE</title>
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
        <meta property="og:title" content="Présentation - Matériel de prêt | INFO'MAINTENANCE">
        <meta property="og:description" content="« ~ Votre stock de prêt, toujours à portée de main. » ● Description.">
        <meta property="og:image" content="https://192.168.102.132.info-maintenance.fr/img/logo_pret.png">
        <meta property="og:url" content="https://192.168.102.132.info-maintenance.fr">
        <meta property="og:type" content="website">
    </head>
    <body>
    <!--Header - Haut de page-->
    <?php include '../inclus/header-template-public.php'; ?>
    <!-- Le contenu de la page commence ici -->
    <main class="main-content">
        <h1>Catalogue des catégories de matériels proposés</h1>
        <p class="subtitle">« ~ Catalogue de ce que l'on peut vous proposé en prêt via ce site internet. »</p>
        <p class="description">● Consulter.</p>
    <!--Coeur de la page-->
        <div class="grid">
            <div class="item">
                <img src="../img/switch.png" alt="Switch">
                <h3>Switchs</h3>
                <p>Différents modèles x ports</p>
            </div>
            <div class="item">
                <img src="../img/pc-portable.jpg" alt="PC Portable">
                <h3>PC portable</h3>
                <p>Déployés</p>
            </div>
            <div class="item">
                <img src="../img/pc-fixe.jpg" alt="PC Fixe">
                <h3>PC fixe</h3>
                <p>Déployés</p>
                </div>
            <div class="item">
                <img src="../img/ecran.png" alt="Écran">
                <h3>Écrans</h3>
                <p>24” & 27”</p>
            </div>
            <div class="item">
                <img src="../img/pare-feux.jpg" alt="Pare-feu">
                <h3>Pare-feux</h3>
                <p>Mise à jour</p>
            </div>
            <div class="item">
                <img src="../img/serveur.jpg" alt="Serveurs">
                <h3>Serveurs</h3>
                <p>HYPERV déployés</p>
                </div>
            <div class="item">
                <img src="../img/nas.png" alt="NAS">
                <h3>NAS</h3>
                <p>Portable</p>
            </div>
        </div>
    </main>

    <!--Footer - Bas de page-->
    <?php include '../inclus/footer-template-public.php'; ?>

    <!--Script - Responsive-->
    <script src="../inclus/responsive.js" async defer></script>
    <script src="../inclus/fade-n.js" async defer></script>
    </body>
</html>