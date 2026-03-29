<style>
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

<div class="hero">
    <h2>Bienvenue sur TP_SEO</h2>
    <p>Découvrez nos derniers articles sur la situation géopolitique en Iran et ses implications régionales.</p>
</div>

<?php if (!empty($posts)): ?>
    <h3 style="margin-bottom: 20px; font-size: 1.5em; color: #333;">Articles Récents</h3>
    <div class="posts-grid">
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <div class="post-image">📄</div>
                <div class="post-content">
                    <h4 class="post-title"><?= htmlspecialchars($post['title']) ?></h4>
                    <p class="post-excerpt"><?= substr(htmlspecialchars($post['content']), 0, 100) . '...' ?></p>
                    <div class="post-meta">
                        <span class="status-badge status-<?= htmlspecialchars($post['status']) ?>">
                            <?= ucfirst($post['status']) ?>
                        </span>
                        <br><small>Créé le: <?= date('d/m/Y', strtotime($post['created_at'])) ?></small>
                    </div>
                    <a href="/article/<?= urlencode($post['slug']) ?>" class="btn">Lire l'article →</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="hero">
        <p>Aucun article publié pour le moment.</p>
    </div>
<?php endif; ?>
