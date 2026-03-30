<div style="max-width: 420px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
    <h2 style="margin-bottom: 15px;">Connexion Admin</h2>

    <?php if (!empty($error)) : ?>
        <div style="background: #fdecea; color: #b42318; padding: 10px 12px; border-radius: 6px; margin-bottom: 15px;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="/login">
        <div style="margin-bottom: 12px;">
            <label for="email" style="display: block; margin-bottom: 6px;">Email</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label for="password" style="display: block; margin-bottom: 6px;">Mot de passe</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;">
        </div>

        <button type="submit" style="background: #667eea; color: white; border: none; padding: 10px 14px; border-radius: 6px; cursor: pointer;">Se connecter</button>
    </form>
</div>
