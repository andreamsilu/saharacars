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
      .hero-mesh {
        background:
          radial-gradient(1200px 500px at 10% 0%, rgba(138, 101, 40, 0.14), transparent 60%),
          radial-gradient(900px 420px at 90% 20%, rgba(240, 223, 196, 0.28), transparent 62%);
      }
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
      .hero-glow {
        text-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
      }
      .pulse-chip {
        animation: pulse-soft 2.8s ease-in-out infinite;
      }
      .float-orb {
        animation: float-soft 7s ease-in-out infinite;
      }
      @keyframes pulse-soft {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.03); opacity: 0.92; }
      }
      @keyframes float-soft {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
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
<!-- Hero Section -->
<section class="relative min-h-[min(100svh,720px)] md:min-h-[620px] flex flex-col items-center justify-center px-4 sm:px-6 pt-16 pb-12 sm:pt-20 sm:pb-14 md:pt-24 md:pb-16 overflow-hidden hero-mesh" aria-labelledby="home-hero-heading">
<div class="absolute inset-0 -z-10">
<img class="w-full h-full object-cover" alt="Premium car at Sahara Cars showroom" src="{{ asset('images/bg.png') }}" width="1920" height="1080" decoding="async"/>
<div class="absolute inset-0 bg-primary/65"></div>
<div class="absolute -top-12 left-[10%] w-28 h-28 md:w-36 md:h-36 rounded-full bg-primary-fixed/40 blur-2xl float-orb"></div>
<div class="absolute top-24 right-[8%] w-24 h-24 md:w-32 md:h-32 rounded-full bg-primary-fixed/35 blur-2xl float-orb" style="animation-delay: 1.4s;"></div>
</div>
<div class="max-w-4xl w-full text-center space-y-6 md:space-y-7">
<div class="flex flex-wrap justify-center gap-2">
</div>
<h1 id="home-hero-heading" class="font-headline text-[clamp(1.75rem,6.5vw,3.75rem)] md:text-7xl font-black text-white tracking-tighter leading-[1.1] hero-glow px-1">
                Own Tanzania's Most <span class="text-secondary-container">Wanted Cars</span>
</h1>
<p class="text-white text-base sm:text-lg md:text-xl font-semibold max-w-2xl mx-auto hero-glow px-1">
                Premium and rugged cars chosen for Tanzanian roads—from Dar commutes to upcountry runs—with clear pricing and documentation you can review before you buy.
            </p>
<form action="{{ route('cars.index') }}" method="GET" class="max-w-5xl mx-auto bg-white/90 backdrop-blur rounded-2xl p-3 sm:p-4 border border-white/70 shadow-[0_16px_30px_rgba(25,28,30,0.16)]">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2 sm:gap-3">
        <input name="q" type="search" placeholder="Brand, model, or keyword" class="rounded-xl bg-surface-container-highest px-3 py-2.5 text-sm ghost-border focus:ring-2 focus:ring-primary/30" />
        <select name="brand" class="rounded-xl bg-surface-container-highest px-3 py-2.5 text-sm ghost-border focus:ring-2 focus:ring-primary/30">
            <option value="">Any brand</option>
            @foreach ($brandOptions as $brandOption)
                <option value="{{ $brandOption }}">{{ $brandOption }}</option>
            @endforeach
        </select>
        <select name="source_country" class="rounded-xl bg-surface-container-highest px-3 py-2.5 text-sm ghost-border focus:ring-2 focus:ring-primary/30">
            <option value="">Any source country</option>
            @foreach (($sourceCountryOptions ?? collect()) as $sourceCountryOption)
                <option value="{{ $sourceCountryOption }}">{{ $sourceCountryOption }}</option>
            @endforeach
        </select>
        <input name="price_min" type="number" inputmode="numeric" placeholder="Min TZS" class="rounded-xl bg-surface-container-highest px-3 py-2.5 text-sm ghost-border focus:ring-2 focus:ring-primary/30" />
        <button type="submit" class="rounded-xl cta-gradient text-white font-bold px-4 py-2.5 min-h-[44px] focus-ring-on-dark">Search Cars</button>
    </div>
</form>
<div class="flex flex-wrap justify-center gap-2 -mt-1">
    @foreach (($homeQuickFilterChips ?? []) as $quickFilterChip)
        <a href="{{ $quickFilterChip['url'] }}" class="inline-flex items-center rounded-full bg-white/15 text-white px-4 py-2 text-xs font-bold uppercase tracking-wide border border-white/30 hover:bg-white/25 transition-colors">
            {{ $quickFilterChip['label'] }}
        </a>
    @endforeach
</div>
<div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 pt-2 w-full max-w-2xl mx-auto">
<a href="{{ $salesWaHref }}" target="_blank" rel="noopener noreferrer" class="bg-[#25D366] text-white px-5 sm:px-7 py-3 sm:py-3.5 min-h-[48px] rounded-full text-sm font-extrabold shadow-lg shadow-black/20 text-center touch-manipulation focus-ring-on-dark focus-visible:outline-offset-4 inline-flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-white text-[18px]" aria-hidden="true">chat</span> Chat on WhatsApp
</a>
<a href="{{ route('cars.index') }}" class="bg-white text-primary px-5 sm:px-7 py-3 sm:py-3.5 min-h-[48px] rounded-full text-sm font-bold border border-white/60 text-center touch-manipulation focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white">Browse Inventory</a>
</div>
<button type="button" id="save-search-wa" class="inline-flex items-center justify-center gap-2 rounded-full bg-white/20 text-white border border-white/35 px-5 py-2.5 text-xs font-bold hover:bg-white/30 transition-colors min-h-[44px]">
    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">bookmark_add</span>
    Save Search on WhatsApp
</button>
<p class="text-white/85 text-xs sm:text-sm font-semibold">Fastest path: start on WhatsApp, then we guide you to the best matching units.</p>
</div>
</section>
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-6" aria-label="Live inventory stats">
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
<div id="home-panel-new-arrivals" role="tabpanel" aria-labelledby="home-tab-new-arrivals" class="home-tab-panel grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8" data-panel="new-arrivals">
@forelse ($newArrivals as $car)
    <x-car-card :car="$car" />
@empty
    <div class="lg:col-span-3 bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline font-black text-2xl text-primary">No cars yet</div>
        <p class="text-on-surface-variant mt-2">Car highlights will appear here as soon as new cars are added.</p>
    </div>
@endforelse
</div>
<div id="home-panel-editor-picks" role="tabpanel" aria-labelledby="home-tab-editor-picks" class="home-tab-panel hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8" data-panel="editor-picks">
@forelse ($editorPicks as $car)
    <x-car-card :car="$car" />
@empty
    <div class="lg:col-span-3 bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline font-black text-2xl text-primary">More picks coming soon</div>
        <p class="text-on-surface-variant mt-2">Our team is curating fresh editor recommendations.</p>
    </div>
@endforelse
</div>
<div id="home-panel-value-picks" role="tabpanel" aria-labelledby="home-tab-value-picks" class="home-tab-panel hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8" data-panel="value-picks">
@forelse ($valuePicks as $car)
    <x-car-card :car="$car" />
@empty
    <div class="lg:col-span-3 bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
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
    const homeSearchForm = document.querySelector('form[action="{{ route('cars.index') }}"]');
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
