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
                <strong>08</strong>
                <span>Total Projects</span>
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
            <?php foreach ($featuredProjects as $idx => $project): ?>
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
                            <button class="project-details-btn" type="button" data-project="<?= $idx ?>">View Details</button>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- Project Detail Modal -->
        <div class="pd-overlay" id="projectModal">
            <div class="pd-modal" role="dialog" aria-modal="true" aria-labelledby="pd-title">
                <button class="pd-close" type="button" aria-label="Close">&times;</button>
                <div class="pd-scroll">
                    <div class="pd-hero">
                        <div class="pd-hero-copy">
                            <span class="pd-category"></span>
                            <h2 class="pd-title" id="pd-title"></h2>
                            <p class="pd-description"></p>
                            <div class="pd-meta">
                                <span class="pd-meta-chip pd-location"></span>
                                <span class="pd-meta-chip pd-status"></span>
                            </div>
                        </div>
                        <div class="pd-cover-card">
                            <img class="pd-cover-img" src="" alt="">
                        </div>
                    </div>

                    <section class="pd-block">
                        <div class="pd-block-header">
                            <div class="pd-section-label">Engineering Specifications</div>
                            <p class="pd-block-copy">Core structural, compliance, and sustainability benchmarks that define project performance.</p>
                        </div>
                        <div class="pd-specs"></div>
                    </section>

                    <section class="pd-main-grid">
                        <div class="pd-plan-panel">
                            <div class="pd-block-header pd-block-header-inline">
                                <div>
                                    <div class="pd-section-label pd-floor-title"></div>
                                    <p class="pd-floor-copy"></p>
                                </div>
                            </div>

                            <div class="pd-active-plan-card">
                                <div class="pd-active-plan-head">
                                    <span class="pd-plate-label">Selected Plan</span>
                                    <h3 class="pd-active-plan-title"></h3>
                                    <p class="pd-active-plan-caption"></p>
                                </div>
                                <div class="pd-active-plan-frame">
                                    <img class="pd-active-plan-image" src="" alt="">
                                </div>
                            </div>

                            <div class="pd-plan-thumbs" role="tablist" aria-label="Project plan gallery"></div>
                        </div>

                        <div class="pd-side-stack">
                            <div class="pd-unit-matrix">
                                <span class="pd-unit-heading">Unit Matrix</span>
                                <div class="pd-units"></div>
                            </div>

                            <div class="pd-zoning-card">
                                <div class="pd-section-label">Planning Insight</div>
                                <div class="pd-zoning-title"></div>
                                <p class="pd-zoning-copy"></p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <script>
        (function () {
            var projects = <?= json_encode(array_map(function ($p) {
                return [
                    'category'   => $p['category'],
                    'title'      => $p['title'],
                    'detail_copy'=> $p['detail_copy'],
                    'image'      => $p['image'],
                    'location'   => $p['location'],
                    'status'     => $p['status'],
                    'specs'      => $p['specs'],
                    'floor_plan_title' => $p['floor_plan_title'],
                    'floor_plan_copy'  => $p['floor_plan_copy'],
                    'plans'      => $p['plans'],
                    'units'      => $p['units'],
                    'zoning_title' => $p['zoning_title'],
                    'zoning_copy'  => $p['zoning_copy'],
                ];
            }, $featuredProjects), JSON_HEX_TAG | JSON_HEX_AMP) ?>;

            var specIcons = {
                foundation: '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 21h18M4 18h16M6 15h12M5 18v-3M19 18v-3M9 15V9l3-3 3 3v6"/></svg>',
                structure: '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>',
                safety: '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                sustainability: '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22c4-4 8-7.5 8-12A8 8 0 004 10c0 4.5 4 8 8 12z"/><path d="M12 14V8M9 11l3-3 3 3"/></svg>'
            };

            var overlay = document.getElementById('projectModal');
            var activeProjectIndex = null;
            var activePlanIndex = 0;

            function createNode(tag, className, text) {
                var node = document.createElement(tag);
                if (className) {
                    node.className = className;
                }

                if (typeof text === 'string') {
                    node.textContent = text;
                }

                return node;
            }

            function renderPlans(project, selectedIndex) {
                var plan = project.plans[selectedIndex] || project.plans[0];
                var thumbs = overlay.querySelector('.pd-plan-thumbs');

                overlay.querySelector('.pd-active-plan-title').textContent = plan.title;
                overlay.querySelector('.pd-active-plan-caption').textContent = plan.caption || '';
                overlay.querySelector('.pd-active-plan-image').src = plan.image;
                overlay.querySelector('.pd-active-plan-image').alt = plan.title;

                thumbs.innerHTML = '';

                project.plans.forEach(function (item, index) {
                    var button = createNode('button', 'pd-thumb' + (index === selectedIndex ? ' is-active' : ''));
                    var thumbImage = createNode('img', 'pd-thumb-image');
                    var thumbBody = createNode('span', 'pd-thumb-body');
                    var thumbTitle = createNode('span', 'pd-thumb-title', item.title);
                    var thumbCaption = createNode('span', 'pd-thumb-caption', item.caption || '');

                    button.type = 'button';
                    button.setAttribute('role', 'tab');
                    button.setAttribute('aria-selected', index === selectedIndex ? 'true' : 'false');
                    button.setAttribute('aria-label', item.title);
                    button.dataset.planIndex = String(index);

                    thumbImage.src = item.image;
                    thumbImage.alt = item.title;

                    thumbBody.appendChild(thumbTitle);
                    thumbBody.appendChild(thumbCaption);
                    button.appendChild(thumbImage);
                    button.appendChild(thumbBody);
                    thumbs.appendChild(button);
                });
            }

            function open(idx) {
                var p = projects[idx];
                if (!p) return;

                activeProjectIndex = idx;
                activePlanIndex = 0;

                overlay.querySelector('.pd-category').textContent = p.category;
                overlay.querySelector('.pd-title').textContent = p.title;
                overlay.querySelector('.pd-description').textContent = p.detail_copy;
                overlay.querySelector('.pd-location').textContent = p.location;
                overlay.querySelector('.pd-status').textContent = p.status;
                overlay.querySelector('.pd-cover-img').src = p.image;
                overlay.querySelector('.pd-cover-img').alt = p.title;

                var specs = overlay.querySelector('.pd-specs');
                specs.innerHTML = '';
                p.specs.forEach(function (s) {
                    var specCard = createNode('div', 'pd-spec-card');
                    var specIcon = createNode('div', 'pd-spec-icon');
                    var specLabel = createNode('div', 'pd-spec-label', s.label);
                    var specValue = createNode('div', 'pd-spec-value', s.value);

                    specIcon.innerHTML = specIcons[s.icon] || '';
                    specCard.appendChild(specIcon);
                    specCard.appendChild(specLabel);
                    specCard.appendChild(specValue);
                    specs.appendChild(specCard);
                });

                overlay.querySelector('.pd-floor-title').textContent = p.floor_plan_title;
                overlay.querySelector('.pd-floor-copy').textContent = p.floor_plan_copy;
                renderPlans(p, activePlanIndex);

                var units = overlay.querySelector('.pd-units');
                units.innerHTML = '';
                p.units.forEach(function (u) {
                    var row = createNode('div', 'pd-unit-row');
                    var type = createNode('span', 'pd-unit-type', u.type);
                    var size = createNode('span', 'pd-unit-size', u.size);

                    row.appendChild(type);
                    row.appendChild(size);
                    units.appendChild(row);
                });

                overlay.querySelector('.pd-zoning-title').textContent = p.zoning_title;
                overlay.querySelector('.pd-zoning-copy').textContent = p.zoning_copy;
                overlay.querySelector('.pd-scroll').scrollTop = 0;

                overlay.classList.add('is-active');
                document.body.style.overflow = 'hidden';
            }

            function close() {
                overlay.classList.remove('is-active');
                document.body.style.overflow = '';
                activeProjectIndex = null;
            }

            document.querySelectorAll('.project-details-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    open(parseInt(this.getAttribute('data-project'), 10));
                });
            });

            overlay.querySelector('.pd-plan-thumbs').addEventListener('click', function (event) {
                var trigger = event.target.closest('.pd-thumb');
                var project = projects[activeProjectIndex];

                if (!trigger || !project) {
                    return;
                }

                activePlanIndex = parseInt(trigger.dataset.planIndex || '0', 10);
                renderPlans(project, activePlanIndex);
            });

            overlay.querySelector('.pd-close').addEventListener('click', close);
            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) close();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') close();
            });
        })();
        </script>
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
