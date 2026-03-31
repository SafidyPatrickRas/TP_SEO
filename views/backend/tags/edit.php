<div class="page-header">
    <div>
        <h2 class="page-title">Modifier le tag</h2>
        <p class="page-meta">Mettez a jour le tag selectionne.</p>
    </div>
</div>

<form method="post" action="/admin/tags/<?= (int)$tag['id'] ?>/update" class="card form-card">
    <div class="form-field">
        <label for="name">Nom du tag</label>
        <input id="name" type="text" name="name" value="<?= htmlspecialchars($tag['name']) ?>" required class="form-input">
    </div>

    <button type="submit" class="btn btn-primary">Mettre a jour</button>
    <a href="/admin/tags" class="btn btn-ghost">Annuler</a>
</form>
