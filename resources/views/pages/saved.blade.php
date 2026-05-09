<!DOCTYPE html>

<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<x-public-seo
    :title="__('public.meta.saved_title', ['company' => config('sahara.legal_entity_name')])"
    :description="__('public.meta.saved_description')"
    :canonical="route('saved', ['locale' => app()->getLocale()])"
    :noindex="true"
/>
<script src="https://cdn.tailwindcss.com" defer></script>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" media="print" onload="this.media='all'"/>
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/></noscript>
<link rel="stylesheet" href="{{ asset('css/material-symbols-outlined.css') }}"/>
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
    </style>
</head>
<body class="bg-surface font-body text-on-surface attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none max-w-3xl lg:max-w-4xl mx-auto px-4 sm:px-6 section-editorial-compact">
<header class="mb-8 md:mb-10 text-center lg:text-left">
<p class="font-label text-[10px] uppercase tracking-widest text-secondary font-bold mb-2">{{ __('public.saved.kicker') }}</p>
<h1 class="font-headline text-[clamp(1.85rem,5vw,2.75rem)] font-black text-primary tracking-tight">{{ __('public.saved.title') }}</h1>
<p class="text-on-surface-variant mt-3 leading-relaxed max-w-2xl mx-auto lg:mx-0">{!! __('public.saved.intro') !!}</p>
</header>
<div class="sahara-live-panel bg-surface-container-lowest rounded-2xl md:rounded-3xl p-5 sm:p-8 md:p-10 shadow-[0_16px_40px_rgba(25,28,30,0.06)] attention-panel border border-outline-variant/20">
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6 md:mb-8">
<div class="text-center sm:text-left">
<h2 class="font-headline text-xl md:text-2xl font-bold text-primary tracking-tight">{{ __('public.saved.picks_title') }}</h2>
<p class="text-sm text-on-surface-variant mt-1">{{ __('public.saved.picks_subtitle') }}</p>
</div>
<a class="sahara-live-cta inline-flex items-center justify-center gap-2 self-start sm:self-auto rounded-full bg-primary text-on-primary px-5 py-2.5 min-h-[44px] text-sm font-bold shadow-md shadow-primary/15 transition-[filter,transform] hover:brightness-110 focus-ring-on-dark" href="{{ route('cars.index') }}">
<span class="material-symbols-outlined text-[20px]" aria-hidden="true">directions_car</span>
                {{ __('public.saved.browse_cars') }}
            </a>
</div>
<ul
    id="saved-cars-render-list"
    class="list-none m-0 p-0 grid gap-3 sm:gap-4"
    data-cars-base-url="{{ rtrim(route('cars.index'), '/').'/' }}"
    data-browse-url="{{ route('cars.index') }}"
    aria-live="polite"
    aria-relevant="additions removals"
></ul>
<p class="text-sm text-on-surface-variant mt-8 pt-6 border-t border-outline-variant/40 text-center sm:text-left">
    @php
        $savedContactUrl = route('contact', ['locale' => app()->getLocale()]);
    @endphp
    {!! __('public.saved.footer_help', ['url' => $savedContactUrl]) !!}
</p>
</div>
</main>
@php
    $savedCarsI18n = [
        'emptyTitle' => __('public.saved.js_empty_title'),
        'emptyBody' => __('public.saved.js_empty_body'),
        'browse' => __('public.saved.js_browse'),
        'savedOnTpl' => __('public.saved.js_saved_on'),
        'savedListing' => __('public.saved.js_saved_listing'),
        'removePrefix' => __('public.saved.js_remove_aria_prefix'),
        'removeSuffix' => __('public.saved.js_remove_aria_suffix'),
        'removeLabel' => __('public.common.remove'),
    ];
@endphp
<script id="saved-cars-i18n" type="application/json">@json($savedCarsI18n)</script>
<x-footer class="mt-16"/>
<x-mobile-nav active="saved"/>
<x-whatsapp-float/>
</body></html>
