<!DOCTYPE html>

<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
@php
    $legal = config('sahara.legal_entity_name', config('app.name'));
    $homeSeoTitle = $legal.' | '.__('site.nav.home');
    $homeSeoDesc = trim((string) config('sahara.brand_tagline', '')) ?: (number_format($totalPublishedCars).' curated vehicles across Dar & beyond.');
@endphp
<x-public-seo
    :title="$homeSeoTitle"
    :description="$homeSeoDesc"
    :canonical="route('home', ['locale' => app()->getLocale()])"
/>
<script src="https://cdn.tailwindcss.com" defer></script>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/></noscript>
<link rel="preload" as="style" href="{{ asset('css/material-symbols-outlined.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/material-symbols-outlined.css') }}" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="{{ asset('css/material-symbols-outlined.css') }}"/></noscript>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#8a6528",
              "on-surface": "#191c1e",
              "on-surface-variant": "#43474f",
              "surface": "#f3f3f3",
              "surface-container-low": "#f2f4f6",
              "surface-container-lowest": "#ffffff",
              "surface-container-high": "#e6e8ea",
              "secondary": "#006d2f",
              "secondary-container": "#5dfd8a",
              "on-secondary-container": "#007232",
              "outline-variant": "#c3c6d1",
              "background": "#f3f3f3",
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
<body class="bg-surface font-body text-on-surface attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<x-brand-ticker />
<x-navbar />

<main id="main-content" tabindex="-1" class="outline-none max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">

    {{-- Hero --}}
    <header class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
        <p class="font-label text-xs uppercase tracking-widest text-secondary font-bold mb-3">{{ $legal }}</p>
        <h1 class="font-headline text-[clamp(1.85rem,5vw,3rem)] font-black text-primary tracking-tight leading-tight">
            {{ __('site.nav.brand_tagline_mobile') }}
        </h1>
        <p class="text-on-surface-variant mt-4 text-lg leading-relaxed">
            {{ $homeSeoDesc }}
        </p>
        <div class="flex flex-wrap justify-center gap-3 mt-8">
            <a href="{{ route('cars.index') }}" class="sahara-live-cta inline-flex items-center justify-center gap-2 min-h-[48px] rounded-full bg-primary text-white px-8 py-3 font-bold shadow-lg shadow-primary/20 hover:brightness-110">
                <span class="material-symbols-outlined" aria-hidden="true">directions_car</span>
                {{ __('site.engagement.browse_cars') }}
            </a>
            <a href="{{ route('order.request') }}" class="inline-flex items-center justify-center gap-2 min-h-[48px] rounded-full border-2 border-primary text-primary px-8 py-3 font-bold hover:bg-primary/5">
                <span class="material-symbols-outlined" aria-hidden="true">inventory_2</span>
                {{ __('site.nav.order_request') }}
            </a>
        </div>
    </header>

    {{-- Live stats --}}
    <section class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-14" aria-label="Marketplace stats">
        <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-4 text-center shadow-sm">
            <p class="text-2xl font-black text-primary tabular-nums">{{ number_format($totalPublishedCars) }}</p>
            <p class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide mt-1">Listed</p>
        </div>
        <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-4 text-center shadow-sm">
            <p class="text-2xl font-black text-primary tabular-nums">{{ number_format($carsAddedThisWeek) }}</p>
            <p class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide mt-1">New (7d)</p>
        </div>
        <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-4 text-center shadow-sm">
            <p class="text-2xl font-black text-primary tabular-nums">{{ number_format($darReadyCars) }}</p>
            <p class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide mt-1">Dar-ready</p>
        </div>
        <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-4 text-center shadow-sm">
            <p class="text-2xl font-black text-primary tabular-nums">{{ number_format($carsNewTodayCount) }}</p>
            <p class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide mt-1">Today</p>
        </div>
    </section>

    {{-- Shortcuts --}}
    <section class="mb-12" aria-labelledby="home-shortcuts-title">
        <div class="text-center md:text-left mb-6">
            <h2 id="home-shortcuts-title" class="font-headline text-2xl font-bold text-primary">{{ $homeShortcutsTitle }}</h2>
            <p class="text-on-surface-variant mt-1">{{ $homeShortcutsSubtitle }}</p>
        </div>
        <div class="flex flex-wrap justify-center md:justify-start gap-2">
            @foreach ($homeShortcutChips as $chip)
                <a href="{{ $chip['url'] }}" class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 text-primary text-sm font-bold hover:bg-primary/15 border border-primary/20">
                    {{ $chip['label'] }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- Quick filters --}}
    <section class="mb-14" aria-label="Quick filters">
        <div class="flex flex-wrap justify-center md:justify-start gap-2">
            @foreach ($homeQuickFilterChips as $chip)
                <a href="{{ $chip['url'] }}" class="inline-flex items-center px-3 py-1.5 rounded-full bg-surface-container-high text-on-surface text-sm font-semibold hover:bg-surface-container-lowest border border-outline-variant/40">
                    {{ $chip['label'] }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured (search popularity) --}}
    @if ($featuredCars->isNotEmpty())
        <section class="mb-16" aria-labelledby="feat-heading">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                <div>
                    <h2 id="feat-heading" class="font-headline text-2xl sm:text-3xl font-black text-primary">Featured & searched</h2>
                    <p class="text-on-surface-variant mt-1 text-sm">Popular picks from Dar & imports.</p>
                </div>
                <a href="{{ route('cars.index') }}" class="inline-flex items-center gap-2 text-primary font-bold border-b-2 border-primary/20 hover:border-primary text-sm self-start sm:self-auto">
                    {{ __('site.engagement.browse_cars') }}
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3">
                @foreach ($featuredCars as $car)
                    <x-car-card :car="$car" :compact="true" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- New listings --}}
    @if ($newTodayListings->isNotEmpty())
        <section class="mb-16" aria-labelledby="new-listings-heading">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
                <div>
                    <h2 id="new-listings-heading" class="font-headline text-2xl font-bold text-primary">
                        @if ($homeNewListingsIsRecentFallback)
                            Recent arrivals
                        @else
                            New today
                        @endif
                    </h2>
                    @if ($homeNewListingsIsRecentFallback)
                        <p class="text-sm text-on-surface-variant mt-1">No listings created today — showing the latest instead.</p>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3">
                @foreach ($newTodayListings as $car)
                    <x-car-card :car="$car" :compact="true" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Brand rail --}}
    @if (count($homeBrands) > 0)
        <section class="mb-16" aria-labelledby="brands-heading">
            <h2 id="brands-heading" class="font-headline text-xl font-bold text-primary mb-6 text-center">Trusted brands</h2>
            <div class="flex flex-wrap justify-center items-center gap-8 sm:gap-10">
                @foreach ($homeBrands as $b)
                    <div class="flex flex-col items-center gap-2 text-center max-w-[120px]">
                        <img src="{{ $b['logo'] }}" alt="" class="h-12 w-auto object-contain max-w-full" loading="lazy" decoding="async"/>
                        <span class="text-xs font-semibold text-on-surface-variant">{{ $b['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Import flow --}}
    <section class="mb-16 rounded-3xl border border-outline-variant/30 bg-surface-container-low/60 p-6 sm:p-10" aria-labelledby="import-flow-title">
        <h2 id="import-flow-title" class="font-headline text-2xl font-bold text-primary">{{ $homeImportFlowTitle }}</h2>
        <p class="text-on-surface-variant mt-2 mb-8">{{ $homeImportFlowSubtitle }}</p>
        <ol class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 list-none p-0 m-0">
            @foreach ($homeImportFlowSteps as $idx => $step)
                <li class="rounded-2xl bg-surface-container-lowest p-5 border border-outline-variant/25 shadow-sm">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-primary text-on-primary font-black text-sm mb-3">{{ $idx + 1 }}</span>
                    <h3 class="font-headline font-bold text-primary">{{ $step['title'] }}</h3>
                    <p class="text-sm text-on-surface-variant mt-2 leading-relaxed">{{ $step['description'] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- Announcements --}}
    @if ($homeAnnouncements->isNotEmpty())
        <section class="mb-8" aria-labelledby="news-heading">
            <h2 id="news-heading" class="font-headline text-2xl font-bold text-primary mb-6">Offers & news</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($homeAnnouncements as $announcement)
                    @php
                        $href = $announcement->publicLinkHref();
                    @endphp
                    <article class="rounded-2xl border border-outline-variant/30 bg-surface-container-lowest p-5 shadow-sm flex flex-col">
                        <h3 class="font-headline font-bold text-primary">{{ $announcement->title }}</h3>
                        @if ($announcement->summary)
                            <p class="text-sm text-on-surface-variant mt-2 flex-1">{{ $announcement->summary }}</p>
                        @endif
                        @if ($href)
                            <a href="{{ $href }}" class="mt-4 inline-flex items-center gap-1 text-sm font-bold text-secondary hover:underline" @if ($announcement->link_new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                Learn more
                                <span class="material-symbols-outlined text-base">open_in_new</span>
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>
        </section>
    @endif

</main>

<x-footer class="mt-12" />
<x-mobile-nav active="home" />
<x-whatsapp-float />
</body></html>
