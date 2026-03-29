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
    
    View::render('frontend/home.php', [
        'posts' => $posts,
        'title' => 'Accueil - TP_SEO'
    ], 'frontend');
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
    
    View::render('frontend/post-list.php', [
        'posts' => $posts,
        'title' => 'Articles - TP_SEO'
    ], 'frontend');
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
    
    View::render('frontend/post-detail.php', [
        'post' => $post,
        'comments' => $comments,
        'title' => ($post['title'] ?? 'Article') . ' - TP_SEO'
    ], 'frontend');
});

// ============ ROUTES BACKEND (ADMIN) ============

// Dashboard admin
$router->get('/admin', function() {
    $db = $_SESSION['db'];
    $postsCount = $db->fetchOne("SELECT COUNT(*) as total FROM posts");
    $usersCount = $db->fetchOne("SELECT COUNT(*) as total FROM users");
    
    View::render('backend/dashboard.php', [
        'postsCount' => $postsCount,
        'usersCount' => $usersCount,
        'title' => 'Dashboard Admin - TP_SEO'
    ], 'admin');
});

// Liste des articles (admin)
$router->get('/admin/articles', function() {
    $db = $_SESSION['db'];
    $posts = $db->fetchAll("SELECT * FROM posts ORDER BY created_at DESC");
    View::render('backend/posts/list.php', [
        'posts' => $posts,
        'title' => 'Gestion Articles - Admin'
    ], 'admin');
});

// Créer un article
$router->get('/admin/articles/create', function() {
    $db = $_SESSION['db'];
    $categories = $db->fetchAll("SELECT * FROM categories ORDER BY name");
    View::render('backend/posts/create.php', [
        'categories' => $categories,
        'title' => 'Créer Article - Admin'
    ], 'admin');
});

// Éditer un article
$router->get('/admin/articles/:id/edit', function($id) {
    $db = $_SESSION['db'];
    $post = $db->fetchOne("SELECT * FROM posts WHERE id = ?", [$id]);
    if (!$post) throw new Exception("Article non trouvé");
    
    $categories = $db->fetchAll("SELECT * FROM categories ORDER BY name");
    View::render('backend/posts/edit.php', [
        'post' => $post,
        'categories' => $categories,
        'title' => 'Modifier Article - Admin'
    ], 'admin');
});

// ============ CRUD CATEGORIES (ADMIN) ============

// Liste des catégories
$router->get('/admin/categories', function() {
    $db = $_SESSION['db'];
    $categories = $db->fetchAll("SELECT * FROM categories ORDER BY created_at DESC");

    View::render('backend/categories/list.php', [
        'categories' => $categories,
        'title' => 'Gestion Catégories - Admin'
    ], 'admin');
});

// Formulaire création catégorie
$router->get('/admin/categories/create', function() {
    View::render('backend/categories/create.php', [
        'title' => 'Créer Catégorie - Admin'
    ], 'admin');
});

// Enregistrement catégorie
$router->post('/admin/categories', function() {
    $db = $_SESSION['db'];
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        throw new Exception("Le nom de la catégorie est requis");
    }

    $db->query(
        "INSERT INTO categories (name, created_at) VALUES (?, CURRENT_TIMESTAMP)",
        [$name]
    );

    header("Location: /admin/categories");
    exit;
});

// Formulaire édition catégorie
$router->get('/admin/categories/:id/edit', function($id) {
    $db = $_SESSION['db'];
    $category = $db->fetchOne("SELECT * FROM categories WHERE id = ?", [$id]);

    if (!$category) {
        throw new Exception("Catégorie non trouvée");
    }

    View::render('backend/categories/edit.php', [
        'category' => $category,
        'title' => 'Modifier Catégorie - Admin'
    ], 'admin');
});

// Mise à jour catégorie
$router->post('/admin/categories/:id/update', function($id) {
    $db = $_SESSION['db'];
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        throw new Exception("Le nom de la catégorie est requis");
    }

    $db->query(
        "UPDATE categories SET name = ? WHERE id = ?",
        [$name, $id]
    );

    header("Location: /admin/categories");
    exit;
});

// Suppression catégorie
$router->post('/admin/categories/:id/delete', function($id) {
    $db = $_SESSION['db'];
    $db->query("DELETE FROM categories WHERE id = ?", [$id]);

    header("Location: /admin/categories");
    exit;
});

// ============ CRUD TAGS (ADMIN) ============

// Liste des tags
$router->get('/admin/tags', function() {
    $db = $_SESSION['db'];
    $tags = $db->fetchAll("SELECT * FROM tags ORDER BY id DESC");

    View::render('backend/tags/list.php', [
        'tags' => $tags,
        'title' => 'Gestion Tags - Admin'
    ], 'admin');
});

// Formulaire création tag
$router->get('/admin/tags/create', function() {
    View::render('backend/tags/create.php', [
        'title' => 'Créer Tag - Admin'
    ], 'admin');
});

// Enregistrement tag
$router->post('/admin/tags', function() {
    $db = $_SESSION['db'];
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        throw new Exception("Le nom du tag est requis");
    }

    $alreadyExists = $db->fetchOne("SELECT id FROM tags WHERE name = ?", [$name]);
    if ($alreadyExists) {
        throw new Exception("Ce tag existe déjà");
    }

    $db->query("INSERT INTO tags (name) VALUES (?)", [$name]);

    header("Location: /admin/tags");
    exit;
});

// Formulaire édition tag
$router->get('/admin/tags/:id/edit', function($id) {
    $db = $_SESSION['db'];
    $tag = $db->fetchOne("SELECT * FROM tags WHERE id = ?", [$id]);

    if (!$tag) {
        throw new Exception("Tag non trouvé");
    }

    View::render('backend/tags/edit.php', [
        'tag' => $tag,
        'title' => 'Modifier Tag - Admin'
    ], 'admin');
});

// Mise à jour tag
$router->post('/admin/tags/:id/update', function($id) {
    $db = $_SESSION['db'];
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        throw new Exception("Le nom du tag est requis");
    }

    $alreadyExists = $db->fetchOne("SELECT id FROM tags WHERE name = ? AND id <> ?", [$name, $id]);
    if ($alreadyExists) {
        throw new Exception("Un autre tag avec ce nom existe déjà");
    }

    $db->query("UPDATE tags SET name = ? WHERE id = ?", [$name, $id]);

    header("Location: /admin/tags");
    exit;
});

// Suppression tag
$router->post('/admin/tags/:id/delete', function($id) {
    $db = $_SESSION['db'];
    $db->query("DELETE FROM tags WHERE id = ?", [$id]);

    header("Location: /admin/tags");
    exit;
});

// ============ CRUD POST_CATEGORY (ADMIN) ============

// Liste des relations post/category
$router->get('/admin/post-categories', function() {
    $db = $_SESSION['db'];
    $relations = $db->fetchAll(
        "SELECT pc.post_id, pc.category_id, p.title AS post_title, c.name AS category_name
         FROM post_category pc
         JOIN posts p ON p.id = pc.post_id
         JOIN categories c ON c.id = pc.category_id
         ORDER BY p.id DESC, c.name ASC"
    );

    View::render('backend/post-categories/list.php', [
        'relations' => $relations,
        'title' => 'Gestion Post/Catégories - Admin'
    ], 'admin');
});

// Formulaire création relation
$router->get('/admin/post-categories/create', function() {
    $db = $_SESSION['db'];
    $posts = $db->fetchAll("SELECT id, title FROM posts ORDER BY id DESC");
    $categories = $db->fetchAll("SELECT id, name FROM categories ORDER BY name ASC");

    View::render('backend/post-categories/create.php', [
        'posts' => $posts,
        'categories' => $categories,
        'title' => 'Créer relation Post/Catégorie - Admin'
    ], 'admin');
});

// Enregistrement relation
$router->post('/admin/post-categories', function() {
    $db = $_SESSION['db'];
    $postId = (int)($_POST['post_id'] ?? 0);
    $categoryId = (int)($_POST['category_id'] ?? 0);

    if ($postId <= 0 || $categoryId <= 0) {
        throw new Exception("Post et catégorie sont requis");
    }

    $alreadyExists = $db->fetchOne(
        "SELECT 1 FROM post_category WHERE post_id = ? AND category_id = ?",
        [$postId, $categoryId]
    );

    if ($alreadyExists) {
        throw new Exception("Cette relation existe déjà");
    }

    $db->query(
        "INSERT INTO post_category (post_id, category_id) VALUES (?, ?)",
        [$postId, $categoryId]
    );

    header("Location: /admin/post-categories");
    exit;
});

// Formulaire édition relation
$router->get('/admin/post-categories/:postId/:categoryId/edit', function($postId, $categoryId) {
    $db = $_SESSION['db'];

    $relation = $db->fetchOne(
        "SELECT post_id, category_id FROM post_category WHERE post_id = ? AND category_id = ?",
        [$postId, $categoryId]
    );

    if (!$relation) {
        throw new Exception("Relation post/catégorie introuvable");
    }

    $posts = $db->fetchAll("SELECT id, title FROM posts ORDER BY id DESC");
    $categories = $db->fetchAll("SELECT id, name FROM categories ORDER BY name ASC");

    View::render('backend/post-categories/edit.php', [
        'relation' => $relation,
        'posts' => $posts,
        'categories' => $categories,
        'title' => 'Modifier relation Post/Catégorie - Admin'
    ], 'admin');
});

// Mise à jour relation
$router->post('/admin/post-categories/update', function() {
    $db = $_SESSION['db'];

    $oldPostId = (int)($_POST['old_post_id'] ?? 0);
    $oldCategoryId = (int)($_POST['old_category_id'] ?? 0);
    $newPostId = (int)($_POST['post_id'] ?? 0);
    $newCategoryId = (int)($_POST['category_id'] ?? 0);

    if ($oldPostId <= 0 || $oldCategoryId <= 0 || $newPostId <= 0 || $newCategoryId <= 0) {
        throw new Exception("Données de relation invalides");
    }

    if (!($oldPostId === $newPostId && $oldCategoryId === $newCategoryId)) {
        $alreadyExists = $db->fetchOne(
            "SELECT 1 FROM post_category WHERE post_id = ? AND category_id = ?",
            [$newPostId, $newCategoryId]
        );

        if ($alreadyExists) {
            throw new Exception("La nouvelle relation existe déjà");
        }
    }

    $db->query(
        "UPDATE post_category
         SET post_id = ?, category_id = ?
         WHERE post_id = ? AND category_id = ?",
        [$newPostId, $newCategoryId, $oldPostId, $oldCategoryId]
    );

    header("Location: /admin/post-categories");
    exit;
});

// Suppression relation
$router->post('/admin/post-categories/:postId/:categoryId/delete', function($postId, $categoryId) {
    $db = $_SESSION['db'];
    $db->query(
        "DELETE FROM post_category WHERE post_id = ? AND category_id = ?",
        [$postId, $categoryId]
    );

    header("Location: /admin/post-categories");
    exit;
});

// ============ CRUD POST_TAGS (ADMIN) ============

// Liste des relations post/tag
$router->get('/admin/post-tags', function() {
    $db = $_SESSION['db'];
    $relations = $db->fetchAll(
        "SELECT pt.post_id, pt.tag_id, p.title AS post_title, t.name AS tag_name
         FROM post_tags pt
         JOIN posts p ON p.id = pt.post_id
         JOIN tags t ON t.id = pt.tag_id
         ORDER BY p.id DESC, t.name ASC"
    );

    View::render('backend/post-tags/list.php', [
        'relations' => $relations,
        'title' => 'Gestion Post/Tags - Admin'
    ], 'admin');
});

// Formulaire création relation post/tag
$router->get('/admin/post-tags/create', function() {
    $db = $_SESSION['db'];
    $posts = $db->fetchAll("SELECT id, title FROM posts ORDER BY id DESC");
    $tags = $db->fetchAll("SELECT id, name FROM tags ORDER BY name ASC");

    View::render('backend/post-tags/create.php', [
        'posts' => $posts,
        'tags' => $tags,
        'title' => 'Créer relation Post/Tag - Admin'
    ], 'admin');
});

// Enregistrement relation post/tag
$router->post('/admin/post-tags', function() {
    $db = $_SESSION['db'];
    $postId = (int)($_POST['post_id'] ?? 0);
    $tagId = (int)($_POST['tag_id'] ?? 0);

    if ($postId <= 0 || $tagId <= 0) {
        throw new Exception("Post et tag sont requis");
    }

    $alreadyExists = $db->fetchOne(
        "SELECT 1 FROM post_tags WHERE post_id = ? AND tag_id = ?",
        [$postId, $tagId]
    );

    if ($alreadyExists) {
        throw new Exception("Cette relation existe déjà");
    }

    $db->query(
        "INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)",
        [$postId, $tagId]
    );

    header("Location: /admin/post-tags");
    exit;
});

// Formulaire édition relation post/tag
$router->get('/admin/post-tags/:postId/:tagId/edit', function($postId, $tagId) {
    $db = $_SESSION['db'];

    $relation = $db->fetchOne(
        "SELECT post_id, tag_id FROM post_tags WHERE post_id = ? AND tag_id = ?",
        [$postId, $tagId]
    );

    if (!$relation) {
        throw new Exception("Relation post/tag introuvable");
    }

    $posts = $db->fetchAll("SELECT id, title FROM posts ORDER BY id DESC");
    $tags = $db->fetchAll("SELECT id, name FROM tags ORDER BY name ASC");

    View::render('backend/post-tags/edit.php', [
        'relation' => $relation,
        'posts' => $posts,
        'tags' => $tags,
        'title' => 'Modifier relation Post/Tag - Admin'
    ], 'admin');
});

// Mise à jour relation post/tag
$router->post('/admin/post-tags/update', function() {
    $db = $_SESSION['db'];

    $oldPostId = (int)($_POST['old_post_id'] ?? 0);
    $oldTagId = (int)($_POST['old_tag_id'] ?? 0);
    $newPostId = (int)($_POST['post_id'] ?? 0);
    $newTagId = (int)($_POST['tag_id'] ?? 0);

    if ($oldPostId <= 0 || $oldTagId <= 0 || $newPostId <= 0 || $newTagId <= 0) {
        throw new Exception("Données de relation invalides");
    }

    if (!($oldPostId === $newPostId && $oldTagId === $newTagId)) {
        $alreadyExists = $db->fetchOne(
            "SELECT 1 FROM post_tags WHERE post_id = ? AND tag_id = ?",
            [$newPostId, $newTagId]
        );

        if ($alreadyExists) {
            throw new Exception("La nouvelle relation existe déjà");
        }
    }

    $db->query(
        "UPDATE post_tags
         SET post_id = ?, tag_id = ?
         WHERE post_id = ? AND tag_id = ?",
        [$newPostId, $newTagId, $oldPostId, $oldTagId]
    );

    header("Location: /admin/post-tags");
    exit;
});

// Suppression relation post/tag
$router->post('/admin/post-tags/:postId/:tagId/delete', function($postId, $tagId) {
    $db = $_SESSION['db'];
    $db->query(
        "DELETE FROM post_tags WHERE post_id = ? AND tag_id = ?",
        [$postId, $tagId]
    );

    header("Location: /admin/post-tags");
    exit;
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
