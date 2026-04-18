<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary": "#1a1208",
                        "on-background": "#191c1e",
                        "primary": "#b48a40",
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
                        "surface-tint": "#a67c40",
                        "secondary": "#006d2f",
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
                        "on-primary-container": "#f4e4c4",
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
    </style>
</head>
<body class="bg-background font-body text-on-surface attention-mesh">
<!-- TopNavBar -->
<x-navbar />
<main class="max-w-7xl mx-auto px-6 py-8 flex gap-8">
<!-- Left Sidebar Filter -->
<aside class="hidden lg:block w-72 flex-shrink-0">
<div class="sticky top-24 space-y-8 bg-surface-container-low rounded-2xl p-5 md:p-6 attention-panel">
<form action="{{ route('cars.bento') }}" method="GET">
@if (request()->filled('q'))
    <input type="hidden" name="q" value="{{ request('q') }}" />
@endif
<div>
<h3 class="font-headline font-bold text-lg mb-6 text-primary">Refine Selection</h3>
<div class="space-y-6">
<!-- Brand -->
<div class="space-y-3">
<label class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Brand</label>
<select name="brand" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 focus:ring-2 focus:ring-primary/10 ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]">
<option value="">All Manufacturers</option>
<option value="Toyota" {{ request('brand') === 'Toyota' ? 'selected' : '' }}>Toyota</option>
<option value="Land Rover" {{ request('brand') === 'Land Rover' ? 'selected' : '' }}>Land Rover</option>
<option value="Mercedes" {{ request('brand') === 'Mercedes' ? 'selected' : '' }}>Mercedes</option>
<option value="Nissan" {{ request('brand') === 'Nissan' ? 'selected' : '' }}>Nissan</option>
</select>
</div>
<!-- Price Range -->
<div class="space-y-3">
<label class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Price Range (TZS)</label>
<div class="grid grid-cols-2 gap-2">
<input name="price_min" value="{{ request('price_min') }}" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]" placeholder="Min" type="number"/>
<input name="price_max" value="{{ request('price_max') }}" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]" placeholder="Max" type="number"/>
</div>
</div>
<!-- Location -->
<div class="space-y-3">
<label class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Location</label>
<div class="space-y-2">
@php
    $selectedLocations = request()->input('location', []);
    if (!is_array($selectedLocations)) {
        $selectedLocations = $selectedLocations !== '' ? [$selectedLocations] : [];
    }
@endphp
<label class="flex items-center space-x-3 cursor-pointer group">
<input name="location[]" value="Dar es Salaam" {{ in_array('Dar es Salaam', $selectedLocations, true) ? 'checked' : '' }} class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5" type="checkbox"/>
<span class="text-sm font-medium group-hover:text-primary transition-colors">Dar es Salaam</span>
</label>
<label class="flex items-center space-x-3 cursor-pointer group">
<input name="location[]" value="Arusha" {{ in_array('Arusha', $selectedLocations, true) ? 'checked' : '' }} class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5" type="checkbox"/>
<span class="text-sm font-medium group-hover:text-primary transition-colors">Arusha</span>
</label>
<label class="flex items-center space-x-3 cursor-pointer group">
<input name="location[]" value="Zanzibar" {{ in_array('Zanzibar', $selectedLocations, true) ? 'checked' : '' }} class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5" type="checkbox"/>
<span class="text-sm font-medium group-hover:text-primary transition-colors">Zanzibar</span>
</label>
</div>
</div>
<!-- Transmission -->
<div class="space-y-3">
<label class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Transmission</label>
<div class="flex gap-2 p-1 bg-surface-container-low rounded-full text-xs">
<label class="flex-1">
<input type="radio" name="transmission" value="Automatic" class="sr-only peer" {{ request('transmission') === 'Automatic' ? 'checked' : '' }}>
<span class="block text-center py-2 rounded-full font-bold peer-checked:bg-primary peer-checked:text-on-primary text-on-surface-variant hover:bg-surface-container-highest transition-colors">Automatic</span>
</label>
<label class="flex-1">
<input type="radio" name="transmission" value="Manual" class="sr-only peer" {{ request('transmission') === 'Manual' ? 'checked' : '' }}>
<span class="block text-center py-2 rounded-full font-bold peer-checked:bg-primary peer-checked:text-on-primary text-on-surface-variant hover:bg-surface-container-highest transition-colors">Manual</span>
</label>
<label class="flex-1">
<input type="radio" name="transmission" value="" class="sr-only peer" {{ request('transmission') === null || request('transmission') === '' ? 'checked' : '' }}>
<span class="block text-center py-2 rounded-full font-bold peer-checked:bg-primary peer-checked:text-on-primary text-on-surface-variant hover:bg-surface-container-highest transition-colors">Any</span>
</label>
</div>
</div>
<!-- Fuel -->
<div class="space-y-3">
<label class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Fuel</label>
<div class="grid grid-cols-1 gap-2">
<select name="fuel" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 focus:ring-2 focus:ring-primary/10 appearance-none ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]">
<option value="">Any fuel</option>
<option value="Petrol" {{ request('fuel') === 'Petrol' ? 'selected' : '' }}>Petrol</option>
<option value="Diesel" {{ request('fuel') === 'Diesel' ? 'selected' : '' }}>Diesel</option>
<option value="Hybrid" {{ request('fuel') === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
<option value="Electric" {{ request('fuel') === 'Electric' ? 'selected' : '' }}>Electric</option>
</select>
</div>
</div>
<!-- Category -->
<div class="space-y-3">
<label class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Category</label>
<div class="grid grid-cols-1 gap-2">
<select name="category" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 focus:ring-2 focus:ring-primary/10 appearance-none ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]">
<option value="">Any category</option>
<option value="brand_new" {{ request('category', request('condition')) === 'brand_new' ? 'selected' : '' }}>Brand New</option>
<option value="foreign_used" {{ request('category', request('condition')) === 'foreign_used' ? 'selected' : '' }}>Foreign Used</option>
<option value="local_used" {{ request('category', request('condition')) === 'local_used' ? 'selected' : '' }}>Locally Used</option>
</select>
</div>
</div>
</div>
<button class="w-full mt-8 py-4 cta-gradient text-on-primary font-headline font-bold rounded-full shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                        Apply Filters
                    </button>
</div>
</form>
</div>
</aside>
<!-- Main Content -->
<section class="flex-1">
<div class="flex justify-between items-end mb-8">
<div>
<h1 class="font-headline font-extrabold text-3xl text-primary tracking-tight">Premium Inventory</h1>
<p class="text-on-surface-variant font-body mt-1">
Found {{ $cars->total() }} curated vehicle{{ $cars->total() === 1 ? '' : 's' }}
</p>
</div>
<div class="flex items-center space-x-2 text-sm font-medium text-on-surface-variant">
<span>Sort by:</span>
<form action="{{ route('cars.bento') }}" method="GET" class="flex items-center gap-2">
@foreach (request()->except(['sort', 'page']) as $param => $value)
    @if (is_array($value))
        @foreach ($value as $item)
            <input type="hidden" name="{{ $param }}[]" value="{{ $item }}" />
        @endforeach
    @elseif ($value !== null && $value !== '')
        <input type="hidden" name="{{ $param }}" value="{{ $value }}" />
    @endif
@endforeach
<select name="sort" onchange="this.form.submit()" class="rounded-full bg-surface-container-low px-3 py-2 text-xs font-bold text-primary focus:ring-2 focus:ring-primary/20 ghost-border">
    @php $activeSort = request('sort', 'newest'); @endphp
    <option value="newest" {{ $activeSort === 'newest' ? 'selected' : '' }}>Newest</option>
    <option value="price_low_high" {{ $activeSort === 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
    <option value="price_high_low" {{ $activeSort === 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
    <option value="year_new_old" {{ $activeSort === 'year_new_old' ? 'selected' : '' }}>Year: New to Old</option>
    <option value="year_old_new" {{ $activeSort === 'year_old_new' ? 'selected' : '' }}>Year: Old to New</option>
    <option value="engine_capacity_high_low" {{ $activeSort === 'engine_capacity_high_low' ? 'selected' : '' }}>Engine Capacity: High to Low</option>
    <option value="engine_capacity_low_high" {{ $activeSort === 'engine_capacity_low_high' ? 'selected' : '' }}>Engine Capacity: Low to High</option>
</select>
</form>
</div>
</div>
<form id="bento-autosearch-form" action="{{ route('cars.bento') }}" method="GET" class="mb-6">
@foreach (request()->except(['q', 'page']) as $param => $value)
    @if (is_array($value))
        @foreach ($value as $item)
            <input type="hidden" name="{{ $param }}[]" value="{{ $item }}" />
        @endforeach
    @elseif ($value !== null && $value !== '')
        <input type="hidden" name="{{ $param }}" value="{{ $value }}" />
    @endif
@endforeach
<label for="bento-autosearch" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">
Search premium inventory
</label>
<div class="relative max-w-xl attention-panel rounded-2xl p-3">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
    <input
        id="bento-autosearch"
        name="q"
        value="{{ request('q', '') }}"
        type="search"
        autocomplete="off"
        placeholder="Type model, brand, or location..."
        class="w-full rounded-full bg-surface-container-highest py-3 pl-10 pr-4 text-sm font-medium text-primary placeholder:text-on-surface-variant focus:ring-2 focus:ring-primary/20 ghost-border"
    />
</div>
<p class="mt-2 text-xs text-on-surface-variant">Auto-search runs while typing.</p>
</form>
<!-- Bento/Grid Car Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
@forelse ($cars as $car)
<x-car-card :car="$car" />
@empty
<div class="md:col-span-2 bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
<div class="font-headline font-black text-2xl text-primary">No cars yet</div>
<p class="text-on-surface-variant mt-2">No vehicles are available yet. Please check back soon.</p>
</div>
@endforelse
</div>
<!-- Pagination -->
<div class="mt-12 flex justify-center">
{{ $cars->links() }}
</div>
</section>
</main>
<!-- Footer -->
<x-footer class="mt-20" />
<x-mobile-nav active="search" />
<x-whatsapp-float />
<script>
    (() => {
        const form = document.getElementById('bento-autosearch-form');
        const input = document.getElementById('bento-autosearch');
        if (!form || !input) return;

        let debounceId = null;
        input.addEventListener('input', () => {
            window.clearTimeout(debounceId);
            debounceId = window.setTimeout(() => form.submit(), 350);
        });
    })();
</script>
</body></html>

