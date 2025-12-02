<?php
class DocumentationController
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

        $documentModel = new Document($this->db);

        // Récupérer la catégorie si spécifiée
        $categorie = $_GET['cat'] ?? null;
        $documents = $documentModel->getAll($categorie);

        $pageTitle = "Documentation";
        require_once ROOT_PATH . '/app/views/pages/documentation/index.php';
    }
}
