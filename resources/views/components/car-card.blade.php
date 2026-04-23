@props([
    'car',
    'compact' => false,
])

@php
    /** @var \App\Models\Car $car */
    $img = $car->hero_image_path ? asset('storage/' . $car->hero_image_path) : 'https://placehold.co/1200x800?text=Sahara+Cars';
    $conditionLabels = [
        'brand_new' => 'Brand New',
        'foreign_used' => 'Foreign Used',
        'local_used' => 'Locally Used',
    ];
    $conditionText = $conditionLabels[$car->condition] ?? null;
    $makeModel = trim(collect([$car->brand, $car->model])->filter()->implode(' · '));
    $importStatusLabels = [
        'in_tanzania' => 'In Tanzania',
        'on_order' => 'On Order',
        'in_transit' => 'In Transit',
        'ready_for_booking' => 'Ready for Booking',
    ];
    $importStatusText = $importStatusLabels[$car->import_status] ?? null;
    $brandLine = $car->brand ? strtoupper((string) $car->brand) : '';
    $modelLine = $car->model ? strtoupper((string) $car->model) : '';
@endphp

@if ($compact)
<div class="group bg-surface-container-lowest rounded-lg border border-outline-variant/30 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 relative flex flex-col max-w-full">
    <a
        href="{{ route('cars.show', ['slug' => $car->slug]) }}"
        class="absolute inset-0 z-10 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-1"
        aria-label="Open details for {{ $car->title }}"
    ></a>
    <div class="relative aspect-[4/3] max-h-[120px] sm:max-h-[130px] w-full overflow-hidden bg-surface-container-high">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $car->title }}" src="{{ $img }}"/>
        <button
            type="button"
            class="absolute top-2 right-2 z-20 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/95 text-primary shadow border border-outline-variant/30 hover:bg-white"
            data-saved-car-toggle
            data-slug="{{ $car->slug }}"
            data-title="{{ $car->title }}"
            aria-pressed="false"
            aria-label="Save {{ $car->title }} to your list"
        >
            <span class="material-symbols-outlined text-lg text-primary" style="font-variation-settings: 'FILL' 0;" aria-hidden="true">favorite</span>
        </button>
        @if ($car->source_country)
            <span class="absolute top-1.5 left-1.5 z-[5] max-w-[70%] truncate bg-primary/90 text-white px-1.5 py-0.5 rounded text-[8px] font-bold uppercase tracking-wide">{{ $car->source_country }}</span>
        @endif
    </div>
    <div class="p-2.5 sm:p-3 text-left flex-1 flex flex-col relative z-20 min-h-0">
        @if ($brandLine !== '' && $modelLine !== '')
            <p class="text-[10px] sm:text-[11px] font-extrabold text-primary leading-tight uppercase tracking-tight line-clamp-1">{{ $brandLine }}</p>
            <p class="text-[10px] sm:text-[11px] font-extrabold text-primary leading-tight uppercase tracking-tight line-clamp-1 -mt-px">{{ $modelLine }}</p>
        @elseif ($brandLine !== '')
            <p class="text-[10px] sm:text-[11px] font-extrabold text-primary leading-tight uppercase tracking-tight line-clamp-2">{{ $brandLine }}</p>
        @else
            <h3 class="text-[10px] sm:text-[11px] font-extrabold text-primary leading-snug uppercase line-clamp-2 min-h-[1.9rem]">{{ $car->title }}</h3>
        @endif
        <p class="text-[9px] text-on-surface-variant mt-1.5">Price:</p>
        <p class="text-sm font-extrabold text-emerald-700 tabular-nums leading-tight">
            {{ $car->price_tzs ? ('TZS ' . number_format($car->price_tzs)) : 'Contact' }}
        </p>
    </div>
</div>
@else
<div class="group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 relative flex flex-col">
    <a
        href="{{ route('cars.show', ['slug' => $car->slug]) }}"
        class="absolute inset-0 z-10 rounded-2xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
        aria-label="Open details for {{ $car->title }}"
    ></a>
    <div class="relative h-56 sm:h-64 lg:h-72 overflow-hidden">
        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $car->title }}" src="{{ $img }}"/>
        <button
            type="button"
            class="absolute top-4 right-4 z-20 inline-flex items-center justify-center min-h-[44px] min-w-[44px] rounded-full bg-white/95 text-primary shadow-md border border-outline-variant/40 hover:bg-white focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
            data-saved-car-toggle
            data-slug="{{ $car->slug }}"
            data-title="{{ $car->title }}"
            aria-pressed="false"
            aria-label="Save {{ $car->title }} to your list"
        >
            <span class="material-symbols-outlined text-[22px] text-primary" style="font-variation-settings: 'FILL' 0;" aria-hidden="true">favorite</span>
        </button>
        <div class="absolute top-3 left-3 sm:top-4 sm:left-4 flex flex-wrap gap-1.5 sm:gap-2 max-w-[calc(100%-5.5rem)]">
            @if ($car->is_featured)
                <span class="bg-secondary-container text-on-secondary-container px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full text-[9px] sm:text-[10px] font-bold uppercase tracking-wider font-label flex items-center shadow-sm">
                    <span class="material-symbols-outlined text-[14px] mr-1" style="font-variation-settings: 'FILL' 1;" aria-hidden="true">local_fire_department</span> Featured
                </span>
            @endif
            <span class="bg-white/90 backdrop-blur-md text-primary px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full text-[9px] sm:text-[10px] font-bold uppercase tracking-wider font-label flex items-center shadow-sm">
                <span class="material-symbols-outlined text-[14px] mr-1" style="font-variation-settings: 'FILL' 1;" aria-hidden="true">verified</span> Verified
            </span>
            @if ($car->source_country)
                <span class="bg-primary/90 text-white px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full text-[9px] sm:text-[10px] font-bold uppercase tracking-wider font-label shadow-sm">
                    {{ $car->source_country }}
                </span>
            @endif
        </div>
    </div>

    <div class="p-5 sm:p-6 flex-1 flex flex-col relative z-20">
        <div class="mb-4">
            <h3 class="font-headline font-bold text-lg sm:text-xl text-primary leading-snug tracking-tight line-clamp-2 min-h-[2.8rem] sm:min-h-[3.1rem]">
                {{ $car->title }}
            </h3>
            @if ($makeModel !== '')
                <p class="mt-1 text-xs sm:text-sm font-label font-semibold uppercase tracking-wide text-on-surface-variant line-clamp-1">
                    {{ $makeModel }}
                </p>
            @endif
            <div class="mt-3 border-t border-outline-variant/25 pt-3 flex items-center justify-between gap-2">
                <div class="flex items-center text-on-surface-variant text-sm sm:text-base font-medium min-w-0">
                    <span class="material-symbols-outlined text-sm mr-1 shrink-0" aria-hidden="true">location_on</span>
                    <span class="truncate">{{ $car->location ?: 'Tanzania' }}</span>
                </div>
                @if ($conditionText)
                    <div class="text-[11px] font-label font-semibold uppercase tracking-wide text-on-surface-variant shrink-0 whitespace-nowrap">
                        {{ $conditionText }}
                    </div>
                @endif
            </div>
            @if ($importStatusText)
                <p class="mt-2 text-[11px] font-label font-semibold uppercase tracking-wide text-on-surface-variant">
                    {{ $importStatusText }}@if($car->eta_date) · ETA {{ $car->eta_date->format('M Y') }}@endif
                </p>
            @endif
        </div>

        <div class="grid grid-cols-3 gap-2.5 sm:gap-3 mb-6">
            <div class="bg-surface-container-low px-3 py-2.5 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">speed</span>
                <span class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide tabular-nums">
                    {{ $car->mileage_km ? number_format($car->mileage_km) . ' KM' : '—' }}
                </span>
            </div>
            <div class="bg-surface-container-low px-3 py-2.5 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">local_gas_station</span>
                <span class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide">{{ $car->fuel ?: '—' }}</span>
            </div>
            <div class="bg-surface-container-low px-3 py-2.5 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">calendar_today</span>
                <span class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide tabular-nums">{{ $car->year ?: '—' }}</span>
            </div>
        </div>

        <div class="mb-5 border-t border-outline-variant/20 pt-3 text-center">
            <p class="font-headline font-semibold text-lg text-on-surface leading-tight tracking-tight tabular-nums">
                {{ $car->price_tzs ? ('TZS ' . number_format($car->price_tzs)) : 'Contact' }}
            </p>
            <p class="text-[11px] font-label font-medium text-on-surface-variant uppercase tracking-wide mt-1">
                {{ $car->price_tzs ? (($car->price_is_negotiable ?? true) ? 'Negotiable' : 'Not Negotiable') : 'Request price' }}
            </p>
            @if ($car->landed_cost_tzs)
                <p class="text-[11px] font-label font-medium text-on-surface-variant mt-1">
                    Estimated landed: TZS {{ number_format($car->landed_cost_tzs) }}
                </p>
            @endif
        </div>

        <div class="mt-auto">
            <a class="relative z-20 w-full bg-primary text-on-primary py-3.5 min-h-[48px] rounded-full font-label font-bold text-sm uppercase tracking-wide transition-[filter,transform] hover:brightness-110 active:scale-[0.98] text-center inline-flex items-center justify-center focus-ring-on-dark" href="{{ route('cars.show', ['slug' => $car->slug]) }}">
                View Details
            </a>
        </div>
    </div>
</div>
@endif
