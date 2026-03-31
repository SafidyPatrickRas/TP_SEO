<div class="auth-wrap">
    <div class="card auth-card">
        <h2 class="page-title">Connexion admin</h2>
        <p class="page-meta">Acces reserve a la gestion du site.</p>

        <?php if (!empty($error)) : ?>
            <div class="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/login">
            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required class="form-input">
            </div>

            <div class="form-field">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required class="form-input">
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</div>
