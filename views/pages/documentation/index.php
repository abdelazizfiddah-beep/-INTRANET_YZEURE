<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-book"></i> Documentation</h2>
    </div>

    <div class="content-grid">
        <div class="sidebar">
            <div class="card">
                <div class="card-header">
                    <h3>Catégories</h3>
                </div>
                <div class="card-body">
                    <ul class="menu-list">
                        <li><a href="<?php echo BASE_URL; ?>/documentation"><i class="fas fa-list"></i> Tous les documents</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/documentation?cat=procedures"><i class="fas fa-tasks"></i> Procédures</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/documentation?cat=guides"><i class="fas fa-book-open"></i> Guides</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/documentation?cat=deliberations"><i class="fas fa-gavel"></i> Délibérations</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/documentation?cat=formulaires"><i class="fas fa-file-alt"></i> Formulaires</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/documentation?cat=revue-presse"><i class="fas fa-newspaper"></i> Revue de presse</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content-area">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-folder-open"></i> Documents disponibles</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($documents)): ?>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Catégorie</th>
                                    <th>Date</th>
                                    <th>Auteur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($documents as $doc): ?>
                                    <tr>
                                        <td>
                                            <i class="fas fa-file-pdf"></i>
                                            <strong><?php echo htmlspecialchars($doc['titre']); ?></strong>
                                            <?php if ($doc['description']): ?>
                                                <br><small><?php echo htmlspecialchars($doc['description']); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td><span class="badge"><?php echo htmlspecialchars($doc['categorie']); ?></span></td>
                                        <td><?php echo date('d/m/Y', strtotime($doc['date_creation'])); ?></td>
                                        <td><?php echo $doc['prenom'] . ' ' . $doc['nom']; ?></td>
                                        <td>
                                            <a href="<?php echo BASE_URL; ?>/uploads/<?php echo $doc['fichier']; ?>" class="btn btn-sm btn-primary" target="_blank">
                                                <i class="fas fa-download"></i> Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="no-data"><i class="fas fa-info-circle"></i> Aucun document disponible dans cette catégorie</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>