{{-- Shared GET filter form for inventory listing views (desktop sidebar + mobile disclosure). Expects $action URL. Optional $filterFormIdPrefix for unique ids when two instances load (WCAG 4.1.1). --}}
@php
    $filterFormIdPrefix = isset($filterFormIdPrefix) && $filterFormIdPrefix !== '' ? preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $filterFormIdPrefix) : 'filters';
    $brandOptions = isset($brandOptions) && is_iterable($brandOptions) ? collect($brandOptions)->filter(fn ($v) => is_string($v) && trim($v) !== '')->values() : collect(['Toyota', 'Land Rover', 'Mercedes', 'Nissan']);
    $locationOptions = isset($locationOptions) && is_iterable($locationOptions) ? collect($locationOptions)->filter(fn ($v) => is_string($v) && trim($v) !== '')->values() : collect(['Dar es Salaam', 'Arusha', 'Zanzibar']);
    $sourceCountryOptions = isset($sourceCountryOptions) && is_iterable($sourceCountryOptions) ? collect($sourceCountryOptions)->filter(fn ($v) => is_string($v) && trim($v) !== '')->values() : collect(['Japan', 'Germany', 'Thailand']);
    $importStatusOptions = isset($importStatusOptions) && is_iterable($importStatusOptions) ? collect($importStatusOptions)->filter(fn ($v) => is_string($v) && trim($v) !== '')->values() : collect(['in_tanzania', 'on_order', 'in_transit', 'ready_for_booking']);
    $importStatusLabels = [
        'in_tanzania' => __('public.catalog.import_status.in_tanzania'),
        'on_order' => __('public.catalog.import_status.on_order'),
        'in_transit' => __('public.catalog.import_status.in_transit'),
        'ready_for_booking' => __('public.catalog.import_status.ready_for_booking'),
    ];
@endphp
<form action="{{ $action }}" method="GET" data-filter-auto-submit>
    @if (request()->filled('q'))
        <input type="hidden" name="q" value="{{ request('q') }}" />
    @endif
    <div>
        <h3 class="font-headline font-bold text-lg mb-6 text-primary">{{ __('public.filters.heading') }}</h3>
        <div class="space-y-6">
            <div class="space-y-3">
                <label for="filter-brand-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ __('public.filters.brand') }}</label>
                <select id="filter-brand-{{ $filterFormIdPrefix }}" name="brand" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 appearance-none ghost-border">
                    <option value="">{{ __('public.filters.all_manufacturers') }}</option>
                    @foreach ($brandOptions as $brandOption)
                        <option value="{{ $brandOption }}" {{ request('brand') === $brandOption ? 'selected' : '' }}>{{ $brandOption }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-3">
                <span id="filter-price-label-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant block">{{ __('public.filters.price_range') }}</span>
                <div class="grid grid-cols-2 gap-2" role="group" aria-labelledby="filter-price-label-{{ $filterFormIdPrefix }}">
                    <input id="filter-price-min-{{ $filterFormIdPrefix }}" name="price_min" value="{{ request('price_min') }}" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 ghost-border" placeholder="{{ __('public.common.min') }}" type="number" inputmode="numeric" aria-label="{{ __('public.filters.price_min_aria') }}" />
                    <input id="filter-price-max-{{ $filterFormIdPrefix }}" name="price_max" value="{{ request('price_max') }}" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 ghost-border" placeholder="{{ __('public.common.max') }}" type="number" inputmode="numeric" aria-label="{{ __('public.filters.price_max_aria') }}" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-3">
                    @php
                        $locationRequest = request()->input('location', '');
                        $selectedLocation = is_array($locationRequest)
                            ? trim((string) ($locationRequest[0] ?? ''))
                            : trim((string) $locationRequest);
                    @endphp
                    <label for="filter-location-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ __('public.filters.location') }}</label>
                    <select id="filter-location-{{ $filterFormIdPrefix }}" name="location" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 appearance-none ghost-border">
                        <option value="">{{ __('public.filters.all_locations') }}</option>
                        @foreach ($locationOptions as $locationOption)
                            <option value="{{ $locationOption }}" {{ $selectedLocation === $locationOption ? 'selected' : '' }}>{{ $locationOption }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-3">
                    <label for="filter-condition-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ __('public.filters.condition') }}</label>
                    <select id="filter-condition-{{ $filterFormIdPrefix }}" name="condition" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 appearance-none ghost-border">
                        <option value="">{{ __('public.filters.any_condition') }}</option>
                        <option value="brand_new" {{ request('condition', request('category')) === 'brand_new' ? 'selected' : '' }}>{{ __('public.catalog.condition.brand_new') }}</option>
                        <option value="foreign_used" {{ request('condition', request('category')) === 'foreign_used' ? 'selected' : '' }}>{{ __('public.catalog.condition.foreign_used') }}</option>
                        <option value="local_used" {{ request('condition', request('category')) === 'local_used' ? 'selected' : '' }}>{{ __('public.catalog.condition.local_used') }}</option>
                    </select>
                </div>
            </div>
            <div class="space-y-3">
                <span id="filter-transmission-label-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant block">{{ __('public.filters.transmission') }}</span>
                <div class="inventory-transmission-segment grid grid-cols-3 gap-1 p-1 bg-surface-container-low rounded-2xl text-xs" role="radiogroup" aria-labelledby="filter-transmission-label-{{ $filterFormIdPrefix }}">
                    <label class="min-w-0 cursor-pointer">
                        <input type="radio" name="transmission" value="Automatic" data-filter-auto-submit-trigger class="sr-only peer" {{ request('transmission') === 'Automatic' ? 'checked' : '' }} />
                        <span class="inventory-transmission-option block text-center py-2.5 px-1 rounded-xl font-bold leading-tight text-on-surface-variant hover:bg-surface-container-highest hover:text-on-surface peer-checked:bg-primary peer-checked:text-on-primary peer-checked:hover:bg-primary peer-checked:hover:text-on-primary transition-colors touch-manipulation">{{ __('public.filters.trans_auto') }}</span>
                    </label>
                    <label class="min-w-0 cursor-pointer">
                        <input type="radio" name="transmission" value="Manual" data-filter-auto-submit-trigger class="sr-only peer" {{ request('transmission') === 'Manual' ? 'checked' : '' }} />
                        <span class="inventory-transmission-option block text-center py-2.5 px-1 rounded-xl font-bold leading-tight text-on-surface-variant hover:bg-surface-container-highest hover:text-on-surface peer-checked:bg-primary peer-checked:text-on-primary peer-checked:hover:bg-primary peer-checked:hover:text-on-primary transition-colors touch-manipulation">{{ __('public.filters.trans_manual') }}</span>
                    </label>
                    <label class="min-w-0 cursor-pointer">
                        <input type="radio" name="transmission" value="" data-filter-auto-submit-trigger class="sr-only peer" {{ request('transmission') === null || request('transmission') === '' ? 'checked' : '' }} />
                        <span class="inventory-transmission-option block text-center py-2.5 px-1 rounded-xl font-bold leading-tight text-on-surface-variant hover:bg-surface-container-highest hover:text-on-surface peer-checked:bg-primary peer-checked:text-on-primary peer-checked:hover:bg-primary peer-checked:hover:text-on-primary transition-colors touch-manipulation">{{ __('public.filters.trans_any') }}</span>
                    </label>
                </div>
            </div>
            <div class="space-y-3">
                <label for="filter-fuel-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ __('public.filters.fuel') }}</label>
                <select id="filter-fuel-{{ $filterFormIdPrefix }}" name="fuel" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 appearance-none ghost-border">
                    <option value="">{{ __('public.filters.any_fuel') }}</option>
                    <option value="Petrol" {{ request('fuel') === 'Petrol' ? 'selected' : '' }}>{{ __('public.filters.fuel_petrol') }}</option>
                    <option value="Diesel" {{ request('fuel') === 'Diesel' ? 'selected' : '' }}>{{ __('public.filters.fuel_diesel') }}</option>
                    <option value="Hybrid" {{ request('fuel') === 'Hybrid' ? 'selected' : '' }}>{{ __('public.filters.fuel_hybrid') }}</option>
                    <option value="Electric" {{ request('fuel') === 'Electric' ? 'selected' : '' }}>{{ __('public.filters.fuel_electric') }}</option>
                </select>
            </div>
            <div class="space-y-3">
                <label for="filter-source-country-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ __('public.filters.source_country') }}</label>
                <select id="filter-source-country-{{ $filterFormIdPrefix }}" name="source_country" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 appearance-none ghost-border">
                    <option value="">{{ __('public.filters.any_source') }}</option>
                    @foreach ($sourceCountryOptions as $sourceCountryOption)
                        <option value="{{ $sourceCountryOption }}" {{ request('source_country') === $sourceCountryOption ? 'selected' : '' }}>{{ $sourceCountryOption }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-3">
                <label for="filter-import-status-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ __('public.filters.import_status') }}</label>
                <select id="filter-import-status-{{ $filterFormIdPrefix }}" name="import_status" data-filter-auto-submit-trigger class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 appearance-none ghost-border">
                    <option value="">{{ __('public.filters.any_status') }}</option>
                    @foreach ($importStatusOptions as $importStatusOption)
                        <option value="{{ $importStatusOption }}" {{ request('import_status') === $importStatusOption ? 'selected' : '' }}>
                            {{ $importStatusLabels[$importStatusOption] ?? ucwords(str_replace('_', ' ', (string) $importStatusOption)) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="w-full mt-8 py-4 min-h-[48px] cta-gradient text-on-primary font-headline font-bold rounded-full shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all touch-manipulation focus-ring-on-dark">
            {{ __('public.filters.apply') }}
        </button>
    </div>
</form>
<script>
    (() => {
        if (window.__inventoryFilterAutoSubmitBound) {
            return;
        }
        window.__inventoryFilterAutoSubmitBound = true;

        const forms = document.querySelectorAll('form[data-filter-auto-submit]');
        forms.forEach((form) => {
            const triggers = form.querySelectorAll('[data-filter-auto-submit-trigger]');
            if (!triggers.length) {
                return;
            }

            let timeoutId = null;
            const submitForm = () => {
                if (timeoutId !== null) {
                    window.clearTimeout(timeoutId);
                }
                timeoutId = window.setTimeout(() => form.requestSubmit(), 150);
            };

            triggers.forEach((input) => {
                input.addEventListener('change', submitForm);
            });
        });
    })();
</script>
