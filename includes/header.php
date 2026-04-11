<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

$pageTitle = $pageTitle ?? 'Diva Buildcom';
$pageDescription = $pageDescription ?? config('site')['tagline'];
$site = config('site');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset_url('assets/css/styles.css')) ?>">
</head>
<body>
<header class="site-header">
    <div class="container nav-shell">
        <a class="brand" href="<?= e(site_url()) ?>">Diva Buildcom</a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="site-nav" id="primary-nav">
            <ul>
                <?php foreach ($navItems as $item): ?>
                    <li>
                        <a href="<?= e($item['href']) ?>" class="<?= is_active_page($item['page']) ? 'active' : '' ?>">
                            <?= e($item['label']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a class="button button-small button-primary" href="<?= e(site_url('contact.php')) ?>">Get a Quote</a>
        </nav>
    </div>
</header>
<main>
