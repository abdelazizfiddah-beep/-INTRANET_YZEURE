<?php
class AuthController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = new User($this->db);

            if ($user->authenticate($email, $password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_nom'] = $user->nom;
                $_SESSION['user_prenom'] = $user->prenom;
                $_SESSION['user_service'] = $user->service;
                $_SESSION['user_role'] = $user->role;

                redirect('');
            } else {
                $error = "Email ou mot de passe incorrect";
            }
        }

        require_once ROOT_PATH . '/app/views/pages/login.php';
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }
}
