<?php
session_start();

// Inclusion du fichier de configuration
require_once '../config/config.php';

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<!--[if lt IE 7]>      <p class="recherche">Nous vous indiquons que vous utilisé un navigateur non <strong>supporté et dépassé</strong>. Veuillez <a href="#">mettre à jour votre navigateur</a> pour améliorer votre éxpérience sur notre site internet.</p> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Enzo.C - INFO'MAINTENANCE">
        <title>Inscription - Matériel de prêt | INFO'MAINTENANCE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="frame-ancestors 'self'">
        <meta name="description" content="« ~ Votre stock de prêt, toujours à portée de main. » ● Inscrivez-vous et accédez rapidement à votre stock de prêt.">
        <meta name="keywords" content="stock, matériel, prêt, gestion, technicien, entreprise">
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
    <!--Coeur de la page-->
    <main class="main-content">
        <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <?php unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
        <h1>Espace d’inscription</h1>
        <p class="subtitle">« ~ Votre stock de prêt, toujours à portée de main. »</p>
        <p class="description">● Inscrivez-vous et accédez rapidement à votre stock de prêt.</p>
    <!--Formulaire d'inscription - 1ère colonne-->
        <div class="form-section">
            <div class="login-container">
                <form action="../traitement/traitement-signup.php" class="form fade-in show" method="POST" data-animate>
                    <h2>S’inscrire :</h2>
                    <div class="form-group">
                        <div>
                            <label class="form-lbl-color">Prénom</label>
                            <input type="text" name="prenom" id="prenom" placeholder="Robert" required>
                        </div>
                        <div>
                            <label>Nom</label>
                            <input type="text" name="nom" id="nom" placeholder="Junior" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <?php
                                $entreprises = $pdo->query("SELECT id_entreprise, nom FROM ENTREPRISE")->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <label>Entreprise</label> <!-- AJOUTE CE LABEL -->
                            <select name="id_entreprise" id="entreprise" required>
                                <option value="">-- Sélectionner une entreprise --</option>
                                <?php foreach ($entreprises as $entreprise): ?>
                                    <option value="<?= $entreprise['id_entreprise'] ?>"><?= htmlspecialchars($entreprise['nom']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label>Adresse électronique</label>
                            <input type="email" name="email" id="email" placeholder="email.exemple@exemple.com" required>
                        </div>
                    </div>
    <!--Formulaire d'inscription - 2ème colonne-->
                    <div class="form-group">
                        <div>
                            <label>Mot de passe</label>
                            <input type="password" name="password" id="password" placeholder="(9 caractères minimum)." required minlength="9">
                        </div>
                        <div>
                            <label>Confirmez - Mot de passe</label>
                            <input type="password" name="confirm" id="confirm" placeholder="(9 caractères minimum)." required minlength="9">
                        </div>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <!-- autres champs -->
                    <button type="submit" class="submit-btn">S’inscrire</button>
                </form>
            </div>
    <!--Image - Illustration-->
        <div class="form-image">
            <img src="../img/apostrophe_double.svg" alt='Apostrophe' class="apostrophe" style="width: 100px" loading="lazy">
            <img src="../img/h1-background.jpg" alt="Matériel de prêt - illustration informatique" loading="lazy">
        </div>
        </div>
    </main>
    <!--Footer - Bas de page-->
    <?php include '../inclus/footer-template-public.php'; ?>
    <!--Script - Responsive-->
    <script src="../modeles/responsive.js" async defer></script>
    <script src="../modeles/fade-n.js" async defer></script>
    </body>
</html>