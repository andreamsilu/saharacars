<!DOCTYPE html>

<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<x-public-seo
    :title="__('public.meta.contact_title', ['company' => config('sahara.legal_entity_name')])"
    :description="__('public.cars.page_description_fallback', ['company' => config('sahara.legal_entity_name')])"
    :canonical="route('contact', ['locale' => app()->getLocale()])"
/>
<x-public-head-assets />
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
<script src="https://cdn.tailwindcss.com"></script>
<style>
      @include('components.public-typography-tokens')
      @include('components.public-effects-tokens')
      @include('components.public-design-tokens')
      @include('components.public-a11y-tokens')
    </style>
</head>
<body class="bg-surface font-body text-on-surface attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
@php
    $contactWaDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
    $contactPhoneLabel = \App\Support\PhoneDisplay::tzMobileLabel($contactWaDigits);
    $contactSupportEmail = (string) config('sahara.support_email');
    $contactSiteUrl = (string) config('sahara.public_site_url');
    $contactInstagramUrl = trim((string) config('sahara.instagram_url'));
    $contactInstagramLabel = trim((string) config('sahara.instagram_label'));
    $contactLocationLabel = (string) config('sahara.primary_location_label');
    $contactLegalName = (string) config('sahara.legal_entity_name');
    $contactSiteHost = parse_url($contactSiteUrl, PHP_URL_HOST) ?: $contactSiteUrl;
    $contactMapEmbedSrc = \App\Support\GoogleMapEmbed::allowedEmbedSrc((string) config('sahara.contact_map_embed_url'));
    $contactMapDirectionsUrl = \App\Support\GoogleMapEmbed::allowedMapsLink((string) config('sahara.contact_map_directions_url'));
    $officeLandmarksFromConfig = trim((string) config('sahara.office_location_notes'));
    $officeLandmarksDisplay = $officeLandmarksFromConfig !== ''
        ? $officeLandmarksFromConfig
        : __('public.contact.office_landmarks');
@endphp
<!-- Top Navigation Bar -->
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none max-w-7xl mx-auto px-4 sm:px-6 section-editorial-compact">
<!-- Hero Header -->
<header class="mb-14 md:mb-16 text-center md:text-left">
<h1 class="font-headline text-[clamp(2rem,7vw,4.5rem)] md:text-7xl font-extrabold text-primary tracking-tighter mb-4 leading-[1.1] text-balance">{{ __('public.contact.hero_title') }}</h1>
<p class="text-on-surface-variant max-w-2xl text-lg leading-relaxed">{{ __('public.contact.hero_subtitle') }}</p>
</header>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<!-- Contact Form Card -->
<section class="sahara-live-panel md:col-span-7 bg-surface-container-lowest rounded-xl p-5 sm:p-6 md:p-8 shadow-sm attention-panel">
<h2 class="font-headline text-2xl font-bold text-primary mb-8">{{ __('public.contact.form_heading') }}</h2>
@if (session('status'))
<div class="mb-6 rounded-xl bg-green-500/10 p-4 text-sm text-green-900 ghost-border">
{{ session('status') }}
</div>
@endif
@if ($errors->any())
<div class="mb-6 rounded-xl bg-red-500/10 p-4 text-sm text-red-900 ghost-border">
<ul class="list-disc pl-5 space-y-1">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form class="space-y-6" method="POST" action="{{ route('contact.store') }}">
@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="space-y-2">
<label for="contact-full-name" class="font-label text-xs font-semibold uppercase tracking-widest text-on-surface-variant ml-1">{{ __('public.contact.label_full_name') }}</label>
<input id="contact-full-name" class="w-full bg-surface-container-highest rounded-lg p-4 focus:ring-2 focus:ring-primary/40 focus:bg-surface-container-lowest transition-all placeholder:text-outline/50 ghost-border" placeholder="{{ __('public.contact.placeholder_full_name') }}" type="text" name="full_name" value="{{ old('full_name') }}" required autocomplete="name"/>
</div>
<div class="space-y-2">
<label for="contact-email" class="font-label text-xs font-semibold uppercase tracking-widest text-on-surface-variant ml-1">{{ __('public.contact.label_email') }}</label>
<input id="contact-email" class="w-full bg-surface-container-highest rounded-lg p-4 focus:ring-2 focus:ring-primary/40 focus:bg-surface-container-lowest transition-all placeholder:text-outline/50 ghost-border" placeholder="{{ __('public.contact.placeholder_email') }}" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"/>
</div>
</div>
<div class="space-y-2">
<label for="contact-subject" class="font-label text-xs font-semibold uppercase tracking-widest text-on-surface-variant ml-1">{{ __('public.contact.label_subject') }}</label>
<select id="contact-subject" class="w-full bg-surface-container-highest rounded-lg p-4 focus:ring-2 focus:ring-primary/40 focus:bg-surface-container-lowest transition-all ghost-border" name="subject">
<option>{{ __('public.contact.subject_car') }}</option>
<option>{{ __('public.contact.subject_selling') }}</option>
<option>{{ __('public.contact.subject_partnership') }}</option>
<option>{{ __('public.contact.subject_support') }}</option>
</select>
</div>
<div class="space-y-2">
<label for="contact-message" class="font-label text-xs font-semibold uppercase tracking-widest text-on-surface-variant ml-1">{{ __('public.contact.label_message') }}</label>
<textarea id="contact-message" class="w-full bg-surface-container-highest rounded-lg p-4 focus:ring-2 focus:ring-primary/40 focus:bg-surface-container-lowest transition-all placeholder:text-outline/50 ghost-border" placeholder="{{ __('public.contact.placeholder_message') }}" rows="5" name="message" required>{{ old('message') }}</textarea>
</div>
<button class="sahara-live-cta w-full cta-gradient text-on-primary py-4 min-h-[52px] rounded-full font-headline font-bold text-lg transition-[filter,transform] hover:brightness-110 shadow-lg shadow-primary/10 active:scale-95 duration-150 focus-ring-on-dark" type="submit">
                        {{ __('public.contact.submit') }}
                    </button>
</form>
</section>
<!-- Location & Hours Side Cards -->
<div class="md:col-span-5 space-y-6">
<!-- Quick Contact Card -->
<div class="sahara-live-panel bg-primary text-on-primary rounded-xl p-5 sm:p-6 md:p-8 relative overflow-hidden group attention-panel">
<div class="relative z-10">
<h3 class="font-headline text-xl font-bold mb-6">{{ __('public.contact.immediate_support') }}</h3>
<div class="space-y-6">
<a class="flex items-center gap-4 group/btn p-3 -m-3 hover:bg-white/10 rounded-xl transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="https://wa.me/{{ $contactWaDigits }}" aria-label="{{ __('public.contact.wa_aria', ['brand' => config('marketplace.name')]) }}">
<div class="w-12 h-12 bg-secondary flex items-center justify-center rounded-full">
<svg viewBox="0 0 32 32" aria-hidden="true" class="w-6 h-6 fill-current text-white">
<path d="M19.11 17.34c-.29-.14-1.69-.83-1.95-.92-.26-.1-.45-.14-.64.15-.18.29-.74.92-.9 1.1-.17.19-.33.22-.62.07-.29-.14-1.2-.44-2.29-1.39-.84-.75-1.42-1.68-1.58-1.96-.17-.29-.02-.44.12-.58.13-.13.29-.33.44-.5.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.08-.14-.64-1.55-.88-2.13-.23-.55-.46-.47-.64-.48h-.55c-.19 0-.5.07-.76.36-.26.29-1 1-.95 2.43.05 1.43 1 2.81 1.14 3 .14.19 1.95 2.98 4.72 4.17.66.29 1.17.46 1.57.59.66.21 1.27.18 1.75.11.53-.08 1.69-.69 1.93-1.35.24-.67.24-1.24.17-1.35-.08-.11-.27-.18-.55-.33z"/>
<path d="M16.02 3.2c-7.05 0-12.77 5.72-12.77 12.77 0 2.25.59 4.45 1.71 6.39L3.2 28.8l6.6-1.73c1.86 1.01 3.95 1.54 6.09 1.54h.01c7.05 0 12.77-5.72 12.77-12.77 0-3.42-1.33-6.63-3.76-9.05A12.67 12.67 0 0 0 16.02 3.2zm-.12 23.3h-.01c-1.91 0-3.78-.51-5.41-1.48l-.39-.23-3.92 1.03 1.05-3.82-.25-.39a10.58 10.58 0 0 1-1.62-5.65c0-5.86 4.77-10.62 10.63-10.62 2.84 0 5.51 1.1 7.51 3.11a10.54 10.54 0 0 1 3.1 7.51c0 5.86-4.77 10.62-10.62 10.62z"/>
</svg>
</div>
<div>
<p class="font-label text-[10px] uppercase tracking-widest opacity-70">{{ __('public.contact.label_whatsapp') }}</p>
<p class="font-headline font-bold">{{ $contactPhoneLabel }}</p>
</div>
</a>
<a class="flex items-center gap-4 group/btn p-3 -m-3 hover:bg-white/10 rounded-xl transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="mailto:{{ $contactSupportEmail }}" aria-label="{{ __('public.contact.email_aria', ['email' => $contactSupportEmail]) }}">
<div class="w-12 h-12 bg-white/10 flex items-center justify-center rounded-full">
<span class="material-symbols-outlined text-white" aria-hidden="true">mail</span>
</div>
<div>
<p class="font-label text-[10px] uppercase tracking-widest opacity-70">{{ __('public.contact.label_email') }}</p>
<p class="font-headline font-bold">{{ $contactSupportEmail }}</p>
</div>
</a>
<a class="flex items-center gap-4 group/btn p-3 -m-3 hover:bg-white/10 rounded-xl transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ $contactSiteUrl }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __('public.contact.website_aria') }}">
<div class="w-12 h-12 bg-white/10 flex items-center justify-center rounded-full">
<span class="material-symbols-outlined text-white" aria-hidden="true">language</span>
</div>
<div>
<p class="font-label text-[10px] uppercase tracking-widest opacity-70">{{ __('public.contact.label_website') }}</p>
<p class="font-headline font-bold">{{ $contactSiteHost }}</p>
</div>
</a>
@if(filled($contactInstagramUrl))
<a class="flex items-center gap-4 group/btn p-3 -m-3 hover:bg-white/10 rounded-xl transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ $contactInstagramUrl }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __('public.contact.instagram_aria', ['label' => filled($contactInstagramLabel) ? $contactInstagramLabel : '']) }}">
<div class="w-12 h-12 bg-white/10 flex items-center justify-center rounded-full" aria-hidden="true">
<svg class="w-6 h-6 text-white fill-current" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
</div>
<div>
<p class="font-label text-[10px] uppercase tracking-widest opacity-70">{{ __('public.contact.label_instagram') }}</p>
<p class="font-headline font-bold">{{ filled($contactInstagramLabel) ? $contactInstagramLabel : config('sahara.instagram_fallback_caption') }}</p>
</div>
</a>
@endif
</div>
</div>
<div class="absolute -bottom-10 -right-10 opacity-10 transform group-hover:scale-110 transition-transform duration-500" aria-hidden="true">
<span class="material-symbols-outlined text-[180px]" style="font-variation-settings: 'FILL' 1;">directions_car</span>
</div>
</div>
<!-- Office Hours Card -->
<div class="bg-surface-container-low rounded-xl p-5 sm:p-6 md:p-8 attention-panel">
<h3 class="font-headline text-xl font-bold text-primary mb-6">{{ __('public.contact.hours_title') }}</h3>
<div class="space-y-4">
<div class="flex justify-between items-center py-2">
<span class="text-on-surface-variant font-medium">{{ __('public.contact.hours_weekdays') }}</span>
<span class="text-primary font-bold">08:00 - 18:00</span>
</div>
<div class="flex justify-between items-center py-2">
<span class="text-on-surface-variant font-medium">{{ __('public.contact.hours_saturday') }}</span>
<span class="text-primary font-bold">09:00 - 16:00</span>
</div>
<div class="flex justify-between items-center py-2">
<span class="text-on-surface-variant font-medium">{{ __('public.contact.hours_sunday') }}</span>
<span class="text-secondary font-bold">{{ __('public.contact.hours_closed') }}</span>
</div>
</div>
</div>
</div>
</div>
<!-- Location Section (Asymmetric) -->
<section class="mt-20 md:mt-24 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
<div class="lg:col-span-4 text-center lg:text-left">
<div class="inline-block px-4 py-1.5 bg-secondary-container text-on-secondary-container rounded-full font-label text-[10px] uppercase font-bold tracking-widest mb-6">{{ __('public.contact.location_badge') }}</div>
<h2 class="font-headline text-3xl sm:text-4xl font-extrabold text-primary mb-6">{{ __('public.contact.location_title') }}</h2>
<p class="text-on-surface-variant mb-8 text-lg leading-relaxed">{{ __('public.contact.location_body') }}</p>
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_16px_24px_rgba(25,28,30,0.04)] flex items-start gap-4">
<span class="material-symbols-outlined text-secondary text-3xl">location_on</span>
<div>
<p class="font-bold text-primary">{{ config('marketplace.name') }}</p>
<p class="text-sm text-on-surface-variant">{{ $contactLegalName }}</p>
<p class="text-sm text-on-surface-variant">{{ $contactLocationLabel }}</p>
<p class="text-sm text-on-surface-variant mt-3 leading-relaxed whitespace-pre-line">{{ $officeLandmarksDisplay }}</p>
</div>
</div>
</div>
<div class="lg:col-span-8 flex flex-col gap-4">
@if ($contactMapEmbedSrc)
<div class="relative w-full min-h-[320px] sm:min-h-[420px] lg:min-h-[500px] rounded-3xl overflow-hidden shadow-2xl border border-outline-variant/30 bg-surface-container-low">
<iframe
    src="{{ $contactMapEmbedSrc }}"
    class="absolute inset-0 w-full h-full border-0"
    title="{{ __('public.contact.map_title') }}"
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    allowfullscreen
></iframe>
</div>
<div class="flex flex-wrap items-center justify-between gap-3">
<p class="text-sm font-bold text-primary inline-flex items-center gap-2">
<span class="material-symbols-outlined text-secondary" aria-hidden="true">explore</span>
{{ $contactLocationLabel }}
</p>
@if ($contactMapDirectionsUrl)
<a class="bg-primary text-white px-6 py-2 min-h-[44px] rounded-full font-bold text-sm shadow-lg active:scale-95 transition-all focus-ring-on-dark inline-flex items-center justify-center" href="{{ $contactMapDirectionsUrl }}" target="_blank" rel="noopener noreferrer" aria-label="{{ __('public.contact.directions_aria') }}">
{{ __('public.contact.directions') }}
</a>
@endif
</div>
@else
<div class="h-[320px] sm:h-[420px] lg:h-[500px] rounded-3xl overflow-hidden shadow-2xl relative group bg-surface-container-low">
<div class="absolute inset-0 flex items-center justify-center p-6 text-center text-on-surface-variant text-sm">
{{ __('public.contact.location_body') }}
</div>
</div>
@endif
</div>
</section>
</main>
<!-- Footer -->
<x-footer class="mt-20" />
<x-mobile-nav active="contact" />
<x-whatsapp-float />
</body></html>

