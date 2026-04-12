<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

$currentPage = 'admin_dashboard';
require_admin();

$stats = fetch_dashboard_stats();
$recentApplications = fetch_recent_applications(6);
$recentJobs = fetch_recent_jobs(5);
$monthlyData = fetch_monthly_application_counts();

$adminPageTitle = 'Admin Dashboard | Diva Buildcom';
$adminHeading = 'Operational Overview';
$adminIntro = 'Monitoring Diva Buildcom talent pipeline and industrial growth.';

require dirname(__DIR__) . '/includes/admin_header.php';
?>
<?php if (!jobs_feature_ready() || !applicants_feature_ready()): ?>
    <div class="flash flash-error">
        <div>The database schema is not fully ready yet. Import <code>database/schema.sql</code> to unlock the complete admin workflow.</div>
    </div>
<?php endif; ?>

<!-- Summary Cards -->
<section class="admin-stats-grid">
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon blue"><span class="material-symbols-outlined">groups</span></div>
            <span class="stat-badge up">+12%</span>
        </div>
        <div class="stat-label">Total Applications</div>
        <div class="stat-value"><?= e((string) $stats['total_applications']) ?></div>
    </article>
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon amber"><span class="material-symbols-outlined">work</span></div>
            <span class="stat-badge neutral">Active</span>
        </div>
        <div class="stat-label">Open Positions</div>
        <div class="stat-value"><?= e((string) $stats['active_jobs']) ?></div>
    </article>
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon green"><span class="material-symbols-outlined">person_check</span></div>
            <span class="stat-badge up">High Quality</span>
        </div>
        <div class="stat-label">Shortlisted</div>
        <div class="stat-value"><?= e((string) $stats['shortlisted']) ?></div>
    </article>
    <article class="admin-stat-card">
        <div class="stat-top">
            <div class="stat-icon rose"><span class="material-symbols-outlined">person_cancel</span></div>
            <span class="stat-badge down">-4%</span>
        </div>
        <div class="stat-label">Rejected</div>
        <div class="stat-value"><?= e((string) $stats['rejected']) ?></div>
    </article>
</section>

<!-- Analytics Section -->
<section class="admin-chart-grid">
    <!-- Applications Chart -->
    <div class="admin-chart-panel">
        <div class="chart-header">
            <div>
                <h3>Applications Over Time</h3>
                <p>Recruitment trajectory for the current fiscal year</p>
            </div>
        </div>
        <div class="admin-chart-bars">
            <?php if ($monthlyData !== []): ?>
                <?php
                $maxCount = max(array_column($monthlyData, 'total'));
                $maxCount = $maxCount > 0 ? $maxCount : 1;
                foreach ($monthlyData as $i => $month):
                    $pct = round(($month['total'] / $maxCount) * 100);
                    $isLast = $i === count($monthlyData) - 1;
                ?>
                    <div class="admin-bar">
                        <div class="bar-fill <?= $isLast ? 'active' : 'muted' ?>" style="height: <?= e((string) $pct) ?>%"></div>
                        <span class="bar-label"><?= e($month['month_label']) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'] as $i => $m): ?>
                    <?php $heights = [50, 66, 75, 83, 100, 80]; ?>
                    <div class="admin-bar">
                        <div class="bar-fill <?= $i === 4 ? 'active' : 'muted' ?>" style="height: <?= $heights[$i] ?>%"></div>
                        <span class="bar-label"><?= $m ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Hiring Goal Panel -->
    <div class="admin-hiring-panel">
        <div>
            <h3>Quarterly Hiring Goal</h3>
            <p class="hiring-sub">Target: <?= e((string) $stats['active_jobs']) ?> open roles to fill</p>
        </div>
        <?php
        $hired = $stats['shortlisted'];
        $target = max($stats['active_jobs'], 1);
        $pct = min(100, round(($hired / $target) * 100));
        ?>
        <div class="hiring-progress">
            <div class="hiring-meta">
                <span class="hiring-pct"><?= e((string) $pct) ?>%</span>
                <span class="hiring-count"><?= e((string) $hired) ?>/<?= e((string) $target) ?> Filled</span>
            </div>
            <div class="admin-progress-track">
                <div class="admin-progress-fill" style="width: <?= e((string) $pct) ?>%"></div>
            </div>
        </div>
        <a class="hiring-btn" href="<?= e(admin_url('applications.php')) ?>">View Detailed Hiring Plan</a>
    </div>
</section>

<!-- Recent Applications Table -->
<section class="admin-table-section">
    <div class="admin-table-header">
        <div>
            <h3>Recent Applications</h3>
            <p>Live feed of incoming talent profiles</p>
        </div>
    </div>
    <?php if ($recentApplications === []): ?>
        <p class="admin-empty">No applications yet. New submissions from the careers page will appear here.</p>
    <?php else: ?>
        <div style="overflow-x:auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $avatarColors = ['blue', 'green', 'slate', 'amber'];
                    foreach ($recentApplications as $i => $app):
                        $initials = applicant_initials((string) $app['full_name']);
                        $color = $avatarColors[$i % count($avatarColors)];
                        $status = (string) $app['status'];
                    ?>
                        <tr>
                            <td>
                                <div class="admin-name-cell">
                                    <span class="admin-avatar <?= $color ?>"><?= e($initials) ?></span>
                                    <strong><?= e($app['full_name']) ?></strong>
                                </div>
                            </td>
                            <td style="color:#64748b;font-weight:500"><?= e($app['target_position']) ?></td>
                            <td>
                                <span class="admin-badge <?= e(admin_badge_class($status)) ?>"><?= e(admin_status_label($status)) ?></span>
                            </td>
                            <td style="color:#94a3b8;font-size:0.85rem"><?= e(date('M d, Y', strtotime((string) $app['created_at']))) ?></td>
                            <td style="text-align:right">
                                <a class="admin-review-link" href="<?= e(admin_url('applications.php?q=' . urlencode((string) $app['full_name']))) ?>">Review</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <div class="admin-table-footer">
        <a href="<?= e(admin_url('applications.php')) ?>">View All <?= e((string) $stats['total_applications']) ?> Applications</a>
    </div>
</section>
<?php require dirname(__DIR__) . '/includes/admin_footer.php'; ?>
