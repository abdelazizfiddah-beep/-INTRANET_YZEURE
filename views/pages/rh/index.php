<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-users"></i> Ressources Humaines</h2>
    </div>

    <div class="content-grid">
        <div class="sidebar">
            <div class="card">
                <div class="card-header">
                    <h3>Navigation RH</h3>
                </div>
                <div class="card-body">
                    <ul class="menu-list">
                        <li><a href="#droits-obligations"><i class="fas fa-balance-scale"></i> Droits et obligations</a></li>
                        <li><a href="#instances-paritaires"><i class="fas fa-handshake"></i> Instances paritaires</a></li>
                        <li><a href="#carriere"><i class="fas fa-chart-line"></i> Carrière</a></li>
                        <li><a href="#cadres-emploi"><i class="fas fa-briefcase"></i> Cadres d'emploi</a></li>
                        <li><a href="#remuneration"><i class="fas fa-euro-sign"></i> Rémunération</a></li>
                        <li><a href="#absences"><i class="fas fa-calendar-times"></i> Absences</a></li>
                        <li><a href="#retraite"><i class="fas fa-user-clock"></i> Retraite</a></li>
                        <li><a href="#formations"><i class="fas fa-graduation-cap"></i> Formations</a></li>
                        <li><a href="#concours"><i class="fas fa-trophy"></i> Concours</a></li>
                        <li><a href="#recrutements"><i class="fas fa-user-plus"></i> Recrutements</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content-area">
            <div class="card" id="droits-obligations">
                <div class="card-header">
                    <h3><i class="fas fa-balance-scale"></i> Droits et obligations des agents</h3>
                </div>
                <div class="card-body">
                    <p>Retrouvez ici l'ensemble des informations concernant vos droits et obligations en tant qu'agent de la fonction publique territoriale.</p>
                    <div class="button-group">
                        <a href="#" class="btn btn-secondary"><i class="fas fa-download"></i> Télécharger le guide</a>
                        <a href="#" class="btn btn-secondary"><i class="fas fa-file-pdf"></i> Statut de la FPT</a>
                    </div>
                </div>
            </div>

            <div class="card" id="carriere">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line"></i> Carrière</h3>
                </div>
                <div class="card-body">
                    <p>Informations sur le déroulement de carrière, l'avancement, les promotions internes.</p>
                    <div class="info-boxes">
                        <div class="info-box">
                            <i class="fas fa-arrow-up"></i>
                            <h4>Avancement de grade</h4>
                            <p>Conditions et procédures</p>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-star"></i>
                            <h4>Promotion interne</h4>
                            <p>Évolution professionnelle</p>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-clipboard-check"></i>
                            <h4>Entretien professionnel</h4>
                            <p>Évaluation annuelle</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="formations">
                <div class="card-header">
                    <h3><i class="fas fa-graduation-cap"></i> Formations</h3>
                </div>
                <div class="card-body">
                    <p>Catalogue des formations disponibles et modalités d'inscription.</p>
                    <a href="#" class="btn btn-primary"><i class="fas fa-book-open"></i> Voir le catalogue de formation</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-edit"></i> Demander une formation</a>
                </div>
            </div>

            <div class="card" id="absences">
                <div class="card-header">
                    <h3><i class="fas fa-calendar-times"></i> Gestion des absences</h3>
                </div>
                <div class="card-body">
                    <p>Congés, autorisations d'absence, arrêts maladie...</p>
                    <ul class="document-list">
                        <li><i class="fas fa-file-alt"></i> Demande de congé annuel</li>
                        <li><i class="fas fa-file-alt"></i> Autorisation d'absence</li>
                        <li><i class="fas fa-file-alt"></i> Déclaration d'accident de service</li>
                        <li><i class="fas fa-file-alt"></i> Certificat médical</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>