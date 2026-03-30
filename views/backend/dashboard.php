<div class="page-header">
    <div>
        <h2 class="page-title">Statistiques</h2>
        <p class="page-meta">Vue d'ensemble des contenus et activites.</p>
    </div>
    <div class="page-actions">
        <a href="/admin/articles/create" class="btn btn-primary">Creer un article</a>
    </div>
</div>

<div class="stats-grid">
    <div class="card stat-card">
        <div class="stat-value"><?= $postsCount['total'] ?? 0 ?></div>
        <div class="stat-label">Articles au total</div>
        <a href="/admin/articles" class="btn btn-secondary">Gerer</a>
    </div>

    <div class="card stat-card">
        <div class="stat-value"><?= $usersCount['total'] ?? 0 ?></div>
        <div class="stat-label">Utilisateurs</div>
        <a href="/admin" class="btn btn-secondary">Voir</a>
    </div>

    <div class="card stat-card">
        <div class="stat-value">Plan</div>
        <div class="stat-label">Nouveaux modules en preparation</div>
        <a href="#" class="btn btn-ghost">Bientot</a>
    </div>
</div>

<div class="card info-card">
    <h3>Bienvenue dans l'administration TP_SEO</h3>
    <p class="page-meta">Cette interface vous permet de gerer tous les contenus du site.</p>
</div>
