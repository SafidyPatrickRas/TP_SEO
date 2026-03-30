<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Admin - TP_SEO') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
        }
        header h1 { font-size: 1.5em; }
        nav {
            background: white;
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        nav a {
            color: #667eea;
            text-decoration: none;
            margin-right: 30px;
            font-weight: 500;
        }
        nav a:hover { color: #764ba2; }
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<?php View::partial('admin/header.php', ['title' => $title ?? null]); ?>
<div class="container">
    <?php if (!empty($_SESSION['auth_user'])) : ?>
        <?php View::partial('admin/nav.php'); ?>
    <?php endif; ?>
    <?= $content ?>
</div>
<?php View::partial('admin/footer.php'); ?>
</body>
</html>
