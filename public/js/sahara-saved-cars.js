/**
 * Saved cars (localStorage, no login). Key: sahara_saved_cars_v1
 */
(function () {
    'use strict';

    var STORAGE_KEY = 'sahara_saved_cars_v1';
    var MAX_ITEMS = 40;

    function read() {
        try {
            var raw = localStorage.getItem(STORAGE_KEY);
            var data = raw ? JSON.parse(raw) : [];
            return Array.isArray(data) ? data : [];
        } catch (e) {
            return [];
        }
    }

    function write(items) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(items.slice(0, MAX_ITEMS)));
        window.dispatchEvent(new CustomEvent('sahara-saved-changed'));
    }

    function isSaved(slug) {
        return read().some(function (x) {
            return x.slug === slug;
        });
    }

    function toggle(slug, title) {
        var items = read();
        var idx = items.findIndex(function (x) {
            return x.slug === slug;
        });
        var added;
        if (idx >= 0) {
            items.splice(idx, 1);
            added = false;
        } else {
            items.unshift({
                slug: slug,
                title: title || slug,
                savedAt: Date.now(),
            });
            added = true;
        }
        write(items);
        return added;
    }

    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c] || c;
        });
    }

    function syncToggleButtons() {
        document.querySelectorAll('[data-saved-car-toggle]').forEach(function (btn) {
            var slug = btn.getAttribute('data-slug');
            if (!slug) return;
            var filled = isSaved(slug);
            btn.setAttribute('aria-pressed', filled ? 'true' : 'false');
            var icon = btn.querySelector('.material-symbols-outlined');
            if (icon) {
                icon.style.fontVariationSettings = filled ? "'FILL' 1" : "'FILL' 0";
                icon.classList.toggle('text-error', filled);
                icon.classList.toggle('text-primary', !filled);
            }
        });
    }

    function renderSavedList() {
        var list = document.getElementById('saved-cars-render-list');
        if (!list) return;
        var base = list.getAttribute('data-cars-base-url') || '';
        var items = read();
        if (!items.length) {
            list.innerHTML =
                '<li class="text-on-surface-variant text-sm">No saved cars yet. Tap the heart on any listing to save it here.</li>';
            return;
        }
        list.innerHTML = items
            .map(function (x) {
                var href = base + encodeURIComponent(x.slug);
                return (
                    '<li class="border-b border-outline-variant/30 py-3 last:border-0">' +
                    '<a class="font-headline font-bold text-primary hover:underline" href="' +
                    escapeHtml(href) +
                    '">' +
                    escapeHtml(x.title) +
                    '</a>' +
                    '</li>'
                );
            })
            .join('');
    }

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-saved-car-toggle]');
        if (!btn) return;
        var slug = btn.getAttribute('data-slug');
        var title = btn.getAttribute('data-title');
        if (!slug) return;
        e.preventDefault();
        toggle(slug, title);
        syncToggleButtons();
    });

    document.addEventListener('DOMContentLoaded', function () {
        syncToggleButtons();
        renderSavedList();
    });

    document.addEventListener('sahara-saved-changed', function () {
        syncToggleButtons();
        renderSavedList();
    });

    window.SaharaSavedCars = { read: read, isSaved: isSaved, toggle: toggle };
})();
