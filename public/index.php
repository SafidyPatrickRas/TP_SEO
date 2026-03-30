<?php
/**
 * TP_SEO - Point d'entrée principal
 * Ce fichier constitue le point d'entrée unique de l'application
 */

// Configuration de base
define('ROOT_PATH', dirname(__DIR__));
define('APP_DEBUG', true);
define('APP_ENV', 'dev');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chargement des variables d'environnement
$env_file = ROOT_PATH . '/config/.env';
if (file_exists($env_file)) {
    $env_vars = parse_ini_file($env_file);
    foreach ($env_vars as $key => $value) {
        putenv("$key=$value");
    }
}

// Chargement des fichiers noyau
require_once ROOT_PATH . '/config/constants.php';
require_once ROOT_PATH . '/src/Core/Database.php';
require_once ROOT_PATH . '/src/Core/Router.php';
require_once ROOT_PATH . '/src/Core/View.php';
require_once ROOT_PATH . '/src/Model/User.php';
require_once ROOT_PATH . '/src/Controller/AdminAuthController.php';

// Initialisation de la base de données
try {
    $db = new Database();
    $GLOBALS['db'] = $db;
} catch (Exception $e) {
    if (APP_DEBUG) {
        die("Erreur BD: " . $e->getMessage());
    }
    http_response_code(500);
    die("Erreur serveur");
}

// Création du routeur et définition des routes
$router = new Router();
require_once ROOT_PATH . '/config/routes.php';

// Récupération et dispatch de l'URL
$url = $_GET['url'] ?? '/';
$url = rtrim($url, '/');
if ($url === '') {
    $url = '/';
}
if ($url[0] !== '/') {
    $url = '/' . $url;
}

try {
    $router->dispatch($url, $_SERVER['REQUEST_METHOD']);
} catch (Exception $e) {
    if (APP_DEBUG) {
        die("Erreur: " . $e->getMessage());
    }
    http_response_code(404);
    View::render('errors/404.php', ['title' => '404 - Page non trouvée'], 'error');
}
?>
