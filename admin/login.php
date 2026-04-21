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
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(asset_url('assets/css/styles.css')) ?>">
    <style>
        body.admin-login-body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', system-ui, sans-serif;
            background: #0f2033;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .admin-login-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 18px;
            padding: 3rem 3rem 2.25rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
            text-align: center;
        }
        .admin-login-rule {
            width: 56px;
            height: 3px;
            background: #c9a227;
            margin: 0 auto 1.25rem;
            border-radius: 2px;
        }
        .admin-login-brand {
            font-size: 0.85rem;
            letter-spacing: 0.28em;
            font-weight: 700;
            color: #c9a227;
            margin-bottom: 1.75rem;
        }
        .admin-login-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: #0f2033;
            margin: 0 0 0.5rem;
        }
        .admin-login-subtitle {
            color: #5b6b7a;
            font-size: 0.95rem;
            margin: 0 0 2rem;
        }
        .admin-login-form { text-align: left; }
        .admin-login-field { margin-bottom: 1.25rem; }
        .admin-login-field label {
            display: block;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            color: #0f2033;
            margin-bottom: 0.55rem;
        }
        .admin-login-field input {
            width: 100%;
            padding: 0.95rem 1.1rem;
            border: 1px solid transparent;
            border-radius: 999px;
            background: #eef1f4;
            font-size: 0.95rem;
            color: #0f2033;
            font-family: inherit;
            box-sizing: border-box;
            transition: border-color 0.15s, background 0.15s;
        }
        .admin-login-field input:focus {
            outline: none;
            border-color: #c9a227;
            background: #fff;
        }
        .admin-login-submit {
            width: 100%;
            padding: 1rem;
            background: #0f2033;
            color: #fff;
            border: none;
            border-radius: 999px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 0.75rem;
            font-family: inherit;
            transition: background 0.15s;
        }
        .admin-login-submit:hover { background: #1a3353; }
        .admin-login-back {
            display: block;
            margin-top: 1.5rem;
            color: #5b6b7a;
            text-decoration: none;
            font-size: 0.9rem;
            text-align: center;
        }
        .admin-login-back:hover { color: #0f2033; }
        .admin-login-flash {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
            text-align: left;
        }
        .admin-login-flash.flash-error { background: #fdecec; color: #a12828; }
        .admin-login-flash.flash-success { background: #e8f5ee; color: #1f6b3a; }
        .admin-login-field .field-error {
            display: block;
            margin-top: 0.4rem;
            font-size: 0.8rem;
            color: #a12828;
        }
    </style>
</head>
<body class="admin-login-body">
    <main class="admin-login-card">
        <div class="admin-login-rule"></div>
        <div class="admin-login-brand">DIVA BUILDCOM</div>
        <h1 class="admin-login-title">Admin Sign In</h1>
        <p class="admin-login-subtitle">Enter your credentials to access the dashboard.</p>

        <?php if ($flash !== null): ?>
            <div class="admin-login-flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <form class="admin-login-form" action="<?= e(site_url('handlers/admin_login.php')) ?>" method="post" novalidate>
            <?= csrf_field() ?>

            <div class="admin-login-field">
                <label for="admin_identity">EMAIL</label>
                <input id="admin_identity" name="identity" type="email" value="<?= e(old_input($flash, 'identity', '')) ?>" placeholder="admin@divabuildcom.local" required>
                <?php if ($error = field_error($flash, 'identity')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
            </div>

            <div class="admin-login-field">
                <label for="admin_password">PASSWORD</label>
                <input id="admin_password" name="password" type="password" placeholder="Enter password" required>
                <?php if ($error = field_error($flash, 'password')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
            </div>

            <button class="admin-login-submit" type="submit">Sign In</button>
        </form>

        <a class="admin-login-back" href="<?= e(site_url()) ?>">Back to website</a>
    </main>
</body>
</html>
