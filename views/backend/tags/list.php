<div class="page-header">
    <div>
        <h2 class="page-title">Gestion des tags</h2>
        <p class="page-meta">Suivez les tags associes aux articles.</p>
    </div>
    <div class="page-actions">
        <a href="/admin/tags/create" class="btn btn-primary">Nouveau tag</a>
    </div>
</div>

<?php if (!empty($tags)): ?>
    <div class="card table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tags as $tag): ?>
                    <tr>
                        <td><?= (int)$tag['id'] ?></td>
                        <td><?= htmlspecialchars($tag['name']) ?></td>
                        <td>
                            <div class="table-actions">
                                <a class="btn btn-ghost" href="/admin/tags/<?= (int)$tag['id'] ?>/edit">Modifier</a>
                                <form method="post" action="/admin/tags/<?= (int)$tag['id'] ?>/delete" onsubmit="return confirm('Supprimer ce tag ?');">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="page-meta">Aucun tag enregistre.</p>
<?php endif; ?>
