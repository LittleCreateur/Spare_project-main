<!--Template - Header-->
    <header class="header" id="head">
        <div class="logo">
            <a href="../../index.php"><img src="../../img/logo_pret.png" alt="Logo - Matériel de prêt | INFO'MAINTENANCE"></a>
        </div>
        <div class="technicien-box">
            <span class="technicien-role"><a href="../technicen/dashboard.php">🔧</a> Espace Technicien</span>
            <span class="technicien-nom"><?= htmlspecialchars($_SESSION['utilisateur']['prenom']) ?> 👨‍🔧</span>
            <a href="../public/logout.php" class="logout-link">Se déconnecter ❌</a>
        </div>
        <nav class="nav">
            <button class="burger" aria-label="Menu">&#9776;</button>
            <ul class="nav-links">
                <li><a href="../presentation.php">Présentation</a></li>
                <li><a href="../documentations.php">Documentations</a></li>
                <li><a href="../a_propos.php">À propos</a></li>
                <li class="dropdown"><a href="#" class="btn">S’identifier</a>
                    <ul class="dropdown-content">
                        <li><a href="../signup.php">S’inscrire</a></li>
                        <li><a href="../login.php">Se connecter</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>