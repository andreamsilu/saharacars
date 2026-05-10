<!DOCTYPE html>

<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<x-public-seo
    :title="$pageTitle"
    :description="$pageDescription"
    :canonical="$car->publicShowUrl()"
    type="product"
    :image="$car->hero_image_path ? asset('storage/'.$car->hero_image_path) : null"
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
                        "on-primary": "#ffffff",
                        "on-background": "#191c1e",
                        "primary": "#8a6528",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e6e8ea",
                        "on-secondary-container": "#007232",
                        "on-surface-variant": "#43474f",
                        "surface-container-highest": "#e0e3e5",
                        "secondary-container": "#5dfd8a",
                        "background": "#f3f3f3",
                        "secondary": "#25D366",
                        "surface-container": "#eceef0",
                        "surface": "#f3f3f3",
                        "outline": "#737780",
                        "outline-variant": "#c3c6d1",
                        "on-surface": "#191c1e",
                        "surface-container-low": "#f2f4f6",
                        "on-primary-container": "#ffffff",
                        "error": "#ba1a1a"
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
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
    @php
        $hero = $car->hero_image_path ? asset('storage/'.$car->hero_image_path) : asset('images/home-showroom-premium-960.jpg');
        $listingWaHref = $waPhone !== '' ? 'https://wa.me/'.$waPhone.'?text='.rawurlencode($waListingMessage) : null;
    @endphp
    <article class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
        <div class="lg:col-span-7 space-y-6">
            <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-surface-container-high shadow-lg">
                <img src="{{ $hero }}" alt="{{ $car->title }}" class="w-full h-full object-cover" width="1200" height="750" />
            </div>
            @if ($car->description)
                <div class="max-w-none text-on-surface-variant">
                    <h2 class="font-headline text-xl font-bold text-primary">Details</h2>
                    <p class="whitespace-pre-line mt-2">{{ $car->description }}</p>
                </div>
            @endif
        </div>
        <aside class="lg:col-span-5 space-y-6">
            <div class="sahara-live-panel bg-white rounded-2xl p-6 shadow-[0_16px_40px_rgba(25,28,30,0.08)] border border-outline-variant/20">
                <h1 class="font-headline text-2xl sm:text-3xl font-black text-primary tracking-tight">{{ $car->title }}</h1>
                <p class="text-2xl font-extrabold text-emerald-700 tabular-nums mt-4">
                    {{ $car->price_tzs ? ('TZS '.number_format($car->price_tzs)) : __('public.car_card.contact') }}
                </p>
                @if ($car->location)
                    <p class="text-sm text-on-surface-variant mt-2 flex items-center gap-1">
                        <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
                        {{ $car->location }}
                    </p>
                @endif
                <div class="flex flex-wrap gap-2 mt-6">
                    <button
                        type="button"
                        class="inline-flex items-center justify-center min-h-[44px] min-w-[44px] rounded-full border border-outline-variant/60 p-2"
                        data-saved-car-toggle
                        data-car-id="{{ $car->id }}"
                        data-slug="{{ $car->slug }}"
                        data-title="{{ $car->title }}"
                        aria-pressed="false"
                        aria-label="{{ __('public.car_card.aria_save', ['title' => $car->title]) }}"
                    >
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 0;">favorite</span>
                    </button>
                </div>
                @if ($listingWaHref)
                    <a href="{{ $listingWaHref }}" class="mt-6 w-full inline-flex items-center justify-center gap-2 min-h-[52px] rounded-full bg-secondary text-white font-bold px-6 py-3 shadow-lg shadow-secondary/25 hover:brightness-110 transition-[filter]" rel="noopener noreferrer" target="_blank">
                        <span class="material-symbols-outlined">chat</span>
                        WhatsApp
                    </a>
                @endif
            </div>
        </aside>
    </article>

    @if ($related->isNotEmpty())
        <section class="mt-16 border-t border-outline-variant/30 pt-12" aria-labelledby="related-heading">
            <h2 id="related-heading" class="font-headline text-2xl font-bold text-primary mb-6">Related listings</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                @foreach ($related as $rel)
                    <x-car-card :car="$rel" :compact="true" />
                @endforeach
            </div>
        </section>
    @endif
</main>
<x-footer class="mt-20" />
<x-mobile-nav active="inventory" />
<x-whatsapp-float />
</body></html>
