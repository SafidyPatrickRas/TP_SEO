<style>
.post {
    background: white;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.post h1 { margin-bottom: 12px; }
.meta { color: #666; margin-bottom: 20px; }
.comments { margin-top: 30px; }
.comment {
    background: #fff;
    border-left: 4px solid #667eea;
    padding: 12px 16px;
    margin-bottom: 10px;
}
</style>

<article class="post">
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p class="meta">Auteur: <?= htmlspecialchars($post['author_name'] ?? 'Inconnu') ?></p>
    <div><?= nl2br(htmlspecialchars($post['content'])) ?></div>

    <section class="comments">
        <h2>Commentaires</h2>
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <strong><?= htmlspecialchars($comment['name']) ?></strong><br>
                    <?= nl2br(htmlspecialchars($comment['message'])) ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun commentaire pour le moment.</p>
        <?php endif; ?>
    </section>
</article>
