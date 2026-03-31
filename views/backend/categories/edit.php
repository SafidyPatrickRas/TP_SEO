<div class="page-header">
    <div>
        <h2 class="page-title">Modifier la categorie</h2>
        <p class="page-meta">Mettez a jour les informations de la categorie.</p>
    </div>
</div>

<form method="post" action="/admin/categories/<?= (int)$category['id'] ?>/update" class="card form-card">
    <div class="form-field">
        <label for="name">Nom de la categorie</label>
        <input id="name" type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required class="form-input">
    </div>

    <button type="submit" class="btn btn-primary">Mettre a jour</button>
    <a href="/admin/categories" class="btn btn-ghost">Annuler</a>
</form>
