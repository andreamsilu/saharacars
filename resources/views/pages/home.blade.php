<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
              "secondary-fixed": "#d4b896",
              "on-secondary-container": "#3d2e1f",
              "on-primary-fixed-variant": "#4a3614",
              "on-surface-variant": "#43474f",
              "on-tertiary-fixed-variant": "#723610",
              "surface-container-highest": "#e0e3e5",
              "secondary-container": "#f0e6d8",
              "tertiary-fixed": "#ffdbca",
              "surface-variant": "#e0e3e5",
              "on-secondary-fixed-variant": "#4a3d30",
              "tertiary-container": "#592300",
              "on-tertiary": "#ffffff",
              "background": "#f3f3f3",
              "inverse-on-surface": "#eff1f3",
              "surface-tint": "#8a6528",
              "secondary": "#7a6046",
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
              "on-secondary-fixed": "#241a10",
              "on-surface": "#191c1e",
              "primary-fixed-dim": "#d4b57a",
              "on-tertiary-fixed": "#341100",
              "inverse-primary": "#e8c889",
              "on-secondary": "#faf7f3",
              "on-primary-container": "#f4e4c4",
              "surface-container-low": "#f2f4f6",
              "secondary-fixed-dim": "#b8966a"
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
      .section-wash {
        background:
          linear-gradient(180deg, rgba(235, 235, 235, 0.95), rgba(243, 243, 243, 1));
      }
      .section-wash-soft {
        background:
          linear-gradient(180deg, rgba(243, 243, 243, 1), rgba(235, 235, 235, 0.6));
      }
      .graphic-panel {
        background:
          radial-gradient(220px 120px at 85% 10%, rgba(138, 101, 40, 0.2), transparent 65%),
          radial-gradient(180px 120px at 15% 100%, rgba(232, 200, 137, 0.22), transparent 70%),
          #ffffff;
      }
    </style>

</head>
<body class="bg-surface font-body text-on-surface antialiased overflow-x-hidden attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<!-- TopNavBar -->
<x-navbar />
@php
    $salesDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone', '255000000000'));
    $salesTelHref = 'tel:+' . $salesDigits;
    $salesWaMessage = 'Hi Sahara Cars sales, I am interested in buying a car. Please assist.';
    $salesWaHref = 'https://wa.me/' . $salesDigits . '?text=' . rawurlencode($salesWaMessage);
@endphp
<main id="main-content" tabindex="-1" class="outline-none">
{{-- Search-first: compact strip (no full-bleed video), inventory hook + form --}}
@php
    $heroInventoryCount = (int) ($totalPublishedCars ?? 0);
@endphp
<section class="section-wash border-b border-outline-variant/25" aria-labelledby="home-hero-heading">
    <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 pt-20 pb-4 sm:pb-5">
        @if ($heroInventoryCount > 0)
            <h1 id="home-hero-heading" class="font-headline text-[clamp(1.5rem,5vw,2.75rem)] font-black text-on-surface tracking-tight leading-[1.1]">
                Search <span class="text-primary tabular-nums">{{ number_format($heroInventoryCount) }}</span> cars
            </h1>
        @else
            <h1 id="home-hero-heading" class="font-headline text-2xl sm:text-3xl font-black text-on-surface tracking-tight">Search our inventory</h1>
        @endif
        <p class="mt-2 text-sm sm:text-base text-on-surface-variant max-w-2xl">
            @if ($heroInventoryCount > 0)
                Dar, Mwanza &amp; upcountry—import help, full filters on the results page, transparent pricing, and phone or WhatsApp on every lead.
            @else
                New listings are added often—if you are chasing a model we have not published yet, WhatsApp us. The same team answers calls and DMs, with clear next steps.
            @endif
        </p>

        <form action="{{ route('cars.index') }}" method="GET" class="mt-4 w-full rounded-2xl border border-outline-variant/50 bg-surface-container-lowest p-4 sm:p-5 shadow-[0_8px_30px_rgba(25,28,30,0.07)] text-left space-y-3" id="home-hero-search-form">
            <div class="flex flex-col md:flex-row gap-2.5 md:gap-3 md:items-end">
                <div class="min-w-0 flex-1">
                    <label for="hero-q" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-1">Make, model, or keyword</label>
                    <input id="hero-q" name="q" type="search" placeholder="e.g. Harrier, BMW, automatic" class="w-full min-h-[44px] rounded-xl bg-surface-container-highest px-3 py-2.5 text-sm ghost-border text-on-surface focus:ring-2 focus:ring-primary/30" />
                </div>
                <button type="submit" class="w-full md:w-auto md:shrink-0 min-h-[44px] rounded-xl cta-gradient text-white font-bold px-8 focus-ring-on-dark shadow-sm inline-flex items-center justify-center">Search</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 sm:gap-3">
                <div>
                    <label for="hero-brand" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-1">Brand</label>
                    <select id="hero-brand" name="brand" class="w-full min-h-[44px] rounded-xl bg-surface-container-highest px-3 py-2.5 text-sm ghost-border text-on-surface">
                        <option value="">Any brand</option>
                        @foreach ($brandOptions as $brandOption)
                            <option value="{{ $brandOption }}">{{ $brandOption }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="hero-price" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant mb-1">Min price (TZS)</label>
                    <input id="hero-price" name="price_min" type="number" inputmode="numeric" placeholder="Optional" class="w-full min-h-[44px] rounded-xl bg-surface-container-highest px-3 py-2.5 text-sm ghost-border text-on-surface" />
                </div>
            </div>
            <div class="pt-0.5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <a href="{{ route('cars.index') }}" class="text-sm font-bold text-primary hover:underline decoration-primary/30 underline-offset-2">All filters: body, transmission, source country…</a>
            </div>
        </form>
        @if (count($homeQuickFilterChips ?? []) > 0)
            <div class="flex flex-wrap gap-2 mt-3" role="list" aria-label="Quick filters">
                @foreach (($homeQuickFilterChips ?? []) as $quickFilterChip)
                    <a href="{{ $quickFilterChip['url'] }}" role="listitem" class="inline-flex items-center rounded-full border border-primary/20 bg-surface-container-lowest px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide text-on-surface hover:border-primary/40 hover:bg-surface-container-high transition-colors">{{ $quickFilterChip['label'] }}</a>
                @endforeach
            </div>
        @endif
        <div class="mt-3 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3">
            <a href="{{ $salesWaHref }}" target="_blank" rel="noopener noreferrer" class="min-h-[44px] justify-center rounded-full border-2 border-primary/35 bg-surface-container-lowest text-on-surface text-sm font-bold px-5 inline-flex items-center gap-2 hover:border-primary/55 hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-primary text-[18px]" aria-hidden="true">chat</span> WhatsApp sales
            </a>
            <a href="{{ route('cars.index') }}" class="min-h-[44px] justify-center rounded-full bg-primary text-on-primary text-sm font-bold px-5 inline-flex items-center hover:opacity-95">Browse all stock</a>
        </div>
        <p class="mt-2">
            <button type="button" id="save-search-wa" class="text-xs sm:text-sm font-semibold text-primary underline decoration-primary/35 underline-offset-2 hover:decoration-primary">Message this search on WhatsApp</button>
        </p>
        @if (($homeAnnouncements ?? collect())->isNotEmpty())
            <div class="mt-3 pt-4 border-t border-outline-variant/20" aria-labelledby="home-offers-heading">
                <div class="rounded-2xl border border-sky-200/30 bg-surface-container-low/90 px-3 py-2.5 sm:px-4 sm:py-3 shadow-sm">
                    <div class="mb-1.5">
                        <h2 id="home-offers-heading" class="font-headline text-sm font-extrabold text-primary inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-sky-700 text-[20px]" aria-hidden="true">notifications_active</span>
                            Offers, discounts &amp; news
                        </h2>
                    </div>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2" role="list">
                        @foreach ($homeAnnouncements as $ann)
                            @php
                                $annHref = $ann->publicLinkHref();
                                $kindClass = match ($ann->kind) {
                                    \App\Models\Announcement::KIND_DISCOUNT => 'bg-emerald-100 text-emerald-900 border-emerald-200/80',
                                    \App\Models\Announcement::KIND_OFFER => 'bg-amber-100 text-amber-950 border-amber-200/80',
                                    default => 'bg-surface-container-high text-on-surface border-outline-variant/40',
                                };
                                $kindLabel = match ($ann->kind) {
                                    \App\Models\Announcement::KIND_DISCOUNT => 'Discount',
                                    \App\Models\Announcement::KIND_OFFER => 'Offer',
                                    default => 'News',
                                };
                            @endphp
                            <li class="min-w-0">
                                @if ($annHref)
                                    <a href="{{ $annHref }}" @if ($ann->link_new_tab) target="_blank" rel="noopener noreferrer" @endif class="group flex gap-2 rounded-xl border border-outline-variant/30 bg-surface-container-lowest p-2.5 hover:border-sky-300/50 transition-colors text-left h-full">
                                @else
                                    <div class="flex gap-2 rounded-xl border border-outline-variant/30 bg-surface-container-lowest p-2.5 h-full">
                                @endif
                                    <span class="shrink-0 inline-flex h-7 items-center rounded-md border px-1.5 text-[8px] font-extrabold uppercase tracking-wider {{ $kindClass }}">{{ $kindLabel }}</span>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-primary line-clamp-2">{{ $ann->title }}</p>
                                        @if ($ann->summary)
                                            <p class="text-[10px] text-on-surface-variant line-clamp-1 mt-0.5">{{ $ann->summary }}</p>
                                        @endif
                                    </div>
                                @if ($annHref)
                                    </a>
                                @else
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</section>
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-4" aria-label="Live inventory stats">
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
    <article class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 px-4 py-4 shadow-[0_10px_18px_rgba(25,28,30,0.04)]">
        <p class="text-[10px] uppercase tracking-widest text-on-surface-variant font-label">Cars in stock</p>
        <p class="font-headline text-2xl font-black text-primary mt-1">{{ number_format((int) ($totalPublishedCars ?? 0)) }}</p>
    </article>
    <article class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 px-4 py-4 shadow-[0_10px_18px_rgba(25,28,30,0.04)]">
        <p class="text-[10px] uppercase tracking-widest text-on-surface-variant font-label">Added this week</p>
        <p class="font-headline text-2xl font-black text-primary mt-1">{{ number_format((int) ($carsAddedThisWeek ?? 0)) }}</p>
    </article>
    <article class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 px-4 py-4 shadow-[0_10px_18px_rgba(25,28,30,0.04)]">
        <p class="text-[10px] uppercase tracking-widest text-on-surface-variant font-label">Ready to view in Dar</p>
        <p class="font-headline text-2xl font-black text-primary mt-1">{{ number_format((int) ($darReadyCars ?? 0)) }}</p>
    </article>
</div>
</section>
@if (($newTodayListings ?? collect())->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-8" aria-labelledby="home-new-today-heading">
    <div class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-4 sm:p-5 shadow-[0_12px_22px_rgba(25,28,30,0.05)]">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4">
            <div>
                <p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">
                    @if (!($homeNewListingsIsRecentFallback ?? false))
                        New today
                    @else
                        Latest listings
                    @endif
                </p>
                <h2 id="home-new-today-heading" class="font-headline text-xl sm:text-2xl font-extrabold text-primary">
                    @if (!($homeNewListingsIsRecentFallback ?? false))
                        Today’s fresh stock
                    @else
                        Recent arrivals
                    @endif
                </h2>
                @if (!($homeNewListingsIsRecentFallback ?? false))
                    <p class="text-xs sm:text-sm text-on-surface-variant mt-1">
                        <span class="font-semibold text-primary">{{ number_format((int) ($carsNewTodayCount ?? 0)) }}</span> added today.
                    </p>
                @endif
            </div>
            <a href="{{ route('cars.index', ['sort' => 'newest']) }}" class="text-sm font-bold text-primary underline decoration-primary/20 hover:decoration-primary shrink-0">View all by newest</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3">
            @foreach ($newTodayListings as $car)
                <div class="min-w-0">
                    <x-car-card :car="$car" :compact="true" />
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-8">
<div class="bg-surface-container-lowest rounded-2xl p-4 sm:p-5 shadow-[0_12px_22px_rgba(25,28,30,0.05)] attention-panel">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="font-headline text-xl sm:text-2xl font-extrabold text-primary tracking-tight">{{ $homeShortcutsTitle ?? 'Shop by shortcuts' }}</h2>
        <p class="text-xs sm:text-sm text-on-surface-variant">{{ $homeShortcutsSubtitle ?? 'Fast paths for high-intent buyers' }}</p>
    </div>
    <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        @foreach (($homeShortcutChips ?? []) as $shortcut)
            <a href="{{ $shortcut['url'] }}" class="rounded-2xl bg-surface-container-low px-3 py-3 ghost-border hover:bg-surface-container-high transition-colors text-center text-xs font-bold uppercase tracking-wide text-on-surface-variant">{{ $shortcut['label'] }}</a>
        @endforeach
    </div>
</div>
</section>
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-8" aria-label="Showroom highlights">
<div class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-4 sm:p-6 shadow-[0_12px_22px_rgba(25,28,30,0.05)]">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4">
        <div>
            <p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">Visual highlights</p>
            <h2 class="font-headline text-xl sm:text-2xl font-extrabold text-primary">See the Sahara buying experience</h2>
        </div>
        <a href="{{ route('order.request') }}" class="text-sm font-bold text-primary underline decoration-primary/20 hover:decoration-primary">Request a matching car</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <article class="group overflow-hidden rounded-2xl bg-surface-container-low border border-outline-variant/20">
            <div class="overflow-hidden">
                <img src="{{ asset('images/home-showroom-premium.jpg') }}" alt="Premium vehicles displayed at a clean showroom" class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async"/>
            </div>
            <div class="p-4">
                <p class="text-[10px] uppercase tracking-widest font-label text-on-surface-variant">Showroom quality</p>
                <p class="font-headline font-extrabold text-primary mt-1">Curated premium units</p>
            </div>
        </article>
        <article class="group overflow-hidden rounded-2xl bg-surface-container-low border border-outline-variant/20">
            <div class="overflow-hidden">
                <img src="{{ asset('images/home-driving-road.jpg') }}" alt="SUV driving on open road for Tanzania-ready mobility" class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async"/>
            </div>
            <div class="p-4">
                <p class="text-[10px] uppercase tracking-widest font-label text-on-surface-variant">Road confidence</p>
                <p class="font-headline font-extrabold text-primary mt-1">Built for daily + long routes</p>
            </div>
        </article>
        <article class="group overflow-hidden rounded-2xl bg-surface-container-low border border-outline-variant/20">
            <div class="overflow-hidden">
                <img src="{{ asset('images/home-inspection-detail.jpg') }}" alt="Close-up car detail representing inspected condition" class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async"/>
            </div>
            <div class="p-4">
                <p class="text-[10px] uppercase tracking-widest font-label text-on-surface-variant">Condition clarity</p>
                <p class="font-headline font-extrabold text-primary mt-1">Visual inspection focus</p>
            </div>
        </article>
    </div>
</div>
</section>
@php
    $featuredCollection = collect($featuredCars ?? []);
    $newArrivals = $featuredCollection->take(3);
    $editorPicks = $featuredCollection->slice(3, 3);
    $valuePicks = $featuredCollection->sortBy('price_tzs')->take(3);
@endphp
<!-- Content: Featured Cars Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 section-editorial section-wash-soft rounded-[1.25rem] sm:rounded-[2rem]" aria-labelledby="home-featured-cars-heading">
<div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-end mb-8">
<div class="space-y-2 min-w-0">
<span class="text-secondary font-bold text-sm uppercase tracking-[0.2em]">Showroom Preview</span>
<h2 id="home-featured-cars-heading" class="font-headline text-2xl sm:text-4xl font-black text-primary leading-tight">Featured Cars</h2>
</div>
<a class="inline-flex sm:ml-auto items-center justify-center gap-2 text-primary font-bold underline decoration-primary/20 hover:decoration-primary transition-all py-2 min-h-[44px] touch-manipulation shrink-0 rounded-md" href="{{ route('cars.index') }}">
                View All Inventory
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
</a>
</div>
<div class="flex flex-wrap gap-2 mb-8" role="tablist" aria-label="Inventory highlights">
<button type="button" role="tab" id="home-tab-new-arrivals" class="home-tab bg-primary text-on-primary px-4 py-2 rounded-full text-xs font-bold min-h-[44px]" data-target="new-arrivals" aria-selected="true" aria-controls="home-panel-new-arrivals">New Arrivals</button>
<button type="button" role="tab" id="home-tab-editor-picks" class="home-tab bg-surface-container-low text-on-surface px-4 py-2 rounded-full text-xs font-bold ghost-border min-h-[44px]" data-target="editor-picks" aria-selected="false" aria-controls="home-panel-editor-picks">Editor Picks</button>
<button type="button" role="tab" id="home-tab-value-picks" class="home-tab bg-surface-container-low text-on-surface px-4 py-2 rounded-full text-xs font-bold ghost-border min-h-[44px]" data-target="value-picks" aria-selected="false" aria-controls="home-panel-value-picks">Value Picks</button>
</div>
<div id="home-panel-new-arrivals" role="tabpanel" aria-labelledby="home-tab-new-arrivals" class="home-tab-panel grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4" data-panel="new-arrivals">
@forelse ($newArrivals as $car)
    <x-car-card :car="$car" :compact="true" />
@empty
    <div class="col-span-full bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline font-black text-2xl text-primary">No cars yet</div>
        <p class="text-on-surface-variant mt-2">Car highlights will appear here as soon as new cars are added.</p>
    </div>
@endforelse
</div>
<div id="home-panel-editor-picks" role="tabpanel" aria-labelledby="home-tab-editor-picks" class="home-tab-panel hidden grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4" data-panel="editor-picks">
@forelse ($editorPicks as $car)
    <x-car-card :car="$car" :compact="true" />
@empty
    <div class="col-span-full bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline font-black text-2xl text-primary">More picks coming soon</div>
        <p class="text-on-surface-variant mt-2">Our team is curating fresh editor recommendations.</p>
    </div>
@endforelse
</div>
<div id="home-panel-value-picks" role="tabpanel" aria-labelledby="home-tab-value-picks" class="home-tab-panel hidden grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4" data-panel="value-picks">
@forelse ($valuePicks as $car)
    <x-car-card :car="$car" :compact="true" />
@empty
    <div class="col-span-full bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline font-black text-2xl text-primary">No value picks yet</div>
        <p class="text-on-surface-variant mt-2">We will surface budget-friendly recommendations here.</p>
    </div>
@endforelse
</div>
</section>
@if (!empty($homeBrands ?? []))
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-8" aria-labelledby="home-brands-heading">
<div class="bg-surface-container-lowest rounded-2xl p-4 sm:p-5 shadow-[0_12px_22px_rgba(25,28,30,0.05)] attention-panel">
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
<h2 id="home-brands-heading" class="font-headline text-xl sm:text-2xl font-extrabold text-primary tracking-tight">Most searched brands</h2>
<p class="text-xs sm:text-sm text-on-surface-variant">Tap a brand to view matching cars</p>
</div>
<div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
@foreach (($homeBrands ?? []) as $brand)
<a
href="{{ route('cars.index', ['brand' => $brand['name']]) }}"
class="group rounded-2xl bg-surface-container-low px-3 py-3 ghost-border hover:bg-surface-container-high transition-colors flex flex-col items-center justify-center text-center min-h-[92px]"
aria-label="View {{ $brand['name'] }} cars"
>
<img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }} logo" class="h-8 w-auto object-contain mb-2" loading="lazy" decoding="async" />
<span class="text-[11px] font-label font-semibold uppercase tracking-wide text-on-surface-variant group-hover:text-primary">
{{ $brand['name'] }}
</span>
</a>
@endforeach
</div>
</div>
</section>
@endif
<x-partner-logos-slider
    title="Trusted Companies in Our Network"
    subtitle="Working with banking, insurance, logistics, and compliance partners so your purchase stays transparent and on track from quote to keys in Tanzania."
/>
<section class="section-editorial px-4 sm:px-6 section-wash-soft">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
<div class="bg-surface-container-low rounded-2xl p-6 graphic-panel">
<span class="material-symbols-outlined text-primary">directions_car</span>
<p class="font-headline text-4xl font-extrabold text-primary">500+</p>
<p class="text-on-surface-variant text-sm mt-2">Buyers matched across Tanzania</p>
</div>
<div class="bg-surface-container-low rounded-2xl p-6 graphic-panel">
<span class="material-symbols-outlined text-primary">sentiment_satisfied</span>
<p class="font-headline text-4xl font-extrabold text-primary">98%</p>
<p class="text-on-surface-variant text-sm mt-2">Customer satisfaction score</p>
</div>
<div class="bg-surface-container-low rounded-2xl p-6 graphic-panel">
<span class="material-symbols-outlined text-primary">support_agent</span>
<p class="font-headline text-4xl font-extrabold text-primary">24/7</p>
<p class="text-on-surface-variant text-sm mt-2">WhatsApp support for Tanzania buyers</p>
</div>
</div>
<div class="bg-surface-container-lowest rounded-3xl p-8 md:p-12 shadow-[0_20px_32px_rgba(92,67,32,0.1)]">
<div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
<div>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">Client Voices</p>
<h3 class="font-headline text-3xl font-extrabold text-primary mt-2">Trusted by buyers across Tanzania</h3>
</div>
<div class="inline-flex items-center gap-2 bg-surface-container-low rounded-full px-4 py-2 ghost-border">
<span class="material-symbols-outlined text-secondary text-[18px]">star</span>
<span class="text-xs font-bold text-primary">4.9/5 average satisfaction</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-7">
<article class="bg-surface-container-low rounded-2xl p-6 shadow-[0_12px_20px_rgba(25,28,30,0.04)]">
<div class="flex items-center gap-1 text-secondary mb-3" aria-label="5 out of 5 stars">
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
</div>
<p class="text-sm text-on-surface-variant leading-relaxed">
“I was torn between two SUVs for mixed Dar and upcountry use. The team explained inspection notes and paperwork in plain language—no pressure—and I signed within the week feeling sure.”
</p>
<div class="flex items-center gap-3 mt-4">
<div class="h-10 w-10 rounded-full bg-primary-container text-white flex items-center justify-center text-xs font-black">AS</div>
<div>
<p class="text-sm font-bold text-primary">Asha S.</p>
<p class="text-xs text-on-surface-variant">Buyer, Dar es Salaam</p>
</div>
</div>
</article>
<article class="bg-surface-container-low rounded-2xl p-6 shadow-[0_12px_20px_rgba(25,28,30,0.04)]">
<div class="flex items-center gap-1 text-secondary mb-3" aria-label="5 out of 5 stars">
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
</div>
<p class="text-sm text-on-surface-variant leading-relaxed">
“Replies came quickly on WhatsApp, pricing was upfront in TZS, and the finance options actually made sense for my budget. It felt like a proper showroom process, not a roadside gamble.”
</p>
<div class="flex items-center gap-3 mt-4">
<div class="h-10 w-10 rounded-full bg-primary-container text-white flex items-center justify-center text-xs font-black">JM</div>
<div>
<p class="text-sm font-bold text-primary">James M.</p>
<p class="text-xs text-on-surface-variant">Buyer, Arusha</p>
</div>
</div>
</article>
</div>
<div class="mt-8 flex flex-col sm:flex-row gap-3">
<a href="{{ route('cars.index') }}" class="cta-gradient text-white rounded-full px-7 py-3 min-h-[48px] font-bold text-sm text-center inline-flex items-center justify-center focus-ring-on-dark">Explore Inventory</a>
<a href="{{ $salesWaHref }}" target="_blank" rel="noopener noreferrer" class="bg-surface-container-low rounded-full px-7 py-3 min-h-[48px] font-bold text-sm text-primary text-center ghost-border inline-flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[18px]" aria-hidden="true">chat</span> Chat on WhatsApp
</a>
</div>
</div>
</div>
</section>
</main>
<x-mobile-nav active="home" />
<x-whatsapp-float />
<x-footer />
<script>
(() => {
    const saveSearchBtn = document.getElementById('save-search-wa');
    const homeSearchForm = document.getElementById('home-hero-search-form');
    if (saveSearchBtn && homeSearchForm) {
        saveSearchBtn.addEventListener('click', () => {
            const formData = new FormData(homeSearchForm);
            const params = new URLSearchParams();
            const summary = [];

            for (const [key, rawValue] of formData.entries()) {
                const value = String(rawValue).trim();
                if (value === '') continue;
                params.set(key, value);
                summary.push(`${key}: ${value}`);
            }

            const inventoryUrl = `{{ route('cars.index') }}${params.toString() ? `?${params.toString()}` : ''}`;
            const message = [
                'Hi Sahara Cars team, please save this search for me and notify me on matching units.',
                '',
                summary.length ? `Filters: ${summary.join(', ')}` : 'Filters: none specified (general inventory)',
                `Link: ${inventoryUrl}`,
            ].join('\n');

            const waUrl = `https://wa.me/{{ $salesDigits }}?text=${encodeURIComponent(message)}`;
            window.open(waUrl, '_blank', 'noopener,noreferrer');
        });
    }
})();

(() => {
    const tabs = Array.from(document.querySelectorAll('.home-tab'));
    const panels = Array.from(document.querySelectorAll('.home-tab-panel'));
    if (!tabs.length || !panels.length) return;

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.target;
            tabs.forEach((t) => {
                const selected = t === tab;
                t.setAttribute('aria-selected', selected ? 'true' : 'false');
                t.classList.toggle('bg-primary', selected);
                t.classList.toggle('text-on-primary', selected);
                t.classList.toggle('bg-surface-container-low', !selected);
                t.classList.toggle('text-on-surface', !selected);
            });
            panels.forEach((panel) => panel.classList.toggle('hidden', panel.dataset.panel !== target));
        });
    });
})();
</script>
</body></html>
