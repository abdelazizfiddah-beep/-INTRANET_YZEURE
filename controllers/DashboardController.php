<?php
/**
 * INTRANET MAIRIE D'YZEURE
 * Contrôleur du tableau de bord
 */

class DashboardController
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function index(): void
    {
        $user = current_user();

        // On récupère quelques actualités publiées pour la page d'accueil
        $stmt = $this->db->prepare('SELECT id, titre, chapeau, date_publication 
                                    FROM actualites
                                    WHERE statut = "publie"
                                    ORDER BY date_publication DESC
                                    LIMIT 5');
        $stmt->execute();
        $actualites = $stmt->fetchAll();

        // On charge la vue de dashboard
        require __DIR__ . '/../views/dashboard/index.php';
    }
}
/*** à expliquer:

Va chercher les 5 dernières actualités publiées.

Passe les données à la vue views/dashboard/index.php. */