document.addEventListener('DOMContentLoaded', function () {
    var header = document.querySelector('.site-header');
    var menuToggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.site-nav');

    if (menuToggle && nav) {
        menuToggle.addEventListener('click', function () {
            var expanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!expanded));
            nav.classList.toggle('is-open');
        });
    }


    window.addEventListener('scroll', function () {
        if (!header) {
            return;
        }

        header.classList.toggle('is-scrolled', window.scrollY > 12);
    });

    var revealItems = document.querySelectorAll('[data-reveal]');
    if (revealItems.length > 0 && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.16 });

        revealItems.forEach(function (item) {
            observer.observe(item);
        });
    } else {
        revealItems.forEach(function (item) {
            item.classList.add('is-visible');
        });
    }

    var counters = document.querySelectorAll('[data-count]');
    if (counters.length > 0 && 'IntersectionObserver' in window) {
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    return;
                }

                var element = entry.target;
                var targetValue = element.getAttribute('data-count') || '';
                var numeric = parseInt(targetValue.replace(/\D/g, ''), 10);

                if (!numeric || element.dataset.animated === 'true') {
                    counterObserver.unobserve(element);
                    return;
                }

                var suffix = targetValue.replace(String(numeric), '');
                var value = 0;
                var step = Math.max(1, Math.floor(numeric / 35));

                function tick() {
                    value += step;
                    if (value >= numeric) {
                        element.textContent = numeric + suffix;
                        element.dataset.animated = 'true';
                        return;
                    }

                    element.textContent = value + suffix;
                    window.requestAnimationFrame(tick);
                }

                tick();
                counterObserver.unobserve(element);
            });
        }, { threshold: 0.45 });

        counters.forEach(function (counter) {
            counterObserver.observe(counter);
        });
    }

    document.querySelectorAll('.flash').forEach(function (flash) {
        setTimeout(function () {
            flash.classList.add('flash-hide');
        }, 5000);
    });
});
