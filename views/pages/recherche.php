<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-search"></i> Résultats de recherche</h2>
        <?php if (!empty($terme)): ?>
            <p>Résultats pour : <strong><?php echo htmlspecialchars($terme); ?></strong></p>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (!empty($terme)): ?>
                <?php if (!empty($resultats)): ?>
                    <p class="search-info">
                        <i class="fas fa-info-circle"></i> <?php echo count($resultats); ?> document(s) trouvé(s)
                    </p>

                    <div class="search-results">
                        <?php foreach ($resultats as $doc): ?>
                            <div class="search-result-item">
                                <h3>
                                    <i class="fas fa-file-alt"></i>
                                    <?php echo htmlspecialchars($doc['titre']); ?>
                                </h3>
                                <p class="result-meta">
                                    <span class="badge"><?php echo htmlspecialchars($doc['categorie']); ?></span>
                                    <span><i class="fas fa-user"></i> <?php echo $doc['prenom'] . ' ' . $doc['nom']; ?></span>
                                    <span><i class="fas fa-calendar"></i> <?php echo date('d/m/Y', strtotime($doc['date_creation'])); ?></span>
                                </p>
                                <?php if ($doc['description']): ?>
                                    <p><?php echo htmlspecialchars($doc['description']); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo BASE_URL; ?>/uploads/<?php echo $doc['fichier']; ?>" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h3>Aucun résultat trouvé</h3>
                        <p>Essayez avec d'autres mots-clés ou vérifiez l'orthographe.</p>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="search-empty">
                    <i class="fas fa-search"></i>
                    <h3>Effectuez une recherche</h3>
                    <p>Utilisez la barre de recherche ci-dessus pour trouver des documents, procédures, ou informations.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>