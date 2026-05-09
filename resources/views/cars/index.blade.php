<!DOCTYPE html>

<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<x-public-seo
    :title="__('public.cars_index.title').' | '.config('sahara.legal_entity_name')"
    :description="__('public.home.hero_subtitle')"
    :canonical="route('cars.index', ['locale' => app()->getLocale()])"
/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries" defer></script>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/></noscript>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"/></noscript>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary": "#ffffff",
                        "on-background": "#191c1e",
                        "primary": "#8a6528",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e6e8ea",
                        "on-error-container": "#93000a",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#2a1d09",
                        "secondary-fixed": "#66ff8e",
                        "on-secondary-container": "#007232",
                        "on-primary-fixed-variant": "#4a3614",
                        "on-surface-variant": "#43474f",
                        "on-tertiary-fixed-variant": "#723610",
                        "surface-container-highest": "#e0e3e5",
                        "secondary-container": "#5dfd8a",
                        "tertiary-fixed": "#ffdbca",
                        "surface-variant": "#e0e3e5",
                        "on-secondary-fixed-variant": "#005322",
                        "tertiary-container": "#592300",
                        "on-tertiary": "#ffffff",
                        "background": "#f3f3f3",
                        "inverse-on-surface": "#eff1f3",
                        "surface-tint": "#8a6528",
                        "secondary": "#25D366", /* WhatsApp Green */
                        "surface-container": "#eceef0",
                        "surface": "#f3f3f3",
                        "tertiary": "#381300",
                        "primary-fixed": "#f0dfc4",
                        "on-tertiary-container": "#d8885c",
                        "inverse-surface": "#2d3133",
                        "surface-bright": "#f3f3f3",
                        "outline": "#737780",
                        "error-container": "#ffdad6",
                        "tertiary-fixed-dim": "#ffb690",
                        "primary-container": "#5c4320",
                        "error": "#ba1a1a",
                        "outline-variant": "#c3c6d1",
                        "surface-dim": "#d8dadc",
                        "on-secondary-fixed": "#002109",
                        "on-surface": "#191c1e",
                        "primary-fixed-dim": "#d4b57a",
                        "on-tertiary-fixed": "#341100",
                        "inverse-primary": "#e8c889",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "secondary-fixed-dim": "#3de273"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
        @include('components.public-typography-tokens')
        @include('components.public-effects-tokens')
        @include('components.public-design-tokens')
        @include('components.public-a11y-tokens')
    </style>
</head>
<body class="bg-background font-body text-on-surface attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<!-- TopNavBar -->
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8 flex flex-col lg:flex-row gap-6 lg:gap-8">
{{-- Filters: collapsible on small screens, sidebar on lg+ --}}
<details class="sahara-live-panel lg:hidden group rounded-2xl bg-surface-container-low border border-slate-200/80 attention-panel overflow-hidden">
    <summary class="cursor-pointer list-none flex items-center justify-between gap-3 px-4 py-4 min-h-[52px] font-headline font-bold text-primary touch-manipulation rounded-xl focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">
        <span class="inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-[22px]" aria-hidden="true">tune</span>
            {{ __('public.cars_index.filter_toggle') }}
        </span>
        <span class="material-symbols-outlined text-slate-500 group-open:rotate-180 transition-transform" aria-hidden="true">expand_more</span>
    </summary>
    <div class="px-4 pb-4 pt-0 border-t border-slate-200/60">
        @include('cars.partials.inventory-filter-form', ['action' => route('cars.index'), 'filterFormIdPrefix' => 'mobile'])
    </div>
</details>
<aside class="hidden lg:block w-72 flex-shrink-0">
    <div class="sticky top-32 space-y-8 bg-surface-container-low rounded-2xl p-5 md:p-6 attention-panel max-h-[calc(100vh-9rem)] overflow-y-auto overscroll-contain">
        @include('cars.partials.inventory-filter-form', ['action' => route('cars.index'), 'filterFormIdPrefix' => 'sidebar'])
    </div>
</aside>
<!-- Main Content -->
<section class="flex-1 min-w-0">
<div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-end mb-6 sm:mb-8 gap-4">
<div class="min-w-0 text-center sm:text-left">
<h1 class="font-headline font-extrabold text-2xl sm:text-3xl text-primary tracking-tight">{{ __('public.cars_index.title') }}</h1>
<p class="text-on-surface-variant font-body mt-1">
@if ($cars->total() === 1)
{{ __('public.cars_index.found_one', ['count' => number_format($cars->total())]) }}
@else
{{ __('public.cars_index.found_many', ['count' => number_format($cars->total())]) }}
@endif
</p>
</div>
<div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-0 sm:space-x-2 text-sm font-medium text-on-surface-variant w-full sm:w-auto min-w-0">
<span class="shrink-0">{{ __('public.cars_index.sort_by') }}</span>
<form action="{{ route('cars.index') }}" method="GET" class="flex items-center gap-2">
@foreach (request()->except(['sort', 'page']) as $param => $value)
    @if (is_array($value))
        @foreach ($value as $item)
            <input type="hidden" name="{{ $param }}[]" value="{{ $item }}" />
        @endforeach
    @elseif ($value !== null && $value !== '')
        <input type="hidden" name="{{ $param }}" value="{{ $value }}" />
    @endif
@endforeach
<select name="sort" onchange="this.form.submit()" aria-label="{{ __('public.cars_index.sort_aria') }}" class="rounded-full bg-surface-container-low px-3 py-2 text-xs font-bold text-primary focus:ring-2 focus:ring-primary/30 ghost-border min-h-[44px]">
    @php $activeSort = request('sort', 'newest'); @endphp
    <option value="newest" {{ $activeSort === 'newest' ? 'selected' : '' }}>{{ __('public.cars_index.sort_newest') }}</option>
    <option value="price_low_high" {{ $activeSort === 'price_low_high' ? 'selected' : '' }}>{{ __('public.cars_index.sort_price_low') }}</option>
    <option value="price_high_low" {{ $activeSort === 'price_high_low' ? 'selected' : '' }}>{{ __('public.cars_index.sort_price_high') }}</option>
    <option value="year_new_old" {{ $activeSort === 'year_new_old' ? 'selected' : '' }}>{{ __('public.cars_index.sort_year_new') }}</option>
    <option value="year_old_new" {{ $activeSort === 'year_old_new' ? 'selected' : '' }}>{{ __('public.cars_index.sort_year_old') }}</option>
    <option value="engine_capacity_high_low" {{ $activeSort === 'engine_capacity_high_low' ? 'selected' : '' }}>{{ __('public.cars_index.sort_engine_high') }}</option>
    <option value="engine_capacity_low_high" {{ $activeSort === 'engine_capacity_low_high' ? 'selected' : '' }}>{{ __('public.cars_index.sort_engine_low') }}</option>
</select>
</form>
</div>
</div>
<form id="premium-autosearch-form" action="{{ route('cars.index') }}" method="GET" class="mb-6">
@foreach (request()->except(['q', 'page']) as $param => $value)
    @if (is_array($value))
        @foreach ($value as $item)
            <input type="hidden" name="{{ $param }}[]" value="{{ $item }}" />
        @endforeach
    @elseif ($value !== null && $value !== '')
        <input type="hidden" name="{{ $param }}" value="{{ $value }}" />
    @endif
@endforeach
<label for="premium-autosearch" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">
{{ __('public.cars_index.search_label') }}
</label>
<div class="sahara-live-panel relative max-w-xl attention-panel rounded-2xl p-3">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
    <input
        id="premium-autosearch"
        name="q"
        value="{{ request('q', '') }}"
        type="search"
        autocomplete="off"
        placeholder="{{ __('public.cars_index.search_placeholder') }}"
        class="w-full rounded-full bg-surface-container-highest py-3 pl-10 pr-4 text-sm font-medium text-primary placeholder:text-on-surface-variant focus:ring-2 focus:ring-primary/20 ghost-border"
    />
</div>
<p class="mt-2 text-xs text-on-surface-variant">{{ __('public.cars_index.auto_search_hint') }}</p>
</form>
<!-- Car Grid -->
<div class="sahara-stagger-children grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3">
@forelse ($cars as $car)
<x-car-card :car="$car" :compact="true" />
@empty
<div class="col-span-2 sm:col-span-3 md:col-span-4 lg:col-span-5 bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
<div class="font-headline font-black text-2xl text-primary">{{ __('public.cars_index.no_cars_title') }}</div>
<p class="text-on-surface-variant mt-2">{{ __('public.cars_index.no_cars_body') }}</p>
</div>
@endforelse
</div>
<!-- Pagination -->
<div class="mt-16 flex justify-center items-center">
{{ $cars->links() }}
</div>
</section>
</main>
<x-footer class="mt-20" />
<x-mobile-nav active="inventory" />
<x-whatsapp-float />
<script>
    (() => {
        const form = document.getElementById('premium-autosearch-form');
        const input = document.getElementById('premium-autosearch');
        if (!form || !input) return;

        let debounceId = null;
        input.addEventListener('input', () => {
            window.clearTimeout(debounceId);
            debounceId = window.setTimeout(() => form.submit(), 350);
        });
    })();
</script>
</body></html>

