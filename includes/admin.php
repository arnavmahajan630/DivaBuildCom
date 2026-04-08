<?php

declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/data.php';

function admin_url(string $path = ''): string
{
    $path = ltrim($path, '/');

    return $path === '' ? site_url('admin') : site_url('admin/' . $path);
}

function admin_redirect(string $path = 'index.php'): never
{
    header('Location: ' . admin_url($path));
    exit;
}

function admin_config(): array
{
    return (array) config('admin');
}

function admin_nav_items(): array
{
    return [
        ['label' => 'Dashboard', 'href' => admin_url('index.php'), 'page' => 'admin_dashboard'],
        ['label' => 'Job Listings', 'href' => admin_url('jobs.php'), 'page' => 'admin_jobs'],
        ['label' => 'Applications', 'href' => admin_url('applications.php'), 'page' => 'admin_applications'],
    ];
}

function is_admin_page(string $page): bool
{
    return current_page() === $page;
}

function admin_identity(): ?array
{
    $admin = $_SESSION['admin'] ?? null;

    return is_array($admin) ? $admin : null;
}

function is_admin_logged_in(): bool
{
    return admin_identity() !== null;
}

function login_admin(string $identity): void
{
    $_SESSION['admin'] = [
        'identity' => $identity,
        'display_name' => admin_config()['display_name'] ?? 'Admin',
        'logged_in_at' => date(DATE_ATOM),
    ];
}

function logout_admin(): void
{
    unset($_SESSION['admin']);
}

function admin_credentials_match(string $identity, string $password): bool
{
    $config = admin_config();

    if ($identity === '' || $password === '') {
        return false;
    }

    return hash_equals((string) ($config['identity'] ?? ''), $identity)
        && password_verify($password, (string) ($config['password_hash'] ?? ''));
}

function require_admin(): void
{
    if (!is_admin_logged_in()) {
        set_flash('admin_auth', 'Please sign in to access the admin area.', [], [
            'general' => 'Authentication required.',
        ]);
        admin_redirect('login.php');
    }
}

function require_admin_guest(): void
{
    if (is_admin_logged_in()) {
        admin_redirect('index.php');
    }
}

function admin_status_options(): array
{
    return [
        'pending' => 'Pending Review',
        'reviewing' => 'Reviewing',
        'shortlisted' => 'Shortlisted',
        'rejected' => 'Rejected',
        'hired' => 'Hired',
    ];
}

function job_type_options(): array
{
    return ['Full-Time', 'Part-Time', 'Contract', 'Internship'];
}

function admin_table_exists(string $table): bool
{
    static $cache = [];

    if (array_key_exists($table, $cache)) {
        return $cache[$table];
    }

    try {
        $stmt = db()->prepare('SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table');
        $stmt->execute([':table' => $table]);
        $cache[$table] = (int) $stmt->fetchColumn() > 0;
    } catch (Throwable $exception) {
        $cache[$table] = false;
    }

    return $cache[$table];
}

function jobs_feature_ready(): bool
{
    return admin_table_exists('jobs');
}

function applicants_feature_ready(): bool
{
    return admin_table_exists('applicants');
}

function fallback_jobs(): array
{
    return array_map(static function (array $job): array {
        return [
            'id' => 0,
            'title' => $job['title'],
            'location' => $job['location'],
            'experience' => $job['experience'],
            'employment_type' => $job['type'],
            'summary' => $job['summary'] ?? '',
            'is_active' => 1,
            'sort_order' => $job['sort_order'] ?? 0,
            'created_at' => null,
            'updated_at' => null,
        ];
    }, legacy_openings());
}

function fetch_active_jobs(): array
{
    if (!jobs_feature_ready()) {
        return fallback_jobs();
    }

    $stmt = db()->query('SELECT * FROM jobs WHERE is_active = 1 ORDER BY sort_order ASC, created_at DESC');
    $jobs = $stmt->fetchAll();

    return $jobs !== [] ? $jobs : fallback_jobs();
}

function fetch_all_jobs(): array
{
    if (!jobs_feature_ready()) {
        return fallback_jobs();
    }

    $stmt = db()->query('SELECT * FROM jobs ORDER BY is_active DESC, sort_order ASC, created_at DESC');

    return $stmt->fetchAll();
}

function fetch_job_by_id(int $id): ?array
{
    if (!jobs_feature_ready()) {
        return null;
    }

    $stmt = db()->prepare('SELECT * FROM jobs WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $id]);
    $job = $stmt->fetch();

    return is_array($job) ? $job : null;
}

function create_job(array $data): void
{
    $stmt = db()->prepare(
        'INSERT INTO jobs (title, location, experience, employment_type, summary, is_active, sort_order)
         VALUES (:title, :location, :experience, :employment_type, :summary, :is_active, :sort_order)'
    );
    $stmt->execute([
        ':title' => $data['title'],
        ':location' => $data['location'],
        ':experience' => $data['experience'],
        ':employment_type' => $data['employment_type'],
        ':summary' => $data['summary'],
        ':is_active' => $data['is_active'],
        ':sort_order' => $data['sort_order'],
    ]);
}

function update_job(int $id, array $data): void
{
    $stmt = db()->prepare(
        'UPDATE jobs
         SET title = :title,
             location = :location,
             experience = :experience,
             employment_type = :employment_type,
             summary = :summary,
             is_active = :is_active,
             sort_order = :sort_order
         WHERE id = :id'
    );
    $stmt->execute([
        ':id' => $id,
        ':title' => $data['title'],
        ':location' => $data['location'],
        ':experience' => $data['experience'],
        ':employment_type' => $data['employment_type'],
        ':summary' => $data['summary'],
        ':is_active' => $data['is_active'],
        ':sort_order' => $data['sort_order'],
    ]);
}

function delete_job(int $id): void
{
    $stmt = db()->prepare('DELETE FROM jobs WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

function toggle_job(int $id): void
{
    $stmt = db()->prepare('UPDATE jobs SET is_active = IF(is_active = 1, 0, 1) WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

function fetch_dashboard_stats(): array
{
    $defaults = [
        'total_applications' => 0,
        'pending_review' => 0,
        'shortlisted' => 0,
        'rejected' => 0,
        'active_jobs' => count(fetch_active_jobs()),
    ];

    if (!applicants_feature_ready()) {
        return $defaults;
    }

    $stmt = db()->query(
        "SELECT
            COUNT(*) AS total_applications,
            SUM(CASE WHEN status IN ('pending', 'reviewing') THEN 1 ELSE 0 END) AS pending_review,
            SUM(CASE WHEN status = 'shortlisted' THEN 1 ELSE 0 END) AS shortlisted,
            SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) AS rejected
         FROM applicants"
    );
    $stats = $stmt->fetch() ?: [];

    return [
        'total_applications' => (int) ($stats['total_applications'] ?? 0),
        'pending_review' => (int) ($stats['pending_review'] ?? 0),
        'shortlisted' => (int) ($stats['shortlisted'] ?? 0),
        'rejected' => (int) ($stats['rejected'] ?? 0),
        'active_jobs' => jobs_feature_ready()
            ? (int) db()->query('SELECT COUNT(*) FROM jobs WHERE is_active = 1')->fetchColumn()
            : $defaults['active_jobs'],
    ];
}

function fetch_recent_applications(int $limit = 5): array
{
    if (!applicants_feature_ready()) {
        return [];
    }

    $stmt = db()->prepare('SELECT * FROM applicants ORDER BY created_at DESC LIMIT :limit');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

function fetch_recent_jobs(int $limit = 5): array
{
    if (!jobs_feature_ready()) {
        return array_slice(fallback_jobs(), 0, $limit);
    }

    $stmt = db()->prepare('SELECT * FROM jobs ORDER BY updated_at DESC, created_at DESC LIMIT :limit');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

function fetch_application_positions(): array
{
    if (!applicants_feature_ready()) {
        return array_map(static fn(array $job): string => $job['title'], fetch_active_jobs());
    }

    $stmt = db()->query('SELECT DISTINCT target_position FROM applicants WHERE target_position <> "" ORDER BY target_position ASC');

    return array_values(array_filter(array_map(static fn(array $row): string => (string) $row['target_position'], $stmt->fetchAll())));
}

function fetch_applications(array $filters = []): array
{
    if (!applicants_feature_ready()) {
        return [];
    }

    $where = [];
    $params = [];

    $search = trim((string) ($filters['q'] ?? ''));
    if ($search !== '') {
        $where[] = '(full_name LIKE :search OR email LIKE :search OR phone LIKE :search OR target_position LIKE :search)';
        $params[':search'] = '%' . $search . '%';
    }

    $status = trim((string) ($filters['status'] ?? ''));
    if ($status !== '' && array_key_exists($status, admin_status_options())) {
        $where[] = 'status = :status';
        $params[':status'] = $status;
    }

    $position = trim((string) ($filters['position'] ?? ''));
    if ($position !== '') {
        $where[] = 'target_position = :position';
        $params[':position'] = $position;
    }

    $sql = 'SELECT * FROM applicants';
    if ($where !== []) {
        $sql .= ' WHERE ' . implode(' AND ', $where);
    }
    $sql .= ' ORDER BY created_at DESC';

    $stmt = db()->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
}

function update_application_review(int $id, string $status, string $adminNotes): void
{
    $stmt = db()->prepare(
        'UPDATE applicants
         SET status = :status, admin_notes = :admin_notes
         WHERE id = :id'
    );
    $stmt->execute([
        ':id' => $id,
        ':status' => $status,
        ':admin_notes' => $adminNotes,
    ]);
}

function admin_status_label(string $status): string
{
    return admin_status_options()[$status] ?? ucfirst(str_replace('_', ' ', $status));
}

function admin_status_class(string $status): string
{
    return match ($status) {
        'shortlisted', 'hired' => 'is-success',
        'rejected' => 'is-danger',
        'reviewing' => 'is-warning',
        default => 'is-neutral',
    };
}
