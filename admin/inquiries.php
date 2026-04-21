<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

$currentPage = 'admin_inquiries';
require_admin();

$filters = [
    'q' => trim((string) ($_GET['q'] ?? '')),
];
$page = max(1, (int) ($_GET['page'] ?? 1));
$paginated = fetch_inquiries_paginated($filters, $page, 15);
$inquiries = $paginated['data'];
$totalPages = $paginated['pages'];
$totalCount = $paginated['total'];
$stats = fetch_inquiry_stats();

$adminPageTitle = 'Inquiries | Diva Buildcom Admin';
$adminHeading = 'Inquiries';
$adminIntro = 'Contact form submissions from site visitors.';

require dirname(__DIR__) . '/includes/admin_header.php';
?>
<?php if (!inquiries_feature_ready()): ?>
    <div class="flash flash-error">
        <div>The <code>inquiries</code> table is missing. Import <code>database/schema.sql</code> to enable this feature.</div>
    </div>
<?php endif; ?>

<section style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:28px">
    <div>
        <div style="display:flex;align-items:center;gap:6px;font-size:0.68rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:#a87b07;margin-bottom:6px">
            <span>Contact</span>
            <span class="material-symbols-outlined" style="font-size:12px">chevron_right</span>
            <span style="color:#94a3b8">Inquiries</span>
        </div>
        <p style="color:#64748b;margin:8px 0 0;max-width:500px">Read-only log of project inquiries submitted through the public contact form.</p>
    </div>
    <a class="button button-small button-outline" href="<?= e(admin_url('inquiries.php')) ?>">
        <span class="material-symbols-outlined" style="font-size:16px">refresh</span>
        Reset
    </a>
</section>

<section class="admin-stats-grid">
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon blue"><span class="material-symbols-outlined">forum</span></div>
            <span class="stat-badge neutral">All Time</span>
        </div>
        <div class="stat-label">Total Inquiries</div>
        <div class="stat-value"><?= e((string) $stats['total']) ?></div>
    </article>
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon amber"><span class="material-symbols-outlined">schedule</span></div>
            <span class="stat-badge up">Recent</span>
        </div>
        <div class="stat-label">Last 7 Days</div>
        <div class="stat-value"><?= e((string) $stats['last_7_days']) ?></div>
    </article>
</section>

<form class="admin-filter-bar" method="get" action="<?= e(admin_url('inquiries.php')) ?>">
    <div class="filter-group">
        <div class="filter-field">
            <label>Find by name</label>
            <input type="text" name="q" value="<?= e($filters['q']) ?>" placeholder="Inquirer name">
        </div>
    </div>
    <div class="admin-filter-actions">
        <button class="button button-small button-dark" type="submit">Apply</button>
        <a class="button button-small button-outline" href="<?= e(admin_url('inquiries.php')) ?>">Clear</a>
    </div>
</form>

<section class="admin-table-section">
    <div class="admin-table-header">
        <div>
            <h3>Inquiry Feed</h3>
            <p>Latest submissions from the public contact form</p>
        </div>
        <span class="status-pill is-neutral"><?= e((string) $totalCount) ?> results</span>
    </div>

    <?php if ($inquiries === []): ?>
        <p class="admin-empty">No inquiries yet. Submissions from the contact page will appear here.</p>
    <?php else: ?>
        <div style="overflow-x:auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Project Details</th>
                        <th>Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $avatarColors = ['blue', 'green', 'slate', 'amber'];
                    foreach ($inquiries as $i => $row):
                        $initials = applicant_initials((string) $row['full_name']);
                        $color = $avatarColors[$i % count($avatarColors)];
                        $details = (string) $row['project_details'];
                        $trimmed = mb_strlen($details) > 160 ? mb_substr($details, 0, 160) . '…' : $details;
                    ?>
                        <tr>
                            <td>
                                <div class="admin-name-cell">
                                    <span class="admin-avatar <?= $color ?>"><?= e($initials) ?></span>
                                    <strong><?= e($row['full_name']) ?></strong>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:500"><?= e($row['email']) ?></div>
                                <div style="font-size:0.78rem;color:#94a3b8"><?= e($row['phone']) ?></div>
                            </td>
                            <td style="max-width:420px;color:#475569;font-size:0.88rem;line-height:1.5" title="<?= e($details) ?>">
                                <?= e($trimmed) ?>
                            </td>
                            <td style="color:#94a3b8;font-size:0.85rem;white-space:nowrap"><?= e(date('M d, Y H:i', strtotime((string) $row['created_at']))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($totalPages > 1): ?>
        <div class="admin-pagination">
            <span class="page-info">
                Showing <strong><?= e((string) (($page - 1) * 15 + 1)) ?>-<?= e((string) min($page * 15, $totalCount)) ?></strong> of <strong><?= e((string) $totalCount) ?></strong> inquiries
            </span>
            <div class="page-btns">
                <?php if ($page > 1): ?>
                    <a class="page-btn" href="<?= e(admin_url('inquiries.php?' . http_build_query(array_merge($filters, ['page' => $page - 1])))) ?>">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                <?php endif; ?>
                <?php for ($p = 1; $p <= min($totalPages, 5); $p++): ?>
                    <a class="page-btn <?= $p === $page ? 'active' : '' ?>" href="<?= e(admin_url('inquiries.php?' . http_build_query(array_merge($filters, ['page' => $p])))) ?>">
                        <?= $p ?>
                    </a>
                <?php endfor; ?>
                <?php if ($totalPages > 5): ?>
                    <span style="color:#94a3b8;padding:0 4px">...</span>
                    <a class="page-btn" href="<?= e(admin_url('inquiries.php?' . http_build_query(array_merge($filters, ['page' => $totalPages])))) ?>">
                        <?= $totalPages ?>
                    </a>
                <?php endif; ?>
                <?php if ($page < $totalPages): ?>
                    <a class="page-btn" href="<?= e(admin_url('inquiries.php?' . http_build_query(array_merge($filters, ['page' => $page + 1])))) ?>">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php require dirname(__DIR__) . '/includes/admin_footer.php'; ?>
