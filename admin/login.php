<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

require_admin_guest();

$flash = get_flash('admin_auth');
$pageTitle = 'Admin Sign In | Diva Buildcom';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="Sign in to the Diva Buildcom admin area.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset_url('assets/css/styles.css')) ?>">
</head>
<body class="admin-auth-body">
    <div class="admin-auth-shell">
        <div class="admin-auth-card">
            <div class="admin-auth-logo">Diva Buildcom</div>
            <h2>Admin Sign In</h2>
            <p>Enter your credentials to access the dashboard.</p>
            <?php if ($flash !== null): ?>
                <div class="flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
                    <div><?= e($flash['message']) ?></div>
                </div>
            <?php endif; ?>
            <form action="<?= e(site_url('handlers/admin_login.php')) ?>" method="post" novalidate>
                <?= csrf_field() ?>
                <div class="field">
                    <label for="admin_identity">Email</label>
                    <input id="admin_identity" name="identity" type="email" value="<?= e(old_input($flash, 'identity', '')) ?>" placeholder="admin@divabuildcom.local" required>
                    <?php if ($error = field_error($flash, 'identity')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                </div>
                <div class="field">
                    <label for="admin_password">Password</label>
                    <input id="admin_password" name="password" type="password" placeholder="Enter password" required>
                    <?php if ($error = field_error($flash, 'password')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                </div>
                <button class="button button-dark admin-auth-submit" type="submit">Sign In</button>
            </form>
            <a class="admin-auth-back" href="<?= e(site_url()) ?>">Back to website</a>
        </div>
    </div>
</body>
</html>
