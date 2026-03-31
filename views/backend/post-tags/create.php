<div class="page-header">
    <div>
        <h2 class="page-title">Creer une relation post / tag</h2>
        <p class="page-meta">Associez un article a un tag.</p>
    </div>
</div>

<form method="post" action="/admin/post-tags" class="card form-card">
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
        <label for="tag_id">Tag</label>
        <select id="tag_id" name="tag_id" required class="form-select">
            <option value="">-- Choisir un tag --</option>
            <?php foreach ($tags as $tag): ?>
                <option value="<?= (int)$tag['id'] ?>">#<?= (int)$tag['id'] ?> - <?= htmlspecialchars($tag['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/admin/post-tags" class="btn btn-ghost">Annuler</a>
</form>
