<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    admin_redirect('login.php');
}

$identity = trim((string) ($_POST['identity'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$errors = [];

if (!verify_csrf($_POST['csrf_token'] ?? null)) {
    $errors['csrf'] = 'Your session expired. Please try signing in again.';
}

if ($identity === '') {
    $errors['identity'] = 'Please enter the admin email.';
}

if ($password === '') {
    $errors['password'] = 'Please enter the admin password.';
}

if ($errors === [] && !admin_credentials_match($identity, $password)) {
    $errors['identity'] = 'These admin credentials were not accepted.';
}

if ($errors !== []) {
    set_flash('admin_auth', 'Please correct the admin sign-in details and try again.', [
        'identity' => $identity,
    ], $errors);
    admin_redirect('login.php');
}

login_admin($identity);
set_flash('admin_dashboard', 'Welcome back. Careers admin access is now active.');
admin_redirect('index.php');
