@props([
    'car',
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
@endphp

<div class="group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 relative flex flex-col">
    <div class="relative h-72 overflow-hidden">
        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $car->title }}" src="{{ $img }}"/>
        <button
            type="button"
            class="absolute top-4 right-4 z-10 inline-flex items-center justify-center min-h-[44px] min-w-[44px] rounded-full bg-white/95 text-primary shadow-md border border-outline-variant/40 hover:bg-white focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2"
            data-saved-car-toggle
            data-slug="{{ $car->slug }}"
            data-title="{{ $car->title }}"
            aria-pressed="false"
            aria-label="Save {{ $car->title }} to your list"
        >
            <span class="material-symbols-outlined text-[22px] text-primary" style="font-variation-settings: 'FILL' 0;" aria-hidden="true">favorite</span>
        </button>
        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
            @if ($car->is_featured)
                <span class="bg-secondary-container text-on-secondary-container px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider font-label flex items-center shadow-sm">
                    <span class="material-symbols-outlined text-[14px] mr-1" style="font-variation-settings: 'FILL' 1;" aria-hidden="true">local_fire_department</span> Featured
                </span>
            @endif
            <span class="bg-white/90 backdrop-blur-md text-primary px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider font-label flex items-center shadow-sm">
                <span class="material-symbols-outlined text-[14px] mr-1" style="font-variation-settings: 'FILL' 1;" aria-hidden="true">verified</span> Verified
            </span>
        </div>
    </div>

    <div class="p-6 flex-1 flex flex-col">
        <div class="mb-4">
            <h3 class="font-headline font-bold text-xl text-primary leading-snug tracking-tight line-clamp-2 min-h-[3.1rem]">
                {{ $car->title }}
            </h3>
            <div class="mt-3 flex items-end justify-between gap-3 border-t border-outline-variant/25 pt-3">
                <div class="min-w-0">
                    <div class="flex items-center text-on-surface-variant text-sm font-medium">
                        <span class="material-symbols-outlined text-sm mr-1" aria-hidden="true">location_on</span>
                        <span class="truncate">{{ $car->location ?: 'Tanzania' }}</span>
                    </div>
                    @if ($conditionText)
                        <div class="mt-1 text-xs font-label font-semibold uppercase tracking-wide text-on-surface-variant">
                            Condition: {{ $conditionText }}
                        </div>
                    @endif
                </div>
                <div class="text-right shrink-0">
                    <p class="font-headline font-extrabold text-2xl text-primary leading-none tracking-tight">
                        {{ $car->price_tzs ? ('TZS ' . number_format($car->price_tzs)) : 'Contact' }}
                    </p>
                    <p class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide mt-1">
                        {{ $car->price_tzs ? 'Negotiable' : 'Request price' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="bg-surface-container-low p-3 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">speed</span>
                <span class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide">
                    {{ $car->mileage_km ? number_format($car->mileage_km) . ' KM' : '—' }}
                </span>
            </div>
            <div class="bg-surface-container-low p-3 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">local_gas_station</span>
                <span class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide">{{ $car->fuel ?: '—' }}</span>
            </div>
            <div class="bg-surface-container-low p-3 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">calendar_today</span>
                <span class="text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wide">{{ $car->year ?: '—' }}</span>
            </div>
        </div>

        <div class="mt-auto">
            <a class="w-full bg-primary text-on-primary py-3.5 min-h-[48px] rounded-full font-label font-bold text-sm uppercase tracking-wide transition-[filter,transform] hover:brightness-110 active:scale-[0.98] text-center inline-flex items-center justify-center focus-ring-on-dark" href="{{ route('cars.show', ['slug' => $car->slug]) }}">
                View Details
            </a>
        </div>
    </div>
</div>

