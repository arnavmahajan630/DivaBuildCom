<?php

declare(strict_types=1);

$currentPage = 'about';
$pageTitle = 'About | Diva Buildcom';
$pageDescription = 'Learn about Diva Buildcom, its engineering team, working philosophy, and certified construction standards in suburban Mumbai.';

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-about">
    <div class="container hero-grid">
        <div class="hero-copy" data-reveal>
            <span class="pill">Legacy of Excellence</span>
            <h1>Building the future of suburban Mumbai</h1>
            <p>Diva Buildcom is a suburban Mumbai-based construction company focused on precision engineering, durable execution, and architectural clarity.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div data-reveal>
            <div class="eyebrow">Our Mandate</div>
            <div class="section-heading">
                <h2>Our architectural and engineering foundation</h2>
            </div>
            <div class="copy-stack">
                <p>We build residential and commercial developments that respect the realities of urban growth while delivering dependable structural quality. Our work combines design sensitivity with execution discipline.</p>
                <p>Every project begins with feasibility, planning, and engineering logic. That foundation allows us to deliver with transparency, control, and attention to detail all the way to handover.</p>
            </div>
        </div>
        <div class="about-stats" data-reveal>
            <article class="stat-card">
                <strong>4</strong>
                <span>Projects Completed</span>
                <p>Delivered to strong quality and safety benchmarks.</p>
            </article>
            <article class="stat-card">
                <strong>4</strong>
                <span>In Progress</span>
                <p>Active site execution across suburban Mumbai.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading" data-reveal>
            <div class="eyebrow">The Human Factor</div>
            <h2>The engineers of your vision</h2>
            <p>Our team brings together site leadership, project management, and engineering experience across a wide range of build typologies.</p>
        </div>
        <div class="team-grid">
            <?php foreach ($teamMembers as $member): ?>
                <article class="team-card" data-reveal>
                    <img src="<?= e($member['image']) ?>" alt="<?= e($member['name']) ?>">
                    <div class="team-copy">
                        <h3><?= e($member['name']) ?></h3>
                        <p><?= e($member['role']) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div data-reveal>
            <div class="section-heading">
                <h2>Certified structural integrity</h2>
                <p>Our systems and site practices are shaped by quality-focused standards, regulatory awareness, and disciplined execution benchmarks.</p>
            </div>
            <div class="mini-points">
                <div class="mini-point"><strong>ISO 9001:2015</strong><span>Quality process discipline across planning and execution.</span></div>
                <div class="mini-point"><strong>RERA Registered</strong><span>Alignment with compliance and market expectations.</span></div>
            </div>
        </div>
        <div class="cert-grid" data-reveal>
            <article class="cert-card">Quality Council Seal</article>
            <article class="cert-card">Structural Safety Board</article>
            <article class="cert-card">Green Build Cert</article>
            <article class="cert-card">Suburban Dev Authority</article>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
