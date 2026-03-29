<style>
.hero {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
.post-item {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}
.post-item h3 { margin-bottom: 10px; }
.post-item p { color: #666; margin-bottom: 10px; }
.btn {
    display: inline-block;
    padding: 8px 14px;
    background-color: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}
</style>

<div class="hero">
    <h2>Liste des articles</h2>
    <p>Retrouvez ici tous les articles publiés.</p>
</div>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <article class="post-item">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= htmlspecialchars(substr($post['content'], 0, 180)) ?>...</p>
            <a class="btn" href="/article/<?= urlencode($post['slug']) ?>">Lire</a>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun article trouvé.</p>
<?php endif; ?>
