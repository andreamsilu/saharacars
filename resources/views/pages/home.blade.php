<!DOCTYPE html>

<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<x-public-seo
    :title="__('public.meta.home_title', ['company' => config('sahara.legal_entity_name')])"
    :description="__('public.meta.home_description', ['company' => config('sahara.legal_entity_name')])"
    :canonical="route('home', ['locale' => app()->getLocale()])"
/>
<x-public-head-assets />
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
<script src="https://cdn.tailwindcss.com"></script>
<style>
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
      #home-hero-search-form input,
      #home-hero-search-form select {
        color-scheme: dark;
      }
      #home-hero-search-form input:-webkit-autofill,
      #home-hero-search-form input:-webkit-autofill:hover,
      #home-hero-search-form input:-webkit-autofill:focus {
        -webkit-text-fill-color: #ffffff;
        caret-color: #ffffff;
        transition: background-color 9999s ease-out 0s;
        box-shadow: 0 0 0 1000px rgba(255, 255, 255, 0.1) inset;
      }
    </style>

</head>
<body class="bg-surface font-body text-on-surface antialiased overflow-x-hidden attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<!-- TopNavBar -->
<x-navbar />
@php
    $salesDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
    $salesTelHref = 'tel:+' . $salesDigits;
    $salesWaMessage = __('public.home.sales_wa_message');
    $salesWaHref = 'https://wa.me/' . $salesDigits . '?text=' . rawurlencode($salesWaMessage);
@endphp
<main id="main-content" tabindex="-1" class="outline-none">
@if (($newTodayListings ?? collect())->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-4" aria-labelledby="home-new-today-heading">
    <div class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-4 sm:p-5 shadow-[0_12px_22px_rgba(25,28,30,0.05)]">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4 text-center sm:text-left">
            <div>
                <p class="font-label text-editorial-kicker text-on-surface-variant">
                    @if (!($homeNewListingsIsRecentFallback ?? false))
                        {{ __('public.home.new_today') }}
                    @else
                        {{ __('public.home.latest_listings') }}
                    @endif
                </p>
                <h2 id="home-new-today-heading" class="font-headline text-editorial-section-title font-extrabold text-primary tracking-tight leading-tight">
                    @if (!($homeNewListingsIsRecentFallback ?? false))
                        {{ __('public.home.fresh_stock') }}
                    @else
                        {{ __('public.home.recent_arrivals') }}
                    @endif
                </h2>
                @if (!($homeNewListingsIsRecentFallback ?? false))
                    <p class="text-on-surface-variant text-editorial-body mt-1">
                        <span class="font-semibold text-primary">{{ number_format((int) ($carsNewTodayCount ?? 0)) }}</span>{{ __('public.home.added_today_suffix') }}
                    </p>
                @endif
            </div>
            <a href="{{ route('cars.index', ['sort' => 'newest']) }}" class="text-sm font-bold text-primary underline decoration-primary/20 hover:decoration-primary shrink-0">{{ __('public.home.view_all_newest') }}</a>
        </div>
        <div class="sahara-stagger-children grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3">
            @foreach ($newTodayListings as $car)
                <div class="min-w-0">
                    <x-car-card :car="$car" :compact="true" />
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
{{-- Search-first: compact strip (no full-bleed video), inventory hook + form --}}
@php
    $heroInventoryCount = (int) ($totalPublishedCars ?? 0);
@endphp
<section class="relative bg-slate-950 border-b border-white/10 overflow-hidden" aria-label="{{ __('public.home.hero_search_aria') }}">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <picture>
            <source
                type="image/webp"
                srcset="{{ asset('images/login-bg-hero-1280.webp') }} 1280w, {{ asset('images/login-bg-hero-1920.webp') }} 1920w"
                sizes="100vw"
            />
            <img
                src="{{ asset('images/login-bg-hero-1280.jpg') }}"
                alt=""
                class="w-full h-full object-cover grayscale opacity-45"
                loading="eager"
                fetchpriority="high"
                decoding="async"
            />
        </picture>
        <div class="absolute inset-0 bg-slate-950/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-6 pt-8 sm:pt-10 md:pt-12 pb-4 sm:pb-5 text-center text-white">
        <div class="max-w-3xl mx-auto mb-4 sm:mb-5 text-white">
            <p class="text-sm text-white/80">{{ config('sahara.legal_entity_name') }}</p>
            <h1 class="mt-2 font-headline text-editorial-hero font-black uppercase tracking-wide text-white">
                {{ __('public.home.hero_title') }}
            </h1>
            <p class="mt-2 text-editorial-body text-white/95">{{ __('public.home.hero_subtitle') }}</p>
        </div>
        <form action="{{ route('cars.index') }}" method="GET" class="sahara-live-panel home-hero-search mt-1 mx-auto w-full rounded-2xl border border-white/20 bg-white/10 p-4 sm:p-5 shadow-[0_8px_32px_rgba(0,0,0,0.25)] backdrop-blur-md text-left text-white [color-scheme:dark]" id="home-hero-search-form">
            @if ($heroInventoryCount > 0)
                <p class="mb-3 text-sm sm:text-base text-white/90">
                    <span class="font-headline font-extrabold text-white tabular-nums text-lg sm:text-xl text-[clamp(1.25rem,2.2vw,1.75rem)]">{{ number_format($heroInventoryCount) }}</span>
                    <span class="text-white/85"> {{ __('public.home.cars_in_stock') }}</span>
                </p>
            @else
                <p class="text-sm text-white/85 mb-3">{{ __('public.home.no_stock_message') }}</p>
            @endif
            {{-- Mobile: column; sm–lg: 2×2; lg+: 12-col row uses full 7xl width --}}
            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2 sm:items-end sm:gap-3 lg:grid-cols-12 lg:gap-4">
                <div class="min-w-0 sm:col-span-1 lg:col-span-5">
                    <label for="hero-q" class="block font-label text-editorial-kicker text-white/80 mb-1">{{ __('public.home.label_keyword') }}</label>
                    <input id="hero-q" name="q" type="search" placeholder="{{ __('public.home.placeholder_keyword') }}" class="w-full min-h-[44px] rounded-xl border border-white/25 bg-white/10 px-3 py-2.5 text-sm text-white placeholder:text-white/45 ghost-border" />
                </div>
                <button type="submit" class="sahara-live-cta sahara-pulse-subtle w-full min-h-[44px] sm:col-span-1 sm:w-full rounded-xl cta-gradient text-white font-bold px-6 sm:px-4 lg:px-5 lg:col-span-2 focus-ring-on-dark shadow-sm inline-flex items-center justify-center">{{ __('public.common.search') }}</button>
                <div class="sm:col-span-1 lg:col-span-3">
                    <label for="hero-brand" class="block font-label text-editorial-kicker text-white/80 mb-1">{{ __('public.home.label_brand') }}</label>
                    <select id="hero-brand" name="brand" class="w-full min-h-[44px] rounded-xl border border-white/25 bg-white/10 px-3 py-2.5 text-sm text-white ghost-border [&_option]:bg-slate-900 [&_option]:text-white">
                        <option value="">{{ __('public.home.any_brand') }}</option>
                        @foreach ($brandOptions as $brandOption)
                            <option value="{{ $brandOption }}">{{ $brandOption }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-1 lg:col-span-2">
                    <label for="hero-price" class="block font-label text-editorial-kicker text-white/80 mb-1">{{ __('public.home.label_price_min') }}</label>
                    <input id="hero-price" name="price_min" type="number" inputmode="numeric" placeholder="{{ __('public.common.optional') }}" class="w-full min-h-[44px] rounded-xl border border-white/25 bg-white/10 px-3 py-2.5 text-sm text-white placeholder:text-white/45 ghost-border" />
                </div>
            </div>
            <div class="pt-2.5 mt-1 border-t border-white/15 text-center">
                <a href="{{ route('cars.index') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-white/35 bg-white/10 px-3 py-2 text-sm font-bold text-white hover:bg-white/15 transition-colors"><span class="material-symbols-outlined text-[16px] text-white" aria-hidden="true">tune</span> {{ __('public.home.all_filters_link') }}</a>
            </div>
        </form>
        @if (count($homeQuickFilterChips ?? []) > 0)
            <div class="flex flex-wrap justify-center gap-2 mt-4" role="list" aria-label="{{ __('public.home.quick_filters_aria') }}">
                @foreach (($homeQuickFilterChips ?? []) as $quickFilterChip)
                    <a href="{{ $quickFilterChip['url'] }}" role="listitem" class="inline-flex items-center rounded-full border border-white/25 bg-white/10 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide text-white hover:border-white/40 hover:bg-white/15 transition-colors">{{ $quickFilterChip['label'] }}</a>
                @endforeach
            </div>
        @endif
        <div class="mt-4 flex flex-col sm:flex-row items-stretch sm:items-center sm:justify-center gap-2.5 sm:gap-3">
            <a href="{{ $salesWaHref }}" target="_blank" rel="noopener noreferrer" class="sahara-live-cta min-h-[44px] justify-center rounded-full border-2 border-white/40 bg-transparent text-white text-sm font-bold px-5 inline-flex items-center gap-2 hover:border-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-white text-[18px]" aria-hidden="true">chat</span> {{ __('public.home.whatsapp_us') }}
            </a>
            <a href="{{ route('cars.index') }}" class="sahara-live-cta min-h-[44px] justify-center rounded-full border-2 border-white/50 bg-white/10 text-white text-sm font-bold px-5 inline-flex items-center hover:border-white hover:bg-white/15 transition-colors">{{ __('public.home.browse_all_stock') }}</a>
        </div>
        @if (($homeAnnouncements ?? collect())->isNotEmpty())
            <div class="mt-3 pt-4 border-t border-white/15 text-left text-white" aria-labelledby="home-offers-heading">
                <div class="rounded-2xl border border-white/20 bg-white/10 px-3 py-2.5 sm:px-4 sm:py-3 shadow-sm backdrop-blur-md">
                    <div class="mb-1.5 text-center">
                        <h2 id="home-offers-heading" class="font-headline text-sm font-extrabold text-white inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-white text-[20px]" aria-hidden="true">notifications_active</span>
                            {{ __('public.home.offers_heading') }}
                        </h2>
                    </div>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2" role="list">
                        @foreach ($homeAnnouncements as $ann)
                            @php
                                $annHref = $ann->publicLinkHref();
                                $kindClass = match ($ann->kind) {
                                    \App\Models\Announcement::KIND_DISCOUNT => 'bg-emerald-500/25 text-emerald-100 border-emerald-400/40',
                                    \App\Models\Announcement::KIND_OFFER => 'bg-amber-500/25 text-amber-100 border-amber-400/40',
                                    default => 'bg-white/15 text-white border-white/25',
                                };
                                $kindLabel = match ($ann->kind) {
                                    \App\Models\Announcement::KIND_DISCOUNT => __('public.home.announcement_discount'),
                                    \App\Models\Announcement::KIND_OFFER => __('public.home.announcement_offer'),
                                    default => __('public.home.announcement_news'),
                                };
                            @endphp
                            <li class="min-w-0">
                                @if ($annHref)
                                    <a href="{{ $annHref }}" @if ($ann->link_new_tab) target="_blank" rel="noopener noreferrer" @endif class="group flex gap-2 rounded-xl border border-white/20 bg-white/10 p-2.5 hover:border-white/40 hover:bg-white/15 transition-colors text-left h-full">
                                @else
                                    <div class="flex gap-2 rounded-xl border border-white/20 bg-white/10 p-2.5 h-full">
                                @endif
                                    <span class="shrink-0 inline-flex h-7 items-center rounded-md border px-1.5 text-[8px] font-extrabold uppercase tracking-wider {{ $kindClass }}">{{ $kindLabel }}</span>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-white line-clamp-2">{{ $ann->title }}</p>
                                        @if ($ann->summary)
                                            <p class="text-[10px] text-white/75 line-clamp-1 mt-0.5">{{ $ann->summary }}</p>
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
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-4" aria-label="{{ __('public.home.live_stats_aria') }}">
<div class="grid grid-cols-3 gap-2 sm:gap-3">
    <article class="rounded-xl sm:rounded-2xl bg-surface-container-lowest border border-outline-variant/30 px-2.5 py-3 sm:px-4 sm:py-4 shadow-[0_10px_18px_rgba(25,28,30,0.04)] text-center">
        <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.stats_cars_in_stock') }}</p>
        <p class="font-headline text-lg sm:text-2xl font-black text-primary mt-1">{{ number_format((int) ($totalPublishedCars ?? 0)) }}</p>
    </article>
    <article class="rounded-xl sm:rounded-2xl bg-surface-container-lowest border border-outline-variant/30 px-2.5 py-3 sm:px-4 sm:py-4 shadow-[0_10px_18px_rgba(25,28,30,0.04)] text-center">
        <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.stats_added_week') }}</p>
        <p class="font-headline text-lg sm:text-2xl font-black text-primary mt-1">{{ number_format((int) ($carsAddedThisWeek ?? 0)) }}</p>
    </article>
    <article class="rounded-xl sm:rounded-2xl bg-surface-container-lowest border border-outline-variant/30 px-2.5 py-3 sm:px-4 sm:py-4 shadow-[0_10px_18px_rgba(25,28,30,0.04)] text-center">
        <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.stats_ready_dar') }}</p>
        <p class="font-headline text-lg sm:text-2xl font-black text-primary mt-1">{{ number_format((int) ($darReadyCars ?? 0)) }}</p>
    </article>
</div>
</section>
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-8">
<div class="bg-surface-container-lowest rounded-2xl p-4 sm:p-5 shadow-[0_12px_22px_rgba(25,28,30,0.05)] attention-panel">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-center sm:text-left">
        <h2 class="font-headline text-editorial-section-title font-extrabold text-primary tracking-tight leading-tight">{{ $homeShortcutsTitle ?? __('public.home.shortcuts_title_fallback') }}</h2>
        <p class="text-on-surface-variant text-editorial-body">{{ $homeShortcutsSubtitle ?? __('public.home.shortcuts_subtitle_fallback') }}</p>
    </div>
    <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        @foreach (($homeShortcutChips ?? []) as $shortcut)
            <a href="{{ $shortcut['url'] }}" class="rounded-2xl bg-surface-container-low px-3 py-3 ghost-border hover:bg-surface-container-high transition-colors text-center text-xs font-bold uppercase tracking-wide text-on-surface-variant">{{ $shortcut['label'] }}</a>
        @endforeach
    </div>
</div>
</section>
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-8" aria-label="{{ __('public.home.highlights_aria') }}">
<div class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-4 sm:p-6 shadow-[0_12px_22px_rgba(25,28,30,0.05)]">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-4 text-center sm:text-left">
        <div>
            <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.visual_highlights') }}</p>
            <h2 class="font-headline text-editorial-section-title font-extrabold text-primary tracking-tight leading-tight">{{ __('public.home.buying_experience') }}</h2>
        </div>
        <a href="{{ route('order.request') }}" class="text-sm font-bold text-primary underline decoration-primary/20 hover:decoration-primary">{{ __('public.home.request_matching') }}</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <article class="group overflow-hidden rounded-2xl bg-surface-container-low border border-outline-variant/20">
            <div class="overflow-hidden">
                <picture>
                    <source
                        type="image/webp"
                        srcset="{{ asset('images/home-showroom-premium-640.webp') }} 640w, {{ asset('images/home-showroom-premium-960.webp') }} 960w"
                        sizes="(min-width: 768px) 33vw, 100vw"
                    />
                    <img src="{{ asset('images/home-showroom-premium-960.jpg') }}" alt="{{ __('public.home.img_premium_alt') }}" class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async"/>
                </picture>
            </div>
            <div class="p-4">
                <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.panel_showroom_quality') }}</p>
                <p class="font-headline font-extrabold text-primary mt-1">{{ __('public.home.panel_curated') }}</p>
            </div>
        </article>
        <article class="group overflow-hidden rounded-2xl bg-surface-container-low border border-outline-variant/20">
            <div class="overflow-hidden">
                <picture>
                    <source
                        type="image/webp"
                        srcset="{{ asset('images/home-driving-road-640.webp') }} 640w, {{ asset('images/home-driving-road-960.webp') }} 960w"
                        sizes="(min-width: 768px) 33vw, 100vw"
                    />
                    <img src="{{ asset('images/home-driving-road-960.jpg') }}" alt="{{ __('public.home.img_road_alt') }}" class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async"/>
                </picture>
            </div>
            <div class="p-4">
                <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.panel_road') }}</p>
                <p class="font-headline font-extrabold text-primary mt-1">{{ __('public.home.panel_routes') }}</p>
            </div>
        </article>
        <article class="group overflow-hidden rounded-2xl bg-surface-container-low border border-outline-variant/20">
            <div class="overflow-hidden">
                <picture>
                    <source
                        type="image/webp"
                        srcset="{{ asset('images/home-inspection-detail-640.webp') }} 640w, {{ asset('images/home-inspection-detail-960.webp') }} 960w"
                        sizes="(min-width: 768px) 33vw, 100vw"
                    />
                    <img src="{{ asset('images/home-inspection-detail-960.jpg') }}" alt="{{ __('public.home.img_inspection_alt') }}" class="h-44 w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async"/>
                </picture>
            </div>
            <div class="p-4">
                <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.panel_condition') }}</p>
                <p class="font-headline font-extrabold text-primary mt-1">{{ __('public.home.panel_inspection') }}</p>
            </div>
        </article>
    </div>
</div>
</section>
@php
    $featuredCollection = collect($featuredCars ?? []);
    $featuredList = $featuredCollection->take(10);
@endphp
<!-- Content: Featured Cars Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 section-editorial section-wash-soft rounded-[1.25rem] sm:rounded-[2rem]" aria-labelledby="home-featured-cars-heading">
<div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-end mb-8">
<div class="space-y-2 min-w-0 text-center sm:text-left">
<span class="font-label text-editorial-kicker text-secondary">{{ __('public.home.featured_kicker') }}</span>
<h2 id="home-featured-cars-heading" class="font-headline text-editorial-section-title font-black text-primary tracking-tight leading-tight">{{ __('public.home.featured_title') }}</h2>
</div>
<a class="inline-flex sm:ml-auto items-center justify-center gap-2 text-primary font-bold underline decoration-primary/20 hover:decoration-primary transition-all py-2 min-h-[44px] touch-manipulation shrink-0 rounded-md" href="{{ route('cars.index') }}">
                {{ __('public.home.view_all_inventory') }}
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
</a>
</div>
<div class="sahara-stagger-children grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4">
@forelse ($featuredList as $car)
    <x-car-card :car="$car" :compact="true" />
@empty
    <div class="col-span-full bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline text-editorial-section-title font-black text-primary tracking-tight leading-tight">{{ __('public.home.no_cars_title') }}</div>
        <p class="text-on-surface-variant text-editorial-body mt-2">{{ __('public.home.no_cars_body') }}</p>
    </div>
@endforelse
</div>
</section>
@if (!empty($homeBrands ?? []))
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-8" aria-labelledby="home-brands-heading">
<div class="bg-surface-container-lowest rounded-2xl p-4 sm:p-5 shadow-[0_12px_22px_rgba(25,28,30,0.05)] attention-panel">
<div class="text-center sm:text-left">
<h2 id="home-brands-heading" class="font-headline text-editorial-section-title font-extrabold text-primary tracking-tight leading-tight">{{ __('public.home.brands_title') }}</h2>
</div>
<div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
@foreach (($homeBrands ?? []) as $brand)
<a
href="{{ route('cars.index', ['brand' => $brand['name']]) }}"
class="group rounded-2xl bg-surface-container-low px-3 py-3 ghost-border hover:bg-surface-container-high transition-colors flex flex-col items-center justify-center text-center min-h-[92px]"
aria-label="{{ __('public.home.brand_aria', ['brand' => $brand['name']]) }}"
>
@if (!empty($brand['logo']))
<img src="{{ $brand['logo'] }}" alt="{{ __('public.home.brand_logo_alt', ['brand' => $brand['name']]) }}" class="h-8 w-auto object-contain mb-2" width="128" height="32" loading="lazy" decoding="async" />
@else
<span class="mb-2 inline-flex h-8 min-w-[2.5rem] items-center justify-center rounded-full bg-primary/10 px-2 text-[11px] font-extrabold uppercase tracking-wide text-primary">
{{ \Illuminate\Support\Str::limit((string) $brand['name'], 3, '') }}
</span>
@endif
<span class="text-[11px] font-label font-semibold tracking-wide text-on-surface-variant group-hover:text-primary">
{{ $brand['name'] }}
</span>
</a>
@endforeach
</div>
</div>
</section>
@endif
<section class="section-editorial px-4 sm:px-6 section-wash-soft">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
<div class="bg-surface-container-low rounded-2xl p-6 graphic-panel">
<span class="material-symbols-outlined text-primary">directions_car</span>
<p class="font-headline text-4xl font-extrabold text-primary">500+</p>
<p class="text-on-surface-variant text-editorial-body mt-2">{{ __('public.home.stat_buyers') }}</p>
</div>
<div class="bg-surface-container-low rounded-2xl p-6 graphic-panel">
<span class="material-symbols-outlined text-primary">sentiment_satisfied</span>
<p class="font-headline text-4xl font-extrabold text-primary">98%</p>
<p class="text-on-surface-variant text-editorial-body mt-2">{{ __('public.home.stat_satisfaction') }}</p>
</div>
<div class="bg-surface-container-low rounded-2xl p-6 graphic-panel">
<span class="material-symbols-outlined text-primary">support_agent</span>
<p class="font-headline text-4xl font-extrabold text-primary">24/7</p>
<p class="text-on-surface-variant text-editorial-body mt-2">{{ __('public.home.stat_support') }}</p>
</div>
</div>
<div class="bg-surface-container-lowest rounded-3xl p-8 md:p-12 shadow-[0_20px_32px_rgba(92,67,32,0.1)]">
<div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 text-center md:text-left">
<div>
<p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.testimonials_kicker') }}</p>
<h3 class="font-headline text-editorial-section-title font-extrabold text-primary tracking-tight leading-tight mt-2">{{ __('public.home.testimonials_title') }}</h3>
</div>
<div class="inline-flex items-center gap-2 bg-surface-container-low rounded-full px-4 py-2 ghost-border">
<span class="material-symbols-outlined text-secondary text-[18px]">star</span>
<span class="text-xs font-bold text-primary">{{ __('public.home.testimonials_rating') }}</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-7">
<article class="bg-surface-container-low rounded-2xl p-6 shadow-[0_12px_20px_rgba(25,28,30,0.04)]">
<div class="flex items-center gap-1 text-secondary mb-3" aria-label="{{ __('public.home.stars_aria') }}">
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
</div>
<p class="text-on-surface-variant text-editorial-body">
{{ __('public.home.testimonial_1') }}
</p>
<div class="flex items-center gap-3 mt-4">
<div class="h-10 w-10 rounded-full bg-primary-container text-white flex items-center justify-center text-xs font-black">AS</div>
<div>
<p class="text-sm font-bold text-primary">{{ __('public.home.buyer_asha') }}</p>
<p class="text-xs text-on-surface-variant">{{ __('public.home.buyer_dar') }}</p>
</div>
</div>
</article>
<article class="bg-surface-container-low rounded-2xl p-6 shadow-[0_12px_20px_rgba(25,28,30,0.04)]">
<div class="flex items-center gap-1 text-secondary mb-3" aria-label="{{ __('public.home.stars_aria') }}">
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
<span class="material-symbols-outlined text-[18px]">star</span>
</div>
<p class="text-on-surface-variant text-editorial-body">
{{ __('public.home.testimonial_2') }}
</p>
<div class="flex items-center gap-3 mt-4">
<div class="h-10 w-10 rounded-full bg-primary-container text-white flex items-center justify-center text-xs font-black">JM</div>
<div>
<p class="text-sm font-bold text-primary">{{ __('public.home.buyer_james') }}</p>
<p class="text-xs text-on-surface-variant">{{ __('public.home.buyer_arusha') }}</p>
</div>
</div>
</article>
</div>
<div class="mt-8 flex flex-col sm:flex-row gap-3">
<a href="{{ route('cars.index') }}" class="cta-gradient text-white rounded-full px-7 py-3 min-h-[48px] font-bold text-sm text-center inline-flex items-center justify-center focus-ring-on-dark">{{ __('public.home.explore_inventory') }}</a>
<a href="{{ $salesWaHref }}" target="_blank" rel="noopener noreferrer" class="bg-surface-container-low rounded-full px-7 py-3 min-h-[48px] font-bold text-sm text-primary text-center ghost-border inline-flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[18px]" aria-hidden="true">chat</span> {{ __('site.cta.chat_whatsapp') }}
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
            const filtersLineTpl = @json(__('public.home.wa_save_search_filters'));
            const filtersNone = @json(__('public.home.wa_save_search_filters_none'));
            const linkLineTpl = @json(__('public.home.wa_save_search_link'));
            const message = [
                @json(__('public.home.wa_save_search_line1')),
                '',
                summary.length ? filtersLineTpl.replace(':summary', summary.join(', ')) : filtersNone,
                linkLineTpl.replace(':url', inventoryUrl),
            ].join('\n');

            const waUrl = `https://wa.me/{{ $salesDigits }}?text=${encodeURIComponent(message)}`;
            window.open(waUrl, '_blank', 'noopener,noreferrer');
        });
    }
})();

</script>
</body></html>
