<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<title>{{ e($pageTitle) }}</title>
<meta name="description" content="{{ e($pageDescription) }}"/>
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
              "secondary-fixed": "#66ff8e",
              "on-secondary-container": "#007232",
              "on-primary-fixed-variant": "#4a3614",
              "on-surface-variant": "#43474f",
              "on-tertiary-fixed-variant": "#723610",
              "surface-container-highest": "#e0e3e5",
              "secondary-container": "#5dfd8a",
              "tertiary-fixed": "#ffdbca",
              "surface-variant": "#e0e3e5",
              "on-secondary-fixed-variant": "#005322",
              "tertiary-container": "#592300",
              "on-tertiary": "#ffffff",
              "background": "#f3f3f3",
              "inverse-on-surface": "#eff1f3",
              "surface-tint": "#8a6528",
              "secondary": "#006d2f",
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
              "on-secondary-fixed": "#002109",
              "on-surface": "#191c1e",
              "primary-fixed-dim": "#d4b57a",
              "on-tertiary-fixed": "#341100",
              "inverse-primary": "#e8c889",
              "on-secondary": "#ffffff",
              "on-primary-container": "#f4e4c4",
              "surface-container-low": "#f2f4f6",
              "secondary-fixed-dim": "#3de273"
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
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      @include('components.public-effects-tokens')
      @include('components.public-design-tokens')
      @include('components.public-a11y-tokens')
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<!-- TopNavBar -->
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
<!-- Breadcrumbs -->
<nav class="flex items-center gap-2 text-xs font-label uppercase tracking-widest text-outline mb-6 min-w-0" aria-label="Breadcrumb">
<a class="hover:text-primary transition-colors rounded-sm focus-visible:ring-2 focus-visible:ring-primary" href="{{ route('cars.index') }}">Inventory</a>
<span class="material-symbols-outlined text-[12px]" aria-hidden="true">chevron_right</span>
<span class="text-on-surface font-bold truncate">{{ $car->title }}</span>
</nav>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- Left Column: Gallery & Details -->
<div class="lg:col-span-8 space-y-8">
<!-- Interactive car gallery -->
@php
  $conditionLabels = [
    'brand_new' => 'Brand New',
    'foreign_used' => 'Foreign Used',
    'local_used' => 'Locally Used',
  ];
  $conditionText = $conditionLabels[$car->condition] ?? '—';
  $hero = $car->hero_image_path ? asset('storage/' . $car->hero_image_path) : 'https://placehold.co/1400x900?text=Sahara+Cars';

  $frontImages = is_array($car->front_image_paths) ? $car->front_image_paths : array_filter([$car->front_image_path]);
  $rearImages = is_array($car->rear_image_paths) ? $car->rear_image_paths : array_filter([$car->rear_image_path]);
  $sideImages = is_array($car->side_image_paths) ? $car->side_image_paths : array_filter([$car->side_image_path]);
  $interiorImages = is_array($car->interior_image_paths) ? $car->interior_image_paths : array_filter([$car->interior_image_path]);
  $galleryImages = is_array($car->gallery_image_paths) ? $car->gallery_image_paths : [];

  $viewBuckets = [
    'front' => $frontImages,
    'rear' => $rearImages,
    'side' => $sideImages,
    'interior' => $interiorImages,
    'gallery' => $galleryImages,
  ];

  $allImages = [];
  foreach ($viewBuckets as $category => $paths) {
      foreach ($paths as $path) {
          if (is_string($path) && $path !== '') {
              $allImages[] = ['src' => asset('storage/' . $path), 'category' => $category];
          }
      }
  }
  if (empty($allImages)) {
      $allImages[] = ['src' => $hero, 'category' => 'hero'];
  }
@endphp
<section class="bg-surface-container-lowest rounded-2xl p-4 md:p-6 shadow-[0_16px_24px_rgba(25,28,30,0.04)] attention-panel">
  <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <h3 class="font-headline text-lg font-bold">Vehicle gallery</h3>
    <p class="text-xs text-on-surface-variant"><span id="gallery-current">1</span> / <span id="gallery-total">{{ count($allImages) }}</span></p>
  </div>

  <div class="flex flex-wrap gap-2 mb-4" role="tablist" aria-label="Image categories">
    @php
      $tabs = [
        ['key' => 'all', 'label' => 'All', 'count' => count($allImages)],
        ['key' => 'front', 'label' => 'Front', 'count' => count($frontImages)],
        ['key' => 'rear', 'label' => 'Rear', 'count' => count($rearImages)],
        ['key' => 'side', 'label' => 'Side', 'count' => count($sideImages)],
        ['key' => 'interior', 'label' => 'Interior', 'count' => count($interiorImages)],
      ];
    @endphp
    @foreach ($tabs as $tab)
      <button
        type="button"
        class="gallery-tab px-3 py-1.5 rounded-full text-xs font-bold bg-surface-container-low text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary/30 ghost-border"
        data-filter="{{ $tab['key'] }}"
        role="tab"
        aria-selected="{{ $tab['key'] === 'all' ? 'true' : 'false' }}"
      >
        {{ $tab['label'] }} ({{ $tab['count'] }})
      </button>
    @endforeach
  </div>

  <div class="relative overflow-hidden rounded-xl bg-surface-dim aspect-[16/10]">
    <img id="gallery-main-image" src="{{ $allImages[0]['src'] }}" alt="{{ $car->title }}" class="w-full h-full object-cover" />
    <button type="button" id="gallery-open-lightbox" class="absolute right-3 bottom-3 glass-effect bg-surface-container-lowest/70 rounded-full px-3 py-2 min-h-[44px] text-xs font-bold flex items-center gap-1.5 hover:bg-surface-container-lowest focus-visible:ring-2 focus-visible:ring-primary" aria-label="Open car images in fullscreen gallery">
      <span class="material-symbols-outlined text-sm" aria-hidden="true">fullscreen</span>
      Fullscreen
    </button>
  </div>

  <div id="gallery-thumbs" class="mt-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2">
    @foreach ($allImages as $idx => $img)
      <button
        type="button"
        class="gallery-thumb relative rounded-lg overflow-hidden focus:outline-none focus:ring-2 focus:ring-primary/30 ghost-border {{ $idx === 0 ? 'ring-2 ring-primary/40' : '' }}"
        data-index="{{ $idx }}"
        data-src="{{ $img['src'] }}"
        data-category="{{ $img['category'] }}"
        aria-label="View image {{ $idx + 1 }}"
      >
        <img src="{{ $img['src'] }}" alt="{{ $car->title }} thumbnail {{ $idx + 1 }}" class="w-full h-20 object-cover" />
        <span class="absolute left-1 top-1 text-[9px] uppercase tracking-wider bg-black/60 text-white px-1.5 py-0.5 rounded">{{ $img['category'] }}</span>
      </button>
    @endforeach
  </div>
</section>
<!-- Core Specs Grid -->
<section class="grid grid-cols-2 md:grid-cols-5 gap-4">
<div class="bg-surface-container-low p-6 rounded-xl flex flex-col gap-2">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 0;">calendar_today</span>
<span class="text-[10px] font-label uppercase tracking-widest text-outline">Year</span>
<span class="font-headline font-bold text-lg">{{ $car->year ?: '—' }}</span>
</div>
<div class="bg-surface-container-low p-6 rounded-xl flex flex-col gap-2">
<span class="material-symbols-outlined text-primary">speed</span>
<span class="text-[10px] font-label uppercase tracking-widest text-outline">Mileage</span>
<span class="font-headline font-bold text-lg">{{ $car->mileage_km ? number_format($car->mileage_km) . ' KM' : '—' }}</span>
</div>
<div class="bg-surface-container-low p-6 rounded-xl flex flex-col gap-2">
<span class="material-symbols-outlined text-primary">settings_suggest</span>
<span class="text-[10px] font-label uppercase tracking-widest text-outline">Transmission</span>
<span class="font-headline font-bold text-lg">{{ $car->transmission ?: '—' }}</span>
</div>
<div class="bg-surface-container-low p-6 rounded-xl flex flex-col gap-2">
<span class="material-symbols-outlined text-primary">ev_station</span>
<span class="text-[10px] font-label uppercase tracking-widest text-outline">Fuel Type</span>
<span class="font-headline font-bold text-lg">{{ $car->fuel ?: '—' }}</span>
</div>
<div class="bg-surface-container-low p-6 rounded-xl flex flex-col gap-2">
<span class="material-symbols-outlined text-primary">checklist</span>
<span class="text-[10px] font-label uppercase tracking-widest text-outline">Condition</span>
<span class="font-headline font-bold text-lg">{{ $conditionText }}</span>
</div>
<div class="bg-surface-container-low p-6 rounded-xl flex flex-col gap-2">
<span class="material-symbols-outlined text-primary">precision_manufacturing</span>
<span class="text-[10px] font-label uppercase tracking-widest text-outline">Engine Capacity</span>
<span class="font-headline font-bold text-lg">
{{ $car->engine_capacity_cc ? number_format($car->engine_capacity_cc) . ' cc' : ($car->engine ?: '—') }}
</span>
</div>
</section>
@php
    $detail = static fn ($v): string => ($v === null || $v === '') ? '—' : (string) $v;
    $carDetails = [
        ['label' => 'Make', 'value' => $car->brand],
        ['label' => 'Model', 'value' => $car->model],
        ['label' => 'Body color', 'value' => $car->body_color],
        ['label' => 'Body type', 'value' => $car->body_type],
        ['label' => 'Doors', 'value' => $car->doors],
        ['label' => 'Seats', 'value' => $car->seats],
    ];
    $hasCarDetails = collect($carDetails)->contains(fn ($row) => $row['value'] !== null && $row['value'] !== '');
@endphp
@if ($hasCarDetails)
<section class="bg-surface-container-lowest p-5 sm:p-6 md:p-8 rounded-xl shadow-[0_16px_24px_rgba(25,28,30,0.04)] attention-panel" aria-labelledby="car-details-heading">
<h2 id="car-details-heading" class="font-headline text-2xl font-extrabold mb-2 tracking-tight text-primary">Car details</h2>
<p class="text-sm text-on-surface-variant mb-6">As provided by our listing team from import and inspection records.</p>
<dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
@foreach ($carDetails as $row)
<div class="flex flex-col gap-1 border-b border-outline-variant/20 pb-3 sm:border-0 sm:pb-0">
<dt class="font-label text-[10px] font-bold uppercase tracking-widest text-outline">{{ $row['label'] }}</dt>
<dd class="font-headline text-lg font-bold text-on-surface">{{ $detail($row['value']) }}</dd>
</div>
@endforeach
</dl>
</section>
@endif
<!-- Vehicle Description -->
<section class="bg-surface-container-lowest p-5 sm:p-6 md:p-8 rounded-xl shadow-[0_16px_24px_rgba(25,28,30,0.04)] attention-panel">
<h2 class="font-headline text-2xl font-extrabold mb-6 tracking-tight">Vehicle Description</h2>
<div class="space-y-4 text-on-surface-variant leading-relaxed font-body">
@if (!empty($car->description))
<p class="whitespace-pre-line">{{ $car->description }}</p>
@else
<p>No description provided yet.</p>
@endif
</div>
</section>
<!-- Detailed Specs List -->
<section>
<h3 class="font-headline text-xl font-bold mb-6">Technical Specifications</h3>
<div class="bg-surface-container-low rounded-2xl overflow-hidden">
<div class="grid grid-cols-2 md:grid-cols-3 gap-px bg-surface-container-high">
<div class="bg-surface-container-low p-6">
<span class="text-[10px] font-label uppercase tracking-widest text-outline block mb-1">Engine</span>
<span class="font-bold">{{ $car->engine ?: '—' }}</span>
</div>
<div class="bg-surface-container-low p-6">
<span class="text-[10px] font-label uppercase tracking-widest text-outline block mb-1">Transmission</span>
<span class="font-bold">{{ $car->transmission ?: '—' }}</span>
</div>
<div class="bg-surface-container-low p-6">
<span class="text-[10px] font-label uppercase tracking-widest text-outline block mb-1">Fuel</span>
<span class="font-bold">{{ $car->fuel ?: '—' }}</span>
</div>
<div class="bg-surface-container-low p-6">
<span class="text-[10px] font-label uppercase tracking-widest text-outline block mb-1">Engine Capacity</span>
<span class="font-bold">{{ $car->engine_capacity_cc ? number_format($car->engine_capacity_cc) . ' cc' : '—' }}</span>
</div>
<div class="bg-surface-container-low p-6">
<span class="text-[10px] font-label uppercase tracking-widest text-outline block mb-1">Mileage</span>
<span class="font-bold">{{ $car->mileage_km ? number_format($car->mileage_km) . ' KM' : '—' }}</span>
</div>
<div class="bg-surface-container-low p-6">
<span class="text-[10px] font-label uppercase tracking-widest text-outline block mb-1">Condition</span>
<span class="font-bold">{{ $conditionText }}</span>
</div>
</div>
</div>
</section>
</div>
@php
    $listingWaHref = 'https://wa.me/'.$waPhone.'?text='.rawurlencode($waListingMessage);
    $listingTelHref = $waPhone !== '' ? 'tel:+'.$waPhone : 'tel:';
@endphp
<!-- Right Column: Sticky Pricing & Action -->
<div class="lg:col-span-4">
<div class="sticky top-32 space-y-6">
<!-- Pricing Card -->
<div class="sahara-live-panel bg-white p-5 sm:p-6 md:p-8 rounded-2xl shadow-[0_20px_40px_rgba(92,67,32,0.08)] attention-panel">
<div class="flex justify-between items-start mb-4">
<div>
<h1 class="font-headline text-3xl font-black text-primary tracking-tight">
{{ $car->price_tzs ? ('TZS ' . number_format($car->price_tzs)) : 'Contact for price' }}
</h1>
<p class="text-sm text-outline mt-1">
{{ $car->price_tzs ? (($car->price_is_negotiable ?? true) ? 'Negotiable price' : 'Fixed price') : 'Our team will share pricing details.' }}
</p>
</div>
<button
    type="button"
    class="bg-surface-container-high p-2 min-h-[44px] min-w-[44px] rounded-full hover:bg-error-container/30 hover:text-error transition-colors focus-visible:ring-2 focus-visible:ring-primary"
    data-saved-car-toggle
    data-slug="{{ $car->slug }}"
    data-title="{{ $car->title }}"
    aria-pressed="false"
    aria-label="Save {{ $car->title }} to your list on this device"
>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;" aria-hidden="true">favorite</span>
</button>
</div>
<div class="flex items-center gap-3 py-4 my-6 bg-surface-container-low rounded-xl px-4">
<span class="material-symbols-outlined text-primary">location_on</span>
<div class="text-sm">
<p class="font-bold">{{ $car->location ?: 'Tanzania' }}</p>
<p class="text-outline text-xs">Sales center: Dar es Salaam</p>
</div>
</div>
<div class="space-y-3">
<a class="sahara-live-cta w-full bg-secondary text-white font-bold py-4 min-h-[52px] rounded-full flex items-center justify-center gap-2 transition-[filter,transform] hover:brightness-110 active:scale-95 shadow-lg shadow-secondary/20 focus-ring-on-dark [&_svg]:text-white"
   href="{{ $listingWaHref }}"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="Chat on WhatsApp about this car">
<svg viewBox="0 0 32 32" aria-hidden="true" class="w-5 h-5 fill-current">
<path d="M19.11 17.34c-.29-.14-1.69-.83-1.95-.92-.26-.1-.45-.14-.64.15-.18.29-.74.92-.9 1.1-.17.19-.33.22-.62.07-.29-.14-1.2-.44-2.29-1.39-.84-.75-1.42-1.68-1.58-1.96-.17-.29-.02-.44.12-.58.13-.13.29-.33.44-.5.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.08-.14-.64-1.55-.88-2.13-.23-.55-.46-.47-.64-.48h-.55c-.19 0-.5.07-.76.36-.26.29-1 1-.95 2.43.05 1.43 1 2.81 1.14 3 .14.19 1.95 2.98 4.72 4.17.66.29 1.17.46 1.57.59.66.21 1.27.18 1.75.11.53-.08 1.69-.69 1.93-1.35.24-.67.24-1.24.17-1.35-.08-.11-.27-.18-.55-.33z"/>
<path d="M16.02 3.2c-7.05 0-12.77 5.72-12.77 12.77 0 2.25.59 4.45 1.71 6.39L3.2 28.8l6.6-1.73c1.86 1.01 3.95 1.54 6.09 1.54h.01c7.05 0 12.77-5.72 12.77-12.77 0-3.42-1.33-6.63-3.76-9.05A12.67 12.67 0 0 0 16.02 3.2zm-.12 23.3h-.01c-1.91 0-3.78-.51-5.41-1.48l-.39-.23-3.92 1.03 1.05-3.82-.25-.39a10.58 10.58 0 0 1-1.62-5.65c0-5.86 4.77-10.62 10.63-10.62 2.84 0 5.51 1.1 7.51 3.11a10.54 10.54 0 0 1 3.1 7.51c0 5.86-4.77 10.62-10.62 10.62z"/>
</svg>
                                Chat on WhatsApp
                            </a>
<a class="sahara-live-cta w-full cta-gradient text-white font-bold py-4 min-h-[52px] rounded-full flex items-center justify-center gap-2 transition-[filter,transform] hover:brightness-110 active:scale-95 focus-ring-on-dark [&_.material-symbols-outlined]:text-white" href="{{ $listingTelHref }}" aria-label="Call Sahara Cars on the phone">
<span class="material-symbols-outlined" aria-hidden="true">call</span>
                                Call now
                            </a>
<a class="sahara-live-cta w-full bg-surface-container-low text-primary font-bold py-4 min-h-[52px] rounded-full flex items-center justify-center gap-2 border border-outline-variant/40 transition-[filter,transform] hover:brightness-95 active:scale-95 focus-visible:ring-2 focus-visible:ring-primary" href="{{ route('order.request') }}">
<span class="material-symbols-outlined" aria-hidden="true">inventory_2</span>
                                Request Similar Import
                            </a>
<a class="w-full text-center text-sm font-semibold text-primary underline underline-offset-2 py-2 min-h-[44px] rounded-lg focus-visible:ring-2 focus-visible:ring-primary" href="{{ route('contact') }}">Prefer email or a form?</a>
</div>
</div>
</div>
</div>
</div>
<!-- Related Vehicles Section -->
<section class="mt-20">
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-8">
<div class="text-center sm:text-left">
<h3 class="font-headline text-2xl font-black text-primary tracking-tight">Similar Premium SUVs</h3>
<p class="text-on-surface-variant">Recommended for you based on this unit</p>
</div>
<a class="text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all" href="{{ route('cars.index') }}">
                    View Gallery <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
<div class="sahara-stagger-children grid grid-cols-1 md:grid-cols-3 gap-6">
@forelse ($related as $rel)
<a class="bg-surface-container-lowest rounded-2xl overflow-hidden group shadow-sm hover:shadow-xl transition-all block" href="{{ route('cars.show', ['slug' => $rel->slug]) }}">
<div class="aspect-[16/10] overflow-hidden relative bg-surface-dim">
@php
  $relImg = $rel->hero_image_path ? asset('storage/' . $rel->hero_image_path) : 'https://placehold.co/1200x800?text=Sahara+Cars';
@endphp
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $rel->title }}" src="{{ $relImg }}"/>
</div>
<div class="p-6">
<h4 class="font-headline font-bold text-lg mb-1 group-hover:text-primary transition-colors">{{ $rel->title }}</h4>
<div class="flex gap-4 text-xs text-outline mb-4 font-label tracking-wide">
<span>{{ $rel->year ?: '—' }}</span>
<span>{{ $rel->fuel ?: '—' }}</span>
<span>{{ $rel->mileage_km ? number_format($rel->mileage_km) . ' KM' : '—' }}</span>
</div>
<div class="flex justify-between items-center pt-4">
<span class="font-headline font-extrabold text-primary text-xl">{{ $rel->price_tzs ? ('TZS ' . number_format($rel->price_tzs)) : 'Contact' }}</span>
<span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">arrow_outward</span>
</div>
</div>
</a>
@empty
<div class="md:col-span-3 text-on-surface-variant">No related cars yet.</div>
@endforelse
</div>
</section>
</main>
<!-- Footer -->
<x-footer class="mt-20" />
<x-mobile-nav active="inventory" />
<x-whatsapp-float :text="$waListingMessage" />
<div id="gallery-lightbox" class="fixed inset-0 z-[70] hidden bg-black/85 p-4 md:p-8" role="dialog" aria-modal="true" aria-labelledby="gallery-lightbox-title" aria-hidden="true">
  <div class="w-full h-full flex flex-col">
    <div class="flex items-center justify-between text-white mb-4">
      <p id="gallery-lightbox-title" class="text-sm font-bold">Image <span id="lightbox-current">1</span> / <span id="lightbox-total">{{ count($allImages) }}</span></p>
      <button type="button" id="gallery-close-lightbox" class="rounded-full p-2 hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-white/60" aria-label="Close gallery">
        <span class="material-symbols-outlined">close</span>
      </button>
    </div>
    <div class="relative flex-1 min-h-0 rounded-xl overflow-hidden bg-black/40">
      <img id="lightbox-image" src="{{ $allImages[0]['src'] }}" alt="{{ $car->title }}" class="w-full h-full object-contain" />
      <button type="button" id="lightbox-prev" class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full p-2 bg-black/50 text-white hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white/60" aria-label="Previous image">
        <span class="material-symbols-outlined">chevron_left</span>
      </button>
      <button type="button" id="lightbox-next" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full p-2 bg-black/50 text-white hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white/60" aria-label="Next image">
        <span class="material-symbols-outlined">chevron_right</span>
      </button>
    </div>
  </div>
</div>
<script>
  (() => {
    const thumbs = [...document.querySelectorAll('.gallery-thumb')];
    const tabs = [...document.querySelectorAll('.gallery-tab')];
    const mainImg = document.getElementById('gallery-main-image');
    const current = document.getElementById('gallery-current');
    const total = document.getElementById('gallery-total');
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-image');
    const lightboxCurrent = document.getElementById('lightbox-current');
    const lightboxTotal = document.getElementById('lightbox-total');
    const openBtn = document.getElementById('gallery-open-lightbox');
    const closeBtn = document.getElementById('gallery-close-lightbox');
    const prevBtn = document.getElementById('lightbox-prev');
    const nextBtn = document.getElementById('lightbox-next');

    if (!thumbs.length || !mainImg) return;

    let activeFilter = 'all';
    let activeIndex = Number(thumbs[0].dataset.index || 0);

    const visibleThumbs = () => thumbs.filter((t) => !t.classList.contains('hidden'));

    const renderActive = () => {
      const active = thumbs.find((t) => Number(t.dataset.index) === activeIndex) || visibleThumbs()[0];
      if (!active) return;
      activeIndex = Number(active.dataset.index);
      const src = active.dataset.src;
      mainImg.src = src;
      lightboxImg.src = src;
      thumbs.forEach((t) => t.classList.remove('ring-2', 'ring-primary/40'));
      active.classList.add('ring-2', 'ring-primary/40');
      const list = visibleThumbs();
      const pos = Math.max(0, list.findIndex((t) => Number(t.dataset.index) === activeIndex));
      current.textContent = String(pos + 1);
      total.textContent = String(list.length);
      lightboxCurrent.textContent = String(pos + 1);
      lightboxTotal.textContent = String(list.length);
    };

    tabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        activeFilter = tab.dataset.filter || 'all';
        tabs.forEach((t) => {
          t.setAttribute('aria-selected', 'false');
          t.classList.remove('bg-primary', 'text-white', 'border-primary');
          t.classList.add('bg-surface-container-low', 'text-on-surface-variant');
        });
        tab.setAttribute('aria-selected', 'true');
        tab.classList.add('bg-primary', 'text-white', 'border-primary');
        tab.classList.remove('bg-surface-container-low', 'text-on-surface-variant');

        thumbs.forEach((thumb) => {
          const category = thumb.dataset.category;
          const show = activeFilter === 'all' || category === activeFilter;
          thumb.classList.toggle('hidden', !show);
        });

        const first = visibleThumbs()[0];
        if (!first) return;
        activeIndex = Number(first.dataset.index);
        renderActive();
      });
    });

    thumbs.forEach((thumb) => {
      thumb.addEventListener('click', () => {
        activeIndex = Number(thumb.dataset.index);
        renderActive();
      });
    });

    const step = (dir) => {
      const list = visibleThumbs();
      if (!list.length) return;
      let pos = list.findIndex((t) => Number(t.dataset.index) === activeIndex);
      if (pos < 0) pos = 0;
      pos = (pos + dir + list.length) % list.length;
      activeIndex = Number(list[pos].dataset.index);
      renderActive();
    };

    openBtn?.addEventListener('click', () => {
      lightbox.classList.remove('hidden');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.classList.add('overflow-hidden');
    });
    closeBtn?.addEventListener('click', () => {
      lightbox.classList.add('hidden');
      lightbox.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('overflow-hidden');
    });
    prevBtn?.addEventListener('click', () => step(-1));
    nextBtn?.addEventListener('click', () => step(1));

    document.addEventListener('keydown', (event) => {
      if (event.key === 'ArrowLeft') step(-1);
      if (event.key === 'ArrowRight') step(1);
      if (event.key === 'Escape' && !lightbox.classList.contains('hidden')) {
        lightbox.classList.add('hidden');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
      }
    });

    renderActive();
  })();
</script>
</body></html>

