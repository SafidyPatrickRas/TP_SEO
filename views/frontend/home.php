<style>
    .hero {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        color: white;
        border-radius: 12px;
        padding: 40px;
        margin-bottom: 28px;
    }
    .hero h2 { font-size: 2rem; margin-bottom: 12px; }
    .hero p { color: #d1d5db; max-width: 800px; }
    .hero-actions { margin-top: 20px; display: flex; gap: 12px; flex-wrap: wrap; }
    .btn {
        display: inline-block;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }
    .btn-primary { background: #2563eb; color: white; }
    .btn-outline { border: 1px solid #4b5563; color: #e5e7eb; }

    .section-title { margin: 20px 0 14px; font-size: 1.3rem; }

    .featured {
        background: white;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin-bottom: 24px;
    }
    .featured small { color: #6b7280; }
    .featured h3 { margin: 8px 0 10px; font-size: 1.5rem; }
    .featured p { color: #374151; }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        gap: 16px;
    }
    .card {
        background: white;
        border-radius: 10px;
        padding: 18px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .card h4 { margin-bottom: 8px; }
    .card p { color: #4b5563; margin-bottom: 10px; }
    .chip-wrap { margin-top: 18px; display: flex; gap: 8px; flex-wrap: wrap; }
    .chip {
        background: #eef2ff;
        color: #3730a3;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.85rem;
    }
</style>

<section class="hero">
    <h2>Centre d'information sur la guerre en Iran</h2>
    <p>
        Analyses factuelles, suivi des événements et lecture géopolitique pour mieux comprendre les dynamiques du conflit et ses impacts régionaux.
    </p>
    <div class="hero-actions">
        <a class="btn btn-primary" href="/articles">Voir tous les articles</a>
        <a class="btn btn-outline" href="/articles?q=Iran">Rechercher “Iran”</a>
    </div>
</section>

<?php if (!empty($featuredPost)): ?>
    <section class="featured">
        <small>Article à la une</small>
        <h3><?= htmlspecialchars($featuredPost['title']) ?></h3>
        <p><?= htmlspecialchars(substr($featuredPost['content'], 0, 220)) ?>...</p>
        <div style="margin-top:10px; color:#6b7280; font-size:0.9rem;">Par <?= htmlspecialchars($featuredPost['author_name'] ?? 'Rédaction') ?> • <?= date('d/m/Y', strtotime($featuredPost['created_at'])) ?></div>
        <div style="margin-top:14px;">
            <a class="btn btn-primary" href="/article/<?= urlencode($featuredPost['slug']) ?>">Lire l'article</a>
        </div>
    </section>
<?php endif; ?>

<h3 class="section-title">Dernières publications</h3>

<?php if (!empty($posts)): ?>
    <section class="grid">
        <?php foreach ($posts as $post): ?>
            <article class="card">
                <h4><?= htmlspecialchars($post['title']) ?></h4>
                <p><?= htmlspecialchars(substr($post['content'], 0, 140)) ?>...</p>
                <small style="color:#6b7280;">Par <?= htmlspecialchars($post['author_name'] ?? 'Rédaction') ?> • <?= date('d/m/Y', strtotime($post['created_at'])) ?></small>
                <div style="margin-top:12px;">
                    <a class="btn btn-primary" href="/article/<?= urlencode($post['slug']) ?>">Détails</a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
<?php else: ?>
    <p>Aucun article publié pour le moment.</p>
<?php endif; ?>

<?php if (!empty($latestTags)): ?>
    <div class="chip-wrap">
        <?php foreach ($latestTags as $tag): ?>
            <span class="chip">#<?= htmlspecialchars($tag['name']) ?></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
