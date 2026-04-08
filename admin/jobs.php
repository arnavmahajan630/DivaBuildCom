<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

$currentPage = 'admin_jobs';
require_admin();

$flash = get_flash('admin_jobs');
$jobs = fetch_all_jobs();
$editingJob = null;

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

$adminPageTitle = 'Job Listings | Diva Buildcom Admin';
$adminHeading = 'Job Listings Management';
$adminIntro = 'Create, update, and control every public careers listing from one place.';

require dirname(__DIR__) . '/includes/admin_header.php';
?>
<?php if ($flash !== null): ?>
    <div class="flash <?= has_errors($flash) ? 'flash-error' : 'flash-success' ?>">
        <div><?= e($flash['message']) ?></div>
    </div>
<?php endif; ?>

<section class="admin-content-grid admin-content-grid-wide">
    <article class="admin-panel" data-reveal>
        <div class="admin-panel-header">
            <div>
                <span class="eyebrow">Posting Control</span>
                <h2><?= $editingJob !== null ? 'Edit job posting' : 'Create a new job posting' ?></h2>
            </div>
            <?php if ($editingJob !== null): ?>
                <a class="button button-small button-outline" href="<?= e(admin_url('jobs.php')) ?>">Create New</a>
            <?php endif; ?>
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
                    <textarea id="job_summary" name="summary" placeholder="Optional short summary shown for internal context and future listing expansion."><?= e($jobForm['summary']) ?></textarea>
                </div>
            </div>
            <div class="hero-actions">
                <button class="button button-dark" type="submit"><?= $editingJob !== null ? 'Update Job' : 'Create Job' ?></button>
            </div>
        </form>
    </article>

    <article class="admin-panel" data-reveal>
        <div class="admin-panel-header">
            <div>
                <span class="eyebrow">Current Roles</span>
                <h2>All job listings</h2>
            </div>
            <span class="status-pill is-neutral"><?= e((string) count($jobs)) ?> total</span>
        </div>

        <?php if ($jobs === []): ?>
            <p class="admin-empty">No jobs found yet. Create the first posting to populate the careers page.</p>
        <?php else: ?>
            <div class="admin-list">
                <?php foreach ($jobs as $job): ?>
                    <div class="admin-job-card">
                        <div class="admin-job-card-top">
                            <div>
                                <h3><?= e($job['title']) ?></h3>
                                <p><?= e($job['location']) ?> • <?= e($job['experience']) ?> • <?= e($job['employment_type'] ?? $job['type']) ?></p>
                            </div>
                            <span class="status-pill <?= !empty($job['is_active']) ? 'is-success' : 'is-neutral' ?>">
                                <?= !empty($job['is_active']) ? 'Active' : 'Inactive' ?>
                            </span>
                        </div>
                        <?php if (!empty($job['summary'])): ?>
                            <p class="admin-job-summary"><?= e($job['summary']) ?></p>
                        <?php endif; ?>
                        <div class="admin-card-actions">
                            <?php if (!empty($job['id'])): ?>
                                <a class="button button-small button-outline" href="<?= e(admin_url('jobs.php?edit=' . (int) $job['id'])) ?>">Edit</a>
                                <form action="<?= e(site_url('handlers/admin_job_toggle.php')) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= e((string) $job['id']) ?>">
                                    <button class="button button-small button-primary" type="submit"><?= !empty($job['is_active']) ? 'Deactivate' : 'Activate' ?></button>
                                </form>
                                <form action="<?= e(site_url('handlers/admin_job_delete.php')) ?>" method="post" onsubmit="return confirm('Delete this job posting?');">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= e((string) $job['id']) ?>">
                                    <button class="button button-small button-danger" type="submit">Delete</button>
                                </form>
                            <?php else: ?>
                                <span class="admin-inline-note">Legacy fallback jobs will become editable after the schema is applied.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>
</section>
<?php require dirname(__DIR__) . '/includes/admin_footer.php'; ?>
