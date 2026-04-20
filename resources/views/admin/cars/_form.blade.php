@php
    /** @var \App\Models\Car|null $car */
    $car = $car ?? null;
@endphp

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-8 space-y-6">
        <div class="rounded-2xl ring-1 ring-outline-variant/20 bg-surface-container-lowest border border-outline-variant/15 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="title">Title</label>
                    <input id="title" name="title" value="{{ old('title', $car->title ?? '') }}" required class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="Toyota Land Cruiser 300" />
                    @error('title')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                @if ($car?->exists)
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="slug">Slug (optional)</label>
                        <input id="slug" name="slug" value="{{ old('slug', $car->slug ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="toyota-land-cruiser-300" />
                        <div class="mt-2 text-xs text-on-surface-variant">Leave blank to auto-generate from title.</div>
                        @error('slug')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                    </div>
                @endif

                {{-- Vehicle details: shown on the public car page; Make maps to brand. --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="brand">Make (brand)</label>
                    <input id="brand" name="brand" value="{{ old('brand', $car->brand ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="MAZDA" />
                    @error('brand')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="model">Model</label>
                    <input id="model" name="model" value="{{ old('model', $car->model ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="DBA-KF5P" />
                    @error('model')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="body_color">Body color</label>
                    <input id="body_color" name="body_color" value="{{ old('body_color', $car->body_color ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="BLUE(D)" />
                    @error('body_color')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="body_type">Body type</label>
                    <input id="body_type" name="body_type" value="{{ old('body_type', $car->body_type ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="SUV" />
                    @error('body_type')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="doors">Doors</label>
                    <input id="doors" name="doors" type="number" min="1" max="9" value="{{ old('doors', $car->doors ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="5" />
                    @error('doors')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="seats">Seats</label>
                    <input id="seats" name="seats" type="number" min="1" max="20" value="{{ old('seats', $car->seats ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="5" />
                    @error('seats')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="year">Year</label>
                    <input id="year" name="year" type="number" value="{{ old('year', $car->year ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="2023" />
                    @error('year')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="price_tzs">Price (TZS)</label>
                    <input id="price_tzs" name="price_tzs" type="number" value="{{ old('price_tzs', $car->price_tzs ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="185000000" />
                    @error('price_tzs')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="price_is_negotiable">Price policy</label>
                    <select id="price_is_negotiable" name="price_is_negotiable" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface focus:border-primary/40 focus:ring-2 focus:ring-primary/15">
                        <option value="1" {{ (string) old('price_is_negotiable', ($car->price_is_negotiable ?? true) ? '1' : '0') === '1' ? 'selected' : '' }}>Negotiable</option>
                        <option value="0" {{ (string) old('price_is_negotiable', ($car->price_is_negotiable ?? true) ? '1' : '0') === '0' ? 'selected' : '' }}>Not Negotiable</option>
                    </select>
                    @error('price_is_negotiable')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="location">Location</label>
                    <input id="location" name="location" value="{{ old('location', $car->location ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="Dar es Salaam" />
                    @error('location')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="transmission">Transmission</label>
                    <input id="transmission" name="transmission" value="{{ old('transmission', $car->transmission ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="Automatic" />
                    @error('transmission')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="fuel">Fuel</label>
                    <input id="fuel" name="fuel" value="{{ old('fuel', $car->fuel ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="Diesel" />
                    @error('fuel')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="condition">Condition</label>
                    <select id="condition" name="condition" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface focus:border-primary/40 focus:ring-2 focus:ring-primary/15">
                        <option value="">Select condition</option>
                        <option value="brand_new" {{ old('condition', $car->condition ?? '') === 'brand_new' ? 'selected' : '' }}>Brand New</option>
                        <option value="foreign_used" {{ old('condition', $car->condition ?? '') === 'foreign_used' ? 'selected' : '' }}>Foreign Used</option>
                        <option value="local_used" {{ old('condition', $car->condition ?? '') === 'local_used' ? 'selected' : '' }}>Locally Used</option>
                    </select>
                    @error('condition')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="mileage_km">Mileage (KM)</label>
                    <input id="mileage_km" name="mileage_km" type="number" value="{{ old('mileage_km', $car->mileage_km ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="12400" />
                    @error('mileage_km')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="engine">Engine</label>
                    <input id="engine" name="engine" value="{{ old('engine', $car->engine ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="3.5L Diesel" />
                    @error('engine')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="engine_capacity_cc">Engine Capacity (cc)</label>
                    <input id="engine_capacity_cc" name="engine_capacity_cc" type="number" value="{{ old('engine_capacity_cc', $car->engine_capacity_cc ?? '') }}" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="3500" />
                    <p class="mt-2 text-xs text-on-surface-variant">Used for accurate engine-capacity sorting on premium inventory.</p>
                    @error('engine_capacity_cc')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="rounded-2xl ring-1 ring-outline-variant/20 bg-surface-container-lowest border border-outline-variant/15 p-6">
            <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="description">Description</label>
            <textarea id="description" name="description" rows="7" class="w-full rounded-2xl bg-surface-container-low border border-slate-200/80 text-on-surface placeholder:text-on-surface-variant/70 focus:border-primary/40 focus:ring-2 focus:ring-primary/15" placeholder="Write a detailed description...">{{ old('description', $car->description ?? '') }}</textarea>
            @error('description')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="lg:col-span-4 space-y-6">
        <div class="rounded-2xl ring-1 ring-outline-variant/20 bg-surface-container-lowest border border-outline-variant/15 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <label class="text-xs font-semibold text-on-surface-variant" for="is_published">Published</label>
                <input id="is_published" name="is_published" type="checkbox" value="1" {{ old('is_published', ($car->is_published ?? true) ? 1 : 0) ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary/30" />
            </div>
            <div class="flex items-center justify-between">
                <label class="text-xs font-semibold text-on-surface-variant" for="is_featured">Featured</label>
                <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured', ($car->is_featured ?? false) ? 1 : 0) ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary/30" />
            </div>
        </div>

        <div class="rounded-2xl ring-1 ring-outline-variant/20 bg-surface-container-lowest border border-outline-variant/15 p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="hero_image">Hero image</label>
                <input id="hero_image" name="hero_image" type="file" accept="image/*,.heic,.heif,.avif,.webp" class="block w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-on-primary file:font-bold hover:file:opacity-95" />
                @error('hero_image')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
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

        <div class="rounded-2xl ring-1 ring-outline-variant/20 bg-surface-container-lowest border border-outline-variant/15 p-6 space-y-4">
            <div class="text-xs font-semibold text-on-surface-variant uppercase tracking-widest">View-specific images</div>
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
                    <div class="space-y-2 rounded-xl border border-slate-200/80 p-3">
                        <label class="block text-xs font-semibold text-on-surface-variant" for="{{ $slot['input'] }}">{{ $slot['label'] }}</label>
                        <input id="{{ $slot['input'] }}" name="{{ $slot['input'] }}[]" type="file" accept="image/*,.heic,.heif,.avif,.webp" multiple class="block w-full text-xs text-on-surface-variant file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-primary file:text-on-primary file:font-bold hover:file:opacity-95" />
                        <p class="text-xs text-on-surface-variant">You can add multiple {{ strtolower($slot['label']) }} images.</p>
                        @error($slot['input'])<div class="text-xs text-error mt-1">{{ $message }}</div>@enderror
                        @error($slot['input'] . '.*')<div class="text-xs text-error mt-1">{{ $message }}</div>@enderror

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

        <div class="rounded-2xl ring-1 ring-outline-variant/20 bg-surface-container-lowest border border-outline-variant/15 p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-on-surface-variant mb-2" for="gallery_images">Gallery images</label>
                <input id="gallery_images" name="gallery_images[]" type="file" accept="image/*,.heic,.heif,.avif,.webp" multiple class="block w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-on-primary file:font-bold hover:file:opacity-95" />
                <p class="text-xs text-on-surface-variant mt-2">You can upload up to 12 images. Each image max 5MB.</p>
                @error('gallery_images')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
                @error('gallery_images.*')<div class="text-xs text-error mt-2">{{ $message }}</div>@enderror
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
            <div class="rounded-2xl ring-1 ring-outline-variant/20 bg-surface-container-lowest border border-outline-variant/15 p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Image browser</div>
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
