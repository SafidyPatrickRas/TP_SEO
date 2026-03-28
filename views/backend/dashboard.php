<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TP_SEO</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
        }
        
        header h1 {
            font-size: 1.5em;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        nav {
            background: white;
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        nav a {
            color: #667eea;
            text-decoration: none;
            margin-right: 30px;
            font-weight: 500;
        }
        
        nav a:hover {
            color: #764ba2;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .card h3 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 2.5em;
        }
        
        .card p {
            color: #666;
            font-size: 1.1em;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #764ba2;
        }
        
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>⚙️ Dashboard Admin</h1>
        </div>
    </header>
    
    <div class="container">
        <nav>
            <a href="/">← Retour au site</a>
            <a href="/admin/articles">📰 Gestion Articles</a>
            <a href="/admin/articles/create">➕ Créer Article</a>
        </nav>
        
        <h2 style="margin: 30px 0;">Statistiques</h2>
        
        <div class="grid">
            <div class="card">
                <h3><?php echo $postsCount['total'] ?? 0; ?></h3>
                <p>Articles au total</p>
                <a href="/admin/articles" class="btn">Gérer</a>
            </div>
            
            <div class="card">
                <h3><?php echo $usersCount['total'] ?? 0; ?></h3>
                <p>Utilisateurs</p>
                <a href="/admin" class="btn">Voir</a>
            </div>
            
            <div class="card">
                <h3>🎯</h3>
                <p>En Développement</p>
                <a href="#" class="btn">Bientôt</a>
            </div>
        </div>
        
        <div style="margin-top: 40px; padding: 20px; background: white; border-radius: 8px;">
            <h3>Bienvenue dans l'administration TP_SEO!</h3>
            <p>Cette interface vous permet de gérer tous les contenus du site.</p>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2026 TP_SEO Admin | <a href="/" style="color: #667eea;">Retour au site</a></p>
    </footer>
</body>
</html>
