<?php
// Layout principal
$user = current_user();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Intranet Mairie d'Yzeure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/intranet-yzeure/public/css/style.css">
</head>
<body>
<header>
    <h1>Intranet - Mairie d'Yzeure</h1>
    <?php if ($user): ?>
        <div>
            Connecté en tant que <?= e($user['prenom'] . ' ' . $user['nom']); ?> (<?= e($user['role']); ?>)
            | <a href="/intranet-yzeure/public/index.php?route=dashboard">Dashboard</a>
            | <a href="/intranet-yzeure/public/index.php?route=annuaire">Annuaire</a>
            | <a href="/intranet-yzeure/public/index.php?route=logout">Déconnexion</a>
        </div>
    <?php endif; ?>
</header>

<main>
    <?php // le contenu spécifique de chaque page sera inséré ici ?>
    <?= $content ?? ''; ?>
</main>

<footer>
    <small>© Mairie d'Yzeure - Intranet</small>
</footer>
</body>
</html>
