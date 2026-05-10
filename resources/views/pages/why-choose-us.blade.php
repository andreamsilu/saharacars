<!DOCTYPE html>

<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<x-public-seo
    :title="__('public.meta.why_title', ['company' => config('sahara.legal_entity_name')])"
    :description="__('public.meta.why_description', ['company' => config('sahara.legal_entity_name')])"
    :canonical="route('why.choose.us', ['locale' => app()->getLocale()])"
/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/></noscript>
<link rel="preload" as="style" href="{{ asset('css/material-symbols-outlined.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/material-symbols-outlined.css') }}" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="{{ asset('css/material-symbols-outlined.css') }}"/></noscript>
<script src="https://cdn.tailwindcss.com" defer></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-fixed": "#f0dfc4",
              "primary-container": "#5c4320",
              "error-container": "#ffdad6",
              "secondary-fixed": "#66ff8e",
              "on-tertiary-container": "#d8885c",
              "error": "#ba1a1a",
              "surface-container-highest": "#e0e3e5",
              "surface-tint": "#8a6528",
              "on-secondary-container": "#007232",
              "surface-container-lowest": "#ffffff",
              "on-background": "#191c1e",
              "inverse-primary": "#e8c889",
              "on-surface": "#191c1e",
              "surface-container-high": "#e6e8ea",
              "inverse-on-surface": "#eff1f3",
              "surface-container-low": "#f2f4f6",
              "surface-bright": "#f3f3f3",
              "primary-fixed-dim": "#d4b57a",
              "on-tertiary-fixed": "#341100",
              "tertiary-fixed": "#ffdbca",
              "tertiary-fixed-dim": "#ffb690",
              "on-surface-variant": "#43474f",
              "on-primary-fixed": "#2a1d09",
              "background": "#f3f3f3",
              "on-tertiary": "#ffffff",
              "on-secondary": "#ffffff",
              "on-error": "#ffffff",
              "on-error-container": "#93000a",
              "surface": "#f3f3f3",
              "tertiary-container": "#592300",
              "tertiary": "#381300",
              "on-secondary-fixed": "#002109",
              "outline": "#737780",
              "secondary": "#006d2f",
              "secondary-fixed-dim": "#3de273",
              "on-tertiary-fixed-variant": "#723610",
              "on-primary-fixed-variant": "#4a3614",
              "surface-dim": "#d8dadc",
              "on-primary": "#ffffff",
              "outline-variant": "#c3c6d1",
              "surface-container": "#eceef0",
              "secondary-container": "#5dfd8a",
              "surface-variant": "#e0e3e5",
              "inverse-surface": "#2d3133",
              "on-primary-container": "#f4e4c4",
              "primary": "#8a6528",
              "on-secondary-fixed-variant": "#005322"
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
      .why-fade-up {
        opacity: 0;
        transform: translateY(14px);
        animation: whyFadeUp 0.7s ease forwards;
      }
      .why-delay-1 { animation-delay: 0.08s; }
      .why-delay-2 { animation-delay: 0.16s; }
      .why-delay-3 { animation-delay: 0.24s; }
      .why-delay-4 { animation-delay: 0.32s; }
      .why-delay-5 { animation-delay: 0.40s; }
      .why-lift {
        transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
      }
      .why-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 28px rgba(25, 28, 30, 0.10);
      }
      .why-zoom img,
      .why-zoom [role="img"] {
        transition: transform .5s ease;
      }
      .why-zoom:hover img,
      .why-zoom:hover [role="img"] {
        transform: scale(1.04);
      }
      /* Scroll-in cards (preference-aware; toggled via .is-visible) */
      .why-reveal {
        opacity: 0;
        transform: translateY(1.75rem);
        will-change: opacity, transform;
      }
      .why-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
        transition:
          opacity 0.72s cubic-bezier(0.22, 1, 0.36, 1),
          transform 0.72s cubic-bezier(0.22, 1, 0.36, 1);
        transition-delay: var(--why-stagger, 0ms);
      }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(1)  { --why-stagger: 0ms; }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(2)  { --why-stagger: 55ms; }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(3)  { --why-stagger: 110ms; }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(4)  { --why-stagger: 165ms; }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(5)  { --why-stagger: 220ms; }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(6)  { --why-stagger: 275ms; }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(7)  { --why-stagger: 330ms; }
      .why-cards-grid > .why-row.why-reveal.is-visible:nth-child(8)  { --why-stagger: 385ms; }
      .why-reveal-row {
        opacity: 0;
        transform: translateY(14px);
      }
      .why-reveal-row.is-visible {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.55s cubic-bezier(0.22, 1, 0.36, 1), transform 0.55s cubic-bezier(0.22, 1, 0.36, 1);
      }
      @keyframes whyFadeUp {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      @media (prefers-reduced-motion: reduce) {
        .why-fade-up,
        .why-delay-1,
        .why-delay-2,
        .why-delay-3,
        .why-delay-4,
        .why-delay-5 {
          opacity: 1 !important;
          transform: none !important;
          animation: none !important;
        }
        .why-reveal,
        .why-reveal-row {
          opacity: 1 !important;
          transform: none !important;
          transition: none !important;
        }
        .why-zoom:hover img,
        .why-zoom:hover [role="img"] {
          transform: none;
        }
        .why-lift:hover {
          transform: none;
        }
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<!-- TopNavBar -->
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none">
{{-- Hero: on lg+ the photo is full-bleed to the viewport right edge; copy aligns with the 7xl rail. Who-we-are stays max-w-7xl like the sections below. --}}
<section class="overflow-x-hidden pt-10 md:pt-14 pb-8 lg:pb-10" aria-labelledby="why-page-hero-heading">
<div class="lg:grid lg:grid-cols-2 lg:gap-0 lg:min-h-[min(420px,52vh)] lg:items-stretch why-fade-up">
<div class="px-4 sm:px-5 lg:py-6 lg:pr-8 xl:pr-12 lg:pl-[max(2rem,calc((100vw-80rem)/2+2rem))] lg:flex lg:items-center">
<div class="text-center lg:text-left min-w-0 max-w-xl sm:max-w-2xl mx-auto lg:mx-0">
<p class="font-label text-xs md:text-sm font-bold uppercase tracking-widest text-secondary mb-3">{{ __('public.why.page.hero_kicker') }}</p>
<h1 id="why-page-hero-heading" class="text-3xl sm:text-4xl md:text-5xl font-headline font-extrabold text-primary tracking-tight mb-3">{{ config('sahara.legal_entity_name') }}</h1>
<p class="text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">{{ __('public.why.page.hero_intro') }}</p>
</div>
</div>
<figure class="relative mt-8 lg:mt-0 mx-4 sm:mx-5 lg:mx-0 aspect-[16/11] lg:aspect-auto min-h-[220px] sm:min-h-[260px] lg:min-h-0 lg:h-full overflow-hidden rounded-3xl lg:rounded-none lg:rounded-tl-3xl lg:rounded-bl-3xl border border-outline-variant/50 lg:border-y lg:border-l lg:border-r-0 bg-surface-container shadow-md lg:shadow-sm why-zoom isolate max-h-[52vh] lg:max-h-none">
<x-why-visual file="why/vehicles-services.jpg" :alt="__('public.why.page.img_lineup_alt')" :eager="true"/>
<div class="absolute inset-0 bg-gradient-to-tr from-black/45 via-transparent to-transparent pointer-events-none" aria-hidden="true"></div>
</figure>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-5 lg:px-8 mt-8 lg:mt-10">
<div class="why-fade-up why-delay-1 rounded-3xl border border-outline-variant/40 bg-surface-container-low px-6 py-6 sm:px-8 sm:py-7 lg:px-10 lg:py-9 shadow-sm" aria-labelledby="who-we-are-heading">
<div class="text-center lg:text-start border-b-2 border-primary/35 pb-4 mb-5">
<h2 id="who-we-are-heading" class="font-headline text-2xl sm:text-3xl md:text-[2rem] font-extrabold text-primary tracking-tight leading-tight">{{ __('public.why.page.who_heading') }}</h2>
<p class="mt-2 font-label text-xs sm:text-sm font-bold uppercase tracking-widest text-secondary">{{ __('public.why.page.who_subheading') }}</p>
</div>
<p class="text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6] text-center lg:text-start max-w-none">{!! __('public.why.page.who_body', ['company' => '<strong>'.e(config('sahara.legal_entity_name')).'</strong>']) !!}</p>
</div>
</div>
</section>
<section class="px-4 sm:px-5 lg:px-8 pb-14 why-fade-up why-delay-1">
<div class="max-w-7xl mx-auto grid grid-cols-1 gap-6 why-cards-grid">
{{-- Image panels sit outside the gradient text cards (sibling columns in the same row). --}}
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:col-span-5 rounded-2xl border border-amber-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/business-background.jpg" :alt="__('public.why.page.img_showroom_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-amber-950 shadow-md border border-amber-200/80">{{ __('public.why.page.badge_bg') }}</p>
</aside>
<article class="why-lift md:col-span-7 rounded-3xl p-6 sm:p-8 border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">01</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec01_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec01_p1') }}</p>
<p>{{ __('public.why.page.sec01_p2') }}</p>
<p>{{ __('public.why.page.sec01_p3') }}</p>
</div>
</article>
</div>
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:order-2 md:col-span-5 rounded-2xl border border-blue-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/different.jpg" :alt="__('public.why.page.img_quality_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-blue-950 shadow-md border border-blue-200/80">{{ __('public.why.page.badge_diff') }}</p>
</aside>
<article class="why-lift md:order-1 md:col-span-7 rounded-3xl p-6 sm:p-8 border border-blue-200 bg-gradient-to-br from-blue-50 to-cyan-50 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">02</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec02_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec02_p1') }}</p>
<p>{{ __('public.why.page.sec02_p2') }}</p>
<p>{{ __('public.why.page.sec02_p3') }}</p>
</div>
</article>
</div>
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:col-span-5 rounded-2xl border border-emerald-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/customer-trust.jpg" :alt="__('public.why.page.img_handover_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-emerald-950 shadow-md border border-emerald-200/80">{{ __('public.why.page.badge_trust') }}</p>
</aside>
<article class="why-lift md:col-span-7 rounded-3xl p-6 sm:p-8 border border-emerald-200 bg-gradient-to-br from-emerald-50 to-green-50 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">03</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec03_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec03_p1') }}</p>
<p>{{ __('public.why.page.sec03_p2') }}</p>
<p>{{ __('public.why.page.sec03_p3') }}</p>
</div>
</article>
</div>
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:order-2 md:col-span-5 rounded-2xl border border-violet-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/main-customers.jpg" :alt="__('public.why.page.img_consult_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-violet-950 shadow-md border border-violet-200/80">{{ __('public.why.page.badge_serve') }}</p>
</aside>
<article class="why-lift md:order-1 md:col-span-7 rounded-3xl p-6 sm:p-8 border border-violet-200 bg-gradient-to-br from-violet-50 to-purple-50 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">04</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec04_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec04_p1') }}</p>
<p>{{ __('public.why.page.sec04_p2') }}</p>
<p>{{ __('public.why.page.sec04_p3') }}</p>
</div>
</article>
</div>
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:col-span-5 rounded-2xl border border-rose-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/vehicles-services.jpg" :alt="__('public.why.page.img_lineup_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-rose-950 shadow-md border border-rose-200/80">{{ __('public.why.page.badge_vehicles') }}</p>
</aside>
<article class="why-lift md:col-span-7 rounded-3xl p-6 sm:p-8 border border-rose-200 bg-gradient-to-br from-rose-50 to-pink-50 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">05</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec05_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec05_p1') }}</p>
<p>{{ __('public.why.page.sec05_p2') }}</p>
<p>{{ __('public.why.page.sec05_p3') }}</p>
</div>
</article>
</div>
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:order-2 md:col-span-5 rounded-2xl border border-teal-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/customer-experience.jpg" :alt="__('public.why.page.img_experience_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-teal-950 shadow-md border border-teal-200/80">{{ __('public.why.page.badge_experience') }}</p>
</aside>
<article class="why-lift md:order-1 md:col-span-7 rounded-3xl p-6 sm:p-8 border border-teal-200 bg-gradient-to-br from-teal-50 to-sky-50 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">06</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec06_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec06_p1') }}</p>
<p>{{ __('public.why.page.sec06_p2') }}</p>
<p>{{ __('public.why.page.sec06_p3') }}</p>
</div>
</article>
</div>
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:col-span-5 rounded-2xl border border-lime-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/business-strengths.jpg" :alt="__('public.why.page.img_team_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-lime-950 shadow-md border border-lime-300/90">{{ __('public.why.page.badge_strengths') }}</p>
</aside>
<article class="why-lift md:col-span-7 rounded-3xl p-6 sm:p-8 border border-lime-200 bg-gradient-to-br from-lime-50 to-green-100 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">07</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec07_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec07_p1') }}</p>
<p>{{ __('public.why.page.sec07_p2') }}</p>
<p>{{ __('public.why.page.sec07_p3') }}</p>
</div>
</article>
</div>
<div class="why-row why-reveal grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-8 md:items-stretch">
<aside class="md:order-2 md:col-span-5 rounded-2xl border border-indigo-300/60 bg-white/70 min-h-[200px] overflow-hidden relative md:min-h-[260px] why-zoom shadow-sm">
<x-why-visual file="why/customer-support.jpg" :alt="__('public.why.page.img_support_alt')"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-transparent pointer-events-none"></div>
<p class="absolute bottom-3 left-3 right-3 sm:right-auto rounded-lg bg-white/95 backdrop-blur-sm px-3 py-2 text-sm font-headline font-extrabold tracking-tight text-indigo-950 shadow-md border border-indigo-200/80">{{ __('public.why.page.badge_support') }}</p>
</aside>
<article class="why-lift md:order-1 md:col-span-7 rounded-3xl p-6 sm:p-8 border border-indigo-200 bg-gradient-to-br from-indigo-50 to-blue-100 flex flex-col min-w-0 shadow-sm">
<div class="mb-5 pb-4 border-b-2 border-primary/35 space-y-2">
<span class="block font-headline text-2xl sm:text-3xl font-black text-primary leading-tight tracking-tight tabular-nums">08</span>
<h2 class="font-headline text-xl md:text-2xl font-extrabold text-on-surface leading-snug tracking-tight">{{ __('public.why.page.sec08_title') }}</h2>
</div>
<div class="space-y-4 text-on-surface-variant leading-relaxed text-base md:text-lg lg:text-xl/[1.6]">
<p class="font-medium text-on-surface">{{ __('public.why.page.sec08_p1') }}</p>
<p><span class="font-semibold text-primary">{{ __('public.why.page.sec08_before') }}</span> {{ __('public.why.page.sec08_p2') }}</p>
<p><span class="font-semibold text-primary">{{ __('public.why.page.sec08_after') }}</span> {{ __('public.why.page.sec08_p3') }}</p>
<p>{{ __('public.why.page.sec08_p4') }}</p>
</div>
</article>
</div>
</div>
</section>
<!-- Call to Action -->
<section class="section-editorial px-4 sm:px-6 text-center why-reveal-row">
<div class="sahara-live-panel max-w-4xl mx-auto bg-surface-container-lowest rounded-3xl p-6 sm:p-8 md:p-12 shadow-xl relative overflow-hidden attention-panel">
<div class="absolute top-0 right-0 p-4 opacity-5">
<span class="material-symbols-outlined text-9xl">directions_car</span>
</div>
<h3 class="text-3xl sm:text-4xl font-headline font-extrabold text-primary mb-6">{{ __('public.why.page.cta_heading') }}</h3>
<p class="text-on-surface-variant mb-8 sm:mb-10 leading-relaxed text-base md:text-lg lg:text-xl/[1.6] max-w-2xl mx-auto">{{ __('public.why.page.cta_intro') }}</p>
<div class="flex flex-col sm:flex-row justify-center gap-4">
<a class="sahara-live-cta cta-gradient text-white px-6 sm:px-10 py-3 sm:py-4 min-h-[48px] sm:min-h-[52px] rounded-full font-headline font-extrabold text-base sm:text-lg shadow-lg hover:shadow-primary/20 transition-all active:scale-95 inline-flex items-center justify-center focus-ring-on-dark" href="{{ route('cars.index') }}">
                        {{ __('public.why.browse_inventory') }}
                    </a>
<a class="sahara-live-cta bg-secondary text-white px-6 sm:px-10 py-3 sm:py-4 min-h-[48px] sm:min-h-[52px] rounded-full font-headline font-extrabold text-base sm:text-lg flex items-center justify-center gap-2 shadow-lg transition-[filter,transform] hover:brightness-110 hover:shadow-secondary/20 active:scale-95 focus-ring-on-dark [&_.material-symbols-outlined]:text-white" href="{{ route('contact') }}">
<span class="material-symbols-outlined text-white" aria-hidden="true">chat</span>
                        {{ __('site.nav.contact') }}
                    </a>
</div>
</div>
</section>
</main>
<!-- Footer -->
<x-footer />
<x-mobile-nav active="" />
<x-whatsapp-float />
<script>
document.addEventListener('DOMContentLoaded', function whyChooseUsReveal() {
  var mq = window.matchMedia('(prefers-reduced-motion: reduce)');
  function revealAll(sel) {
    document.querySelectorAll(sel).forEach(function (el) { el.classList.add('is-visible'); });
  }
  if (mq.matches) {
    revealAll('.why-reveal');
    revealAll('.why-reveal-row');
    return;
  }
  var io = new IntersectionObserver(
    function (entries, obs) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        obs.unobserve(entry.target);
      });
    },
    { root: null, rootMargin: '0px 0px -12% 0px', threshold: 0.08 }
  );
  document.querySelectorAll('.why-reveal, .why-reveal-row').forEach(function (el) {
    io.observe(el);
  });
});
</script>
</body></html>

