<h2 style="margin-bottom: 20px;">Gestion des relations Post / Tag</h2>

<div style="margin-bottom: 16px;">
    <a href="/admin/post-tags/create" style="padding:10px 14px;background:#667eea;color:white;text-decoration:none;border-radius:5px;">+ Nouvelle relation</a>
</div>

<?php if (!empty($relations)): ?>
    <table style="width:100%;background:white;border-collapse:collapse;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background:#f1f3f5;">
                <th style="padding:10px;text-align:left;">Post ID</th>
                <th style="padding:10px;text-align:left;">Article</th>
                <th style="padding:10px;text-align:left;">Tag ID</th>
                <th style="padding:10px;text-align:left;">Tag</th>
                <th style="padding:10px;text-align:left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($relations as $relation): ?>
                <tr>
                    <td style="padding:10px;border-top:1px solid #eee;"><?= (int)$relation['post_id'] ?></td>
                    <td style="padding:10px;border-top:1px solid #eee;"><?= htmlspecialchars($relation['post_title']) ?></td>
                    <td style="padding:10px;border-top:1px solid #eee;"><?= (int)$relation['tag_id'] ?></td>
                    <td style="padding:10px;border-top:1px solid #eee;"><?= htmlspecialchars($relation['tag_name']) ?></td>
                    <td style="padding:10px;border-top:1px solid #eee;display:flex;gap:10px;align-items:center;">
                        <a href="/admin/post-tags/<?= (int)$relation['post_id'] ?>/<?= (int)$relation['tag_id'] ?>/edit">Modifier</a>
                        <form method="post" action="/admin/post-tags/<?= (int)$relation['post_id'] ?>/<?= (int)$relation['tag_id'] ?>/delete" onsubmit="return confirm('Supprimer cette relation ?');" style="display:inline;">
                            <button type="submit" style="background:#dc3545;color:white;border:0;border-radius:4px;padding:6px 10px;cursor:pointer;">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucune relation post/tag enregistrée.</p>
<?php endif; ?>
