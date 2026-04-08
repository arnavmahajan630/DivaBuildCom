<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    admin_redirect('jobs.php');
}

$id = isset($_POST['id']) && ctype_digit((string) $_POST['id']) ? (int) $_POST['id'] : 0;
$old = [
    'title' => trim((string) ($_POST['title'] ?? '')),
    'location' => trim((string) ($_POST['location'] ?? '')),
    'experience' => trim((string) ($_POST['experience'] ?? '')),
    'employment_type' => trim((string) ($_POST['employment_type'] ?? 'Full-Time')),
    'summary' => trim((string) ($_POST['summary'] ?? '')),
    'sort_order' => trim((string) ($_POST['sort_order'] ?? '0')),
    'is_active' => (string) ($_POST['is_active'] ?? '1'),
];
$errors = [];

if (!verify_csrf($_POST['csrf_token'] ?? null)) {
    $errors['csrf'] = 'Your session expired. Please try again.';
}

if (!jobs_feature_ready()) {
    $errors['general'] = 'The jobs table is not available yet. Import the latest schema first.';
}

if ($old['title'] === '' || strlen($old['title']) < 3) {
    $errors['title'] = 'Please enter a job title.';
}

if ($old['location'] === '' || strlen($old['location']) < 2) {
    $errors['location'] = 'Please enter a job location.';
}

if ($old['experience'] === '') {
    $errors['experience'] = 'Please enter an experience range.';
}

if (!in_array($old['employment_type'], job_type_options(), true)) {
    $old['employment_type'] = 'Full-Time';
}

$sortOrder = filter_var($old['sort_order'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
if ($sortOrder === false) {
    $sortOrder = 0;
}

$payload = [
    'title' => $old['title'],
    'location' => $old['location'],
    'experience' => $old['experience'],
    'employment_type' => $old['employment_type'],
    'summary' => $old['summary'],
    'sort_order' => $sortOrder,
    'is_active' => $old['is_active'] === '0' ? 0 : 1,
];

if ($errors !== []) {
    set_flash('admin_jobs', 'Please correct the job form and submit again.', $old, $errors);
    admin_redirect($id > 0 ? 'jobs.php?edit=' . $id : 'jobs.php');
}

try {
    if ($id > 0) {
        update_job($id, $payload);
        set_flash('admin_jobs', 'Job listing updated successfully.');
    } else {
        create_job($payload);
        set_flash('admin_jobs', 'Job listing created successfully.');
    }
} catch (Throwable $exception) {
    error_log('Admin job save failed: ' . $exception->getMessage());
    set_flash('admin_jobs', 'We could not save that job listing right now.', $old, [
        'general' => 'Save failed.',
    ]);
    admin_redirect($id > 0 ? 'jobs.php?edit=' . $id : 'jobs.php');
}

admin_redirect('jobs.php');
