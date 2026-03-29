<h2 style="margin-bottom: 20px;">Modifier la relation Post / Catégorie</h2>

<form method="post" action="/admin/post-categories/update" style="background:white;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);max-width:700px;">
    <input type="hidden" name="old_post_id" value="<?= (int)$relation['post_id'] ?>">
    <input type="hidden" name="old_category_id" value="<?= (int)$relation['category_id'] ?>">

    <label>Article</label><br>
    <select name="post_id" required style="width:100%;padding:10px;margin:8px 0 14px;">
        <?php foreach ($posts as $post): ?>
            <option value="<?= (int)$post['id'] ?>" <?= (int)$post['id'] === (int)$relation['post_id'] ? 'selected' : '' ?>>
                #<?= (int)$post['id'] ?> - <?= htmlspecialchars($post['title']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Catégorie</label><br>
    <select name="category_id" required style="width:100%;padding:10px;margin:8px 0 14px;">
        <?php foreach ($categories as $category): ?>
            <option value="<?= (int)$category['id'] ?>" <?= (int)$category['id'] === (int)$relation['category_id'] ? 'selected' : '' ?>>
                #<?= (int)$category['id'] ?> - <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit" style="padding:10px 16px;background:#667eea;color:white;border:0;border-radius:5px;">Mettre à jour</button>
    <a href="/admin/post-categories" style="margin-left:10px;">Annuler</a>
</form>
