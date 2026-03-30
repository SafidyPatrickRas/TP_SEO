<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Admin - TP_SEO') ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap');

        :root {
            --admin-accent: #2890c6;
            --admin-ink: #382833;
            --admin-navy: #406280;
            --admin-slate: #5f6693;
            --admin-rust: #ab6d58;
            --admin-rose: #f7c2bb;
            --admin-peach: #ffd9c1;
            --admin-bg: #f4f6f9;
            --admin-panel: #ffffff;
            --admin-border: #e3e7ef;
            --admin-shadow: 0 18px 40px rgba(22, 35, 53, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Manrope', sans-serif;
            background-color: var(--admin-bg);
            color: var(--admin-ink);
        }
        a { color: inherit; }

        .admin-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        header {
            background: #ffffff;
            border-bottom: 1px solid var(--admin-border);
            box-shadow: var(--admin-shadow);
        }
        .admin-header__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 0;
        }
        .admin-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .admin-mark {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--admin-accent), var(--admin-navy));
        }
        .admin-title {
            font-size: 1.5rem;
        }
        .admin-subtitle { color: #6c7a8b; font-size: 0.95rem; }

        nav {
            background: #ffffff;
            border-bottom: 1px solid var(--admin-border);
        }
        .admin-nav__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            flex-wrap: wrap;
        }
        .admin-tabs, .admin-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .admin-tab {
            padding: 8px 14px;
            border-radius: 999px;
            background: #f1f4f8;
            color: #2d3a4b;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid transparent;
        }
        .admin-tab:hover { border-color: var(--admin-accent); }

        .admin-main {
            padding: 28px 0 50px;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }
        .page-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .page-title { font-size: 1.6rem; }
        .page-meta { color: #6c7a8b; }

        .card {
            background: var(--admin-panel);
            border-radius: 16px;
            border: 1px solid var(--admin-border);
            box-shadow: var(--admin-shadow);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }
        .stat-card {
            padding: 20px;
            display: grid;
            gap: 10px;
        }
        .stat-value {
            font-size: 2.2rem;
            color: var(--admin-accent);
            font-weight: 700;
        }
        .stat-label { color: #5a6778; }

        .info-card {
            padding: 20px;
            margin-top: 24px;
        }

        .table-card {
            overflow: hidden;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }
        .admin-table thead {
            background: #f5f7fb;
            color: #3b4557;
        }
        .admin-table th, .admin-table td {
            padding: 12px 14px;
            text-align: left;
        }
        .admin-table tbody tr { border-top: 1px solid #eef1f6; }
        .table-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid transparent;
            cursor: pointer;
            background: transparent;
            color: inherit;
        }
        .btn-primary {
            background: var(--admin-accent);
            color: #ffffff;
        }
        .btn-secondary {
            background: #edf1f7;
            color: #2d3a4b;
        }
        .btn-ghost {
            border-color: #d4dbe6;
            color: #2d3a4b;
        }
        .btn-danger {
            background: var(--admin-rust);
            color: #ffffff;
        }

        .form-card {
            padding: 22px;
            max-width: 720px;
        }
        .form-field {
            display: grid;
            gap: 6px;
            margin-bottom: 14px;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid #d4dbe6;
            font-family: inherit;
        }
        .form-textarea { min-height: 160px; resize: vertical; }

        .auth-wrap {
            max-width: 420px;
            margin: 40px auto;
        }
        .auth-card { padding: 24px; }
        .alert {
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(247, 194, 187, 0.5);
            color: #7a2e2e;
            margin-bottom: 14px;
        }

        footer {
            background: #ffffff;
            color: #6c7a8b;
            text-align: center;
            padding: 18px;
            border-top: 1px solid var(--admin-border);
        }

        @media (max-width: 760px) {
            .admin-header__inner { align-items: flex-start; }
            .admin-tabs, .admin-actions { width: 100%; }
        }
    </style>
</head>
<body>
<?php View::partial('admin/header.php', ['title' => $title ?? null]); ?>
<?php if (!empty($_SESSION['auth_user'])) : ?>
    <?php View::partial('admin/nav.php'); ?>
<?php endif; ?>
<main class="admin-main">
    <div class="admin-container">
        <?= $content ?>
    </div>
</main>
<?php View::partial('admin/footer.php'); ?>
</body>
</html>
