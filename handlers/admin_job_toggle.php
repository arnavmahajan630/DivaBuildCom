<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    admin_redirect('jobs.php');
}

if (!verify_csrf($_POST['csrf_token'] ?? null) || !isset($_POST['id']) || !ctype_digit((string) $_POST['id'])) {
    set_flash('admin_jobs', 'We could not verify that job action. Please try again.', [], [
        'general' => 'Verification failed.',
    ]);
    admin_redirect('jobs.php');
}

try {
    toggle_job((int) $_POST['id']);
    set_flash('admin_jobs', 'Job visibility updated successfully.');
} catch (Throwable $exception) {
    error_log('Admin job toggle failed: ' . $exception->getMessage());
    set_flash('admin_jobs', 'We could not update that job visibility right now.', [], [
        'general' => 'Update failed.',
    ]);
}

admin_redirect('jobs.php');
