<?php
/**
 * Constantes globales de l'application
 */

// Environnement
define('APP_NAME', 'TP_SEO - Iran Infos');
define('APP_VERSION', '1.0.0');

// Chemins
define('VIEWS_PATH', ROOT_PATH . '/views');
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('SRC_PATH', ROOT_PATH . '/src');

// URLs
define('SITE_URL', getenv('APP_URL') ?? 'http://localhost:8001');
define('ASSETS_URL', SITE_URL . '/assets');

// Base de données
define('DB_HOST', getenv('DB_HOST') ?? 'localhost');
define('DB_PORT', getenv('DB_PORT') ?? '5432');
define('DB_NAME', getenv('DB_NAME') ?? 'tp_seo');
define('DB_USER', getenv('DB_USER') ?? 'postgres');

// Configuration
define('ITEMS_PER_PAGE', 10);
define('MAX_UPLOAD_SIZE', 5242880); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf']);

// Rôles utilisateur
define('ROLE_ADMIN', 'admin');
define('ROLE_EDITOR', 'editor');

// Statuts d'articles
define('STATUS_DRAFT', 'draft');
define('STATUS_PUBLISHED', 'published');

// Chemins de redirection
define('URL_HOME', SITE_URL . '/');
define('URL_ADMIN', SITE_URL . '/admin');
define('URL_LOGIN', SITE_URL . '/login');
?>
