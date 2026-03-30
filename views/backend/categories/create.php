<div class="page-header">
    <div>
        <h2 class="page-title">Creer une categorie</h2>
        <p class="page-meta">Ajoutez une nouvelle categorie au site.</p>
    </div>
</div>

<form method="post" action="/admin/categories" class="card form-card">
    <div class="form-field">
        <label for="name">Nom de la categorie</label>
        <input id="name" type="text" name="name" required class="form-input">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/admin/categories" class="btn btn-ghost">Annuler</a>
</form>
