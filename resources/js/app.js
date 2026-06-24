import './bootstrap';

/* ---------------------------------------------------------------
 |  Scroll reveal — adds .is-visible to .reveal elements in view
 * ------------------------------------------------------------- */
function initReveal() {
    const els = document.querySelectorAll('.reveal');
    if (!els.length) return;

    if (!('IntersectionObserver' in window)) {
        els.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const delay = entry.target.dataset.delay || 0;
                    setTimeout(() => entry.target.classList.add('is-visible'), delay);
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    els.forEach((el) => observer.observe(el));
}

/* ---------------------------------------------------------------
 |  Navbar — mobile toggle + shadow on scroll
 * ------------------------------------------------------------- */
function initNavbar() {
    const nav = document.querySelector('[data-navbar]');
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            const open = menu.classList.toggle('hidden');
            toggle.setAttribute('aria-expanded', String(!open));
        });
        menu.querySelectorAll('a').forEach((link) =>
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) menu.classList.add('hidden');
            })
        );
    }

    if (nav) {
        const onScroll = () => {
            nav.classList.toggle('is-scrolled', window.scrollY > 12);
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }
}

/* ---------------------------------------------------------------
 |  Animated counters for the stats section
 * ------------------------------------------------------------- */
function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length || !('IntersectionObserver' in window)) return;

    const run = (el) => {
        const raw = el.dataset.counter;
        const match = raw.match(/(\d[\d,.]*)/);
        if (!match) { el.textContent = raw; return; }

        const numStr = match[1];
        const target = parseFloat(numStr.replace(/,/g, ''));
        const prefix = raw.slice(0, match.index);
        const suffix = raw.slice(match.index + numStr.length);
        const duration = 1400;
        const start = performance.now();

        const tick = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            const val = Math.round(target * eased);
            el.textContent = prefix + val.toLocaleString(document.documentElement.lang || 'en') + suffix;
            if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    const obs = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) { run(e.target); obs.unobserve(e.target); }
        });
    }, { threshold: 0.5 });

    counters.forEach((c) => obs.observe(c));
}

/* ---------------------------------------------------------------
 |  Multi-step project request form
 * ------------------------------------------------------------- */
function initWizard() {
    const form = document.querySelector('[data-wizard]');
    if (!form) return;

    const steps = Array.from(form.querySelectorAll('[data-step]'));
    const dots = Array.from(form.querySelectorAll('[data-step-dot]'));
    const current = form.querySelector('[data-current-step]');
    const bar = form.querySelector('[data-progress-bar]');
    const nextBtns = form.querySelectorAll('[data-next]');
    const prevBtns = form.querySelectorAll('[data-prev]');
    let index = 0;

    const show = (i) => {
        steps.forEach((s, n) => s.classList.toggle('hidden', n !== i));
        dots.forEach((d, n) => {
            d.classList.toggle('bg-brand-600', n <= i);
            d.classList.toggle('text-white', n <= i);
            d.classList.toggle('bg-slate-100', n > i);
            d.classList.toggle('text-slate-400', n > i);
        });
        if (current) current.textContent = i + 1;
        if (bar) bar.style.width = ((i + 1) / steps.length) * 100 + '%';
        index = i;
        const top = form.getBoundingClientRect().top + window.scrollY - 110;
        window.scrollTo({ top, behavior: 'smooth' });
    };

    const validateStep = (i) => {
        const required = steps[i].querySelectorAll('[required]');
        let ok = true;
        required.forEach((field) => {
            const valid = field.type === 'radio'
                ? form.querySelector(`[name="${field.name}"]:checked`)
                : field.value.trim();
            if (!valid) {
                ok = false;
                field.classList.add('!border-red-400', '!ring-2', '!ring-red-200');
                field.addEventListener('input', () =>
                    field.classList.remove('!border-red-400', '!ring-2', '!ring-red-200'),
                    { once: true });
            }
        });
        return ok;
    };

    const fillReview = () => {
        form.querySelectorAll('[data-review]').forEach((node) => {
            const name = node.dataset.review;
            const fields = form.querySelectorAll(`[name="${name}"], [name="${name}[]"]`);
            let out = [];
            fields.forEach((f) => {
                if (f.type === 'checkbox' || f.type === 'radio') {
                    if (f.checked) out.push(f.dataset.label || f.value);
                } else if (f.tagName === 'SELECT') {
                    const opt = f.options[f.selectedIndex];
                    if (opt && opt.value) out.push(opt.dataset.label || opt.textContent.trim());
                } else if (f.value.trim()) {
                    out.push(f.value.trim());
                }
            });
            node.textContent = out.length ? out.join('، ') : (node.dataset.empty || '—');
        });
    };

    nextBtns.forEach((b) => b.addEventListener('click', () => {
        if (!validateStep(index)) return;
        if (index + 1 === steps.length - 1) fillReview();
        if (index < steps.length - 1) show(index + 1);
    }));
    prevBtns.forEach((b) => b.addEventListener('click', () => {
        if (index > 0) show(index - 1);
    }));

    show(0);
}

document.addEventListener('DOMContentLoaded', () => {
    initReveal();
    initNavbar();
    initCounters();
    initWizard();
});
