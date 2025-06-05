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

// Set content type
header('Content-Type: text/html; charset=utf-8');

// Récupération des données pour les selects
$materiels = $pdo->query("SELECT id_materiel, nom FROM MATERIEL")->fetchAll(PDO::FETCH_ASSOC);
$emplacements = $pdo->query("SELECT id_emplacement, description FROM EMPLACEMENT")->fetchAll(PDO::FETCH_ASSOC);
$etats = $pdo->query("SELECT id_etat_materiel, etat FROM ETAT_MATERIEL")->fetchAll(PDO::FETCH_ASSOC);


// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_materiel = $_POST['id_materiel'];
    $id_personne = $_SESSION['utilisateur']['id'];
    $id_depart = $_POST['id_emplacement_depart'];
    $id_destination = $_POST['id_emplacement_destination'];
    $commentaire = $_POST['commentaire'];
    $id_etat = $_POST['id_etat_materiel'];

    $stmt = $pdo->prepare("INSERT INTO DEPLACEMENT (id_materiel, id_personne, id_emplacement_depart, id_emplacement_destination, commentaire, id_etat_materiel) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_materiel, $id_personne, $id_depart, $id_destination, $commentaire, $id_etat]);

    $success = "Matériel déplacé avec succès.";
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
    <main class="main-content">
        <!--Coeur de la page-->
        <h2>Déplacer un matériel</h2>

        <?php if (isset($success)): ?>
        <p class="message"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="id_materiel">Matériel</label>
            <select name="id_materiel" required>
                <option value="">-- Sélectionnez --</option>
                <?php foreach ($materiels as $m): ?>
                <option value="<?= $m['id_materiel'] ?>"><?= htmlspecialchars($m['nom']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="id_emplacement_depart">Emplacement de départ</label>
            <select name="id_emplacement_depart" required>
                <option value="">-- Sélectionnez --</option>
                <?php foreach ($emplacements as $e): ?>
                <option value="<?= $e['id_emplacement'] ?>"><?= htmlspecialchars($e['description']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="id_emplacement_destination">Emplacement de destination</label>
            <select name="id_emplacement_destination" required>
                <option value="">-- Sélectionnez --</option>
                <?php foreach ($emplacements as $e): ?>
                <option value="<?= $e['id_emplacement'] ?>"><?= htmlspecialchars($e['description']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="id_etat_materiel">État du matériel</label>
            <select name="id_etat_materiel" required>
                <option value="">-- Sélectionnez --</option>
                <?php foreach ($etats as $etat): ?>
                <option value="<?= $etat['id_etat_materiel'] ?>"><?= htmlspecialchars($etat['etat']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="commentaire">Commentaire (optionnel)</label>
            <textarea name="commentaire" rows="3"></textarea>

            <button type="submit">Déplacer</button>
        </form>
    </main>
    <!--Footer - Bas de page-->
    <?php include '../../inclus/footer-tech-template.php'; ?>
    <!--Script - Responsive-->
    <script src="../../modeles/responsive.js" async defer></script>
    <script src="../../modeles/fade-n.js" async defer></script>
    <script>
        document.getElementById("search").addEventListener("keyup", function () {
            const search = this.value.toLowerCase();
            const rows = document.querySelectorAll("#stockTable tbody tr");
            rows.forEach(row => {
                row.style.display = [...row.children].some(td =>
                    td.textContent.toLowerCase().includes(search)
                ) ? "" : "none";
            });
        });
    </script>
    </body>
</html>