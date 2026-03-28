<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP_SEO - Iran Infos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header h1 {
            font-size: 2em;
            margin-bottom: 5px;
        }
        
        header p {
            opacity: 0.9;
        }
        
        nav {
            background-color: white;
            padding: 15px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        nav a {
            color: #333;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            transition: color 0.3s;
        }
        
        nav a:hover {
            color: #667eea;
        }
        
        main {
            padding: 40px 0;
        }
        
        .hero {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            text-align: center;
        }
        
        .hero h2 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.8em;
        }
        
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .post-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        
        .post-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3em;
        }
        
        .post-content {
            padding: 20px;
        }
        
        .post-title {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #333;
        }
        
        .post-excerpt {
            color: #666;
            font-size: 0.9em;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        
        .post-meta {
            font-size: 0.85em;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        .btn:hover {
            background-color: #764ba2;
        }
        
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: bold;
        }
        
        .status-published {
            background-color: #28a745;
            color: white;
        }
        
        .status-draft {
            background-color: #ffc107;
            color: #333;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="container">
            <h1>📰 TP_SEO - Iran Infos</h1>
            <p>Plateforme d'informations sur la géopolitique en Iran</p>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="/">🏠 Accueil</a>
            <a href="/articles">📰 Articles</a>
            <a href="/admin">⚙️ Admin</a>
        </div>
    </nav>
    
    <!-- Contenu principal -->
    <main>
        <div class="container">
            <div class="hero">
                <h2>Bienvenue sur TP_SEO</h2>
                <p>Découvrez nos derniers articles sur la situation géopolitique en Iran et ses implications régionales.</p>
            </div>
            
            <!-- Affichage des articles -->
            <?php if (!empty($posts)): ?>
                <h3 style="margin-bottom: 20px; font-size: 1.5em; color: #333;">Articles Récents</h3>
                <div class="posts-grid">
                    <?php foreach ($posts as $post): ?>
                        <div class="post-card">
                            <div class="post-image">📄</div>
                            <div class="post-content">
                                <h4 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h4>
                                <p class="post-excerpt">
                                    <?php echo substr(htmlspecialchars($post['content']), 0, 100) . '...'; ?>
                                </p>
                                <div class="post-meta">
                                    <span class="status-badge status-<?php echo $post['status']; ?>">
                                        <?php echo ucfirst($post['status']); ?>
                                    </span>
                                    <br><small>Créé le: <?php echo date('d/m/Y', strtotime($post['created_at'])); ?></small>
                                </div>
                                <a href="/article/<?php echo $post['slug']; ?>" class="btn">Lire l'article →</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="hero">
                    <p>Aucun article publié pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
    
    <!-- Pied de page -->
    <footer>
        <div class="container">
            <p>&copy; 2026 TP_SEO - Iran Infos. Tous droits réservés. | <a href="/admin" style="color: #667eea;">Panel Admin</a></p>
        </div>
    </footer>
</body>
</html>
