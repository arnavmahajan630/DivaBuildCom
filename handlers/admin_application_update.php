<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    admin_redirect('applications.php');
}

$id = isset($_POST['id']) && ctype_digit((string) $_POST['id']) ? (int) $_POST['id'] : 0;
$status = trim((string) ($_POST['status'] ?? 'pending'));
$adminNotes = trim((string) ($_POST['admin_notes'] ?? ''));
$filters = is_array($_POST['filters'] ?? null) ? $_POST['filters'] : [];
$query = http_build_query(array_filter([
    'q' => trim((string) ($filters['q'] ?? '')),
    'status' => trim((string) ($filters['status'] ?? '')),
    'position' => trim((string) ($filters['position'] ?? '')),
]));
$redirect = 'applications.php' . ($query !== '' ? '?' . $query : '');

if (!verify_csrf($_POST['csrf_token'] ?? null) || $id <= 0) {
    set_flash('admin_applications', 'We could not verify that review update. Please try again.', [], [
        'general' => 'Verification failed.',
    ]);
    admin_redirect($redirect);
}

if (!array_key_exists($status, admin_status_options())) {
    set_flash('admin_applications', 'Please choose a valid application status.', [], [
        'status' => 'Invalid status.',
    ]);
    admin_redirect($redirect);
}

try {
    update_application_review($id, $status, $adminNotes);
    set_flash('admin_applications', 'Application review updated successfully.');
} catch (Throwable $exception) {
    error_log('Admin application update failed: ' . $exception->getMessage());
    set_flash('admin_applications', 'We could not update that application right now.', [], [
        'general' => 'Update failed.',
    ]);
}

admin_redirect($redirect);
