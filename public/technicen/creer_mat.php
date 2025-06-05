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

require_once '../../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;

// Charger types et états depuis la BDD
$types = $pdo->query("SELECT id_type_materiel, description FROM TYPE_MATERIEL")->fetchAll(PDO::FETCH_ASSOC);
$etats = $pdo->query("SELECT id_etat_materiel, etat FROM ETAT_MATERIEL")->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $sn = strtoupper(trim($_POST['sn']));
    $valoriser = isset($_POST['valoriser']) ? 1 : 0;
    $valeur = $valoriser ? intval($_POST['valeur']) : null;
    $provenance = $_POST['provenance'];
    $id_type = intval($_POST['id_type_materiel']);
    $id_etat = intval($_POST['id_etat_materiel']);
    $etiquette = bin2hex(random_bytes(4));
    $date_creation = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("INSERT INTO MATERIEL (nom, sn, valoriser, valeur, provenance, date_creation, etiquette, perdu, id_type_materiel, id_etat_materiel) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?, ?)");

    $stmt->execute([$nom, $sn, $valoriser, $valeur, $provenance, $date_creation, $etiquette, $id_type, $id_etat]);

    // Génération du QR code
    $qr = new QrCode(strtoupper($etiquette));
    $qr->setEncoding(new Encoding('UTF-8'))->setSize(250)->setMargin(10);
    $writer = new PngWriter();
    $result = $writer->write($qr);
    $qrDir = __DIR__ . '/../qrcodes/';
    if (!file_exists($qrDir)) mkdir($qrDir, 0775, true);
    $result->saveToFile($qrDir . strtoupper($etiquette) . '.png');

    $success = "Matériel ajouté avec succès !";
}

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
     <main class="main-content">
    <!--Coeur de la page-->
    <h2>Créer un matériel</h2>

        <?php if (!empty($success)) echo "<div class='success'>$success</div>"; ?>

        <form method="post" class="form fade-in show">
            <div class="form-section">
                <div class="tech-container">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="sn">Numéro de série (SN)</label>
                        <input type="text" id="sn" name="sn" minlength="8" maxlength="8" required placeholder="Ex : 12345678">
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" name="valoriser" id="valoriser" onchange="toggleValeur()"> Valoriser</label>
                        <div id="valeurContainer" style="display: none;">
                            <label for="valeur">Valeur (€)</label>
                            <input type="number" name="valeur" id="valeur" min="0">
                        </div>
                    </div>

                        <label for="provenance">Provenance</label>
                        <input type="text" name="provenance" id="provenance" required placeholder="Ex : Stock INFO'MAINTENANCE">

                        <label for="id_type_materiel">Type de matériel</label>
                        <select name="id_type_materiel" id="id_type_materiel" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?= $type['id_type_materiel'] ?>"><?= htmlspecialchars($type['description']) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="id_etat_materiel">État</label>
                        <select name="id_etat_materiel" id="id_etat_materiel" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($etats as $etat): ?>
                                <option value="<?= $etat['id_etat_materiel'] ?>"><?= htmlspecialchars($etat['etat']) ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
            </div>

            <button type="submit" class="btn">✅ Créer</button>
        </form>
    </main>
    <!--Footer - Bas de page-->
    <?php include '../../inclus/footer-tech-template.php'; ?>
    <!--Script - Responsive-->
    <script src="../modeles/responsive.js" async defer></script>
    <script src="../modeles/fade-n.js" async defer></script>
    <script>function toggleValeur() {
    const isChecked = document.getElementById('valoriser').checked;
    document.getElementById('valeurContainer').style.display = isChecked ? 'block' : 'none';
    }
    </script>
    </body>
</html>