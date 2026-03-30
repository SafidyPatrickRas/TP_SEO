<style>
    .article-wrap {
        padding: 28px;
        border-radius: 20px;
        border: 1px solid rgba(56, 40, 51, 0.08);
        box-shadow: var(--shadow);
        background: var(--panel);
    }
    .meta { color: rgba(56, 40, 51, 0.65); margin: 12px 0 18px; }
    .content { color: rgba(56, 40, 51, 0.9); line-height: 1.8; }
    .chips { margin: 16px 0; display: flex; gap: 8px; flex-wrap: wrap; }
    .chip {
        background: rgba(255, 217, 193, 0.8);
        color: var(--ink);
        padding: 6px 12px;
        border-radius: 999px;
        border: 1px solid rgba(171, 109, 88, 0.3);
        font-size: 0.85rem;
        font-weight: 600;
    }
    .section-title { margin: 26px 0 12px; }
    .related-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 12px;
    }
    .related-item {
        background: rgba(64, 98, 128, 0.08);
        border: 1px solid rgba(64, 98, 128, 0.2);
        border-radius: 14px;
        padding: 14px;
        text-decoration: none;
        color: var(--ink);
        font-weight: 600;
    }
    .comment {
        background: rgba(247, 194, 187, 0.35);
        border-left: 4px solid var(--rust);
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 10px;
    }
</style>

<article class="article-wrap">
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p class="meta">Par <?= htmlspecialchars($post['author_name'] ?? 'Rédaction') ?> • <?= date('d/m/Y', strtotime($post['created_at'])) ?></p>

    <?php if (!empty($categories)): ?>
        <div class="chips">
            <?php foreach ($categories as $category): ?>
                <span class="chip">Catégorie: <?= htmlspecialchars($category['name']) ?></span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($tags)): ?>
        <div class="chips">
            <?php foreach ($tags as $tag): ?>
                <span class="chip">#<?= htmlspecialchars($tag['name']) ?></span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="content"><?= nl2br(htmlspecialchars($post['content'])) ?></div>

    <h2 class="section-title">Commentaires</h2>
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

    <?php if (!empty($relatedPosts)): ?>
        <h2 class="section-title">Articles associés</h2>
        <div class="related-list">
            <?php foreach ($relatedPosts as $relatedPost): ?>
                <a class="related-item" href="/article/<?= urlencode($relatedPost['slug']) ?>">
                    <?= htmlspecialchars($relatedPost['title']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</article>
