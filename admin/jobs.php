<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

$currentPage = 'admin_jobs';
require_admin();

$flash = get_flash('admin_jobs');
$jobs = fetch_all_jobs();
$jobStats = fetch_job_stats();
$editingJob = null;
$showForm = isset($_GET['create']) || isset($_GET['edit']);

if (isset($_GET['edit']) && ctype_digit((string) $_GET['edit'])) {
    $editingJob = fetch_job_by_id((int) $_GET['edit']);
}

$flashOld = $flash['old'] ?? [];
$jobForm = [
    'id' => $editingJob['id'] ?? '',
    'title' => (string) ($flashOld['title'] ?? $editingJob['title'] ?? ''),
    'location' => (string) ($flashOld['location'] ?? $editingJob['location'] ?? ''),
    'experience' => (string) ($flashOld['experience'] ?? $editingJob['experience'] ?? ''),
    'employment_type' => (string) ($flashOld['employment_type'] ?? $editingJob['employment_type'] ?? 'Full-Time'),
    'summary' => (string) ($flashOld['summary'] ?? $editingJob['summary'] ?? ''),
    'sort_order' => (string) ($flashOld['sort_order'] ?? $editingJob['sort_order'] ?? '0'),
    'is_active' => (string) ($flashOld['is_active'] ?? $editingJob['is_active'] ?? '1'),
];

// Static job images for cards
$jobImages = [
    'https://lh3.googleusercontent.com/aida-public/AB6AXuCzsuC6ev87zHUCCuPoUD5xrk_omjuLXx2lfUCwT_2XXkuyAYH_CT_bTBRkAb0V1eOqNdAQ5k9hgqsDRojEwiP_-waDOGHFzbkHgee1RahmQtNmpLvbr6SvXjYwlCk-AU2bglvDa4gphe-U-m_XWATSVmMfgnkYY-4nTW8G9ZRCzh3v5Ao4-lnxEqBi5lAcoOMJgM6HJy6vxJW4B2l7QZZttVB4h9Xq-KKxe5CnP4sCOCpFUzdOy9KxnuhpDDf5S5Fx-Dq5RnGv7bw',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuCcUF7CrWKijjSeidgmBwqjwlc40DaOYHbPqJ5hHPplXX-1AVjeVOLVk3Bafk_hfdjQGzNe_2EgjTxcGBAoBdDYB5NKAEPytFkiARz3Pszt2gaZZpifEEbOi1M0MbnOO5rtJi6hIJK4JEgXNOK8xgN7ieuGog6UwFrFSq54iharmPqwlJQAgKN5z-Y0-nayiMdUWhlSnS6r1RoGx8lj4IaXLIWsVqFkFfZeBGrihUSdUJaLjdTUrA1_nNAD8899MBlhDfx5wuNpdcA',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuBM016BEHNUle4bfkrR2jJaQjBl6Fa-59TAvd5cvc3LH7sBQNB4zNqSnjSDXndzTzQehbI1tZ-jDENwvcuPgVvfxLRGsyMmHN0yWjbJRlbg_NU7cSlUz3pDurH8BhBVQkl73Rr4E5eb11v4gQcpEmVMklIBX9Qn4jkF4Aat0ZckLrL6FVPYPh4IyWqT-BvfYpPiksPJRn1ARBco0voPCMGGDaLZ_-CJXrUoS4dBbX6ILS-VT-9a9DhbGdpk1QNq-MSZP9QRSChScxo',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuA34lbDktyDdzDDpwmMpmLzmzVYfT93O8uc6FxvKbGMSdn3HNhSDKlzC19zE9bXmQrUNhyswDUVKsJiuABD2-l7PMGWzlmkfBONRoMKRYy1KV9iLbs6dFZhk75tfUEKbMeVM623hjOhd1fzXvlI4Xi8BkQJyKfPoYV7xd8kEhq8ScSUWCzeiPBu6hxqTmsF2JtRCCvZdKGXMXRWR4sx6GBt4y3KUJuL7qJyMaiwXJO6XBLCVldcODfLf0KmYnnpcmgyJMw3b_QgDec',
];

$adminPageTitle = 'Job Listings | Diva Buildcom Admin';
$adminHeading = 'Job Listings';
$adminIntro = 'Manage active architectural and engineering opportunities.';

require dirname(__DIR__) . '/includes/admin_header.php';
?>
<?php if ($flash !== null): ?>
    <div class="flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
        <div><?= e($flash['message']) ?></div>
    </div>
<?php endif; ?>

<!-- Header Section -->
<section style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:32px">
    <div>
        <div class="eyebrow" style="margin-bottom:6px">Personnel Management</div>
        <p style="color:#64748b;margin:8px 0 0;max-width:500px">Manage active architectural and engineering opportunities. Maintain high standards by layering structural requirements into every posting.</p>
    </div>
    <a class="button button-primary" href="<?= e(admin_url('jobs.php?create=1')) ?>">
        <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
        Add New Job
    </a>
</section>

<!-- Stats Row -->
<section class="admin-stats-row">
    <div class="stat-cell">
        <span class="stat-label">Active Postings</span>
        <span class="stat-value"><?= e((string) $jobStats['active_postings']) ?></span>
    </div>
    <div class="stat-cell">
        <span class="stat-label">Total Applicants</span>
        <span class="stat-value"><?= e((string) $jobStats['total_applicants']) ?></span>
    </div>
    <div class="stat-cell">
        <span class="stat-label">Urgent Hires</span>
        <span class="stat-value accent"><?= e((string) $jobStats['urgent_hires']) ?></span>
    </div>
    <div class="stat-cell">
        <span class="stat-label">Avg. Time to Fill</span>
        <span class="stat-value"><?= e((string) $jobStats['avg_time_to_fill']) ?></span>
    </div>
</section>

<!-- Create/Edit Form (collapsible) -->
<?php if ($showForm): ?>
<section class="admin-form-section">
    <div class="form-section-header">
        <h3><?= $editingJob !== null ? 'Edit Job Posting' : 'Create New Job Posting' ?></h3>
        <a class="button button-small button-outline" href="<?= e(admin_url('jobs.php')) ?>">Cancel</a>
    </div>
    <form action="<?= e(site_url('handlers/admin_job_save.php')) ?>" method="post" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= e((string) $jobForm['id']) ?>">
        <div class="form-grid">
            <div class="field">
                <label for="job_title">Job Title</label>
                <input id="job_title" name="title" type="text" value="<?= e($jobForm['title']) ?>" required>
                <?php if ($error = field_error($flash, 'title')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
            </div>
            <div class="field">
                <label for="job_location">Location</label>
                <input id="job_location" name="location" type="text" value="<?= e($jobForm['location']) ?>" required>
                <?php if ($error = field_error($flash, 'location')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
            </div>
            <div class="field">
                <label for="job_experience">Experience</label>
                <input id="job_experience" name="experience" type="text" value="<?= e($jobForm['experience']) ?>" placeholder="e.g. 2-4 Years" required>
                <?php if ($error = field_error($flash, 'experience')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
            </div>
            <div class="field">
                <label for="job_type">Employment Type</label>
                <select id="job_type" name="employment_type">
                    <?php foreach (job_type_options() as $type): ?>
                        <option value="<?= e($type) ?>" <?= $jobForm['employment_type'] === $type ? 'selected' : '' ?>><?= e($type) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="job_sort_order">Sort Order</label>
                <input id="job_sort_order" name="sort_order" type="number" min="0" value="<?= e($jobForm['sort_order']) ?>">
            </div>
            <div class="field">
                <label for="job_is_active">Visibility</label>
                <select id="job_is_active" name="is_active">
                    <option value="1" <?= $jobForm['is_active'] === '1' ? 'selected' : '' ?>>Active on Careers Page</option>
                    <option value="0" <?= $jobForm['is_active'] === '0' ? 'selected' : '' ?>>Inactive / Hidden</option>
                </select>
            </div>
            <div class="field field-full">
                <label for="job_summary">Summary</label>
                <textarea id="job_summary" name="summary" placeholder="Optional short summary for internal context."><?= e($jobForm['summary']) ?></textarea>
            </div>
        </div>
        <div style="margin-top:20px">
            <button class="button button-dark" type="submit"><?= $editingJob !== null ? 'Update Job' : 'Create Job' ?></button>
        </div>
    </form>
</section>
<?php endif; ?>

<!-- Job Cards Grid -->
<?php if ($jobs === []): ?>
    <p class="admin-empty">No jobs found yet. Create the first posting to populate the careers page.</p>
<?php else: ?>
<section class="admin-job-grid">
    <?php foreach ($jobs as $i => $job): ?>
        <div class="admin-job-card">
            <div class="job-img" style="position:relative">
                <img src="<?= e($jobImages[$i % count($jobImages)]) ?>" alt="<?= e($job['title']) ?>">
            </div>
            <div class="job-body">
                <div class="job-title-row">
                    <div>
                        <h3><?= e($job['title']) ?></h3>
                        <div class="job-location">
                            <span class="material-symbols-outlined">location_on</span>
                            <?= e($job['location']) ?>
                        </div>
                    </div>
                    <?php if (!empty($job['id'])): ?>
                        <div style="text-align:center">
                            <form action="<?= e(site_url('handlers/admin_job_toggle.php')) ?>" method="post" style="display:inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= e((string) $job['id']) ?>">
                                <label class="admin-toggle">
                                    <input type="checkbox" <?= !empty($job['is_active']) ? 'checked' : '' ?> onchange="this.form.submit()">
                                    <span class="toggle-slider"></span>
                                </label>
                            </form>
                            <span class="admin-toggle-label <?= !empty($job['is_active']) ? 'active' : 'inactive' ?>">
                                <?= !empty($job['is_active']) ? 'ACTIVE' : 'CLOSED' ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="job-footer">
                    <span class="job-type-badge"><?= e($job['employment_type'] ?? $job['type'] ?? 'Full-Time') ?></span>
                    <?php if (!empty($job['id'])): ?>
                        <div class="job-actions">
                            <a class="act-edit" href="<?= e(admin_url('jobs.php?edit=' . (int) $job['id'])) ?>" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form action="<?= e(site_url('handlers/admin_job_delete.php')) ?>" method="post" style="display:inline" onsubmit="return confirm('Delete this job posting?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= e((string) $job['id']) ?>">
                                <button class="act-delete" type="submit" title="Delete">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Add New Job CTA -->
    <a class="admin-add-cta" href="<?= e(admin_url('jobs.php?create=1')) ?>" style="text-decoration:none">
        <div class="cta-icon">
            <span class="material-symbols-outlined">add_box</span>
        </div>
        <h3>Create New Opening</h3>
        <p>Ready to expand your crew? Post a new job listing to start receiving applications.</p>
    </a>
</section>
<?php endif; ?>

<!-- Footer Pagination -->
<div style="margin-top:32px;padding-top:24px;border-top:1px solid rgba(194,199,207,0.15);display:flex;justify-content:space-between;align-items:center">
    <p style="font-size:0.78rem;color:#64748b;font-style:italic">
        Showing <strong><?= e((string) count($jobs)) ?></strong> job listing(s).
    </p>
</div>
<?php require dirname(__DIR__) . '/includes/admin_footer.php'; ?>
