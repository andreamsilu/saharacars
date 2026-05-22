@php
    /** @var \App\Models\Car|null $car */
    $car = $car ?? null;
@endphp

<div class="admin-car-form grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-8 space-y-6">
        <div class="admin-panel">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-4">
                <div class="admin-field md:col-span-2">
                    <label class="admin-label" for="title">Title</label>
                    <input id="title" name="title" value="{{ old('title', $car->title ?? '') }}" required class="admin-control" placeholder="Toyota Land Cruiser 300" />
                    @error('title')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                @if ($car?->exists)
                    <div class="md:col-span-2">
                        <label class="admin-label" for="slug">Slug (optional)</label>
                        <input id="slug" name="slug" value="{{ old('slug', $car->slug ?? '') }}" class="admin-control" placeholder="toyota-land-cruiser-300" />
                        <p class="admin-hint">Leave blank to auto-generate from title.</p>
                        @error('slug')<div class="admin-field-error">{{ $message }}</div>@enderror
                    </div>
                @endif

                <div>
                    <label class="admin-label" for="brand_id">Brand</label>
                    <select id="brand_id" name="brand_id" class="admin-control">
                        <option value="">Select brand</option>
                        @foreach (($brands ?? collect()) as $brandOption)
                            <option value="{{ $brandOption->id }}" {{ (string) old('brand_id', $car->brand_id ?? '') === (string) $brandOption->id ? 'selected' : '' }}>
                                {{ $brandOption->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="admin-hint">Manage brands from Admin -> Brands.</p>
                    @error('brand_id')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="model">Model</label>
                    <input id="model" name="model" value="{{ old('model', $car->model ?? '') }}" class="admin-control" placeholder="DBA-KF5P" />
                    @error('model')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="body_color">Body color</label>
                    <input id="body_color" name="body_color" value="{{ old('body_color', $car->body_color ?? '') }}" class="admin-control" placeholder="BLUE(D)" />
                    @error('body_color')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="body_type">Body type</label>
                    <input id="body_type" name="body_type" value="{{ old('body_type', $car->body_type ?? '') }}" class="admin-control" placeholder="SUV" />
                    @error('body_type')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="doors">Doors</label>
                    <input id="doors" name="doors" type="number" min="1" max="9" value="{{ old('doors', $car->doors ?? '') }}" class="admin-control" placeholder="5" />
                    @error('doors')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="seats">Seats</label>
                    <input id="seats" name="seats" type="number" min="1" max="20" value="{{ old('seats', $car->seats ?? '') }}" class="admin-control" placeholder="5" />
                    @error('seats')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="year">Year</label>
                    <input id="year" name="year" type="number" value="{{ old('year', $car->year ?? '') }}" class="admin-control" placeholder="2023" />
                    @error('year')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="price_tzs">Price (TZS)</label>
                    <input id="price_tzs" name="price_tzs" type="number" value="{{ old('price_tzs', $car->price_tzs ?? '') }}" class="admin-control" placeholder="185000000" />
                    @error('price_tzs')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="landed_cost_tzs">Estimated landed cost (TZS)</label>
                    <input id="landed_cost_tzs" name="landed_cost_tzs" type="number" value="{{ old('landed_cost_tzs', $car->landed_cost_tzs ?? '') }}" class="admin-control" placeholder="220000000" />
                    @error('landed_cost_tzs')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="price_is_negotiable">Price policy</label>
                    <select id="price_is_negotiable" name="price_is_negotiable" class="admin-control">
                        <option value="1" {{ (string) old('price_is_negotiable', ($car->price_is_negotiable ?? true) ? '1' : '0') === '1' ? 'selected' : '' }}>Negotiable</option>
                        <option value="0" {{ (string) old('price_is_negotiable', ($car->price_is_negotiable ?? true) ? '1' : '0') === '0' ? 'selected' : '' }}>Not Negotiable</option>
                    </select>
                    @error('price_is_negotiable')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="location">Location</label>
                    <input id="location" name="location" value="{{ old('location', $car->location ?? '') }}" class="admin-control" placeholder="Dar es Salaam" />
                    @error('location')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="source_country">Source country</label>
                    <select id="source_country" name="source_country" class="admin-control">
                        <option value="">Select source country</option>
                        @foreach (['Japan', 'Germany', 'Thailand', 'United Kingdom', 'United Arab Emirates', 'South Korea', 'Tanzania'] as $sourceCountryOption)
                            <option value="{{ $sourceCountryOption }}" {{ old('source_country', $car->source_country ?? '') === $sourceCountryOption ? 'selected' : '' }}>{{ $sourceCountryOption }}</option>
                        @endforeach
                    </select>
                    @error('source_country')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="transmission">Transmission</label>
                    <select id="transmission" name="transmission" class="admin-control">
                        <option value="">Select transmission</option>
                        <option value="Automatic" {{ old('transmission', $car->transmission ?? '') === 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="Manual" {{ old('transmission', $car->transmission ?? '') === 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                    @error('transmission')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="fuel">Fuel</label>
                    <select id="fuel" name="fuel" class="admin-control">
                        <option value="">Select fuel type</option>
                        <option value="Petrol" {{ old('fuel', $car->fuel ?? '') === 'Petrol' ? 'selected' : '' }}>Petrol</option>
                        <option value="Diesel" {{ old('fuel', $car->fuel ?? '') === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    </select>
                    @error('fuel')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="condition">Condition</label>
                    <select id="condition" name="condition" class="admin-control">
                        <option value="">Select condition</option>
                        <option value="brand_new" {{ old('condition', $car->condition ?? '') === 'brand_new' ? 'selected' : '' }}>Brand New</option>
                        <option value="foreign_used" {{ old('condition', $car->condition ?? '') === 'foreign_used' ? 'selected' : '' }}>Foreign Used</option>
                        <option value="local_used" {{ old('condition', $car->condition ?? '') === 'local_used' ? 'selected' : '' }}>Locally Used</option>
                    </select>
                    @error('condition')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="import_status">Import status</label>
                    <select id="import_status" name="import_status" class="admin-control">
                        <option value="">Select status</option>
                        <option value="in_tanzania" {{ old('import_status', $car->import_status ?? '') === 'in_tanzania' ? 'selected' : '' }}>In Tanzania</option>
                        <option value="on_order" {{ old('import_status', $car->import_status ?? '') === 'on_order' ? 'selected' : '' }}>On Order</option>
                        <option value="in_transit" {{ old('import_status', $car->import_status ?? '') === 'in_transit' ? 'selected' : '' }}>In Transit</option>
                        <option value="ready_for_booking" {{ old('import_status', $car->import_status ?? '') === 'ready_for_booking' ? 'selected' : '' }}>Ready for Booking</option>
                    </select>
                    @error('import_status')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="eta_date">Expected arrival date (ETA)</label>
                    <input id="eta_date" name="eta_date" type="date" value="{{ old('eta_date', isset($car?->eta_date) ? optional($car->eta_date)->format('Y-m-d') : '') }}" class="admin-control" />
                    @error('eta_date')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="mileage_km">Mileage (KM)</label>
                    <input id="mileage_km" name="mileage_km" type="number" value="{{ old('mileage_km', $car->mileage_km ?? '') }}" class="admin-control" placeholder="12400" />
                    @error('mileage_km')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="engine">Engine</label>
                    <input id="engine" name="engine" value="{{ old('engine', $car->engine ?? '') }}" class="admin-control" placeholder="3.5L Diesel" />
                    @error('engine')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label" for="engine_capacity_cc">Engine Capacity (cc)</label>
                    <input id="engine_capacity_cc" name="engine_capacity_cc" type="number" value="{{ old('engine_capacity_cc', $car->engine_capacity_cc ?? '') }}" class="admin-control" placeholder="3500" />
                    <p class="admin-hint">Used for accurate engine-capacity sorting on premium inventory.</p>
                    @error('engine_capacity_cc')<div class="admin-field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="admin-panel">
            <label class="admin-label" for="description">Description</label>
            <textarea id="description" name="description" rows="7" class="admin-control" placeholder="Write a detailed description...">{{ old('description', $car->description ?? '') }}</textarea>
            @error('description')<div class="admin-field-error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="lg:col-span-4 space-y-6">
        <div class="admin-panel space-y-0">
            <div class="admin-toggle-row">
                <label for="is_published">Published</label>
                <input id="is_published" name="is_published" type="checkbox" value="1" {{ old('is_published', ($car->is_published ?? true) ? 1 : 0) ? 'checked' : '' }} />
            </div>
            <div class="admin-toggle-row">
                <label for="is_featured">Featured</label>
                <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured', ($car->is_featured ?? false) ? 1 : 0) ? 'checked' : '' }} />
            </div>
        </div>

        <div class="admin-panel space-y-4">
            <div>
                <label class="admin-label" for="hero_image">Hero image</label>
                <input id="hero_image" name="hero_image" type="file" accept="image/*,.heic,.heif,.avif,.webp" />
                @error('hero_image')<div class="admin-field-error">{{ $message }}</div>@enderror
            </div>

            @if (!empty($car?->hero_image_path))
                <div class="space-y-3">
                    <div class="text-xs text-on-surface-variant">Current:</div>
                    <img src="{{ asset('storage/' . $car->hero_image_path) }}" alt="" class="w-full rounded-2xl border border-slate-200/80" />
                    <label class="inline-flex items-center gap-2 text-xs text-on-surface-variant">
                        <input type="checkbox" name="remove_hero_image" value="1" class="rounded border-slate-300 text-primary focus:ring-primary/30" />
                        Remove current image
                    </label>
                </div>
            @endif
        </div>

        <div class="admin-panel space-y-4">
            <p class="admin-section-kicker">View-specific images</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @php
                    $viewImages = [
                        ['label' => 'Front view', 'input' => 'front_images', 'array' => 'front_image_paths', 'single' => 'front_image_path', 'remove' => 'remove_front_images'],
                        ['label' => 'Rear view', 'input' => 'rear_images', 'array' => 'rear_image_paths', 'single' => 'rear_image_path', 'remove' => 'remove_rear_images'],
                        ['label' => 'Side view', 'input' => 'side_images', 'array' => 'side_image_paths', 'single' => 'side_image_path', 'remove' => 'remove_side_images'],
                        ['label' => 'Interior view', 'input' => 'interior_images', 'array' => 'interior_image_paths', 'single' => 'interior_image_path', 'remove' => 'remove_interior_images'],
                    ];
                @endphp

                @foreach ($viewImages as $slot)
                    <div class="admin-upload-slot space-y-2">
                        <label class="block text-xs font-semibold text-on-surface-variant" for="{{ $slot['input'] }}">{{ $slot['label'] }}</label>
                        <input id="{{ $slot['input'] }}" name="{{ $slot['input'] }}[]" type="file" accept="image/*,.heic,.heif,.avif,.webp" multiple />
                        <p class="admin-hint">You can add multiple {{ strtolower($slot['label']) }} images.</p>
                        @error($slot['input'])<div class="admin-field-error">{{ $message }}</div>@enderror
                        @error($slot['input'] . '.*')<div class="admin-field-error">{{ $message }}</div>@enderror

                        @php
                            $existing = [];
                            if (!empty($car?->{$slot['array']}) && is_array($car->{$slot['array']})) {
                                $existing = $car->{$slot['array']};
                            } elseif (!empty($car?->{$slot['single']})) {
                                $existing = [$car->{$slot['single']}];
                            }
                        @endphp
                        @if (!empty($existing))
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($existing as $imgPath)
                                    <img src="{{ asset('storage/' . $imgPath) }}" alt="" class="w-full h-20 object-cover rounded-lg border border-slate-200/80" />
                                @endforeach
                            </div>
                            <label class="inline-flex items-center gap-2 text-xs text-on-surface-variant">
                                <input type="checkbox" name="{{ $slot['remove'] }}" value="1" class="rounded border-slate-300 text-primary focus:ring-primary/30" />
                                Remove all {{ strtolower($slot['label']) }} images
                            </label>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="admin-panel space-y-4">
            <div>
                <label class="admin-label" for="gallery_images">Gallery images</label>
                <input id="gallery_images" name="gallery_images[]" type="file" accept="image/*,.heic,.heif,.avif,.webp" multiple />
                <p class="admin-hint">You can upload up to 12 images. Each image max 5MB.</p>
                @error('gallery_images')<div class="admin-field-error">{{ $message }}</div>@enderror
                @error('gallery_images.*')<div class="admin-field-error">{{ $message }}</div>@enderror
            </div>

            @if (!empty($car?->gallery_image_paths) && is_array($car->gallery_image_paths))
                <div class="space-y-3">
                    <div class="text-xs text-on-surface-variant">Current gallery:</div>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach ($car->gallery_image_paths as $galleryPath)
                            <img src="{{ asset('storage/' . $galleryPath) }}" alt="" class="w-full h-28 object-cover rounded-xl border border-slate-200/80" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        @php
            $frontPreview = is_array($car?->front_image_paths ?? null) ? $car->front_image_paths : array_filter([$car?->front_image_path]);
            $rearPreview = is_array($car?->rear_image_paths ?? null) ? $car->rear_image_paths : array_filter([$car?->rear_image_path]);
            $sidePreview = is_array($car?->side_image_paths ?? null) ? $car->side_image_paths : array_filter([$car?->side_image_path]);
            $interiorPreview = is_array($car?->interior_image_paths ?? null) ? $car->interior_image_paths : array_filter([$car?->interior_image_path]);
            $generalPreview = is_array($car?->gallery_image_paths ?? null) ? $car->gallery_image_paths : [];

            $previewBuckets = [
                'front' => $frontPreview,
                'rear' => $rearPreview,
                'side' => $sidePreview,
                'interior' => $interiorPreview,
                'gallery' => $generalPreview,
            ];

            $previewImages = [];
            foreach ($previewBuckets as $category => $paths) {
                foreach ($paths as $path) {
                    if (is_string($path) && $path !== '') {
                        $previewImages[] = ['src' => asset('storage/' . $path), 'path' => $path, 'category' => $category];
                    }
                }
            }
        @endphp
        @if (!empty($previewImages))
            <div class="admin-panel space-y-4">
                <div class="flex items-center justify-between">
                    <p class="admin-section-kicker mb-0">Image browser</p>
                    <div class="text-xs text-on-surface-variant"><span id="admin-gallery-current">1</span> / <span id="admin-gallery-total">{{ count($previewImages) }}</span></div>
                </div>

                <div class="flex flex-wrap gap-2">
                    @php
                        $adminTabs = [
                            ['key' => 'all', 'label' => 'All', 'count' => count($previewImages)],
                            ['key' => 'front', 'label' => 'Front', 'count' => count($frontPreview)],
                            ['key' => 'rear', 'label' => 'Rear', 'count' => count($rearPreview)],
                            ['key' => 'side', 'label' => 'Side', 'count' => count($sidePreview)],
                            ['key' => 'interior', 'label' => 'Interior', 'count' => count($interiorPreview)],
                            ['key' => 'gallery', 'label' => 'Gallery', 'count' => count($generalPreview)],
                        ];
                    @endphp
                    @foreach ($adminTabs as $tab)
                        <button
                            type="button"
                            class="admin-gallery-tab px-3 py-1.5 rounded-full text-xs font-bold border border-slate-200 bg-surface-container-low text-on-surface-variant focus:outline-none focus:ring-2 focus:ring-primary/30"
                            data-filter="{{ $tab['key'] }}"
                            aria-selected="{{ $tab['key'] === 'all' ? 'true' : 'false' }}"
                        >
                            {{ $tab['label'] }} ({{ $tab['count'] }})
                        </button>
                    @endforeach
                </div>

                <div class="rounded-xl overflow-hidden bg-surface-dim border border-slate-200/80">
                    <img id="admin-gallery-main-image" src="{{ $previewImages[0]['src'] }}" alt="Car image preview" class="w-full h-56 object-cover" />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    @foreach ($previewImages as $idx => $img)
                        <div class="space-y-1">
                            <button
                                type="button"
                                class="admin-gallery-thumb-btn relative rounded-lg overflow-hidden border border-slate-200/80 focus:outline-none focus:ring-2 focus:ring-primary/30 w-full {{ $idx === 0 ? 'ring-2 ring-primary/40' : '' }}"
                                data-index="{{ $idx }}"
                                data-src="{{ $img['src'] }}"
                                data-category="{{ $img['category'] }}"
                                aria-label="Open preview image {{ $idx + 1 }}"
                            >
                                <img src="{{ $img['src'] }}" alt="" class="w-full h-20 object-cover" />
                                <span class="absolute left-1 top-1 text-[9px] uppercase tracking-wider bg-black/60 text-white px-1.5 py-0.5 rounded">{{ $img['category'] }}</span>
                            </button>
                            <label class="inline-flex items-center gap-1.5 text-[11px] text-on-surface-variant">
                                <input type="checkbox" name="remove_image_paths[]" value="{{ $img['path'] }}" class="rounded border-slate-300 text-error focus:ring-error/30" />
                                Remove this image
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <script>
                (() => {
                    const tabs = [...document.querySelectorAll('.admin-gallery-tab')];
                    const thumbs = [...document.querySelectorAll('.admin-gallery-thumb-btn')];
                    const main = document.getElementById('admin-gallery-main-image');
                    const current = document.getElementById('admin-gallery-current');
                    const total = document.getElementById('admin-gallery-total');

                    if (!tabs.length || !thumbs.length || !main) return;

                    let activeIndex = Number(thumbs[0].dataset.index || 0);

                    const visibleThumbs = () => thumbs.filter((t) => !t.classList.contains('hidden'));

                    const render = () => {
                        const active = thumbs.find((t) => Number(t.dataset.index) === activeIndex) || visibleThumbs()[0];
                        if (!active) return;
                        activeIndex = Number(active.dataset.index);
                        main.src = active.dataset.src || '';
                        thumbs.forEach((t) => t.classList.remove('ring-2', 'ring-primary/40'));
                        active.classList.add('ring-2', 'ring-primary/40');
                        const list = visibleThumbs();
                        const pos = Math.max(0, list.findIndex((t) => Number(t.dataset.index) === activeIndex));
                        current.textContent = String(pos + 1);
                        total.textContent = String(list.length);
                    };

                    tabs.forEach((tab) => {
                        tab.addEventListener('click', () => {
                            const filter = tab.dataset.filter || 'all';
                            tabs.forEach((t) => {
                                t.classList.remove('bg-primary', 'text-on-primary', 'border-primary');
                                t.classList.add('bg-surface-container-low', 'text-on-surface-variant');
                                t.setAttribute('aria-selected', 'false');
                            });
                            tab.classList.add('bg-primary', 'text-on-primary', 'border-primary');
                            tab.classList.remove('bg-surface-container-low', 'text-on-surface-variant');
                            tab.setAttribute('aria-selected', 'true');

                            thumbs.forEach((thumb) => {
                                const match = filter === 'all' || thumb.dataset.category === filter;
                                thumb.classList.toggle('hidden', !match);
                            });

                            const first = visibleThumbs()[0];
                            if (!first) return;
                            activeIndex = Number(first.dataset.index);
                            render();
                        });
                    });

                    thumbs.forEach((thumb) => {
                        thumb.addEventListener('click', () => {
                            activeIndex = Number(thumb.dataset.index);
                            render();
                        });
                    });

                    render();
                })();
            </script>
        @endif
    </div>
</div>
