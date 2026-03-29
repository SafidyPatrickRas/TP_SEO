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
    
    $featuredPost = $db->fetchOne(
        "SELECT p.*, u.name as author_name
         FROM posts p
         LEFT JOIN users u ON p.author_id = u.id
         WHERE p.status = 'published'
         ORDER BY p.created_at DESC
         LIMIT 1"
    );

    $posts = $db->fetchAll(
        "SELECT p.*, u.name as author_name
         FROM posts p
         LEFT JOIN users u ON p.author_id = u.id
         WHERE p.status = 'published'
         ORDER BY p.created_at DESC
         LIMIT 6"
    );

    $latestTags = $db->fetchAll("SELECT id, name FROM tags ORDER BY id DESC LIMIT 12");
    
<<<<<<< Updated upstream
    include VIEWS_PATH . '/frontend/home.php';
=======
    View::render('frontend/home.php', [
        'featuredPost' => $featuredPost,
        'posts' => $posts,
        'latestTags' => $latestTags,
        'title' => 'Actualités Guerre en Iran | TP_SEO',
        'metaDescription' => 'Suivez les dernières actualités, analyses et dossiers sur la guerre en Iran avec un suivi éditorial structuré et vérifié.'
    ], 'frontend');
>>>>>>> Stashed changes
});

// Liste des articles
$router->get('/articles', function() {
    $db = $_SESSION['db'];
    $page = (int)($_GET['page'] ?? 1);
    if ($page < 1) {
        $page = 1;
    }

    $query = trim($_GET['q'] ?? '');
    $limit = ITEMS_PER_PAGE;
    $offset = ($page - 1) * $limit;

    if ($query !== '') {
        $posts = $db->fetchAll(
            "SELECT p.*, u.name as author_name
             FROM posts p
             LEFT JOIN users u ON p.author_id = u.id
             WHERE p.status = 'published'
               AND (
                   LOWER(p.title) LIKE LOWER(?)
                   OR LOWER(p.content) LIKE LOWER(?)
               )
             ORDER BY p.created_at DESC
             LIMIT ? OFFSET ?",
            ['%' . $query . '%', '%' . $query . '%', $limit, $offset]
        );

        $countResult = $db->fetchOne(
            "SELECT COUNT(*) AS total
             FROM posts p
             WHERE p.status = 'published'
               AND (
                   LOWER(p.title) LIKE LOWER(?)
                   OR LOWER(p.content) LIKE LOWER(?)
               )",
            ['%' . $query . '%', '%' . $query . '%']
        );
    } else {
        $posts = $db->fetchAll(
            "SELECT p.*, u.name as author_name
             FROM posts p
             LEFT JOIN users u ON p.author_id = u.id
             WHERE p.status = 'published'
             ORDER BY p.created_at DESC
             LIMIT ? OFFSET ?",
            [$limit, $offset]
        );

        $countResult = $db->fetchOne(
            "SELECT COUNT(*) AS total FROM posts WHERE status = 'published'"
        );
    }

    $totalPosts = (int)($countResult['total'] ?? 0);
    $totalPages = (int)ceil($totalPosts / $limit);
    
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    include VIEWS_PATH . '/frontend/post-list.php';
=======
=======
>>>>>>> Stashed changes
    View::render('frontend/post-list.php', [
        'posts' => $posts,
        'query' => $query,
        'page' => $page,
        'totalPages' => $totalPages,
        'totalPosts' => $totalPosts,
        'title' => $query !== '' ? 'Recherche: ' . $query . ' | Articles Iran' : 'Articles Guerre en Iran | TP_SEO',
        'metaDescription' => $query !== ''
            ? 'Résultats de recherche pour "' . $query . '" sur les articles liés à la guerre en Iran.'
            : 'Consultez tous les articles publiés sur la guerre en Iran: analyses, contexte géopolitique et suivi de l’actualité.'
    ], 'frontend');
>>>>>>> Stashed changes
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

    $categories = $db->fetchAll(
        "SELECT c.id, c.name
         FROM post_category pc
         JOIN categories c ON c.id = pc.category_id
         WHERE pc.post_id = ?
         ORDER BY c.name ASC",
        [$post['id']]
    );

    $tags = $db->fetchAll(
        "SELECT t.id, t.name
         FROM post_tags pt
         JOIN tags t ON t.id = pt.tag_id
         WHERE pt.post_id = ?
         ORDER BY t.name ASC",
        [$post['id']]
    );

    $relatedPosts = $db->fetchAll(
        "SELECT id, title, slug
         FROM posts
         WHERE status = 'published' AND id <> ?
         ORDER BY created_at DESC
         LIMIT 4",
        [$post['id']]
    );
    
<<<<<<< Updated upstream
    include VIEWS_PATH . '/frontend/post-detail.php';
=======
    View::render('frontend/post-detail.php', [
        'post' => $post,
        'comments' => $comments,
        'categories' => $categories,
        'tags' => $tags,
        'relatedPosts' => $relatedPosts,
        'title' => ($post['title'] ?? 'Article') . ' | Dossier Iran',
        'metaDescription' => substr(trim(preg_replace('/\s+/', ' ', strip_tags($post['content'] ?? ''))), 0, 160)
    ], 'frontend');
>>>>>>> Stashed changes
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
