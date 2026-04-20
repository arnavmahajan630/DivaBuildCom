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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset_url('assets/css/styles.css')) ?>">
</head>
<body class="admin-auth-body">
    <main class="admin-auth-shell">
        <section class="admin-auth-visual" aria-hidden="true">
            <div class="admin-auth-visual-overlay"></div>
            <img
                class="admin-auth-visual-image"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuASrNcTgBRFxfq_uUAGWO-77vU6guM4OGHjeptRqtM8MnHdGqzejCbcRAUdeJznjbQfk3NmPVdOjug3duXEsO_c07ZEbhCnFZcjsP7uFZIJix4hESOW3wiACaV9AhUS8vdpzahKHRZ0eNGnZQ9FiBf4wt_D6UKE1DDgpZQZ5q45VqI9irg4-ZjP41vY82kOBNMRYw0y7AvsI04rvSY3yeim4glp_bA3U_5ONhqsghmZp22OmBgXHrUp-N2UszlK9tDmgcHQ5TIwMMI"
                alt="Construction cranes at sunset"
            >
            <div class="admin-auth-visual-content">
                <div class="admin-auth-visual-top">
                    <span class="admin-auth-badge">Systems Access</span>
                    <h1>Building the foundations of excellence.</h1>
                </div>
                <div class="admin-auth-visual-bottom">
                    <div class="admin-auth-visual-divider"></div>
                    <div>
                        <p class="admin-auth-visual-label">Operations Unit</p>
                        <p class="admin-auth-visual-copy">Secured enterprise portal for Diva Buildcom project management and structural oversight.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="admin-auth-panel">
            <div class="admin-auth-panel-inner">
                <div class="admin-auth-brand">
                    <div class="admin-auth-brand-mark">
                        <span class="material-symbols-outlined" aria-hidden="true">architecture</span>
                    </div>
                    <span class="admin-auth-brand-text">Diva Buildcom</span>
                </div>

                <header class="admin-auth-header">
                    <h2>Admin Terminal</h2>
                    <p>Please enter your credentials to access the project dashboard.</p>
                </header>

                <?php if ($flash !== null): ?>
                    <div class="flash admin-auth-flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
                        <div><?= e($flash['message']) ?></div>
                    </div>
                <?php endif; ?>

                <form class="admin-auth-form" action="<?= e(site_url('handlers/admin_login.php')) ?>" method="post" novalidate>
                    <?= csrf_field() ?>

                    <div class="admin-auth-field">
                        <label for="admin_identity">Email / Username</label>
                        <div class="admin-auth-input-wrap">
                            <span class="material-symbols-outlined admin-auth-input-icon" aria-hidden="true">person</span>
                            <input id="admin_identity" name="identity" type="email" value="<?= e(old_input($flash, 'identity', '')) ?>" placeholder="name@divabuild.com" required>
                        </div>
                        <?php if ($error = field_error($flash, 'identity')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>

                    <div class="admin-auth-field">
                        <div class="admin-auth-field-row">
                            <label for="admin_password">Password</label>
                            <a class="admin-auth-help" href="#" aria-disabled="true">Forgot password?</a>
                        </div>
                        <div class="admin-auth-input-wrap">
                            <span class="material-symbols-outlined admin-auth-input-icon" aria-hidden="true">lock</span>
                            <input id="admin_password" name="password" type="password" placeholder="••••••••" required>
                        </div>
                        <?php if ($error = field_error($flash, 'password')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>

                    <button class="button admin-auth-submit" type="submit">
                        <span>Initialize Session</span>
                        <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
                    </button>

                    <div class="admin-auth-divider" aria-hidden="true">
                        <span></span>
                        <strong>Authorized Access Only</strong>
                        <span></span>
                    </div>
                </form>

                <div class="admin-auth-meta">
                    <div class="admin-auth-security">
                        <span class="material-symbols-outlined" aria-hidden="true">verified_user</span>
                        <p>Encrypted 256-bit SSL Connection Active. Session ID: DIVA-SYS-8821</p>
                    </div>
                    <p class="admin-auth-copyright">&copy; 2024 Diva Buildcom. Engineered for Excellence.</p>
                </div>

                <a class="admin-auth-back" href="<?= e(site_url()) ?>">Back to website</a>
            </div>
        </section>
    </main>
</body>
</html>
