<h2 style="margin-bottom: 20px;">Modifier le tag</h2>

<form method="post" action="/admin/tags/<?= (int)$tag['id'] ?>/update" style="background:white;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);max-width:700px;">
    <label>Nom du tag</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($tag['name']) ?>" required style="width:100%;padding:10px;margin:8px 0 14px;"><br>

    <button type="submit" style="padding:10px 16px;background:#667eea;color:white;border:0;border-radius:5px;">Mettre à jour</button>
    <a href="/admin/tags" style="margin-left:10px;">Annuler</a>
</form>
