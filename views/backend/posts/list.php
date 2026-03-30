<div class="page-header">
    <div>
        <h2 class="page-title">Gestion des articles</h2>
        <p class="page-meta">Consultez et mettez a jour les publications.</p>
    </div>
    <div class="page-actions">
        <a class="btn btn-primary" href="/admin/articles/create">Creer un article</a>
    </div>
</div>

<?php if (!empty($posts)): ?>
    <div class="card table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= (int)$post['id'] ?></td>
                        <td><?= htmlspecialchars($post['title']) ?></td>
                        <td><?= htmlspecialchars($post['status']) ?></td>
                        <td>
                            <div class="table-actions">
                                <a class="btn btn-ghost" href="/admin/articles/<?= (int)$post['id'] ?>/edit">Modifier</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="page-meta">Aucun article enregistre.</p>
<?php endif; ?>
