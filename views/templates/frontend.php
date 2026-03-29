<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'TP_SEO - Iran Infos') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        header h1 { font-size: 2em; margin-bottom: 5px; }
        header p { opacity: 0.9; }
        nav {
            background-color: white;
            padding: 15px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        nav a {
            color: #333;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            transition: color 0.3s;
        }
        nav a:hover { color: #667eea; }
        main { padding: 40px 0; }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
        footer a { color: #667eea; }
    </style>
</head>
<body>
<?php View::partial('frontend/header.php', ['title' => $title ?? null]); ?>
<?php View::partial('frontend/nav.php'); ?>
<main>
    <div class="container">
        <?= $content ?>
    </div>
</main>
<?php View::partial('frontend/footer.php'); ?>
</body>
</html>
