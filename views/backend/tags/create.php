<div class="page-header">
    <div>
        <h2 class="page-title">Creer un tag</h2>
        <p class="page-meta">Ajoutez un nouveau tag a associer aux articles.</p>
    </div>
</div>

<form method="post" action="/admin/tags" class="card form-card">
    <div class="form-field">
        <label for="name">Nom du tag</label>
        <input id="name" type="text" name="name" required class="form-input">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/admin/tags" class="btn btn-ghost">Annuler</a>
</form>
