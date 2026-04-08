<?php

declare(strict_types=1);

$currentPage = 'services';
$pageTitle = 'Services | Diva Buildcom';
$pageDescription = 'Explore Diva Buildcom services including residential, commercial, renovation, and plumbing and electrical construction solutions.';

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-services">
    <div class="container hero-grid">
        <div class="hero-copy" data-reveal>
            <span class="pill">Engineered Excellence</span>
            <h1>Structural <span style="color:var(--secondary)">solutions</span></h1>
            <p>We build high-end residential, commercial, and renovation-focused spaces with a premium finish and an execution model grounded in engineering control.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="services-list">
            <?php foreach ($services as $service): ?>
                <article class="service-row <?= $service['reverse'] ? 'reverse' : '' ?>">
                    <div class="service-media" data-reveal>
                        <img src="<?= e($service['image']) ?>" alt="<?= e($service['title']) ?>">
                        <div class="service-note"><?= e($service['title']) ?></div>
                    </div>
                    <div class="service-copy" data-reveal>
                        <h2><?= e($service['title']) ?></h2>
                        <p><?= e($service['copy']) ?></p>
                        <ul class="service-bullets">
                            <?php foreach ($service['bullets'] as $bullet): ?>
                                <li><?= e($bullet) ?></li>
                            <?php endforeach; ?>
                        </ul>
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
                <h2>Ready to start your blueprint?</h2>
                <p>Talk to our team about project planning, execution strategy, and how we can bring the right construction solution to your site.</p>
            </div>
            <div class="hero-actions">
                <a class="button button-primary" href="<?= e(site_url('contact.php')) ?>">Start Project</a>
                <a class="button button-dark" href="<?= e(site_url()) ?>#projects">Our Projects</a>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
