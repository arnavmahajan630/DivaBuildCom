<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    admin_redirect('jobs.php');
}

if (!verify_csrf($_POST['csrf_token'] ?? null) || !isset($_POST['id']) || !ctype_digit((string) $_POST['id'])) {
    set_flash('admin_jobs', 'We could not verify that delete action. Please try again.', [], [
        'general' => 'Verification failed.',
    ]);
    admin_redirect('jobs.php');
}

try {
    delete_job((int) $_POST['id']);
    set_flash('admin_jobs', 'Job listing deleted successfully.');
} catch (Throwable $exception) {
    error_log('Admin job delete failed: ' . $exception->getMessage());
    set_flash('admin_jobs', 'We could not delete that job listing right now.', [], [
        'general' => 'Delete failed.',
    ]);
}

admin_redirect('jobs.php');
