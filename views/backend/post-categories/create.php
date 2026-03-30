<h2 style="margin-bottom: 20px;">Créer une relation Post / Catégorie</h2>

<form method="post" action="/admin/post-categories" style="background:white;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);max-width:700px;">
    <label>Article</label><br>
    <select name="post_id" required style="width:100%;padding:10px;margin:8px 0 14px;">
        <option value="">-- Choisir un article --</option>
        <?php foreach ($posts as $post): ?>
            <option value="<?= (int)$post['id'] ?>">#<?= (int)$post['id'] ?> - <?= htmlspecialchars($post['title']) ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Catégorie</label><br>
    <select name="category_id" required style="width:100%;padding:10px;margin:8px 0 14px;">
        <option value="">-- Choisir une catégorie --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= (int)$category['id'] ?>">#<?= (int)$category['id'] ?> - <?= htmlspecialchars($category['name']) ?></option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit" style="padding:10px 16px;background:#667eea;color:white;border:0;border-radius:5px;">Enregistrer</button>
    <a href="/admin/post-categories" style="margin-left:10px;">Annuler</a>
</form>
