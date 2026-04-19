@props([
    'car',
])

@php
    /** @var \App\Models\Car $car */
    $img = $car->hero_image_path ? asset('storage/' . $car->hero_image_path) : 'https://placehold.co/1200x800?text=Sahara+Cars';
    $categoryLabels = [
        'brand_new' => 'Brand New',
        'foreign_used' => 'Foreign Used',
        'local_used' => 'Locally Used',
    ];
    $categoryText = $categoryLabels[$car->condition] ?? null;
    $waDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone', '255000000000'));
    $waCardMessage = 'Hi, I saw this car on the Sahara Cars website and would like more details.'
        ."\n\n".'Vehicle: '.$car->title
        .($car->year ? ' ('.$car->year.')' : '')
        ."\n".'Link: '.route('cars.show', ['slug' => $car->slug]);
    $waCardUrl = 'https://wa.me/'.$waDigits.'?text='.rawurlencode($waCardMessage);
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
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="font-headline font-bold text-xl text-primary leading-tight">{{ $car->title }}</h3>
                <div class="flex items-center text-on-surface-variant mt-1.5 text-xs font-semibold">
                    <span class="material-symbols-outlined text-sm mr-1" aria-hidden="true">location_on</span>
                    {{ $car->location ?: 'Tanzania' }}
                </div>
                @if ($categoryText)
                    <div class="mt-1.5 text-xs font-semibold text-on-surface-variant">Category: {{ $categoryText }}</div>
                @endif
            </div>
            <div class="text-right">
                <p class="font-headline font-extrabold text-2xl text-primary">
                    {{ $car->price_tzs ? ('TZS ' . number_format($car->price_tzs)) : 'Contact' }}
                </p>
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest font-label">
                    {{ $car->price_tzs ? 'Negotiable' : 'Request price' }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="bg-surface-container-low p-3 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">speed</span>
                <span class="text-[10px] font-bold text-on-surface-variant uppercase">
                    {{ $car->mileage_km ? number_format($car->mileage_km) . ' KM' : '—' }}
                </span>
            </div>
            <div class="bg-surface-container-low p-3 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">local_gas_station</span>
                <span class="text-[10px] font-bold text-on-surface-variant uppercase">{{ $car->fuel ?: '—' }}</span>
            </div>
            <div class="bg-surface-container-low p-3 rounded-2xl flex flex-col items-center text-center">
                <span class="material-symbols-outlined text-primary text-xl mb-1" aria-hidden="true">calendar_today</span>
                <span class="text-[10px] font-bold text-on-surface-variant uppercase">{{ $car->year ?: '—' }}</span>
            </div>
        </div>

        <div class="mt-auto flex gap-3">
            <a class="flex-[2] bg-primary text-on-primary py-3.5 min-h-[48px] rounded-full font-bold text-sm transition-[filter,transform] hover:brightness-110 active:scale-[0.98] text-center inline-flex items-center justify-center focus-ring-on-dark" href="{{ route('cars.show', ['slug' => $car->slug]) }}">
                View Details
            </a>
            <a
                class="flex-1 bg-[#25D366] text-white flex min-h-[48px] min-w-[48px] items-center justify-center rounded-full transition-[filter,transform] hover:brightness-110 active:scale-[0.98] shadow-md shadow-green-200 focus-ring-on-dark [&_svg]:text-white"
                href="{{ $waCardUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Chat on WhatsApp about {{ e($car->title) }}"
            >
                <svg viewBox="0 0 32 32" aria-hidden="true" class="w-5 h-5 fill-current">
                    <path d="M19.11 17.34c-.29-.14-1.69-.83-1.95-.92-.26-.1-.45-.14-.64.15-.18.29-.74.92-.9 1.1-.17.19-.33.22-.62.07-.29-.14-1.2-.44-2.29-1.39-.84-.75-1.42-1.68-1.58-1.96-.17-.29-.02-.44.12-.58.13-.13.29-.33.44-.5.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.08-.14-.64-1.55-.88-2.13-.23-.55-.46-.47-.64-.48h-.55c-.19 0-.5.07-.76.36-.26.29-1 1-.95 2.43.05 1.43 1 2.81 1.14 3 .14.19 1.95 2.98 4.72 4.17.66.29 1.17.46 1.57.59.66.21 1.27.18 1.75.11.53-.08 1.69-.69 1.93-1.35.24-.67.24-1.24.17-1.35-.08-.11-.27-.18-.55-.33z"/>
                    <path d="M16.02 3.2c-7.05 0-12.77 5.72-12.77 12.77 0 2.25.59 4.45 1.71 6.39L3.2 28.8l6.6-1.73c1.86 1.01 3.95 1.54 6.09 1.54h.01c7.05 0 12.77-5.72 12.77-12.77 0-3.42-1.33-6.63-3.76-9.05A12.67 12.67 0 0 0 16.02 3.2zm-.12 23.3h-.01c-1.91 0-3.78-.51-5.41-1.48l-.39-.23-3.92 1.03 1.05-3.82-.25-.39a10.58 10.58 0 0 1-1.62-5.65c0-5.86 4.77-10.62 10.63-10.62 2.84 0 5.51 1.1 7.51 3.11a10.54 10.54 0 0 1 3.1 7.51c0 5.86-4.77 10.62-10.62 10.62z"/>
                </svg>
            </a>
        </div>
    </div>
</div>

