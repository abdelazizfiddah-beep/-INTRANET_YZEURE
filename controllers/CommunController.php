<?php
class CommunController
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

        $pageTitle = "Commun";
        require_once ROOT_PATH . '/app/views/pages/commun/index.php';
    }
}
