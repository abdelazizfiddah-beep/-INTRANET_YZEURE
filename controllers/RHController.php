<?php
class RHController
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

        $pageTitle = "Ressources Humaines";
        require_once ROOT_PATH . '/app/views/pages/rh/index.php';
    }
}
