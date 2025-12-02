<?php
ob_start();
?>
<h2>Connexion à l'intranet</h2>

<?php if (!empty($errorMessage)): ?>
    <div style="color: red;"><?= e($errorMessage); ?></div>
<?php endif; ?>

<form method="post" action="/intranet-yzeure/public/index.php?route=login">
    <div>
        <label for="username">Identifiant</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Se connecter</button>
</form>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
/*ob_start() / ob_get_clean() capturent le contenu dans $content.

Puis le layout main.php est inclus pour l’entourer.*/