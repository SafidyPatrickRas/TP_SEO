<h2 style="margin-bottom: 20px;">Créer un article</h2>
<form method="post" action="/admin/articles" style="background:white;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
    <label>Titre</label><br>
    <input type="text" name="title" required style="width:100%;padding:10px;margin:8px 0 14px;"><br>

    <label>Contenu</label><br>
    <textarea name="content" rows="8" required style="width:100%;padding:10px;margin:8px 0 14px;"></textarea><br>

    <label>Statut</label><br>
    <select name="status" style="width:100%;padding:10px;margin:8px 0 14px;">
        <option value="draft">Brouillon</option>
        <option value="published">Publié</option>
    </select><br>

    <button type="submit" style="padding:10px 16px;background:#667eea;color:white;border:0;border-radius:5px;">Enregistrer</button>
</form>
