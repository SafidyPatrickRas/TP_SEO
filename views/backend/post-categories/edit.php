<div class="page-header">
    <div>
        <h2 class="page-title">Modifier la relation post / categorie</h2>
        <p class="page-meta">Mettez a jour le lien entre article et categorie.</p>
    </div>
</div>

<form method="post" action="/admin/post-categories/update" class="card form-card">
    <input type="hidden" name="old_post_id" value="<?= (int)$relation['post_id'] ?>">
    <input type="hidden" name="old_category_id" value="<?= (int)$relation['category_id'] ?>">

    <div class="form-field">
        <label for="post_id">Article</label>
        <select id="post_id" name="post_id" required class="form-select">
            <?php foreach ($posts as $post): ?>
                <option value="<?= (int)$post['id'] ?>" <?= (int)$post['id'] === (int)$relation['post_id'] ? 'selected' : '' ?>>
                    #<?= (int)$post['id'] ?> - <?= htmlspecialchars($post['title']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-field">
        <label for="category_id">Categorie</label>
        <select id="category_id" name="category_id" required class="form-select">
            <?php foreach ($categories as $category): ?>
                <option value="<?= (int)$category['id'] ?>" <?= (int)$category['id'] === (int)$relation['category_id'] ? 'selected' : '' ?>>
                    #<?= (int)$category['id'] ?> - <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Mettre a jour</button>
    <a href="/admin/post-categories" class="btn btn-ghost">Annuler</a>
</form>
