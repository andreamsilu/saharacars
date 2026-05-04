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

    function formatSavedDate(ts) {
        var n = Number(ts);
        if (!n || isNaN(n)) return '';
        try {
            return new Date(n).toLocaleDateString(undefined, {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
            });
        } catch (e) {
            return '';
        }
    }

    function readSavedI18n() {
        var el = document.getElementById('saved-cars-i18n');
        if (!el || !el.textContent) {
            return {};
        }
        try {
            return JSON.parse(el.textContent);
        } catch (e) {
            return {};
        }
    }

    function renderSavedList() {
        var list = document.getElementById('saved-cars-render-list');
        if (!list) return;
        var i18n = readSavedI18n();
        var base = list.getAttribute('data-cars-base-url') || '';
        var browseUrl =
            list.getAttribute('data-browse-url') ||
            (function () {
                var m = /^\/([^/]+)\//.exec(window.location.pathname || '');
                var loc = m ? m[1] : 'en';
                return '/' + loc + '/cars';
            })();
        var items = read();
        if (!items.length) {
            var emptyTitle = i18n.emptyTitle || 'No saved cars yet';
            var emptyBody = i18n.emptyBody || 'When you see something you like in inventory, tap the heart — it will show up here for quick access.';
            var browseLabel = i18n.browse || 'Browse cars';
            list.innerHTML =
                '<li class="rounded-2xl border border-dashed border-outline-variant/70 bg-surface-container-low/60 px-6 py-12 sm:py-14 text-center">' +
                '<span class="material-symbols-outlined text-5xl text-primary/40" aria-hidden="true">favorite</span>' +
                '<p class="font-headline text-lg sm:text-xl font-bold text-primary mt-5">' +
                escapeHtml(emptyTitle) +
                '</p>' +
                '<p class="text-sm text-on-surface-variant mt-2 max-w-md mx-auto leading-relaxed">' +
                escapeHtml(emptyBody) +
                '</p>' +
                '<a class="inline-flex items-center justify-center gap-2 mt-8 min-h-[48px] rounded-full bg-secondary text-white px-8 py-3 text-sm font-bold shadow-lg shadow-secondary/20 transition-[filter] hover:brightness-110 focus-visible:ring-2 focus-visible:ring-secondary focus-visible:ring-offset-2" href="' +
                escapeHtml(browseUrl) +
                '"><span class="material-symbols-outlined text-[20px]" aria-hidden="true">directions_car</span>' +
                escapeHtml(browseLabel) +
                '</a>' +
                '</li>';
            return;
        }
        list.innerHTML = items
            .map(function (x) {
                var href = base + encodeURIComponent(x.slug);
                var title = x.title || x.slug;
                var when = formatSavedDate(x.savedAt);
                var savedOnTpl = i18n.savedOnTpl || 'Saved :date';
                var meta = when ? savedOnTpl.replace(':date', escapeHtml(when)) : i18n.savedListing || 'Saved listing';
                return (
                    '<li class="min-w-0">' +
                    '<div class="flex items-stretch gap-2 sm:gap-3 min-w-0">' +
                    '<a class="group flex flex-1 min-w-0 items-center gap-3 sm:gap-4 rounded-2xl border border-outline-variant/50 bg-surface-container-low px-3 py-3 sm:px-5 sm:py-4 text-left shadow-sm transition-[border-color,box-shadow,transform] hover:border-primary/35 hover:shadow-md hover:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="' +
                    escapeHtml(href) +
                    '">' +
                    '<span class="flex h-11 w-11 sm:h-12 sm:w-12 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary" aria-hidden="true">' +
                    '<span class="material-symbols-outlined text-[22px] sm:text-[24px]" style="font-variation-settings: &quot;FILL&quot; 1;">directions_car</span>' +
                    '</span>' +
                    '<span class="min-w-0 flex-1">' +
                    '<span class="font-headline font-bold text-primary text-base sm:text-lg leading-snug group-hover:underline decoration-primary/40 underline-offset-2 line-clamp-2">' +
                    escapeHtml(title) +
                    '</span>' +
                    '<span class="mt-0.5 block text-xs sm:text-sm text-on-surface-variant">' +
                    meta +
                    '</span>' +
                    '</span>' +
                    '<span class="material-symbols-outlined shrink-0 text-on-surface-variant group-hover:text-primary transition-colors" aria-hidden="true">chevron_right</span>' +
                    '</a>' +
                    '<button type="button" class="flex w-12 sm:w-14 shrink-0 flex-col items-center justify-center gap-0.5 rounded-2xl border border-outline-variant/50 bg-surface-container-lowest text-on-surface-variant shadow-sm transition-[background-color,color,border-color] hover:bg-error-container/30 hover:text-error hover:border-error/25 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary touch-manipulation" data-saved-remove data-slug="' +
                    escapeHtml(x.slug) +
                    '" data-title="' +
                    escapeHtml(title) +
                    '" aria-label="' +
                    escapeHtml((i18n.removePrefix || 'Remove ') + title + (i18n.removeSuffix || ' from saved')) +
                    '">' +
                    '<span class="material-symbols-outlined text-[22px]" aria-hidden="true">delete</span>' +
                    '<span class="hidden sm:block text-[9px] font-bold uppercase tracking-wide">' +
                    escapeHtml(i18n.removeLabel || 'Remove') +
                    '</span>' +
                    '</button>' +
                    '</div>' +
                    '</li>'
                );
            })
            .join('');
    }

    document.addEventListener('click', function (e) {
        var removeBtn = e.target.closest('[data-saved-remove]');
        if (removeBtn) {
            e.preventDefault();
            var rSlug = removeBtn.getAttribute('data-slug');
            var rTitle = removeBtn.getAttribute('data-title');
            if (!rSlug) return;
            toggle(rSlug, rTitle || rSlug);
            return;
        }

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
