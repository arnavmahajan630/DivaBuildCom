<?php

declare(strict_types=1);

return [
    'site' => [
        'name' => 'Diva Buildcom',
        'base_url' => '/DivaBuildCom',
        'phone_display' => '+91 22 4590 8800',
        'phone_link' => '+912245908800',
        'mobile_display' => '+91 98200 12345',
        'mobile_link' => '+919820012345',
        'email_primary' => 'projects@divabuildcom.com',
        'email_secondary' => 'info@divabuildcom.com',
        'address_html' => 'Suite 402, Platinum Heights, Link Road,<br>Andheri West, Mumbai 400053',
        'tagline' => 'Reliable civil contractors shaping suburban Mumbai with premium execution and engineering clarity.',
    ],
    'db' => [
        'host' => 'localhost',
        'name' => 'divabuildcom',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8mb4',
    ],
    'uploads' => [
        'resume_dir' => dirname(__DIR__) . '/assets/uploads/resumes',
        'resume_web_dir' => 'assets/uploads/resumes',
        'max_resume_bytes' => 5 * 1024 * 1024,
        'allowed_resume_extensions' => ['pdf', 'doc', 'docx'],
        'allowed_resume_mimes' => [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-office',
            'application/zip',
            'application/octet-stream',
        ],
    ],
];
