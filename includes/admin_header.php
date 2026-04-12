<?php

declare(strict_types=1);

require_once __DIR__ . '/admin.php';

$adminPageTitle = $adminPageTitle ?? 'Admin | Diva Buildcom';
$adminHeading = $adminHeading ?? 'Admin';
$adminIntro = $adminIntro ?? 'Manage careers operations from one place.';
$adminIdentity = admin_identity();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($adminPageTitle) ?></title>
    <meta name="description" content="<?= e($adminIntro) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset_url('assets/css/styles.css')) ?>">
</head>
<body class="admin-body">
<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <a class="brand" href="<?= e(site_url()) ?>">Diva Buildcom</a>
            <p>Admin Terminal</p>
        </div>
        <nav class="admin-nav">
            <?php foreach (admin_nav_items() as $item): ?>
                <a href="<?= e($item['href']) ?>" class="<?= is_admin_page($item['page']) ? 'active' : '' ?>">
                    <span class="material-symbols-outlined"><?= e($item['icon']) ?></span>
                    <?= e($item['label']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
        <div class="admin-sidebar-card">
            <strong>Public Site</strong>
            <p>Careers listings and application submissions stay synced with this admin area.</p>
            <a class="button button-small button-primary" href="<?= e(site_url('careers.php')) ?>">View Careers Page</a>
        </div>
    </aside>
    <div class="admin-main">
        <header class="admin-topbar">
            <div>
                <h1><?= e($adminHeading) ?></h1>
                <p><?= e($adminIntro) ?></p>
            </div>
            <div class="admin-topbar-actions">
                <div class="admin-user-chip">
                    <strong><?= e($adminIdentity['display_name'] ?? 'Admin') ?></strong>
                    <span><?= e($adminIdentity['identity'] ?? '') ?></span>
                </div>
                <a class="button button-small button-dark" href="<?= e(admin_url('logout.php')) ?>">Logout</a>
            </div>
        </header>
        <main class="admin-page">
