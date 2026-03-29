<h2 style="margin-bottom: 20px;">Créer une catégorie</h2>

<form method="post" action="/admin/categories" style="background:white;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);max-width:700px;">
    <label>Nom de la catégorie</label><br>
    <input type="text" name="name" required style="width:100%;padding:10px;margin:8px 0 14px;"><br>

    <button type="submit" style="padding:10px 16px;background:#667eea;color:white;border:0;border-radius:5px;">Enregistrer</button>
    <a href="/admin/categories" style="margin-left:10px;">Annuler</a>
</form>
