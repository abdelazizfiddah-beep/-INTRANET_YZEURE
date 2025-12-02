<?php
class OrganigrammeController
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

        $pageTitle = "Organigramme";
        require_once ROOT_PATH . '/app/views/pages/organigramme.php';
    }
}
