 <?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

 <div class="container">
     <div class="page-header">
         <h2><i class="fas fa-home"></i> Bienvenue sur l'intranet</h2>
         <p>Bonjour <?php echo $_SESSION['user_prenom']; ?>, bienvenue sur votre espace de travail</p>
     </div>

     <div class="dashboard-grid">
         <!-- Actualités -->
         <div class="card card-large">
             <div class="card-header">
                 <h3><i class="fas fa-newspaper"></i> Actualités</h3>
             </div>
             <div class="card-body">
                 <?php if (!empty($actualites)): ?>
                     <?php foreach ($actualites as $actu): ?>
                         <div class="actualite-item">
                             <h4><?php echo htmlspecialchars($actu['titre']); ?></h4>
                             <p class="meta">
                                 <i class="fas fa-user"></i> <?php echo $actu['prenom'] . ' ' . $actu['nom']; ?> -
                                 <i class="fas fa-calendar"></i> <?php echo date('d/m/Y', strtotime($actu['date_publication'])); ?>
                             </p>
                             <p><?php echo nl2br(htmlspecialchars(substr($actu['contenu'], 0, 200))); ?>...</p>
                         </div>
                     <?php endforeach; ?>
                 <?php else: ?>
                     <p class="no-data">Aucune actualité pour le moment</p>
                 <?php endif; ?>
             </div>
         </div>

         <!-- Accès rapides -->
         <div class="card">
             <div class="card-header">
                 <h3><i class="fas fa-bolt"></i> Accès rapides</h3>
             </div>
             <div class="card-body">
                 <ul class="quick-links">
                     <li><a href="<?php echo BASE_URL; ?>/rh"><i class="fas fa-users"></i> Ressources Humaines</a></li>
                     <li><a href="<?php echo BASE_URL; ?>/documentation"><i class="fas fa-book"></i> Documentation</a></li>
                     <li><a href="<?php echo BASE_URL; ?>/organigramme"><i class="fas fa-sitemap"></i> Organigramme</a></li>
                     <li><a href="<?php echo BASE_URL; ?>/commun"><i class="fas fa-share-alt"></i> Outils communs</a></li>
                 </ul>
             </div>
         </div>

         <!-- Liens utiles -->
         <div class="card">
             <div class="card-header">
                 <h3><i class="fas fa-link"></i> Liens utiles</h3>
             </div>
             <div class="card-body">
                 <ul class="quick-links">
                     <li><a href="#"><i class="fas fa-phone"></i> Annuaire téléphonique</a></li>
                     <li><a href="#"><i class="fas fa-calendar-alt"></i> Astreinte des cadres</a></li>
                     <li><a href="#"><i class="fas fa-user-tie"></i> Permanence des élus</a></li>
                     <li><a href="#"><i class="fas fa-comments"></i> Forum utilisateurs</a></li>
                 </ul>
             </div>
         </div>
     </div>
 </div>

 <?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>