<!DOCTYPE html>

<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<title>Saved Cars | Sahara Cars Tanzania</title>
<meta name="description" content="Cars you saved while browsing. Stored on this device — no account required."/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
<main id="main-content" tabindex="-1" class="outline-none max-w-3xl mx-auto px-4 sm:px-6 section-editorial-compact">
<header class="mb-8">
<p class="font-label text-[10px] uppercase tracking-widest text-secondary font-bold mb-2">Your shortlist</p>
<h1 class="font-headline text-[clamp(1.75rem,5vw,2.5rem)] font-black text-primary tracking-tight">Saved cars</h1>
<p class="text-on-surface-variant mt-3 leading-relaxed">Listings you heart while browsing stay here on <strong>this device only</strong>. Clearing browser data removes them — optional accounts can come later.</p>
</header>
<div class="bg-surface-container-lowest rounded-2xl p-6 md:p-8 shadow-sm attention-panel">
<h2 class="font-headline text-lg font-bold text-primary mb-4">Your picks</h2>
<ul
    id="saved-cars-render-list"
    class="list-none m-0 p-0"
    data-cars-base-url="{{ rtrim(url('/cars'), '/') }}/"
></ul>
<p class="text-sm text-on-surface-variant mt-6">
<a class="text-primary font-bold underline" href="{{ route('cars.index') }}">Browse inventory</a>
            ·
            <a class="text-primary font-bold underline" href="{{ route('contact') }}">Contact us</a>
</p>
</div>
</main>
<x-footer class="mt-16"/>
<x-mobile-nav active="saved"/>
<x-whatsapp-float/>
</body></html>
