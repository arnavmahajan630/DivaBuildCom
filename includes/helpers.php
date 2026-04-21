<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function config(?string $section = null): mixed
{
    static $config;

    if ($config === null) {
        $config = require __DIR__ . '/config.php';
    }

    if ($section === null) {
        return $config;
    }

    return $config[$section] ?? null;
}

function site_url(string $path = ''): string
{
    $baseUrl = rtrim((string) config('site')['base_url'], '/');
    $path = ltrim($path, '/');

    return $path === '' ? $baseUrl . '/' : $baseUrl . '/' . $path;
}

function asset_url(string $path): string
{
    return site_url($path);
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function current_page(): string
{
    return $GLOBALS['currentPage'] ?? '';
}

function is_active_page(string $page): bool
{
    return current_page() === $page;
}

function set_flash(string $key, string $message, array $old = [], array $errors = []): void
{
    $_SESSION['flash'][$key] = [
        'message' => $message,
        'old' => $old,
        'errors' => $errors,
    ];
}

function get_flash(string $key): ?array
{
    if (!isset($_SESSION['flash'][$key])) {
        return null;
    }

    $flash = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);

    return $flash;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf(?string $token): bool
{
    return isset($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
}

function old_input(?array $flash, string $field, string $default = ''): string
{
    return (string) ($flash['old'][$field] ?? $default);
}

function field_error(?array $flash, string $field): ?string
{
    return $flash['errors'][$field] ?? null;
}

function has_errors(?array $flash): bool
{
    return !empty($flash['errors']);
}

function normalize_phone(string $value): string
{
    return trim(preg_replace('/\s+/', ' ', $value));
}

function valid_phone(string $value): bool
{
    $digits = preg_replace('/\D+/', '', $value);
    return strlen((string) $digits) === 10;
}

function redirect(string $path): never
{
    header('Location: ' . site_url($path));
    exit;
}
