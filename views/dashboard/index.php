<?php
ob_start();
?>
<h2>Tableau de bord</h2>

<p>Bienvenue sur l'intranet de la mairie d'Yzeure.</p>

<h3>Dernières actualités</h3>
<?php if (!empty($actualites)): ?>
    <ul>
        <?php foreach ($actualites as $actu): ?>
            <li>
                <strong><?= e($actu['titre']); ?></strong>
                <br>
                <em><?= e($actu['chapeau'] ?? ''); ?></em>
                <br>
                <small>Publié le <?= e($actu['date_publication']); ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune actualité publiée pour le moment.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
