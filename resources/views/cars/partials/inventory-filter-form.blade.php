{{-- Shared GET filter form for inventory listing views (desktop sidebar + mobile disclosure). Expects $action URL. Optional $filterFormIdPrefix for unique ids when two instances load (WCAG 4.1.1). --}}
@php
    $filterFormIdPrefix = isset($filterFormIdPrefix) && $filterFormIdPrefix !== '' ? preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $filterFormIdPrefix) : 'filters';
@endphp
<form action="{{ $action }}" method="GET">
    @if (request()->filled('q'))
        <input type="hidden" name="q" value="{{ request('q') }}" />
    @endif
    <div>
        <h3 class="font-headline font-bold text-lg mb-6 text-primary">Refine Selection</h3>
        <div class="space-y-6">
            <div class="space-y-3">
                <label for="filter-brand-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Brand</label>
                <select id="filter-brand-{{ $filterFormIdPrefix }}" name="brand" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 focus:ring-2 focus:ring-primary/30 appearance-none ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]">
                    <option value="">All Manufacturers</option>
                    <option value="Toyota" {{ request('brand') === 'Toyota' ? 'selected' : '' }}>Toyota</option>
                    <option value="Land Rover" {{ request('brand') === 'Land Rover' ? 'selected' : '' }}>Land Rover</option>
                    <option value="Mercedes" {{ request('brand') === 'Mercedes' ? 'selected' : '' }}>Mercedes</option>
                    <option value="Nissan" {{ request('brand') === 'Nissan' ? 'selected' : '' }}>Nissan</option>
                </select>
            </div>
            <div class="space-y-3">
                <span id="filter-price-label-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant block">Price Range (TZS)</span>
                <div class="grid grid-cols-2 gap-2" role="group" aria-labelledby="filter-price-label-{{ $filterFormIdPrefix }}">
                    <input id="filter-price-min-{{ $filterFormIdPrefix }}" name="price_min" value="{{ request('price_min') }}" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="Min" type="number" inputmode="numeric" aria-label="Minimum price in TZS" />
                    <input id="filter-price-max-{{ $filterFormIdPrefix }}" name="price_max" value="{{ request('price_max') }}" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="Max" type="number" inputmode="numeric" aria-label="Maximum price in TZS" />
                </div>
            </div>
            <div class="space-y-3">
                <span id="filter-location-label-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant block">Location</span>
                <div class="space-y-2" role="group" aria-labelledby="filter-location-label-{{ $filterFormIdPrefix }}">
                    @php
                        $selectedLocations = request()->input('location', []);
                        if (! is_array($selectedLocations)) {
                            $selectedLocations = $selectedLocations !== '' ? [$selectedLocations] : [];
                        }
                    @endphp
                    <label class="flex items-center space-x-3 cursor-pointer group min-h-[44px]">
                        <input name="location[]" value="Dar es Salaam" {{ in_array('Dar es Salaam', $selectedLocations, true) ? 'checked' : '' }} class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5 shrink-0" type="checkbox" />
                        <span class="text-sm font-medium group-hover:text-primary transition-colors">Dar es Salaam</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer group min-h-[44px]">
                        <input name="location[]" value="Arusha" {{ in_array('Arusha', $selectedLocations, true) ? 'checked' : '' }} class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5 shrink-0" type="checkbox" />
                        <span class="text-sm font-medium group-hover:text-primary transition-colors">Arusha</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer group min-h-[44px]">
                        <input name="location[]" value="Zanzibar" {{ in_array('Zanzibar', $selectedLocations, true) ? 'checked' : '' }} class="rounded border-outline-variant text-primary focus:ring-primary w-5 h-5 shrink-0" type="checkbox" />
                        <span class="text-sm font-medium group-hover:text-primary transition-colors">Zanzibar</span>
                    </label>
                </div>
            </div>
            <div class="space-y-3">
                <span id="filter-transmission-label-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant block">Transmission</span>
                <div class="flex flex-wrap gap-2 p-1 bg-surface-container-low rounded-full text-xs" role="radiogroup" aria-labelledby="filter-transmission-label-{{ $filterFormIdPrefix }}">
                    <label class="flex-1 min-w-[5.5rem]">
                        <input type="radio" name="transmission" value="Automatic" class="sr-only peer" {{ request('transmission') === 'Automatic' ? 'checked' : '' }} />
                        <span class="block text-center py-2.5 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-highest hover:text-on-surface peer-checked:bg-primary peer-checked:text-on-primary peer-checked:hover:bg-primary peer-checked:hover:text-on-primary transition-colors touch-manipulation">Automatic</span>
                    </label>
                    <label class="flex-1 min-w-[5.5rem]">
                        <input type="radio" name="transmission" value="Manual" class="sr-only peer" {{ request('transmission') === 'Manual' ? 'checked' : '' }} />
                        <span class="block text-center py-2.5 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-highest hover:text-on-surface peer-checked:bg-primary peer-checked:text-on-primary peer-checked:hover:bg-primary peer-checked:hover:text-on-primary transition-colors touch-manipulation">Manual</span>
                    </label>
                    <label class="flex-1 min-w-[5.5rem]">
                        <input type="radio" name="transmission" value="" class="sr-only peer" {{ request('transmission') === null || request('transmission') === '' ? 'checked' : '' }} />
                        <span class="block text-center py-2.5 rounded-full font-bold text-on-surface-variant hover:bg-surface-container-highest hover:text-on-surface peer-checked:bg-primary peer-checked:text-on-primary peer-checked:hover:bg-primary peer-checked:hover:text-on-primary transition-colors touch-manipulation">Any</span>
                    </label>
                </div>
            </div>
            <div class="space-y-3">
                <label for="filter-fuel-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Fuel</label>
                <select id="filter-fuel-{{ $filterFormIdPrefix }}" name="fuel" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 focus:ring-2 focus:ring-primary/30 appearance-none ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]">
                    <option value="">Any fuel</option>
                    <option value="Petrol" {{ request('fuel') === 'Petrol' ? 'selected' : '' }}>Petrol</option>
                    <option value="Diesel" {{ request('fuel') === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="Hybrid" {{ request('fuel') === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                    <option value="Electric" {{ request('fuel') === 'Electric' ? 'selected' : '' }}>Electric</option>
                </select>
            </div>
            <div class="space-y-3">
                <label for="filter-category-{{ $filterFormIdPrefix }}" class="font-label text-xs font-bold uppercase tracking-widest text-on-surface-variant">Category</label>
                <select id="filter-category-{{ $filterFormIdPrefix }}" name="category" class="w-full bg-surface-container-highest rounded-xl font-body text-sm py-3 px-4 focus:ring-2 focus:ring-primary/30 appearance-none ghost-border focus:shadow-[inset_0_0_0_1px_rgba(195,198,209,0.15)]">
                    <option value="">Any category</option>
                    <option value="brand_new" {{ request('category', request('condition')) === 'brand_new' ? 'selected' : '' }}>Brand New</option>
                    <option value="foreign_used" {{ request('category', request('condition')) === 'foreign_used' ? 'selected' : '' }}>Foreign Used</option>
                    <option value="local_used" {{ request('category', request('condition')) === 'local_used' ? 'selected' : '' }}>Locally Used</option>
                </select>
            </div>
        </div>
        <button type="submit" class="w-full mt-8 py-4 min-h-[48px] cta-gradient text-on-primary font-headline font-bold rounded-full shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all touch-manipulation focus-ring-on-dark">
            Apply Filters
        </button>
    </div>
</form>
