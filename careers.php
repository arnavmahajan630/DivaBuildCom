<?php

declare(strict_types=1);

$currentPage = 'careers';
$pageTitle = 'Careers | Diva Buildcom';
$pageDescription = 'Apply for careers at Diva Buildcom and submit your professional profile with resume upload support.';

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/admin.php';

$applicationFlash = get_flash('application');
$activeJobs = fetch_active_jobs();

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-careers">
    <div class="container hero-grid">
        <div class="hero-copy" data-reveal>
            <span class="pill">Join the Elite Crew</span>
            <h1>Build your career with Diva Buildcom</h1>
            <p>Join a construction company working on real projects across suburban Mumbai, with room for ownership, mentorship, and long-term growth.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="#openings">View Open Positions</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h2>Structural growth</h2>
            <p>Our culture is built around site learning, execution accountability, and the kind of mentorship that helps strong professionals grow fast.</p>
        </div>
        <div class="card-grid">
            <?php foreach ($benefits as $benefit): ?>
                <article class="capability-card" data-reveal>
                    <div class="icon-box">+</div>
                    <h3><?= e($benefit) ?></h3>
                    <p>Designed to support meaningful career progress in a premium project environment.</p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="openings">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h2>Active blueprints</h2>
            <p>Current opportunities for professionals ready to contribute on projects across suburban Mumbai.</p>
        </div>
        <div class="jobs-grid">
            <?php if ($activeJobs === []): ?>
                <p class="admin-empty">No open positions at this time. Please check back soon.</p>
            <?php else: ?>
                <?php foreach ($activeJobs as $job): ?>
                    <article class="job-card" data-reveal>
                        <div>
                            <h3><?= e($job['title']) ?></h3>
                            <p><?= e($job['location']) ?> • <?= e($job['experience']) ?></p>
                        </div>
                        <span class="job-badge"><?= e($job['employment_type'] ?? 'Full-Time') ?></span>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section section-deep process-dark blueprint-grid">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h2>Our selection blueprint</h2>
            <p>A simple process designed to move the right candidates from application to onboarding with clarity.</p>
        </div>
        <div class="selection-grid">
            <?php foreach (['Apply Online', 'Resume Screening', 'Interview', 'Selection & Joining'] as $index => $step): ?>
                <div class="selection-step" data-reveal>
                    <div class="process-icon"><?= e((string) ($index + 1)) ?></div>
                    <h3><?= e($step) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container benefits-layout">
        <div class="benefits-panel" data-reveal>
            <h3>Foundation of benefits</h3>
            <p>We invest in our people with practical exposure, strong responsibilities, and a team culture that values quality work.</p>
            <ul class="benefits-list">
                <?php foreach ($benefits as $benefit): ?>
                    <li><?= e($benefit) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="form-card" data-reveal>
            <h3>Submit your application</h3>
            <p>Share your details and resume to be considered for current and upcoming roles.</p>
            <?php if ($applicationFlash !== null): ?>
                <div class="flash <?= has_errors($applicationFlash) ? 'flash-error' : 'flash-success' ?>">
                    <div><?= e($applicationFlash['message']) ?></div>
                </div>
            <?php endif; ?>
            <form action="<?= e(site_url('handlers/submit_application.php')) ?>" method="post" enctype="multipart/form-data" novalidate>
                <?= csrf_field() ?>
                <div class="form-grid">
                    <div class="field">
                        <label for="app_full_name">Full Name</label>
                        <input id="app_full_name" name="full_name" type="text" value="<?= e(old_input($applicationFlash, 'full_name')) ?>" placeholder="e.g. Rahul Sharma">
                        <?php if ($error = field_error($applicationFlash, 'full_name')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="app_email">Email Address</label>
                        <input id="app_email" name="email" type="email" value="<?= e(old_input($applicationFlash, 'email')) ?>" placeholder="rahul@example.com">
                        <?php if ($error = field_error($applicationFlash, 'email')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="app_phone">Phone Number</label>
                        <input id="app_phone" name="phone" type="tel" value="<?= e(old_input($applicationFlash, 'phone')) ?>" placeholder="+91 98765 43210">
                        <?php if ($error = field_error($applicationFlash, 'phone')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="app_position">Target Position</label>
                        <select id="app_position" name="target_position">
                            <option value="">Select Position</option>
                            <?php foreach ($activeJobs as $job): ?>
                                <option value="<?= e($job['title']) ?>" <?= old_input($applicationFlash, 'target_position') === $job['title'] ? 'selected' : '' ?>>
                                    <?= e($job['title']) ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="Other" <?= old_input($applicationFlash, 'target_position') === 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                        <?php if ($error = field_error($applicationFlash, 'target_position')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field field-full">
                        <label for="app_resume">Upload Resume (PDF/DOC/DOCX)</label>
                        <input id="app_resume" name="resume" type="file" accept=".pdf,.doc,.docx">
                        <span class="upload-note">Accepted formats: PDF, DOC, DOCX. Maximum size: 5 MB.</span>
                        <?php if ($error = field_error($applicationFlash, 'resume')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field field-full">
                        <label for="app_message">Brief Message</label>
                        <textarea id="app_message" name="message" placeholder="Tell us why you want to join Diva Buildcom..."><?= e(old_input($applicationFlash, 'message')) ?></textarea>
                        <?php if ($error = field_error($applicationFlash, 'message')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                </div>
                <div class="hero-actions">
                    <button class="button button-dark" type="submit">Submit Professional Profile</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-panel" data-reveal>
            <div>
                <h2>Start your career journey with Diva Buildcom today</h2>
                <p>We’re always interested in ambitious professionals who care about quality construction and clean execution.</p>
            </div>
            <div>
                <a class="button button-primary" href="#openings">See Current Roles</a>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
