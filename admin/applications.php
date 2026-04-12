<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

$currentPage = 'admin_applications';
require_admin();

$flash = get_flash('admin_applications');
$filters = [
    'q' => trim((string) ($_GET['q'] ?? '')),
    'status' => trim((string) ($_GET['status'] ?? '')),
    'position' => trim((string) ($_GET['position'] ?? '')),
];
$page = max(1, (int) ($_GET['page'] ?? 1));
$paginated = fetch_applications_paginated($filters, $page, 10);
$applications = $paginated['data'];
$totalPages = $paginated['pages'];
$totalCount = $paginated['total'];

$positions = fetch_application_positions();
$stats = fetch_dashboard_stats();

$adminPageTitle = 'Career Applications | Diva Buildcom Admin';
$adminHeading = 'Career Applications';
$adminIntro = 'Review and manage incoming candidate profiles for current active roles.';

require dirname(__DIR__) . '/includes/admin_header.php';
?>
<?php if ($flash !== null): ?>
    <div class="flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
        <div><?= e($flash['message']) ?></div>
    </div>
<?php endif; ?>

<!-- Breadcrumb + Header -->
<section style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:28px">
    <div>
        <div style="display:flex;align-items:center;gap:6px;font-size:0.68rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:#a87b07;margin-bottom:6px">
            <span>Recruitment</span>
            <span class="material-symbols-outlined" style="font-size:12px">chevron_right</span>
            <span style="color:#94a3b8">Applications</span>
        </div>
        <p style="color:#64748b;margin:8px 0 0;max-width:500px">Review and manage incoming candidate profiles for current active industrial and engineering roles.</p>
    </div>
    <div style="display:flex;gap:10px">
        <a class="button button-small button-outline" href="<?= e(admin_url('applications.php')) ?>">
            <span class="material-symbols-outlined" style="font-size:16px">refresh</span>
            Reset
        </a>
    </div>
</section>

<!-- Stats Cards -->
<section class="admin-stats-grid">
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon blue"><span class="material-symbols-outlined">group</span></div>
            <span class="stat-badge up">+12%</span>
        </div>
        <div class="stat-label">Total Applicants</div>
        <div class="stat-value"><?= e((string) $stats['total_applications']) ?></div>
    </article>
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon amber"><span class="material-symbols-outlined">schedule</span></div>
            <span class="stat-badge neutral">Current</span>
        </div>
        <div class="stat-label">Pending Review</div>
        <div class="stat-value"><?= e((string) $stats['pending_review']) ?></div>
    </article>
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon green"><span class="material-symbols-outlined">how_to_reg</span></div>
            <span class="stat-badge up">Top 5%</span>
        </div>
        <div class="stat-label">Shortlisted</div>
        <div class="stat-value"><?= e((string) $stats['shortlisted']) ?></div>
    </article>
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon rose"><span class="material-symbols-outlined">work</span></div>
            <span class="stat-badge neutral"><?= e((string) $stats['active_jobs']) ?> Open</span>
        </div>
        <div class="stat-label">Active Roles</div>
        <div class="stat-value"><?= e((string) $stats['active_jobs']) ?></div>
    </article>
</section>

<!-- Filter Bar -->
<form class="admin-filter-bar" method="get" action="<?= e(admin_url('applications.php')) ?>">
    <div class="filter-group">
        <div class="filter-field">
            <label>Position</label>
            <select name="position">
                <option value="">All Positions</option>
                <?php foreach ($positions as $pos): ?>
                    <option value="<?= e($pos) ?>" <?= $filters['position'] === $pos ? 'selected' : '' ?>><?= e($pos) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-field">
            <label>Status</label>
            <select name="status">
                <option value="">All Statuses</option>
                <?php foreach (admin_status_options() as $value => $label): ?>
                    <option value="<?= e($value) ?>" <?= $filters['status'] === $value ? 'selected' : '' ?>><?= e($label) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-field">
            <label>Search</label>
            <input type="text" name="q" value="<?= e($filters['q']) ?>" placeholder="Name, email, phone...">
        </div>
    </div>
    <div class="admin-filter-actions">
        <button class="button button-small button-dark" type="submit">Apply</button>
        <a class="button button-small button-outline" href="<?= e(admin_url('applications.php')) ?>">Clear</a>
    </div>
</form>

<!-- Applications Table -->
<section class="admin-table-section">
    <div class="admin-table-header">
        <div>
            <h3>Application Queue</h3>
            <p>Candidate profiles matching current filters</p>
        </div>
        <span class="status-pill is-neutral"><?= e((string) $totalCount) ?> results</span>
    </div>

    <?php if ($applications === []): ?>
        <p class="admin-empty">No applications matched the current filters.</p>
    <?php else: ?>
        <div style="overflow-x:auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Contact Information</th>
                        <th>Position Applied</th>
                        <th style="text-align:center">Resume</th>
                        <th>Status</th>
                        <th style="text-align:right">Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $avatarColors = ['blue', 'green', 'slate', 'amber'];
                    foreach ($applications as $i => $app):
                        $initials = applicant_initials((string) $app['full_name']);
                        $color = $avatarColors[$i % count($avatarColors)];
                        $status = (string) $app['status'];
                    ?>
                        <tr>
                            <td>
                                <div class="admin-name-cell">
                                    <span class="admin-avatar <?= $color ?>"><?= e($initials) ?></span>
                                    <div>
                                        <strong><?= e($app['full_name']) ?></strong>
                                        <div style="font-size:0.78rem;color:#94a3b8"><?= e(date('M d, Y', strtotime((string) $app['created_at']))) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500"><?= e($app['email']) ?></div>
                                <div style="font-size:0.78rem;color:#94a3b8"><?= e($app['phone']) ?></div>
                            </td>
                            <td>
                                <span style="font-size:0.78rem;font-weight:700;color:#0a3558;background:rgba(10,53,88,0.06);padding:4px 10px;border-radius:999px"><?= e($app['target_position']) ?></span>
                            </td>
                            <td style="text-align:center">
                                <div class="admin-resume-actions">
                                    <a href="<?= e(site_url((string) $app['resume_path'])) ?>" target="_blank" rel="noopener" title="View Resume">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </a>
                                    <a href="<?= e(site_url((string) $app['resume_path'])) ?>" download title="Download">
                                        <span class="material-symbols-outlined">download</span>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <span class="admin-badge <?= e(admin_badge_class($status)) ?>"><?= e(admin_status_label($status)) ?></span>
                            </td>
                            <td style="text-align:right">
                                <form class="admin-inline-form" action="<?= e(site_url('handlers/admin_application_update.php')) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= e((string) $app['id']) ?>">
                                    <input type="hidden" name="admin_notes" value="<?= e((string) ($app['admin_notes'] ?? '')) ?>">
                                    <input type="hidden" name="filters[q]" value="<?= e($filters['q']) ?>">
                                    <input type="hidden" name="filters[status]" value="<?= e($filters['status']) ?>">
                                    <input type="hidden" name="filters[position]" value="<?= e($filters['position']) ?>">
                                    <select name="status">
                                        <?php foreach (admin_status_options() as $value => $label): ?>
                                            <option value="<?= e($value) ?>" <?= $status === $value ? 'selected' : '' ?>><?= e($label) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit">Save</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <div class="admin-pagination">
            <span class="page-info">
                Showing <strong><?= e((string) (($page - 1) * 10 + 1)) ?>-<?= e((string) min($page * 10, $totalCount)) ?></strong> of <strong><?= e((string) $totalCount) ?></strong> applicants
            </span>
            <div class="page-btns">
                <?php if ($page > 1): ?>
                    <a class="page-btn" href="<?= e(admin_url('applications.php?' . http_build_query(array_merge($filters, ['page' => $page - 1])))) ?>">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                <?php endif; ?>
                <?php for ($p = 1; $p <= min($totalPages, 5); $p++): ?>
                    <a class="page-btn <?= $p === $page ? 'active' : '' ?>" href="<?= e(admin_url('applications.php?' . http_build_query(array_merge($filters, ['page' => $p])))) ?>">
                        <?= $p ?>
                    </a>
                <?php endfor; ?>
                <?php if ($totalPages > 5): ?>
                    <span style="color:#94a3b8;padding:0 4px">...</span>
                    <a class="page-btn" href="<?= e(admin_url('applications.php?' . http_build_query(array_merge($filters, ['page' => $totalPages])))) ?>">
                        <?= $totalPages ?>
                    </a>
                <?php endif; ?>
                <?php if ($page < $totalPages): ?>
                    <a class="page-btn" href="<?= e(admin_url('applications.php?' . http_build_query(array_merge($filters, ['page' => $page + 1])))) ?>">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php require dirname(__DIR__) . '/includes/admin_footer.php'; ?>
