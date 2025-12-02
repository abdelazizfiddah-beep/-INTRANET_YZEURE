<?php
require_once '../config/config.php';
require_once '../config/database.php';

// Récupérer l'URL demandée
$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/intranet-yzeure/public', '', $request);
$request = strtok($request, '?'); // Enlever les paramètres GET

// Router simple
switch ($request) {
    case '':
    case '/':
        require_once '../app/controllers/AccueilController.php';
        $controller = new AccueilController();
        $controller->index();
        break;

    case '/login':
        require_once '../app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;

    case '/logout':
        require_once '../app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;

    case '/rh':
        requireLogin();
        require_once '../app/controllers/RHController.php';
        $controller = new RHController();
        $controller->index();
        break;

    case '/documentation':
        requireLogin();
        require_once '../app/controllers/DocumentationController.php';
        $controller = new DocumentationController();
        $controller->index();
        break;

    case '/commun':
        requireLogin();
        require_once '../app/controllers/CommunController.php';
        $controller = new CommunController();
        $controller->index();
        break;

    case '/organigramme':
        requireLogin();
        require_once '../app/controllers/OrganigrammeController.php';
        $controller = new OrganigrammeController();
        $controller->index();
        break;

    case '/recherche':
        requireLogin();
        require_once '../app/controllers/RechercheController.php';
        $controller = new RechercheController();
        $controller->index();
        break;

    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}
