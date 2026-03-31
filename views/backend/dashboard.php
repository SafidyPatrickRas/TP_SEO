<style>
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
</style>

<h2 style="margin: 30px 0;">Statistiques</h2>

<div class="grid">
    <div class="card">
        <h3><?= $postsCount['total'] ?? 0 ?></h3>
        <p>Articles au total</p>
        <a href="/admin/articles" class="btn">Gérer</a>
    </div>

    <div class="card">
        <h3><?= $usersCount['total'] ?? 0 ?></h3>
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
