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
$applications = fetch_applications($filters);
$positions = fetch_application_positions();
$stats = fetch_dashboard_stats();

$adminPageTitle = 'Career Applications | Diva Buildcom Admin';
$adminHeading = 'Career Applications';
$adminIntro = 'Review, filter, and update incoming applicant records without leaving the project.';

require dirname(__DIR__) . '/includes/admin_header.php';
?>
<?php if ($flash !== null): ?>
    <div class="flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
        <div><?= e($flash['message']) ?></div>
    </div>
<?php endif; ?>

<section class="admin-stats-grid admin-stats-grid-compact">
    <article class="admin-stat-card" data-reveal>
        <span>Total Applicants</span>
        <strong><?= e((string) $stats['total_applications']) ?></strong>
        <p>Every submission currently captured from the careers page.</p>
    </article>
    <article class="admin-stat-card" data-reveal>
        <span>Pending Review</span>
        <strong><?= e((string) $stats['pending_review']) ?></strong>
        <p>Applicants that still need triage or review action.</p>
    </article>
    <article class="admin-stat-card" data-reveal>
        <span>Shortlisted</span>
        <strong><?= e((string) $stats['shortlisted']) ?></strong>
        <p>Candidates advanced to the stronger-fit pool.</p>
    </article>
</section>

<section class="admin-panel" data-reveal>
    <div class="admin-panel-header">
        <div>
            <span class="eyebrow">Filters</span>
            <h2>Search and narrow the queue</h2>
        </div>
    </div>
    <form class="admin-filter-grid" method="get" action="<?= e(admin_url('applications.php')) ?>">
        <div class="field">
            <label for="applications_q">Search</label>
            <input id="applications_q" name="q" type="text" value="<?= e($filters['q']) ?>" placeholder="Name, email, phone, or role">
        </div>
        <div class="field">
            <label for="applications_status">Status</label>
            <select id="applications_status" name="status">
                <option value="">All Statuses</option>
                <?php foreach (admin_status_options() as $value => $label): ?>
                    <option value="<?= e($value) ?>" <?= $filters['status'] === $value ? 'selected' : '' ?>><?= e($label) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field">
            <label for="applications_position">Position</label>
            <select id="applications_position" name="position">
                <option value="">All Positions</option>
                <?php foreach ($positions as $position): ?>
                    <option value="<?= e($position) ?>" <?= $filters['position'] === $position ? 'selected' : '' ?>><?= e($position) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="admin-filter-actions">
            <button class="button button-dark" type="submit">Apply Filters</button>
            <a class="button button-outline" href="<?= e(admin_url('applications.php')) ?>">Clear</a>
        </div>
    </form>
</section>

<section class="admin-panel" data-reveal>
    <div class="admin-panel-header">
        <div>
            <span class="eyebrow">Application Queue</span>
            <h2>Candidate profiles</h2>
        </div>
        <span class="status-pill is-neutral"><?= e((string) count($applications)) ?> results</span>
    </div>

    <?php if ($applications === []): ?>
        <p class="admin-empty">No applications matched the current filters.</p>
    <?php else: ?>
        <div class="admin-application-list">
            <?php foreach ($applications as $application): ?>
                <article class="admin-application-card">
                    <div class="admin-application-head">
                        <div>
                            <h3><?= e($application['full_name']) ?></h3>
                            <p><?= e($application['target_position']) ?> • <?= e($application['email']) ?> • <?= e($application['phone']) ?></p>
                        </div>
                        <span class="status-pill <?= e(admin_status_class((string) $application['status'])) ?>"><?= e(admin_status_label((string) $application['status'])) ?></span>
                    </div>
                    <div class="admin-application-body">
                        <div class="admin-application-copy">
                            <p><?= nl2br(e($application['message'])) ?></p>
                            <div class="admin-application-meta">
                                <span>Submitted <?= e(date('d M Y, h:i A', strtotime((string) $application['created_at']))) ?></span>
                                <a href="<?= e(site_url((string) $application['resume_path'])) ?>" target="_blank" rel="noopener">Open Resume</a>
                            </div>
                        </div>
                        <form class="admin-review-form" action="<?= e(site_url('handlers/admin_application_update.php')) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= e((string) $application['id']) ?>">
                            <input type="hidden" name="filters[q]" value="<?= e($filters['q']) ?>">
                            <input type="hidden" name="filters[status]" value="<?= e($filters['status']) ?>">
                            <input type="hidden" name="filters[position]" value="<?= e($filters['position']) ?>">
                            <div class="field">
                                <label for="status_<?= e((string) $application['id']) ?>">Status</label>
                                <select id="status_<?= e((string) $application['id']) ?>" name="status">
                                    <?php foreach (admin_status_options() as $value => $label): ?>
                                        <option value="<?= e($value) ?>" <?= (string) $application['status'] === $value ? 'selected' : '' ?>><?= e($label) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label for="notes_<?= e((string) $application['id']) ?>">Admin Notes</label>
                                <textarea id="notes_<?= e((string) $application['id']) ?>" name="admin_notes" placeholder="Add review notes, interview context, or follow-up details."><?= e((string) ($application['admin_notes'] ?? '')) ?></textarea>
                            </div>
                            <button class="button button-primary" type="submit">Save Review</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?php require dirname(__DIR__) . '/includes/admin_footer.php'; ?>
