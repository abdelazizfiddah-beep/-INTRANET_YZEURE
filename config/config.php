<?php
// Configuration générale
define('SITE_NAME', 'Intranet Ville d\'Yzeure');
define('BASE_URL', 'http://localhost/intranet-yzeure/public');
define('ROOT_PATH', dirname(__DIR__));

// Fuseau horaire
date_default_timezone_set('Europe/Paris');

// Gestion des sessions
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fonction d'autoload pour charger automatiquement les classes
spl_autoload_register(function ($class_name) {
    $paths = [
        ROOT_PATH . '/app/controllers/' . $class_name . '.php',
        ROOT_PATH . '/app/models/' . $class_name . '.php'
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Fonctions utilitaires
function redirect($url)
{
    header('Location: ' . BASE_URL . '/' . $url);
    exit;
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        redirect('login');
    }
}
