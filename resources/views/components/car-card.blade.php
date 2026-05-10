@props([
    'car',
    'compact' => false,
])

@php
    /** @var \App\Models\Car $car */
    $img = $car->hero_image_path ? asset('storage/' . $car->hero_image_path) : asset('images/home-showroom-premium-960.jpg');
    $detailUrl = $car->publicShowUrl();
@endphp

@if ($compact)
<div class="sahara-card-motion group bg-surface-container-lowest rounded-lg border border-outline-variant/30 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 relative flex flex-col max-w-full">
    <a
        href="{{ $detailUrl }}"
        class="absolute inset-0 z-10 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-1"
        aria-label="{{ __('site.nav.inventory') }}: {{ $car->title }}"
    ></a>
    <div class="relative aspect-[4/3] max-h-[130px] w-full overflow-hidden bg-surface-container-high">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="" src="{{ $img }}"/>
        <button
            type="button"
            class="absolute top-2 right-2 z-20 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/95 text-primary shadow border border-outline-variant/30 hover:bg-white"
            data-saved-car-toggle
            data-car-id="{{ $car->id }}"
            data-slug="{{ $car->slug }}"
            data-title="{{ $car->title }}"
            aria-pressed="false"
            aria-label="{{ __('site.nav.saved') }}"
        >
            <span class="material-symbols-outlined text-lg text-primary" style="font-variation-settings: 'FILL' 0;" aria-hidden="true">favorite</span>
        </button>
    </div>
    <div class="p-2.5 sm:p-3 text-left flex-1 flex flex-col relative z-20 min-h-0">
        <h3 class="text-[10px] sm:text-[11px] font-extrabold text-primary leading-snug uppercase line-clamp-2 min-h-[1.9rem]">{{ $car->title }}</h3>
        <p class="text-[9px] text-on-surface-variant mt-1.5">TZS</p>
        <p class="text-sm font-extrabold text-emerald-700 tabular-nums leading-tight">
            {{ $car->price_tzs ? number_format($car->price_tzs) : '—' }}
        </p>
    </div>
</div>
@else
<div class="sahara-card-motion group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 relative flex flex-col">
    <a
        href="{{ $detailUrl }}"
        class="absolute inset-0 z-10 rounded-2xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
        aria-label="{{ __('site.nav.inventory') }}: {{ $car->title }}"
    ></a>
    <div class="relative h-56 sm:h-64 overflow-hidden">
        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="" src="{{ $img }}"/>
        <button
            type="button"
            class="absolute top-4 right-4 z-20 inline-flex items-center justify-center min-h-[44px] min-w-[44px] rounded-full bg-white/95 text-primary shadow-md border border-outline-variant/40 hover:bg-white"
            data-saved-car-toggle
            data-car-id="{{ $car->id }}"
            data-slug="{{ $car->slug }}"
            data-title="{{ $car->title }}"
            aria-pressed="false"
            aria-label="{{ __('site.nav.saved') }}"
        >
            <span class="material-symbols-outlined text-[22px] text-primary" style="font-variation-settings: 'FILL' 0;" aria-hidden="true">favorite</span>
        </button>
    </div>
    <div class="p-5 sm:p-6 flex-1 flex flex-col relative z-20">
        <h3 class="font-headline font-bold text-lg text-primary leading-snug line-clamp-2">{{ $car->title }}</h3>
        <p class="mt-3 font-headline font-semibold text-lg text-on-surface tabular-nums">
            {{ $car->price_tzs ? ('TZS '.number_format($car->price_tzs)) : '—' }}
        </p>
        <div class="mt-auto pt-4">
            <span class="relative z-20 inline-flex w-full justify-center rounded-full bg-primary text-on-primary py-3 font-label font-bold text-sm uppercase">
                {{ __('site.nav.inventory') }}
            </span>
        </div>
    </div>
</div>
@endif
