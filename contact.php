<?php

declare(strict_types=1);

$currentPage = 'contact';
$pageTitle = 'Contact | Diva Buildcom';
$pageDescription = 'Contact Diva Buildcom for project inquiries, consultations, and premium construction services in suburban Mumbai.';

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/data.php';

$inquiryFlash = get_flash('inquiry');
$site = config('site');

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-contact">
    <div class="container contact-layout">
        <div data-reveal>
            <span class="pill">Reach Our Office</span>
            <div class="hero-copy">
                <h1>Let’s build your vision into reality.</h1>
                <p>Based in the heart of suburban Mumbai, we bring engineering precision, premium detailing, and professional project coordination to every build.</p>
            </div>
            <div class="contact-stack" style="margin-top:34px">
                <div class="contact-item">
                    <div class="icon-box">HQ</div>
                    <div>
                        <strong>Headquarters</strong>
                        <p><?= $site['address_html'] ?></p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-box">PH</div>
                    <div>
                        <strong>Phone & Mobile</strong>
                        <p><a href="tel:<?= e($site['phone_link']) ?>"><?= e($site['phone_display']) ?></a><br><a href="tel:<?= e($site['mobile_link']) ?>"><?= e($site['mobile_display']) ?></a></p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="icon-box">EM</div>
                    <div>
                        <strong>Email Inquiries</strong>
                        <p><a href="mailto:<?= e($site['email_primary']) ?>"><?= e($site['email_primary']) ?></a><br><a href="mailto:<?= e($site['email_secondary']) ?>"><?= e($site['email_secondary']) ?></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-card" data-reveal>
            <h3>Send an inquiry</h3>
            <p>Tell us about your project and we’ll get back to you with the right next steps.</p>
            <?php if ($inquiryFlash !== null): ?>
                <div class="flash <?= has_errors($inquiryFlash) ? 'flash-error' : 'flash-success' ?>">
                    <div><?= e($inquiryFlash['message']) ?></div>
                </div>
            <?php endif; ?>
            <form action="<?= e(site_url('handlers/submit_inquiry.php')) ?>" method="post" novalidate>
                <?= csrf_field() ?>
                <div class="form-grid">
                    <div class="field">
                        <label for="inq_full_name">Full Name</label>
                        <input id="inq_full_name" name="full_name" type="text" value="<?= e(old_input($inquiryFlash, 'full_name')) ?>" placeholder="Jay Patel">
                        <?php if ($error = field_error($inquiryFlash, 'full_name')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="inq_phone">Phone Number</label>
                        <input id="inq_phone" name="phone" type="tel" value="<?= e(old_input($inquiryFlash, 'phone')) ?>" placeholder="+91 00000 00000">
                        <?php if ($error = field_error($inquiryFlash, 'phone')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field field-full">
                        <label for="inq_email">Email Address</label>
                        <input id="inq_email" name="email" type="email" value="<?= e(old_input($inquiryFlash, 'email')) ?>" placeholder="diva@example.com">
                        <?php if ($error = field_error($inquiryFlash, 'email')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                    <div class="field field-full">
                        <label for="inq_project_details">Project Details</label>
                        <textarea id="inq_project_details" name="project_details" placeholder="Tell us about your project requirements..."><?= e(old_input($inquiryFlash, 'project_details')) ?></textarea>
                        <?php if ($error = field_error($inquiryFlash, 'project_details')): ?><span class="field-error"><?= e($error) ?></span><?php endif; ?>
                    </div>
                </div>
                <div class="hero-actions">
                    <button class="button button-primary" type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading" data-reveal style="text-align:center">
            <div class="eyebrow" style="justify-content:center">Frequently Asked Questions</div>
            <h2>Common queries</h2>
        </div>
        <div class="faq-list">
            <?php foreach ($faqItems as $faq): ?>
                <details class="faq-card" data-reveal>
                    <summary><?= e($faq['question']) ?></summary>
                    <p><?= e($faq['answer']) ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-panel" data-reveal>
            <div>
                <h2>Start your project with us today</h2>
                <p>Partner with a team that values strong planning, quality construction, and a polished client experience from blueprint to final handover.</p>
            </div>
            <div>
                <a class="button button-primary" href="tel:<?= e($site['mobile_link']) ?>">Request Quote</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container gallery-grid">
        <?php foreach ($contactGallery as $image): ?>
            <article class="gallery-card" data-reveal>
                <img src="<?= e($image) ?>" alt="Diva Buildcom gallery image">
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
