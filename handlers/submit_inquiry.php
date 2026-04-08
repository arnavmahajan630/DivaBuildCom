<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('contact.php');
}

$old = [
    'full_name' => trim($_POST['full_name'] ?? ''),
    'phone' => normalize_phone((string) ($_POST['phone'] ?? '')),
    'email' => trim($_POST['email'] ?? ''),
    'project_details' => trim($_POST['project_details'] ?? ''),
];

$errors = [];

if (!verify_csrf($_POST['csrf_token'] ?? null)) {
    $errors['csrf'] = 'Your session expired. Please try submitting the form again.';
}

if ($old['full_name'] === '' || strlen($old['full_name']) < 2) {
    $errors['full_name'] = 'Please enter your full name.';
}

if ($old['phone'] === '' || !valid_phone($old['phone'])) {
    $errors['phone'] = 'Please enter a valid phone number.';
}

if ($old['email'] === '' || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if ($old['project_details'] === '' || strlen($old['project_details']) < 15) {
    $errors['project_details'] = 'Please share a few more details about your project.';
}

if ($errors !== []) {
    set_flash('inquiry', 'Please correct the highlighted fields and submit again.', $old, $errors);
    redirect('contact.php');
}

try {
    $stmt = db()->prepare(
        'INSERT INTO inquiries (full_name, phone, email, project_details, ip_address, user_agent)
         VALUES (:full_name, :phone, :email, :project_details, :ip_address, :user_agent)'
    );
    $stmt->execute([
        ':full_name' => $old['full_name'],
        ':phone' => $old['phone'],
        ':email' => $old['email'],
        ':project_details' => $old['project_details'],
        ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ':user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
    ]);
} catch (Throwable $exception) {
    error_log('Inquiry submission failed: ' . $exception->getMessage());
    set_flash('inquiry', 'We could not submit your inquiry right now. Please try again in a moment.', $old, [
        'general' => 'Submission failed.',
    ]);
    redirect('contact.php');
}

set_flash('inquiry', 'Your inquiry has been submitted successfully. Our team will contact you shortly.');
redirect('contact.php');
