<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-sitemap"></i> Organigramme des services</h2>
        <p>Structure organisationnelle de la Ville d'Yzeure</p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="organigramme-container">
                <!-- Direction Générale -->
                <div class="org-level-1">
                    <div class="org-box org-maire">
                        <h3>Maire</h3>
                        <p><strong>Pascal Perrin</strong></p>
                        <p class="org-subtitle">Président du CCAS</p>
                    </div>

                    <div class="org-box org-dgs">
                        <h3>Directeur Général des Services</h3>
                        <p><strong>Luc Reverdy</strong></p>
                    </div>
                </div>

                <!-- Services rattachés à la DGS -->
                <div class="org-level-2">
                    <div class="org-box">
                        <h4><i class="fas fa-bullhorn"></i> Communication</h4>
                        <p><strong>Louisa Merchadier</strong></p>
                    </div>

                    <div class="org-box">
                        <h4><i class="fas fa-shield-alt"></i> Police Municipale</h4>
                        <p><strong>Thierry Saunier</strong></p>
                    </div>

                    <div class="org-box">
                        <h4><i class="fas fa-users"></i> Ressources Humaines</h4>
                        <p><strong>Jean-Baptiste Maronne</strong></p>
                    </div>

                    <div class="org-box">
                        <h4><i class="fas fa-hard-hat"></i> Prévention des risques</h4>
                        <p><strong>Anthony Duc</strong></p>
                    </div>
                </div>

                <!-- Directions -->
                <div class="org-level-3">
                    <div class="org-box org-direction">
                        <h4><i class="fas fa-calculator"></i> Direction des ressources administratives</h4>
                        <p><strong>Christelle Perrin</strong></p>
                        <p class="org-subtitle">Adjointe au DGS</p>
                        <ul class="org-services">
                            <li>Administration générale - Jérôme Guigue</li>
                            <li>Systèmes d'information - Cheikh Fall</li>
                        </ul>
                    </div>

                    <div class="org-box org-direction">
                        <h4><i class="fas fa-tools"></i> Direction des services techniques</h4>
                        <p><strong>Guillaume Couble</strong></p>
                        <ul class="org-services">
                            <li>Logistique - Vincent Buzalski</li>
                            <li>Ingénierie - Sandra Genest</li>
                            <li>Bâtiments - Philippe Vif</li>
                            <li>Espaces publics - Guillaume Cante</li>
                        </ul>
                    </div>

                    <div class="org-box org-direction">
                        <h4><i class="fas fa-theater-masks"></i> Direction action sportive, culturelle et solidaire</h4>
                        <p><strong>Olivier Dudun</strong></p>
                        <ul class="org-services">
                            <li>Spectacle vivant - Claude Bouret</li>
                            <li>Centre social - Magali Leiffet-Parguel</li>
                            <li>Sports - Stéphane Chanet</li>
                            <li>Lecture - Karine Gougnot</li>
                        </ul>
                    </div>

                    <div class="org-box org-direction">
                        <h4><i class="fas fa-child"></i> Direction de l'enfance</h4>
                        <p><strong>Anne-Claire Cantineau</strong></p>
                        <ul class="org-services">
                            <li>Jeunesse - Marie-Laure Pommier</li>
                            <li>Multi-accueil L'Escalette - Charlène Brun</li>
                            <li>Multi-accueil Yzatis - Sonia Frileux</li>
                            <li>Micro-crèche - Camille Jeune</li>
                            <li>Crèche familiale - Morgane Aubard</li>
                            <li>Relais petite enfance - Isabelle Ray</li>
                        </ul>
                    </div>

                    <div class="org-box org-direction">
                        <h4><i class="fas fa-utensils"></i> Direction restauration municipale</h4>
                        <p><strong>Guillaume Saunier</strong></p>
                        <ul class="org-services">
                            <li>Restauration scolaire - Arnaud Harasse</li>
                            <li>Gestion administrative - Agnès Perrot</li>
                        </ul>
                    </div>

                    <div class="org-box org-direction">
                        <h4><i class="fas fa-hand-holding-heart"></i> CCAS</h4>
                        <p><strong>Sylvie Asseloos</strong></p>
                        <ul class="org-services">
                            <li>EHPAD La Gloriette - Franck Réau</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="org-actions">
                <a href="<?php echo BASE_URL; ?>/uploads/organigramme.pdf" class="btn btn-primary" target="_blank">
                    <i class="fas fa-download"></i> Télécharger l'organigramme complet (PDF)
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>