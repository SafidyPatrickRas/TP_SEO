<div class="page-header">
    <div>
        <h2 class="page-title">Creer un article</h2>
        <p class="page-meta">Saisissez le contenu a publier.</p>
    </div>
</div>

<form method="post" action="/admin/articles" class="card form-card">
    <div class="form-field">
        <label for="title">Titre</label>
        <input id="title" type="text" name="title" required class="form-input">
    </div>

    <div class="form-field">
        <label for="content">Contenu</label>
        <textarea id="content" name="content" rows="8" required class="form-textarea"></textarea>
    </div>

    <div class="form-field">
        <label for="status">Statut</label>
        <select id="status" name="status" class="form-select">
            <option value="draft">Brouillon</option>
            <option value="published">Publie</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
