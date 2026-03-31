<div class="page-header">
    <div>
        <h2 class="page-title">Modifier la relation post / tag</h2>
        <p class="page-meta">Mettez a jour le lien entre article et tag.</p>
    </div>
</div>

<form method="post" action="/admin/post-tags/update" class="card form-card">
    <input type="hidden" name="old_post_id" value="<?= (int)$relation['post_id'] ?>">
    <input type="hidden" name="old_tag_id" value="<?= (int)$relation['tag_id'] ?>">

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
        <label for="tag_id">Tag</label>
        <select id="tag_id" name="tag_id" required class="form-select">
            <?php foreach ($tags as $tag): ?>
                <option value="<?= (int)$tag['id'] ?>" <?= (int)$tag['id'] === (int)$relation['tag_id'] ? 'selected' : '' ?>>
                    #<?= (int)$tag['id'] ?> - <?= htmlspecialchars($tag['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Mettre a jour</button>
    <a href="/admin/post-tags" class="btn btn-ghost">Annuler</a>
</form>
