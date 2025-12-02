<?php
class RechercheController
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

        $resultats = [];
        $terme = '';

        if (isset($_GET['q'])) {
            $terme = $_GET['q'];
            $documentModel = new Document($this->db);
            $resultats = $documentModel->search($terme);
        }

        $pageTitle = "Recherche";
        require_once ROOT_PATH . '/app/views/pages/recherche.php';
    }
}
