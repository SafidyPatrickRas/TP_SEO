<style>
    .toolbar {
        padding: 22px;
        display: grid;
        gap: 10px;
        margin-bottom: 18px;
    }
    .toolbar h2 { font-size: 1.8rem; }
    .result-meta { color: rgba(56, 40, 51, 0.7); }
    .search-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .search-form input {
        flex: 1 1 280px;
        padding: 12px 14px;
        border: 1px solid rgba(64, 98, 128, 0.3);
        border-radius: 12px;
        font-family: inherit;
        background: rgba(255, 255, 255, 0.8);
    }
    .search-form button, .search-form a {
        padding: 10px 16px;
        border: 0;
        border-radius: 999px;
        background: linear-gradient(120deg, var(--accent), var(--navy));
        color: white;
        text-decoration: none;
        cursor: pointer;
        font-weight: 600;
    }
    .search-form a { background: rgba(95, 102, 147, 0.2); color: var(--ink); }

    .post-item {
        padding: 20px;
        border-radius: 18px;
        border: 1px solid rgba(56, 40, 51, 0.08);
        box-shadow: var(--shadow);
        margin-bottom: 16px;
        background: var(--panel);
    }
    .post-item h3 { margin-bottom: 8px; }
    .post-item p { color: rgba(56, 40, 51, 0.78); margin-bottom: 10px; }
    .post-meta { color: rgba(56, 40, 51, 0.65); font-size: 0.9rem; margin-bottom: 10px; }

    .btn-link {
        display: inline-flex;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(40, 144, 198, 0.18);
        color: var(--ink);
        text-decoration: none;
        font-weight: 600;
    }

    .pagination { margin-top: 16px; display: flex; gap: 8px; flex-wrap: wrap; }
    .pagination a, .pagination span {
        padding: 8px 12px;
        border-radius: 999px;
        border: 1px solid rgba(64, 98, 128, 0.35);
        text-decoration: none;
        color: var(--ink);
        background: rgba(255, 255, 255, 0.75);
        font-weight: 600;
    }
    .pagination .current {
        background: var(--accent);
        color: white;
        border-color: var(--accent);
    }
</style>

<section class="toolbar panel">
    <h2>Articles sur la guerre en Iran</h2>
    <p class="result-meta">Recherchez par mot-clé (titre ou contenu) pour filtrer les articles.</p>

    <form class="search-form" method="get" action="/articles">
        <input type="text" name="q" value="<?= htmlspecialchars($query ?? '') ?>" placeholder="Ex: sanctions, diplomatie, Téhéran...">
        <button type="submit">Rechercher</button>
        <?php if (!empty($query)): ?>
            <a href="/articles">Réinitialiser</a>
        <?php endif; ?>
    </form>
</section>

<p class="result-meta">
    <?= (int)($totalPosts ?? 0) ?> résultat(s)
    <?php if (!empty($query)): ?>
        pour “<?= htmlspecialchars($query) ?>”
    <?php endif; ?>
</p>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <article class="post-item">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <div class="post-meta">
                Par <?= htmlspecialchars($post['author_name'] ?? 'Rédaction') ?> • <?= date('d/m/Y', strtotime($post['created_at'])) ?>
            </div>
            <p><?= htmlspecialchars(substr($post['content'], 0, 220)) ?>...</p>
            <a class="btn-link" href="/article/<?= urlencode($post['slug']) ?>">Lire l'article</a>
        </article>
    <?php endforeach; ?>

    <?php if (($totalPages ?? 1) > 1): ?>
        <div class="pagination">
            <?php for ($currentPage = 1; $currentPage <= $totalPages; $currentPage++): ?>
                <?php
                    $queryString = '?page=' . $currentPage;
                    if (!empty($query)) {
                        $queryString .= '&q=' . urlencode($query);
                    }
                ?>
                <?php if ($currentPage === (int)$page): ?>
                    <span class="current"><?= $currentPage ?></span>
                <?php else: ?>
                    <a href="/articles<?= $queryString ?>"><?= $currentPage ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
<?php else: ?>
    <article class="post-item">
        <h3>Aucun article trouvé</h3>
        <p>Essayez un autre mot-clé ou revenez à la liste complète.</p>
    </article>
<?php endif; ?>
