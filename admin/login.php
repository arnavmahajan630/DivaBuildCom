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
    <meta name="description" content="Sign in to the Diva Buildcom careers admin area.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset_url('assets/css/styles.css')) ?>">
</head>
<body class="admin-auth-body">
    <div class="admin-auth-shell">
        <section class="admin-auth-panel admin-auth-branding">
            <span class="pill">Admin Access</span>
            <h1>Careers operations, hiring visibility, and job management in one secure space.</h1>
            <p>Use the admin terminal to keep public job listings current, review incoming applications, and move candidates through the hiring pipeline.</p>
            <div class="admin-auth-points">
                <span>Live dashboard metrics</span>
                <span>Job posting controls</span>
                <span>Application review workflow</span>
            </div>
            <a class="button button-outline" href="<?= e(site_url()) ?>">Back to Website</a>
        </section>
        <section class="admin-auth-panel admin-auth-form-panel">
            <div class="admin-auth-card">
                <span class="eyebrow">Diva Buildcom</span>
                <h2>Admin Sign In</h2>
                <p>Sign in with the configured admin account to manage careers operations.</p>
                <?php if ($flash !== null): ?>
                    <div class="flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
                        <div><?= e($flash['message']) ?></div>
                    </div>
                <?php endif; ?>
                <form action="<?= e(site_url('handlers/admin_login.php')) ?>" method="post" novalidate>
                    <?= csrf_field() ?>
                    <div class="form-grid admin-auth-grid">
                        <div class="field field-full">
                            <label for="admin_identity">Email</label>
                            <input id="admin_identity" name="identity" type="email" value="<?= e(old_input($flash, 'identity', admin_config()['identity'] ?? '')) ?>" placeholder="admin@divabuildcom.local" required>
                            <?php if ($error = field_error($flash, 'identity')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                        </div>
                        <div class="field field-full">
                            <label for="admin_password">Password</label>
                            <input id="admin_password" name="password" type="password" placeholder="Enter password" required>
                            <?php if ($error = field_error($flash, 'password')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                        </div>
                    </div>
                    <div class="hero-actions">
                        <button class="button button-dark" type="submit">Sign In to Admin</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>
