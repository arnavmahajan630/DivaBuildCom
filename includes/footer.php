<?php

declare(strict_types=1);

$site = config('site');
?>
</main>
<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <div class="footer-brand">Diva Buildcom</div>
            <p><?= e($site['tagline']) ?></p>
        </div>
        <div>
            <h4>Navigation</h4>
            <ul>
                <li><a href="<?= e(site_url()) ?>">Home</a></li>
                <li><a href="<?= e(site_url('about.php')) ?>">About</a></li>
                <li><a href="<?= e(site_url('services.php')) ?>">Services</a></li>
                <li><a href="<?= e(site_url('careers.php')) ?>">Careers</a></li>
                <li><a href="<?= e(site_url('contact.php')) ?>">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4>Reach Us</h4>
            <ul>
                <li><a href="tel:<?= e($site['phone_link']) ?>"><?= e($site['phone_display']) ?></a></li>
                <li><a href="tel:<?= e($site['mobile_link']) ?>"><?= e($site['mobile_display']) ?></a></li>
                <li><a href="mailto:<?= e($site['email_primary']) ?>"><?= e($site['email_primary']) ?></a></li>
                <li><a href="mailto:<?= e($site['email_secondary']) ?>"><?= e($site['email_secondary']) ?></a></li>
            </ul>
        </div>
        <div>
            <h4>Location</h4>
            <p><?= $site['address_html'] ?></p>
            <a class="footer-link" href="<?= e(site_url('contact.php')) ?>">Schedule a consultation</a>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>&copy; <?= date('Y') ?> Diva Buildcom. Engineered for Excellence.</p>
    </div>
</footer>
<script src="<?= e(asset_url('assets/js/main.js')) ?>"></script>
</body>
</html>
