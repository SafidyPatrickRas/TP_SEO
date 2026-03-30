<div class="page-header">
    <div>
        <h2 class="page-title">Creer une relation post / categorie</h2>
        <p class="page-meta">Associez un article a une categorie.</p>
    </div>
</div>

<form method="post" action="/admin/post-categories" class="card form-card">
    <div class="form-field">
        <label for="post_id">Article</label>
        <select id="post_id" name="post_id" required class="form-select">
            <option value="">-- Choisir un article --</option>
            <?php foreach ($posts as $post): ?>
                <option value="<?= (int)$post['id'] ?>">#<?= (int)$post['id'] ?> - <?= htmlspecialchars($post['title']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-field">
        <label for="category_id">Categorie</label>
        <select id="category_id" name="category_id" required class="form-select">
            <option value="">-- Choisir une categorie --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int)$category['id'] ?>">#<?= (int)$category['id'] ?> - <?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/admin/post-categories" class="btn btn-ghost">Annuler</a>
</form>
