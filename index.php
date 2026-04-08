<?php

declare(strict_types=1);

$currentPage = 'home';
$pageTitle = 'Diva Buildcom | Reliable Civil Contractors in Suburban Mumbai';
$pageDescription = 'Premium construction company website for Diva Buildcom with modern civil contracting, suburban Mumbai expertise, and strong execution standards.';

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-home">
    <div class="container hero-grid">
        <div class="hero-copy" data-reveal>
            <span class="pill">Engineering Excellence</span>
            <h1>Reliable Civil Contractors in Suburban Mumbai</h1>
            <p>Transforming the suburban skyline with precision engineering, premium material standards, and disciplined site execution for residential, commercial, and industrial development.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="<?= e(site_url('contact.php')) ?>">Get a Quote</a>
                <a class="button button-ghost" href="#projects">View Our Projects</a>
            </div>
        </div>
    </div>
</section>

<section class="stat-band">
    <div class="container">
        <div class="stats-grid" data-reveal>
            <?php foreach ($homeStats as $stat): ?>
                <div class="stat">
                    <strong data-count="<?= e($stat['value']) ?>"><?= e($stat['value']) ?></strong>
                    <span><?= e($stat['label']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div class="image-panel" data-reveal>
            <div class="image-frame">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiiy82X96vxx-NayZyGql9Dk1-vYyz7iZFxl-CfrplQIHenM4OgD-kZ9fxL-WVlFvWRCwLOeSdOG19DjNFtGC4Wts0vTHj96CBeTh5lBLXyKmdYu2EmmabakuxZCuZBW0p3xpjLNuwH0-dJ1Z7vKViVgC5adnJym5OgcPyeJA_rTmdBcXf8yMUmcoTUIuR5D0omBuPWsf0t7XVA3vbJxxBmEnyXgG65TkBGljqllgrFGY-p8WsIrMdXbyTvBBEKW9wAhN54eOkLIc2" alt="Architectural drawing and tools">
            </div>
            <div class="floating-badge">
                <strong>15+</strong>
                <span>Years of Precision</span>
            </div>
        </div>
        <div data-reveal>
            <div class="eyebrow">Who We Are</div>
            <div class="section-heading">
                <h2>Defining the standards of suburban infrastructure</h2>
            </div>
            <div class="copy-stack">
                <p>Diva Buildcom stands as a reliable construction partner in Mumbai’s suburban growth corridor. We balance structural integrity, premium detailing, and practical site execution to deliver lasting value.</p>
                <p>Our approach is rooted in clarity, technical discipline, and material quality. Every project is handled with strong planning, measured coordination, and a finish that reflects a premium brand.</p>
            </div>
            <div class="mini-points">
                <div class="mini-point"><strong>Mumbai Based</strong><span>Strong understanding of suburban terrain and approval realities.</span></div>
                <div class="mini-point"><strong>Quality First</strong><span>High attention to standards, safety, and engineered execution.</span></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading" data-reveal>
            <div class="eyebrow">Our Core Values</div>
            <h2>Why choose Diva Buildcom?</h2>
        </div>
        <div class="card-grid">
            <?php foreach ($homeValues as $value): ?>
                <article class="capability-card" data-reveal>
                    <div class="icon-box"><?= e(substr($value['title'], 0, 1)) ?></div>
                    <h3><?= e($value['title']) ?></h3>
                    <p><?= e($value['copy']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-deep process-dark blueprint-grid">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h2>Our streamlined process</h2>
            <p>From consultation to handover, every phase is managed with clear communication and engineering-led control.</p>
        </div>
        <div class="process-grid">
            <?php foreach ($processSteps as $index => $step): ?>
                <article class="process-card" data-reveal>
                    <div class="process-icon"><?= e((string) ($index + 1)) ?></div>
                    <h3><?= e($step['title']) ?></h3>
                    <p><?= e($step['copy']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h2>Our core capabilities</h2>
            <p>Comprehensive civil solutions tailored for residential, commercial, and infrastructure-driven growth.</p>
        </div>
        <div class="card-grid">
            <?php foreach ($capabilities as $capability): ?>
                <article class="capability-card" data-reveal>
                    <div class="icon-box"><?= e($capability['icon']) ?></div>
                    <h3><?= e($capability['title']) ?></h3>
                    <p><?= e($capability['copy']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="projects">
    <div class="container">
        <div class="section-heading" data-reveal>
            <div class="eyebrow">Portfolio</div>
            <h2>Featured projects</h2>
            <p>Selected work that reflects our standards for delivery, finish, and long-term structural value.</p>
        </div>
        <div class="projects-grid">
            <?php foreach ($featuredProjects as $project): ?>
                <article class="project-card" data-reveal>
                    <div class="project-media">
                        <img src="<?= e($project['image']) ?>" alt="<?= e($project['title']) ?>">
                        <span class="project-status"><?= e($project['status']) ?></span>
                    </div>
                    <div class="project-body">
                        <span class="eyebrow" style="margin-bottom:10px"><?= e($project['category']) ?></span>
                        <h3 class="card-title"><?= e($project['title']) ?></h3>
                        <p><?= e($project['copy']) ?></p>
                        <div class="project-meta">
                            <span><?= e($project['location']) ?></span>
                            <span>View Details</span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading" data-reveal>
            <h2>What our clients say</h2>
            <p>Trusted by developers, property owners, and businesses across suburban Mumbai.</p>
        </div>
        <div class="testimonials-grid">
            <?php foreach ($testimonials as $testimonial): ?>
                <article class="testimonial-card" data-reveal>
                    <div class="testimonial-stars">★★★★★</div>
                    <p>"<?= e($testimonial['copy']) ?>"</p>
                    <div class="testimonial-identity">
                        <div class="avatar"><?= e($testimonial['initials']) ?></div>
                        <div>
                            <h3><?= e($testimonial['name']) ?></h3>
                            <p><?= e($testimonial['role']) ?></p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-panel" data-reveal>
            <div>
                <h2>Start your construction project today</h2>
                <p>Our team is ready to review your project scope, understand your site needs, and share a structured path forward.</p>
                <div class="cta-checks">
                    <span>Free site analysis</span>
                    <span>Expert consultation</span>
                </div>
            </div>
            <div>
                <a class="button button-primary" href="<?= e(site_url('contact.php')) ?>">Schedule a Consultation</a>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
