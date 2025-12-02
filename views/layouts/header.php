<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Intranet'; ?> - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php if (isLoggedIn()): ?>
        <header class="main-header">
            <div class="container">
                <div class="logo">
                    <h1><i class="fas fa-city"></i> Intranet Ville d'Yzeure</h1>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>/" class="<?php echo ($_SERVER['REQUEST_URI'] == '/intranet-yzeure/public/' || $_SERVER['REQUEST_URI'] == '/intranet-yzeure/public') ? 'active' : ''; ?>"><i class="fas fa-home"></i> Accueil</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/rh" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/rh') !== false) ? 'active' : ''; ?>"><i class="fas fa-users"></i> RH</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/commun" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/commun') !== false) ? 'active' : ''; ?>"><i class="fas fa-share-alt"></i> Commun</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/documentation" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/documentation') !== false) ? 'active' : ''; ?>"><i class="fas fa-book"></i> Documentation</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/organigramme"><i class="fas fa-sitemap"></i> Organigramme</a></li>
                    </ul>
                </nav>
                <div class="user-info">
                    <span><i class="fas fa-user"></i> <?php echo $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom']; ?></span>
                    <span class="service"><?php echo $_SESSION['user_service']; ?></span>
                    <a href="<?php echo BASE_URL; ?>/logout" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </div>
            </div>
        </header>

        <div class="search-bar">
            <div class="container">
                <form action="<?php echo BASE_URL; ?>/recherche" method="GET">
                    <input type="text" name="q" placeholder="Rechercher dans l'intranet..." value="<?php echo $_GET['q'] ?? ''; ?>">
                    <button type="submit"><i class="fas fa-search"></i> Rechercher</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <main class="main-content">