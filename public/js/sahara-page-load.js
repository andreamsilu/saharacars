/**
 * Lightweight navigation hint: car-on-circle loader during in-app page transitions.
 */
(function () {
    'use strict';

    var root = document.getElementById('sahara-page-load-bar');
    if (!root) return;

    var depth = 0;

    function show() {
        depth += 1;
        root.classList.add('is-active');
    }

    function hideAll() {
        depth = 0;
        root.classList.remove('is-active');
    }

    /** True when the link only changes the hash (no full document load). */
    function isInPageOnlyNav(a) {
        try {
            var u = new URL(a.href, window.location.href);
            if (u.origin !== window.location.origin) return false;
            return u.pathname === window.location.pathname && u.search === window.location.search;
        } catch (e) {
            return false;
        }
    }

    function isInternalNavigationLink(a) {
        if (!a || a.tagName !== 'A') return false;
        if (a.target === '_blank' || a.hasAttribute('download')) return false;
        var href = a.getAttribute('href');
        if (!href || href === '#' || href.indexOf('javascript:') === 0 || href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) {
            return false;
        }
        if (isInPageOnlyNav(a)) return false;
        try {
            var u = new URL(a.href, window.location.href);
            return u.origin === window.location.origin;
        } catch (e2) {
            return false;
        }
    }

    document.addEventListener(
        'click',
        function (e) {
            var a = e.target.closest('a');
            if (!isInternalNavigationLink(a)) return;
            if (e.defaultPrevented) return;
            if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
            show();
        },
        true
    );

    document.addEventListener(
        'submit',
        function (e) {
            var form = e.target;
            if (!form || form.tagName !== 'FORM') return;
            if (form.target === '_blank') return;
            try {
                var u = new URL(form.getAttribute('action') || window.location.href, window.location.href);
                if (u.origin !== window.location.origin) return;
            } catch (err) {
                return;
            }
            show();
        },
        true
    );

    window.addEventListener('pageshow', function () {
        hideAll();
    });

    window.addEventListener('DOMContentLoaded', hideAll);
    window.addEventListener('load', hideAll);

    if (document.readyState !== 'loading') {
        hideAll();
    }
})();
