<?php
class AccueilController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index()
    {
        requireLogin();

        // Récupérer les actualités récentes
        $actualiteModel = new Actualite($this->db);
        $actualites = $actualiteModel->getRecent(5);

        $pageTitle = "Accueil";
        require_once ROOT_PATH . '/app/views/pages/accueil/index.php';
    }
}
