<div class="page-header">
    <div>
        <h2 class="page-title">Gestion des categories</h2>
        <p class="page-meta">Organisez les categories visibles sur le site.</p>
    </div>
    <div class="page-actions">
        <a href="/admin/categories/create" class="btn btn-primary">Nouvelle categorie</a>
    </div>
</div>

<?php if (!empty($categories)): ?>
    <div class="card table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Creee le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= (int)$category['id'] ?></td>
                        <td><?= htmlspecialchars($category['name']) ?></td>
                        <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($category['created_at']))) ?></td>
                        <td>
                            <div class="table-actions">
                                <a class="btn btn-ghost" href="/admin/categories/<?= (int)$category['id'] ?>/edit">Modifier</a>
                                <form method="post" action="/admin/categories/<?= (int)$category['id'] ?>/delete" onsubmit="return confirm('Supprimer cette categorie ?');">
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
    <p class="page-meta">Aucune categorie enregistree.</p>
<?php endif; ?>
