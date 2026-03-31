<h2 style="margin-bottom: 20px;">Gestion des tags</h2>

<div style="margin-bottom: 16px;">
    <a href="/admin/tags/create" style="padding:10px 14px;background:#667eea;color:white;text-decoration:none;border-radius:5px;">+ Nouveau tag</a>
</div>

<?php if (!empty($tags)): ?>
    <table style="width:100%;background:white;border-collapse:collapse;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background:#f1f3f5;">
                <th style="padding:10px;text-align:left;">ID</th>
                <th style="padding:10px;text-align:left;">Nom</th>
                <th style="padding:10px;text-align:left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
                <tr>
                    <td style="padding:10px;border-top:1px solid #eee;"><?= (int)$tag['id'] ?></td>
                    <td style="padding:10px;border-top:1px solid #eee;"><?= htmlspecialchars($tag['name']) ?></td>
                    <td style="padding:10px;border-top:1px solid #eee;display:flex;gap:10px;align-items:center;">
                        <a href="/admin/tags/<?= (int)$tag['id'] ?>/edit">Modifier</a>
                        <form method="post" action="/admin/tags/<?= (int)$tag['id'] ?>/delete" onsubmit="return confirm('Supprimer ce tag ?');" style="display:inline;">
                            <button type="submit" style="background:#dc3545;color:white;border:0;border-radius:4px;padding:6px 10px;cursor:pointer;">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun tag enregistré.</p>
<?php endif; ?>
