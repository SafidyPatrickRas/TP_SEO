<style>
    .hero {
        position: relative;
        padding: 34px 36px;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(64, 98, 128, 0.9), rgba(95, 102, 147, 0.95));
        color: #fffaf7;
        overflow: hidden;
        margin-bottom: 28px;
    }
    .hero::after {
        content: '';
        position: absolute;
        right: -120px;
        top: -80px;
        width: 260px;
        height: 260px;
        background: radial-gradient(circle, rgba(247, 194, 187, 0.6), transparent 65%);
    }
    .hero .kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.22);
        font-weight: 600;
        font-size: 0.85rem;
    }
    .hero h2 { font-size: clamp(1.7rem, 2.6vw, 2.4rem); margin: 12px 0 10px; }
    .hero p { max-width: 720px; color: rgba(255, 250, 247, 0.85); }
    .hero-actions { margin-top: 18px; display: flex; gap: 12px; flex-wrap: wrap; }

    .home-layout {
        display: grid;
        grid-template-columns: minmax(0, 2.1fr) minmax(0, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }
    .feature {
        padding: 24px;
        display: grid;
        gap: 16px;
    }
    .feature-media {
        height: 240px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(40, 144, 198, 0.75), rgba(171, 109, 88, 0.75));
        border: 1px solid rgba(56, 40, 51, 0.1);
    }
    .feature small { color: rgba(56, 40, 51, 0.7); font-weight: 600; }
    .feature h3 { font-size: 1.6rem; }
    .feature p { color: rgba(56, 40, 51, 0.85); }

    .side-panel {
        padding: 20px;
        display: grid;
        gap: 14px;
    }
    .side-panel h4 { font-size: 1.1rem; }
    .mini-card {
        padding: 14px;
        border-radius: 14px;
        background: rgba(64, 98, 128, 0.08);
        border: 1px solid rgba(64, 98, 128, 0.2);
        display: grid;
        gap: 6px;
    }
    .mini-card span { font-size: 0.85rem; color: rgba(56, 40, 51, 0.7); }

    .section-title { margin: 18px 0 14px; font-size: 1.3rem; }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
    }
    .card {
        padding: 18px;
        border-radius: 16px;
        background: var(--panel);
        border: 1px solid rgba(56, 40, 51, 0.08);
        box-shadow: var(--shadow);
        display: grid;
        gap: 10px;
    }
    .card p { color: rgba(56, 40, 51, 0.78); }
    .card small { color: rgba(56, 40, 51, 0.6); }

    .chip-wrap { margin-top: 18px; display: flex; gap: 8px; flex-wrap: wrap; }
    .chip {
        background: rgba(255, 217, 193, 0.8);
        color: var(--ink);
        padding: 6px 12px;
        border-radius: 999px;
        border: 1px solid rgba(171, 109, 88, 0.3);
        font-size: 0.85rem;
        font-weight: 600;
    }

    @media (max-width: 900px) {
        .home-layout { grid-template-columns: 1fr; }
    }
</style>

<section class="hero panel">
    <span class="kicker">Veille geopolitique</span>
    <h2>Centre d'information sur la guerre en Iran</h2>
    <p>
        Analyses factuelles, suivi des evenements et lecture geopolitique pour comprendre les dynamiques du conflit et ses impacts regionaux.
    </p>
    <div class="hero-actions">
        <a class="btn btn-primary" href="/articles">Voir tous les articles</a>
        <a class="btn btn-outline" href="/articles?q=Iran">Rechercher "Iran"</a>
    </div>
</section>

<div class="home-layout">
    <?php if (!empty($featuredPost)): ?>
        <section class="feature panel">
            <div class="feature-media"></div>
            <small>Article a la une</small>
            <h3><?= htmlspecialchars($featuredPost['title']) ?></h3>
            <p><?= htmlspecialchars(substr($featuredPost['content'], 0, 220)) ?>...</p>
            <div style="color: rgba(56, 40, 51, 0.7); font-size: 0.9rem;">
                Par <?= htmlspecialchars($featuredPost['author_name'] ?? 'Redaction') ?> • <?= date('d/m/Y', strtotime($featuredPost['created_at'])) ?>
            </div>
            <div>
                <a class="btn btn-primary" href="/article/<?= urlencode($featuredPost['slug']) ?>">Lire l'article</a>
            </div>
        </section>
    <?php endif; ?>

    <aside class="side-panel panel">
        <h4>Focus rapides</h4>
        <?php if (!empty($posts)): ?>
            <?php $sideCount = 0; ?>
            <?php foreach ($posts as $post): ?>
                <?php if ($sideCount >= 4) { break; } ?>
                <div class="mini-card">
                    <strong><?= htmlspecialchars($post['title']) ?></strong>
                    <span><?= htmlspecialchars(substr($post['content'], 0, 80)) ?>...</span>
                </div>
                <?php $sideCount++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun article publie pour le moment.</p>
        <?php endif; ?>
        <a class="btn btn-muted" href="/articles">Voir plus</a>
    </aside>
</div>

<h3 class="section-title">Dernieres publications</h3>

<?php if (!empty($posts)): ?>
    <section class="grid">
        <?php foreach ($posts as $post): ?>
            <article class="card">
                <h4><?= htmlspecialchars($post['title']) ?></h4>
                <p><?= htmlspecialchars(substr($post['content'], 0, 140)) ?>...</p>
                <small>Par <?= htmlspecialchars($post['author_name'] ?? 'Redaction') ?> • <?= date('d/m/Y', strtotime($post['created_at'])) ?></small>
                <div>
                    <a class="btn btn-primary" href="/article/<?= urlencode($post['slug']) ?>">Details</a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
<?php else: ?>
    <p>Aucun article publie pour le moment.</p>
<?php endif; ?>

<?php if (!empty($latestTags)): ?>
    <div class="chip-wrap">
        <?php foreach ($latestTags as $tag): ?>
            <span class="chip">#<?= htmlspecialchars($tag['name']) ?></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
