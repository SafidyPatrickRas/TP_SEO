<div class="page-header">
    <div>
        <h2 class="page-title">Modifier l'article</h2>
        <p class="page-meta">Mettez a jour le contenu et le statut.</p>
    </div>
</div>

<form method="post" action="/admin/articles/<?= (int)$post['id'] ?>" class="card form-card">
    <div class="form-field">
        <label for="title">Titre</label>
        <input id="title" type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required class="form-input">
    </div>

    <div class="form-field">
        <label for="content">Contenu</label>
        <textarea id="content" name="content" rows="8" required class="form-textarea"><?= htmlspecialchars($post['content']) ?></textarea>
    </div>

    <div class="form-field">
        <label for="status">Statut</label>
        <select id="status" name="status" class="form-select">
            <option value="draft" <?= $post['status'] === 'draft' ? 'selected' : '' ?>>Brouillon</option>
            <option value="published" <?= $post['status'] === 'published' ? 'selected' : '' ?>>Publie</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Mettre a jour</button>
</form>
