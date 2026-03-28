<?php
/**
 * Configuration des routes de l'application
 * Format: $router->get('/path', 'ControllerName@methodName');
 */

// ============ ROUTES FRONTEND (PUBLIQUES) ============

// Page d'accueil
$router->get('/', function() {
    $db = $_SESSION['db'] ?? null;
    if (!$db) {
        die("Base de données non initialisée");
    }
    
    $posts = $db->fetchAll("SELECT * FROM posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 10");
    
    include VIEWS_PATH . '/frontend/home.php';
});

// Liste des articles
$router->get('/articles', function() {
    $db = $_SESSION['db'];
    $page = $_GET['page'] ?? 1;
    $limit = ITEMS_PER_PAGE;
    $offset = ($page - 1) * $limit;
    
    $posts = $db->fetchAll(
        "SELECT * FROM posts WHERE status = 'published' ORDER BY created_at DESC LIMIT ? OFFSET ?",
        [$limit, $offset]
    );
    
    include VIEWS_PATH . '/frontend/post-list.php';
});

// Détail d'un article
$router->get('/article/:slug', function($slug) {
    $db = $_SESSION['db'];
    $post = $db->fetchOne(
        "SELECT p.*, u.name as author_name FROM posts p 
         LEFT JOIN users u ON p.author_id = u.id 
         WHERE p.slug = ? AND p.status = 'published'",
        [$slug]
    );
    
    if (!$post) {
        throw new Exception("Article non trouvé");
    }
    
    $comments = $db->fetchAll(
        "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC",
        [$post['id']]
    );
    
    include VIEWS_PATH . '/frontend/post-detail.php';
});

// ============ ROUTES BACKEND (ADMIN) ============

// Dashboard admin
$router->get('/admin', function() {
    $db = $_SESSION['db'];
    $postsCount = $db->fetchOne("SELECT COUNT(*) as total FROM posts");
    $usersCount = $db->fetchOne("SELECT COUNT(*) as total FROM users");
    
    include VIEWS_PATH . '/backend/dashboard.php';
});

// Liste des articles (admin)
$router->get('/admin/articles', function() {
    $db = $_SESSION['db'];
    $posts = $db->fetchAll("SELECT * FROM posts ORDER BY created_at DESC");
    include VIEWS_PATH . '/backend/posts/list.php';
});

// Créer un article
$router->get('/admin/articles/create', function() {
    $db = $_SESSION['db'];
    $categories = $db->fetchAll("SELECT * FROM categories ORDER BY name");
    include VIEWS_PATH . '/backend/posts/create.php';
});

// Éditer un article
$router->get('/admin/articles/:id/edit', function($id) {
    $db = $_SESSION['db'];
    $post = $db->fetchOne("SELECT * FROM posts WHERE id = ?", [$id]);
    if (!$post) throw new Exception("Article non trouvé");
    
    $categories = $db->fetchAll("SELECT * FROM categories ORDER BY name");
    include VIEWS_PATH . '/backend/posts/edit.php';
});

// Traitement formulaire créer article
$router->post('/admin/articles', function() {
    $db = $_SESSION['db'];
    
    $title = $_POST['title'] ?? '';
    $slug = str_replace(' ', '-', strtolower($title));
    $content = $_POST['content'] ?? '';
    $status = $_POST['status'] ?? 'draft';
    
    $db->query(
        "INSERT INTO posts (title, slug, content, status, created_at, updated_at) 
         VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)",
        [$title, $slug, $content, $status]
    );
    
    header("Location: /admin/articles");
    exit;
});

/**
 * AJOUTER D'AUTRES ROUTES AU BESOIN:
 * $router->post('/admin/articles/:id', 'PostController@update');
 * $router->delete('/admin/articles/:id', 'PostController@delete');
 * $router->get('/api/posts', 'ApiController@getPosts');
 * ...
 */
?>
