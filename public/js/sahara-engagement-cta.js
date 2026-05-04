/**
 * Soft engagement prompt: primary = browse inventory, secondary = WhatsApp.
 * Skips /cars/*, respects 7-day snooze (localStorage) and session dismiss.
 */
(function () {
    'use strict';

    var STORAGE_KEY = 'sahara_engagement_cta_v1';
    var SESSION_KEY = 'sahara_engagement_cta_session';
    var DELAY_MS = 22000;
    var SNOOZE_DAYS = 7;

    var root = document.getElementById('sahara-engagement-root');
    if (!root) return;

    var dialog = document.getElementById('sahara-engagement-dialog');
    var noremind = document.getElementById('sahara-engagement-noremind');
    var lastFocus = null;

    function isCarsPath() {
        var p = window.location.pathname || '';
        if (p === '/cars' || p.indexOf('/cars/') === 0) return true;
        // Localized URLs: /{locale}/cars and /{locale}/cars/...
        return /^\/[^/]+\/cars(\/|$)/.test(p);
    }

    function snoozed() {
        try {
            var raw = localStorage.getItem(STORAGE_KEY);
            if (!raw) return false;
            var o = JSON.parse(raw);
            if (!o || typeof o.until !== 'number') return false;
            return Date.now() < o.until;
        } catch (e) {
            return false;
        }
    }

    function sessionDismissed() {
        try {
            return sessionStorage.getItem(SESSION_KEY) === '1';
        } catch (e) {
            return false;
        }
    }

    function shouldRun() {
        if (isCarsPath()) return false;
        if (snoozed()) return false;
        if (sessionDismissed()) return false;
        return true;
    }

    function open() {
        lastFocus = document.activeElement;
        root.classList.remove('hidden');
        root.setAttribute('aria-hidden', 'false');
        document.documentElement.classList.add('overflow-hidden');
        var first = dialog.querySelector('[data-engagement-focus]');
        if (first && typeof first.focus === 'function') {
            window.setTimeout(function () {
                first.focus();
            }, 50);
        }
    }

    function close() {
        root.classList.add('hidden');
        root.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('overflow-hidden');
        if (lastFocus && typeof lastFocus.focus === 'function') {
            try {
                lastFocus.focus();
            } catch (e) {}
        }
    }

    /** @param {boolean} weekOff If true, snooze for SNOOZE_DAYS; else only this session. */
    function dismiss(weekOff) {
        if (weekOff) {
            try {
                localStorage.setItem(
                    STORAGE_KEY,
                    JSON.stringify({
                        until: Date.now() + SNOOZE_DAYS * 86400000,
                    })
                );
            } catch (e) {}
        } else {
            try {
                sessionStorage.setItem(SESSION_KEY, '1');
            } catch (e2) {}
        }
        close();
    }

    function tryOpen() {
        if (!shouldRun()) return;
        if (document.visibilityState !== 'visible') return;
        open();
    }

    function schedule() {
        if (!shouldRun()) return;
        var delay = DELAY_MS;
        try {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                delay = Math.min(delay, 8000);
            }
        } catch (e) {}

        window.setTimeout(function () {
            if (document.visibilityState === 'visible') {
                tryOpen();
                return;
            }
            function onVis() {
                if (document.visibilityState !== 'visible') return;
                document.removeEventListener('visibilitychange', onVis);
                tryOpen();
            }
            document.addEventListener('visibilitychange', onVis);
        }, delay);
    }

    document.addEventListener(
        'click',
        function (e) {
            if (!root || root.classList.contains('hidden')) return;
            if (e.target.closest && e.target.closest('[data-engagement-dismiss="backdrop"]')) {
                e.preventDefault();
                dismiss(!!(noremind && noremind.checked));
                return;
            }
            if (e.target.closest && e.target.closest('[data-engagement-dismiss="action"]')) {
                e.preventDefault();
                dismiss(!!(noremind && noremind.checked));
            }
        },
        true
    );

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        if (!root || root.classList.contains('hidden')) return;
        dismiss(!!(noremind && noremind.checked));
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', schedule);
    } else {
        schedule();
    }
})();
