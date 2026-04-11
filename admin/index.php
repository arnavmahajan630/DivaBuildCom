<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

$currentPage = 'admin_dashboard';
require_admin();

$stats = fetch_dashboard_stats();
$recentApplications = fetch_recent_applications(6);
$recentJobs = fetch_recent_jobs(5);

$adminPageTitle = 'Admin Dashboard | Diva Buildcom';
$adminHeading = 'Operational Overview';
$adminIntro = 'Monitor the careers pipeline, review candidate flow, and keep open roles aligned with the public site.';

require dirname(__DIR__) . '/includes/admin_header.php';
?>
<?php if (!jobs_feature_ready() || !applicants_feature_ready()): ?>
    <div class="flash flash-error">
        <div>The database schema is not fully ready yet. Import `database/schema.sql` to unlock the complete admin workflow.</div>
    </div>
<?php endif; ?>

<section class="admin-stats-grid">
    <article class="admin-stat-card" data-reveal>
        <span>Total Applications</span>
        <strong><?= e((string) $stats['total_applications']) ?></strong>
        <p>All candidate submissions currently stored in the system.</p>
    </article>
    <article class="admin-stat-card" data-reveal>
        <span>Pending Review</span>
        <strong><?= e((string) $stats['pending_review']) ?></strong>
        <p>Applications awaiting first review or active screening.</p>
    </article>
    <article class="admin-stat-card" data-reveal>
        <span>Shortlisted</span>
        <strong><?= e((string) $stats['shortlisted']) ?></strong>
        <p>Candidates moved forward for stronger consideration.</p>
    </article>
    <article class="admin-stat-card" data-reveal>
        <span>Active Roles</span>
        <strong><?= e((string) $stats['active_jobs']) ?></strong>
        <p>Live roles currently visible on the public careers page.</p>
    </article>
</section>

<section class="admin-content-grid">
    <article class="admin-panel" data-reveal>
        <div class="admin-panel-header">
            <div>
                <span class="eyebrow">Latest Applications</span>
                <h2>Incoming candidate flow</h2>
            </div>
            <a class="button button-small button-outline" href="<?= e(admin_url('applications.php')) ?>">Open Applications</a>
        </div>
        <?php if ($recentApplications === []): ?>
            <p class="admin-empty">No applications yet. New submissions from the careers page will appear here.</p>
        <?php else: ?>
            <div class="admin-list">
                <?php foreach ($recentApplications as $application): ?>
                    <div class="admin-list-row">
                        <div>
                            <strong><?= e($application['full_name']) ?></strong>
                            <p><?= e($application['target_position']) ?> • <?= e($application['email']) ?></p>
                        </div>
                        <div class="admin-list-meta">
                            <span class="status-pill <?= e(admin_status_class((string) $application['status'])) ?>"><?= e(admin_status_label((string) $application['status'])) ?></span>
                            <small><?= e(date('d M Y', strtotime((string) $application['created_at']))) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>

    <article class="admin-panel" data-reveal>
        <div class="admin-panel-header">
            <div>
                <span class="eyebrow">Jobs Snapshot</span>
                <h2>Recent role updates</h2>
            </div>
            <a class="button button-small button-primary" href="<?= e(admin_url('jobs.php')) ?>">Manage Jobs</a>
        </div>
        <div class="admin-list">
            <?php foreach ($recentJobs as $job): ?>
                <div class="admin-list-row">
                    <div>
                        <strong><?= e($job['title']) ?></strong>
                        <p><?= e($job['location']) ?> • <?= e($job['experience']) ?></p>
                    </div>
                    <div class="admin-list-meta">
                        <span class="status-pill <?= !empty($job['is_active']) ? 'is-success' : 'is-neutral' ?>">
                            <?= !empty($job['is_active']) ? 'Active' : 'Inactive' ?>
                        </span>
                        <small><?= e($job['employment_type'] ?? $job['type']) ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </article>
</section>
<?php require dirname(__DIR__) . '/includes/admin_footer.php'; ?>
