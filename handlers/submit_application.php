<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('careers.php');
}

$uploadConfig = config('uploads');

$old = [
    'full_name' => trim($_POST['full_name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'phone' => normalize_phone((string) ($_POST['phone'] ?? '')),
    'target_position' => trim($_POST['target_position'] ?? ''),
    'message' => trim($_POST['message'] ?? ''),
];

$errors = [];

if (!verify_csrf($_POST['csrf_token'] ?? null)) {
    $errors['csrf'] = 'Your session expired. Please try again.';
}

if ($old['full_name'] === '' || strlen($old['full_name']) < 2) {
    $errors['full_name'] = 'Please enter your full name.';
}

if ($old['email'] === '' || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if ($old['phone'] === '' || !valid_phone($old['phone'])) {
    $errors['phone'] = 'Please enter a valid phone number.';
}

if ($old['target_position'] === '') {
    $errors['target_position'] = 'Please select a target position.';
}

if ($old['message'] === '' || strlen($old['message']) < 12) {
    $errors['message'] = 'Please add a short message about your interest in the role.';
}

$resume = $_FILES['resume'] ?? null;

if ($resume === null || !is_array($resume) || (int) ($resume['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
    $errors['resume'] = 'Please upload your resume.';
}

$storedName = null;
$resumePath = null;
$originalName = null;

if (!isset($errors['resume']) && is_array($resume)) {
    $uploadError = (int) $resume['error'];

    if ($uploadError !== UPLOAD_ERR_OK) {
        $errors['resume'] = 'There was a problem uploading your resume.';
    } else {
        $originalName = (string) $resume['name'];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $size = (int) ($resume['size'] ?? 0);
        $tmpName = (string) ($resume['tmp_name'] ?? '');

        if (!in_array($extension, $uploadConfig['allowed_resume_extensions'], true)) {
            $errors['resume'] = 'Resume must be a PDF, DOC, or DOCX file.';
        } elseif ($size <= 0 || $size > $uploadConfig['max_resume_bytes']) {
            $errors['resume'] = 'Resume must be smaller than 5 MB.';
        } else {
            $fileInfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $fileInfo->file($tmpName) ?: '';

            if (!in_array($mimeType, $uploadConfig['allowed_resume_mimes'], true)) {
                $errors['resume'] = 'Uploaded file type is not allowed.';
            } else {
                if (!is_dir($uploadConfig['resume_dir']) && !mkdir($uploadConfig['resume_dir'], 0775, true) && !is_dir($uploadConfig['resume_dir'])) {
                    $errors['resume'] = 'Resume directory is not writable.';
                } else {
                    $storedName = 'resume_' . date('Ymd_His') . '_' . bin2hex(random_bytes(6)) . '.' . $extension;
                    $resumePath = $uploadConfig['resume_dir'] . '/' . $storedName;
                }
            }
        }
    }
}

if ($errors !== []) {
    set_flash('application', 'Please correct the highlighted fields and submit again.', $old, $errors);
    redirect('careers.php');
}

if (!move_uploaded_file((string) $resume['tmp_name'], (string) $resumePath)) {
    set_flash('application', 'We could not save your resume upload. Please try again.', $old, [
        'resume' => 'Resume upload failed.',
    ]);
    redirect('careers.php');
}

try {
    $stmt = db()->prepare(
        'INSERT INTO applicants (
            full_name, email, phone, target_position, resume_original_name, resume_stored_name, resume_path, message, ip_address, user_agent
         ) VALUES (
            :full_name, :email, :phone, :target_position, :resume_original_name, :resume_stored_name, :resume_path, :message, :ip_address, :user_agent
         )'
    );
    $stmt->execute([
        ':full_name' => $old['full_name'],
        ':email' => $old['email'],
        ':phone' => $old['phone'],
        ':target_position' => $old['target_position'],
        ':resume_original_name' => $originalName,
        ':resume_stored_name' => $storedName,
        ':resume_path' => $uploadConfig['resume_web_dir'] . '/' . $storedName,
        ':message' => $old['message'],
        ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ':user_agent' => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
    ]);
} catch (Throwable $exception) {
    error_log('Application submission failed: ' . $exception->getMessage());
    if ($resumePath !== null && is_file($resumePath)) {
        unlink($resumePath);
    }
    set_flash('application', 'We could not submit your application right now. Please try again.', $old, [
        'general' => 'Submission failed.',
    ]);
    redirect('careers.php');
}

set_flash('application', 'Your application has been submitted successfully. We will review your profile and get in touch if there is a match.');
redirect('careers.php');
