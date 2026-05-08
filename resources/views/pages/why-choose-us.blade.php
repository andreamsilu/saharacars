<!DOCTYPE html>

<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<x-public-seo
    :title="__('public.meta.why_title', ['company' => config('sahara.legal_entity_name')])"
    :description="__('public.meta.why_description', ['company' => config('sahara.legal_entity_name')])"
    :canonical="route('why.choose.us', ['locale' => app()->getLocale()])"
/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
      .why-zoom img {
        transition: transform .5s ease;
      }
      .why-zoom:hover img {
        transform: scale(1.04);
      }
      @keyframes whyFadeUp {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<!-- TopNavBar -->
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none">
<section class="px-4 sm:px-6 pt-10 md:pt-14 pb-6 why-fade-up">
<div class="max-w-7xl mx-auto text-center">
<p class="font-label text-[10px] font-bold uppercase tracking-widest text-secondary mb-3">{{ __('public.why.kicker') }}</p>
<h1 class="text-3xl md:text-5xl font-headline font-extrabold text-primary tracking-tight mb-3">{{ __('public.why.hero_title') }}</h1>
<p class="text-on-surface-variant max-w-3xl mx-auto leading-relaxed">{{ __('public.why.hero_subtitle') }}</p>
</div>
</section>
<!-- Quick trust stats -->
<section class="px-4 sm:px-6 relative z-20 why-fade-up why-delay-1">
<div class="sahara-live-panel max-w-7xl mx-auto bg-surface-container-lowest rounded-3xl p-4 sm:p-6 shadow-[0_18px_38px_rgba(92,67,32,0.14)] border border-outline-variant/30">
<div class="sahara-stagger-children grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
<article class="rounded-2xl border border-primary/15 bg-gradient-to-br from-surface-container-low to-surface-container p-5 why-lift text-center sm:text-left">
<div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
<span class="material-symbols-outlined text-[20px]" aria-hidden="true">verified</span>
</div>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant mt-3">{{ __('public.why.card_listing_control') }}</p>
<p class="font-headline text-xl font-black text-primary mt-1">{{ __('public.why.card_verified') }}</p>
<p class="text-xs text-on-surface-variant mt-2">{{ __('public.why.card_no_anonymous') }}</p>
</article>
<article class="rounded-2xl border border-primary/15 bg-gradient-to-br from-surface-container-low to-surface-container p-5 why-lift text-center sm:text-left">
<div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
<span class="material-symbols-outlined text-[20px]" aria-hidden="true">bolt</span>
</div>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant mt-3">{{ __('public.why.card_response') }}</p>
<p class="font-headline text-xl font-black text-primary mt-1">{{ __('public.why.card_advisor') }}</p>
<p class="text-xs text-on-surface-variant mt-2">{{ __('public.why.card_whatsapp_phone') }}</p>
</article>
<article class="rounded-2xl border border-primary/15 bg-gradient-to-br from-surface-container-low to-surface-container p-5 why-lift text-center sm:text-left">
<div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
<span class="material-symbols-outlined text-[20px]" aria-hidden="true">description</span>
</div>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant mt-3">{{ __('public.why.card_clarity') }}</p>
<p class="font-headline text-xl font-black text-primary mt-1">{{ __('public.why.card_structured') }}</p>
<p class="text-xs text-on-surface-variant mt-2">{{ __('public.why.card_specs_present') }}</p>
</article>
<article class="rounded-2xl border border-primary/15 bg-gradient-to-br from-surface-container-low to-surface-container p-5 why-lift text-center sm:text-left">
<div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
<span class="material-symbols-outlined text-[20px]" aria-hidden="true">location_city</span>
</div>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant mt-3">{{ __('public.why.card_base') }}</p>
<p class="font-headline text-xl font-black text-primary mt-1">{{ __('public.why.card_dar') }}</p>
<p class="text-xs text-on-surface-variant mt-2">{{ __('public.why.card_physical') }}</p>
</article>
</div>
</div>
</section>
<!-- Why buyers choose Sahara -->
<section class="section-editorial px-4 sm:px-6 bg-surface-container-low py-16 md:py-20 why-fade-up why-delay-2" aria-labelledby="why-core-heading">
<div class="max-w-7xl mx-auto">
<div class="text-center">
<p class="font-label text-[10px] font-bold uppercase tracking-widest text-secondary mb-3">{{ __('public.why.section_kicker') }}</p>
<h2 id="why-core-heading" class="text-3xl md:text-4xl font-headline font-extrabold text-primary tracking-tight mb-4">{{ __('public.why.section_title') }}</h2>
<p class="text-on-surface-variant max-w-3xl mx-auto leading-relaxed mb-10">{{ __('public.why.section_body') }}</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
<div class="lg:col-span-7 rounded-3xl border border-outline-variant/30 bg-surface-container-lowest p-6 sm:p-8 why-lift">
<div class="space-y-5">
<article class="flex flex-col items-center text-center gap-4 sm:flex-row sm:items-start sm:text-left">
<span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">verified_user</span>
<div>
<h3 class="font-headline text-lg font-bold">{{ __('public.why.feat_verified_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.why.feat_verified_body') }}</p>
</div>
</article>
<article class="flex flex-col items-center text-center gap-4 sm:flex-row sm:items-start sm:text-left">
<span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">description</span>
<div>
<h3 class="font-headline text-lg font-bold">{{ __('public.why.feat_details_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.why.feat_details_body') }}</p>
</div>
</article>
<article class="flex flex-col items-center text-center gap-4 sm:flex-row sm:items-start sm:text-left">
<span class="material-symbols-outlined text-primary text-3xl" aria-hidden="true">support_agent</span>
<div>
<h3 class="font-headline text-lg font-bold">{{ __('public.why.feat_human_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.why.feat_human_body') }}</p>
</div>
</article>
</div>
</div>
<aside class="lg:col-span-5 rounded-3xl overflow-hidden border border-outline-variant/30 bg-surface-container-lowest why-lift why-zoom text-center sm:text-left">
<img class="h-56 sm:h-64 w-full object-cover" src="{{ asset('images/why-showroom.jpg') }}" alt="{{ __('public.why.why_img_showroom_alt') }}" loading="lazy" decoding="async"/>
<div class="p-6">
<p class="text-xs uppercase tracking-widest text-on-surface-variant font-label">{{ __('public.why.aside_kicker') }}</p>
<h3 class="font-headline text-xl font-bold mt-2">{{ __('public.why.aside_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-2">{{ __('public.why.aside_body') }}</p>
</div>
</aside>
</div>
</div>
</section>
<!-- By the numbers -->
<section class="section-editorial px-4 sm:px-6 bg-surface py-16 md:py-20 border-y border-outline-variant/30 why-fade-up why-delay-3" aria-labelledby="why-numbers-heading">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
<div class="lg:col-span-4 rounded-3xl bg-primary-container text-on-primary p-6 sm:p-8 why-lift text-center lg:text-left">
<p class="text-xs uppercase tracking-widest text-white/80 font-label">{{ __('public.why.numbers_kicker') }}</p>
<h2 id="why-numbers-heading" class="text-3xl font-headline font-extrabold mt-3 leading-tight">{{ __('public.why.numbers_title') }}</h2>
<p class="text-sm text-white/85 mt-3">{{ __('public.why.numbers_body') }}</p>
</div>
<div class="lg:col-span-8 grid grid-cols-2 gap-4">
<div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center">
<p class="font-headline text-3xl font-black text-primary">500+</p>
<p class="text-xs uppercase tracking-widest text-on-surface-variant mt-2">{{ __('public.why.num_listed') }}</p>
</div>
<div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center">
<p class="font-headline text-3xl font-black text-primary">10k+</p>
<p class="text-xs uppercase tracking-widest text-on-surface-variant mt-2">{{ __('public.why.num_inquiries') }}</p>
</div>
<div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center">
<p class="font-headline text-3xl font-black text-primary">&lt; 30 min</p>
<p class="text-xs uppercase tracking-widest text-on-surface-variant mt-2">{{ __('public.why.num_response') }}</p>
</div>
<div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center">
<p class="font-headline text-3xl font-black text-primary">4.8/5</p>
<p class="text-xs uppercase tracking-widest text-on-surface-variant mt-2">{{ __('public.why.num_rating') }}</p>
</div>
</div>
</div>
</div>
</section>
<!-- Graphics placeholders -->
<section class="section-editorial px-4 sm:px-6 bg-surface-container-low py-16 md:py-20 why-fade-up why-delay-4" aria-labelledby="why-visuals-heading">
<div class="max-w-7xl mx-auto">
<h2 id="why-visuals-heading" class="text-3xl md:text-4xl font-headline font-extrabold text-primary tracking-tight mb-4 text-center">{{ __('public.why.journey_title') }}</h2>
<p class="text-on-surface-variant max-w-3xl mx-auto mb-10 text-center">{{ __('public.why.journey_subtitle') }}</p>
<div class="sahara-stagger-children grid grid-cols-1 md:grid-cols-4 gap-4">
<article class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center md:text-left">
<p class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-container text-white text-xs font-bold">1</p>
<span class="material-symbols-outlined text-primary text-2xl mt-3" aria-hidden="true">search</span>
<h3 class="font-headline text-base font-bold mt-3">{{ __('public.why.step1_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.why.step1_body') }}</p>
</article>
<article class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center md:text-left">
<p class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-container text-white text-xs font-bold">2</p>
<span class="material-symbols-outlined text-primary text-2xl mt-3" aria-hidden="true">chat</span>
<h3 class="font-headline text-base font-bold mt-3">{{ __('public.why.step2_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.why.step2_body') }}</p>
</article>
<article class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center md:text-left">
<p class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-container text-white text-xs font-bold">3</p>
<span class="material-symbols-outlined text-primary text-2xl mt-3" aria-hidden="true">event_available</span>
<h3 class="font-headline text-base font-bold mt-3">{{ __('public.why.step3_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.why.step3_body') }}</p>
</article>
<article class="rounded-2xl bg-surface-container-lowest border border-outline-variant/30 p-5 why-lift text-center md:text-left">
<p class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-container text-white text-xs font-bold">4</p>
<span class="material-symbols-outlined text-primary text-2xl mt-3" aria-hidden="true">key</span>
<h3 class="font-headline text-base font-bold mt-3">{{ __('public.why.step4_title') }}</h3>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.why.step4_body') }}</p>
</article>
</div>
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="rounded-3xl overflow-hidden border border-outline-variant/30 bg-surface-container-lowest why-lift why-zoom">
<img class="h-56 w-full object-cover" src="{{ asset('images/why-handover.jpg') }}" alt="{{ __('public.why.img_handover_alt') }}" loading="lazy" decoding="async"/>
</div>
<div class="rounded-3xl overflow-hidden border border-outline-variant/30 bg-surface-container-lowest why-lift why-zoom">
<img class="h-56 w-full object-cover" src="{{ asset('images/why-lineup.jpg') }}" alt="{{ __('public.why.img_lineup_alt') }}" loading="lazy" decoding="async"/>
</div>
</div>
</div>
</section>
<x-partner-logos-slider
    :title="__('public.why.partner_title')"
    :subtitle="__('public.why.partner_subtitle')"
/>
<!-- Call to Action -->
<section class="section-editorial px-4 sm:px-6 text-center why-fade-up why-delay-5">
<div class="sahara-live-panel max-w-4xl mx-auto bg-surface-container-lowest rounded-3xl p-6 sm:p-8 md:p-12 shadow-xl relative overflow-hidden attention-panel">
<div class="absolute top-0 right-0 p-4 opacity-5">
<span class="material-symbols-outlined text-9xl">directions_car</span>
</div>
<h3 class="text-3xl sm:text-4xl font-headline font-extrabold text-primary mb-6">{{ __('public.why.cta_title') }}</h3>
<p class="text-on-surface-variant mb-8 sm:mb-10 text-base sm:text-lg max-w-2xl mx-auto">{{ __('public.why.cta_body') }}</p>
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
</body></html>

