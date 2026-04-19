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
<main id="main-content" tabindex="-1" class="outline-none">
<!-- Hero Section -->
<section class="relative min-h-[min(100svh,720px)] md:min-h-[620px] flex flex-col items-center justify-center px-4 sm:px-6 pt-16 pb-12 sm:pt-20 sm:pb-14 md:pt-24 md:pb-16 overflow-hidden hero-mesh" aria-labelledby="home-hero-heading">
<div class="absolute inset-0 -z-10">
<img class="w-full h-full object-cover" alt="" src="{{ asset('images/hero-home.svg') }}" width="1920" height="1080" decoding="async"/>
<div class="absolute inset-0 bg-primary/65"></div>
<div class="absolute -top-12 left-[10%] w-28 h-28 md:w-36 md:h-36 rounded-full bg-primary-fixed/40 blur-2xl float-orb"></div>
<div class="absolute top-24 right-[8%] w-24 h-24 md:w-32 md:h-32 rounded-full bg-primary-fixed/35 blur-2xl float-orb" style="animation-delay: 1.4s;"></div>
</div>
<div class="max-w-4xl w-full text-center space-y-6 md:space-y-7">
<div class="flex flex-wrap justify-center gap-2">
<span class="pulse-chip bg-white/25 backdrop-blur-md text-white px-3 py-1.5 rounded-full text-[11px] font-bold tracking-wider uppercase">Dar Showroom Selection</span>
<span class="bg-secondary-container text-on-secondary-container px-3 py-1.5 rounded-full text-[11px] font-bold tracking-wider uppercase">Fully Verified Stock</span>
</div>
<h1 id="home-hero-heading" class="font-headline text-[clamp(1.75rem,6.5vw,3.75rem)] md:text-7xl font-black text-white tracking-tighter leading-[1.1] hero-glow px-1">
                Own Tanzania's Most <span class="text-secondary-container">Wanted Cars</span>
</h1>
<p class="text-white text-base sm:text-lg md:text-xl font-semibold max-w-2xl mx-auto hero-glow px-1">
                Premium and rugged vehicles chosen for Tanzanian roads—from Dar commutes to upcountry runs—with clear pricing and documentation you can review before you buy.
            </p>
<div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 pt-2 w-full max-w-md sm:max-w-none mx-auto">
<a href="{{ route('cars.index') }}" class="cta-gradient text-white px-8 py-3.5 min-h-[48px] rounded-full text-sm font-extrabold shadow-lg shadow-primary/25 text-center touch-manipulation focus-ring-on-dark focus-visible:outline-offset-4">Browse Verified Stock</a>
<a href="{{ route('contact') }}" class="bg-white/25 backdrop-blur-md text-white px-8 py-3.5 min-h-[48px] rounded-full text-sm font-bold border border-white/50 text-center touch-manipulation focus-ring-on-dark focus-visible:outline-offset-4">Request a Quick Callback</a>
</div>
</div>
</section>
<section class="px-4 sm:px-6 -mt-6 md:-mt-8 relative z-20">
<div class="max-w-7xl mx-auto bg-surface-container-lowest rounded-2xl sm:rounded-3xl p-3 sm:p-4 md:p-6 shadow-[0_20px_36px_rgba(92,67,32,0.14)]">
<div class="grid grid-cols-1 md:grid-cols-4 gap-3">
<div class="bg-surface-container-low rounded-2xl p-4 graphic-panel">
<span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">verified</span>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">Verified Listings</p>
<p class="font-headline text-lg font-extrabold text-primary mt-1">Inspected &amp; Documented</p>
</div>
<div class="bg-surface-container-low rounded-2xl p-4 graphic-panel">
<span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">bolt</span>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">Fast Response</p>
<p class="font-headline text-lg font-extrabold text-primary mt-1">Quick Replies</p>
</div>
<div class="bg-surface-container-low rounded-2xl p-4 graphic-panel">
<span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">account_balance</span>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">Finance &amp; Cover</p>
<p class="font-headline text-lg font-extrabold text-primary mt-1">Banks &amp; Insurance</p>
</div>
<div class="bg-surface-container-low rounded-2xl p-4 graphic-panel">
<span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">location_city</span>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">Showroom</p>
<p class="font-headline text-lg font-extrabold text-primary mt-1">Dar es Salaam</p>
</div>
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
<section class="max-w-7xl mx-auto px-4 sm:px-6 section-editorial section-wash-soft rounded-[1.25rem] sm:rounded-[2rem]" aria-labelledby="home-inventory-heading">
<div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-end mb-8">
<div class="space-y-2 min-w-0">
<span class="text-secondary font-bold text-sm uppercase tracking-[0.2em]">Showroom Preview</span>
<h2 id="home-inventory-heading" class="font-headline text-2xl sm:text-4xl font-black text-primary leading-tight">Premium Inventory Highlights</h2>
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
<div id="home-panel-new-arrivals" role="tabpanel" aria-labelledby="home-tab-new-arrivals" class="home-tab-panel grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-panel="new-arrivals">
@forelse ($newArrivals as $car)
    <x-car-card :car="$car" />
@empty
    <div class="lg:col-span-3 bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline font-black text-2xl text-primary">No vehicles yet</div>
        <p class="text-on-surface-variant mt-2">Inventory previews will appear once listings are published.</p>
    </div>
@endforelse
</div>
<div id="home-panel-editor-picks" role="tabpanel" aria-labelledby="home-tab-editor-picks" class="home-tab-panel hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-panel="editor-picks">
@forelse ($editorPicks as $car)
    <x-car-card :car="$car" />
@empty
    <div class="lg:col-span-3 bg-surface-container-lowest rounded-2xl p-10 text-center shadow-[0_16px_24px_rgba(25,28,30,0.04)]">
        <div class="font-headline font-black text-2xl text-primary">More picks coming soon</div>
        <p class="text-on-surface-variant mt-2">Our team is curating fresh editor recommendations.</p>
    </div>
@endforelse
</div>
<div id="home-panel-value-picks" role="tabpanel" aria-labelledby="home-tab-value-picks" class="home-tab-panel hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-panel="value-picks">
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
<section class="section-editorial px-6 section-wash">
<div class="max-w-7xl mx-auto">
<div class="max-w-3xl flex flex-col sm:flex-row items-start gap-4">
<div class="h-14 w-14 rounded-2xl bg-primary-container text-white flex items-center justify-center shadow-lg shadow-primary/20">
<span class="material-symbols-outlined text-[28px]">timeline</span>
</div>
<div>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">Buyer Journey</p>
<h3 class="font-headline text-4xl font-extrabold text-primary mt-2">How Buying Works</h3>
<p class="text-on-surface-variant mt-3">A clear 3-step path from browsing to handover—built for buyers who want straight answers, fair paperwork, and support right here in Tanzania.</p>
</div>
</div>
<div class="mt-10">
<div class="relative overflow-hidden" id="journey-slider">
<div class="flex transition-transform duration-500 ease-out" id="journey-track">
<article class="w-full shrink-0 bg-surface-container-lowest rounded-3xl p-6 md:p-8 shadow-[0_14px_24px_rgba(25,28,30,0.05)] graphic-panel">
<div class="flex items-center justify-between">
<span class="inline-flex items-center gap-2 font-label text-[10px] uppercase tracking-widest text-on-surface-variant">
<span class="h-6 w-6 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-bold">1</span>
Step 01
</span>
<span class="h-10 w-10 rounded-full bg-primary-container text-white flex items-center justify-center">
<span class="material-symbols-outlined text-[18px]">search</span>
</span>
</div>
<h4 class="font-headline text-2xl font-extrabold text-primary mt-4">Browse & Shortlist</h4>
<p class="text-sm md:text-base text-on-surface-variant mt-2">Filter by budget in Tanzanian Shillings, brand, and body style, then shortlist vehicles that suit Dar traffic, family use, or upcountry trips.</p>
<img src="{{ asset('images/step-browse.svg') }}" alt="Browse and shortlist visual" class="mt-5 h-40 w-full object-cover rounded-2xl"/>
</article>
<article class="w-full shrink-0 bg-surface-container-lowest rounded-3xl p-6 md:p-8 shadow-[0_14px_24px_rgba(25,28,30,0.05)] graphic-panel">
<div class="flex items-center justify-between">
<span class="inline-flex items-center gap-2 font-label text-[10px] uppercase tracking-widest text-on-surface-variant">
<span class="h-6 w-6 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-bold">2</span>
Step 02
</span>
<span class="h-10 w-10 rounded-full bg-primary-container text-white flex items-center justify-center">
<span class="material-symbols-outlined text-[18px]">fact_check</span>
</span>
</div>
<h4 class="font-headline text-2xl font-extrabold text-primary mt-4">Inspect & Verify</h4>
<p class="text-sm md:text-base text-on-surface-variant mt-2">Review condition and service clues, confirm ownership paperwork with our team, and book a guided inspection before you commit.</p>
<img src="{{ asset('images/step-inspect.svg') }}" alt="Inspect and verify visual" class="mt-5 h-40 w-full object-cover rounded-2xl"/>
</article>
<article class="w-full shrink-0 bg-surface-container-lowest rounded-3xl p-6 md:p-8 shadow-[0_14px_24px_rgba(25,28,30,0.05)] graphic-panel">
<div class="flex items-center justify-between">
<span class="inline-flex items-center gap-2 font-label text-[10px] uppercase tracking-widest text-on-surface-variant">
<span class="h-6 w-6 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-bold">3</span>
Step 03
</span>
<span class="h-10 w-10 rounded-full bg-primary-container text-white flex items-center justify-center">
<span class="material-symbols-outlined text-[18px]">handshake</span>
</span>
</div>
<h4 class="font-headline text-2xl font-extrabold text-primary mt-4">Close with Confidence</h4>
<p class="text-sm md:text-base text-on-surface-variant mt-2">Finalize payment and pickup with help from trusted banking and insurance partners, and answers to common questions about transfer and registration next steps.</p>
<img src="{{ asset('images/step-close.svg') }}" alt="Close with confidence visual" class="mt-5 h-40 w-full object-cover rounded-2xl"/>
</article>
</div>
</div>
<div class="mt-5 flex items-center justify-between">
<button type="button" id="journey-prev" class="inline-flex items-center gap-1 rounded-full bg-surface-container-low px-4 py-2 min-h-[44px] text-xs font-bold text-primary ghost-border transition-colors hover:bg-white hover:text-primary" aria-label="Previous buying step">
<span class="material-symbols-outlined text-[16px] text-inherit" aria-hidden="true">arrow_back</span> Prev
</button>
<div class="text-[11px] font-bold uppercase tracking-widest text-on-surface-variant" id="journey-counter">Step 1 of 3</div>
<div class="flex items-center gap-2" id="journey-dots" role="group" aria-label="Buying journey steps">
<button type="button" class="journey-dot inline-flex min-h-[44px] min-w-[44px] items-center justify-center rounded-full bg-primary p-2" data-index="0" aria-label="Go to step 1"><span class="journey-dot-marker h-2.5 w-2.5 rounded-full bg-white" aria-hidden="true"></span></button>
<button type="button" class="journey-dot inline-flex min-h-[44px] min-w-[44px] items-center justify-center rounded-full bg-surface-container-high ghost-border p-2" data-index="1" aria-label="Go to step 2"><span class="journey-dot-marker h-2.5 w-2.5 rounded-full bg-on-surface-variant/50" aria-hidden="true"></span></button>
<button type="button" class="journey-dot inline-flex min-h-[44px] min-w-[44px] items-center justify-center rounded-full bg-surface-container-high ghost-border p-2" data-index="2" aria-label="Go to step 3"><span class="journey-dot-marker h-2.5 w-2.5 rounded-full bg-on-surface-variant/50" aria-hidden="true"></span></button>
</div>
<button type="button" id="journey-next" class="inline-flex items-center gap-1 rounded-full cta-gradient px-4 py-2 min-h-[44px] text-xs font-bold text-white focus-ring-on-dark transition-[filter] hover:brightness-110" aria-label="Next buying step">
Next <span class="material-symbols-outlined text-[16px] text-white" aria-hidden="true">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<x-partner-logos-slider
    title="Trusted Companies in Our Network"
    subtitle="Working with banking, insurance, logistics, and compliance partners so your purchase stays transparent and on track from quote to keys in Tanzania."
/>
<section class="section-editorial px-6 section-wash-soft">
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
<a href="{{ route('contact') }}" class="bg-surface-container-low rounded-full px-7 py-3 min-h-[48px] font-bold text-sm text-primary text-center ghost-border inline-flex items-center justify-center">Talk to Our Dar Team</a>
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

(() => {
    const track = document.getElementById('journey-track');
    const slider = document.getElementById('journey-slider');
    const prev = document.getElementById('journey-prev');
    const next = document.getElementById('journey-next');
    const counter = document.getElementById('journey-counter');
    const dots = Array.from(document.querySelectorAll('.journey-dot'));
    if (!track || !prev || !next || !dots.length || !slider || !counter) return;

    let index = 0;
    const max = dots.length - 1;
    let autoId = null;

    const render = () => {
        track.style.transform = `translateX(-${index * 100}%)`;
        counter.textContent = `Step ${index + 1} of ${max + 1}`;
        dots.forEach((dot, i) => {
            const active = i === index;
            dot.classList.toggle('bg-primary', active);
            dot.classList.toggle('bg-surface-container-high', !active);
            dot.classList.toggle('ghost-border', !active);
            dot.setAttribute('aria-current', active ? 'step' : 'false');
            const inner = dot.querySelector('.journey-dot-marker');
            if (inner) {
                inner.classList.toggle('bg-white', active);
                inner.classList.toggle('bg-on-surface-variant/50', !active);
            }
        });
    };
    const startAuto = () => {
        if (autoId) return;
        autoId = window.setInterval(() => {
            index = index >= max ? 0 : index + 1;
            render();
        }, 4200);
    };
    const stopAuto = () => {
        if (!autoId) return;
        window.clearInterval(autoId);
        autoId = null;
    };

    prev.addEventListener('click', () => {
        index = index <= 0 ? max : index - 1;
        render();
    });
    next.addEventListener('click', () => {
        index = index >= max ? 0 : index + 1;
        render();
    });
    dots.forEach((dot, i) => dot.addEventListener('click', () => {
        index = i;
        render();
    }));
    slider.addEventListener('mouseenter', stopAuto);
    slider.addEventListener('mouseleave', startAuto);
    slider.addEventListener('touchstart', stopAuto, { passive: true });
    slider.addEventListener('touchend', startAuto, { passive: true });
    startAuto();
})();
</script>
</body></html>
