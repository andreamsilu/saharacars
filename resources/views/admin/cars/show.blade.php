@extends('admin.layout')

@section('title', 'View Car')
@section('breadcrumb', 'Cars / View')

@section('content')
    @php
        $publicSiteUrl = url('/' . config('app.locale') . '/cars/' . $car->getKey());
    @endphp

    <div class="flex items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black tracking-tight text-primary font-headline">View car</h1>
            <p class="text-sm text-on-surface-variant mt-2">{{ $car->title }}</p>
            <p class="text-xs text-on-surface-variant mt-3 max-w-2xl leading-relaxed">
                <strong class="text-on-surface">Admin vs website:</strong> This page is only in the admin panel.
                The public listing lives at <code class="text-xs bg-surface-container-high px-1 rounded">{{ $publicSiteUrl }}</code>.
                @if ($car->is_published)
                    Visitors can open it; use “Open public page” below.
                @else
                    <span class="text-tertiary font-semibold">This listing is not published — the public URL will show 404 until you turn on <strong>Published</strong> in Edit.</span>
                @endif
            </p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <a href="{{ $publicSiteUrl }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-2 min-h-10 px-4 rounded-lg border text-sm font-semibold transition-colors {{ $car->is_published ? 'border-secondary/40 bg-secondary-container/15 text-on-secondary-container hover:bg-secondary-container/25' : 'border-outline-variant/50 text-on-surface-variant cursor-not-allowed pointer-events-none opacity-60' }}"
                @if ($car->is_published) title="Open public listing in new tab" @else title="Publish this listing first — public visitors cannot see drafts" @endif
                @if (! $car->is_published) aria-disabled="true" @endif>
                <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                Open public page
            </a>
            <div class="flex items-center gap-2">
            <a href="{{ route('admin.cars.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-surface-container-low hover:bg-surface-container-high border border-slate-200/80 text-primary" title="Back to inventory" aria-label="Back to inventory">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span class="sr-only">Back</span>
            </a>
            <a href="{{ route('admin.cars.edit', $car) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-primary text-on-primary border border-primary/20 transition-[filter] hover:brightness-110 [&_.material-symbols-outlined]:text-on-primary" title="Edit listing" aria-label="Edit listing">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span class="sr-only">Edit</span>
            </a>
            </div>
        </div>
    </div>

    @php
        $imageBuckets = [
            'Hero' => array_filter([$car->hero_image_path]),
            'Front' => is_array($car->front_image_paths) ? $car->front_image_paths : array_filter([$car->front_image_path]),
            'Rear' => is_array($car->rear_image_paths) ? $car->rear_image_paths : array_filter([$car->rear_image_path]),
            'Side' => is_array($car->side_image_paths) ? $car->side_image_paths : array_filter([$car->side_image_path]),
            'Interior' => is_array($car->interior_image_paths) ? $car->interior_image_paths : array_filter([$car->interior_image_path]),
            'Gallery' => is_array($car->gallery_image_paths) ? $car->gallery_image_paths : [],
        ];
    @endphp

    <section class="rounded-2xl border border-slate-200/80 bg-surface-container-lowest p-6 space-y-6">
        <div>
            <h2 class="text-xl font-extrabold text-primary font-headline">Current listing details</h2>
            <p class="text-sm text-on-surface-variant">Read-only overview of this listing in admin panel.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
            <div><span class="text-on-surface-variant">Title:</span> <span class="font-semibold text-on-surface">{{ $car->title }}</span></div>
            <div><span class="text-on-surface-variant">Slug:</span> <span class="font-semibold text-on-surface">{{ $car->slug }}</span></div>
            <div><span class="text-on-surface-variant">Make (brand):</span> <span class="font-semibold text-on-surface">{{ $car->brand ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Model:</span> <span class="font-semibold text-on-surface">{{ $car->model ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Body color:</span> <span class="font-semibold text-on-surface">{{ $car->body_color ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Body type:</span> <span class="font-semibold text-on-surface">{{ $car->body_type ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Doors:</span> <span class="font-semibold text-on-surface">{{ $car->doors !== null ? $car->doors : '—' }}</span></div>
            <div><span class="text-on-surface-variant">Seats:</span> <span class="font-semibold text-on-surface">{{ $car->seats !== null ? $car->seats : '—' }}</span></div>
            <div><span class="text-on-surface-variant">Year:</span> <span class="font-semibold text-on-surface">{{ $car->year ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Price (TZS):</span> <span class="font-semibold text-on-surface">{{ $car->price_tzs ? number_format($car->price_tzs) : '—' }}</span></div>
            <div><span class="text-on-surface-variant">Estimated landed (TZS):</span> <span class="font-semibold text-on-surface">{{ $car->landed_cost_tzs ? number_format($car->landed_cost_tzs) : '—' }}</span></div>
            <div><span class="text-on-surface-variant">Condition:</span> <span class="font-semibold text-on-surface">{{ $car->condition ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Source country:</span> <span class="font-semibold text-on-surface">{{ $car->source_country ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Import status:</span> <span class="font-semibold text-on-surface">{{ $car->import_status ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">ETA:</span> <span class="font-semibold text-on-surface">{{ $car->eta_date?->format('M d, Y') ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Transmission:</span> <span class="font-semibold text-on-surface">{{ $car->transmission ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Fuel:</span> <span class="font-semibold text-on-surface">{{ $car->fuel ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Mileage:</span> <span class="font-semibold text-on-surface">{{ $car->mileage_km ? number_format($car->mileage_km).' km' : '—' }}</span></div>
            <div><span class="text-on-surface-variant">Engine:</span> <span class="font-semibold text-on-surface">{{ $car->engine ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Engine cc:</span> <span class="font-semibold text-on-surface">{{ $car->engine_capacity_cc ?: '—' }}</span></div>
            <div><span class="text-on-surface-variant">Published:</span> <span class="font-semibold text-on-surface">{{ $car->is_published ? 'Yes' : 'No' }}</span></div>
            <div><span class="text-on-surface-variant">Featured:</span> <span class="font-semibold text-on-surface">{{ $car->is_featured ? 'Yes' : 'No' }}</span></div>
            <div><span class="text-on-surface-variant">Updated:</span> <span class="font-semibold text-on-surface">{{ $car->updated_at?->format('M d, Y H:i') ?: '—' }}</span></div>
        </div>

        <div>
            <h3 class="text-sm font-bold text-primary mb-2">Description</h3>
            <p class="text-sm text-on-surface-variant whitespace-pre-line">{{ $car->description ?: 'No description.' }}</p>
        </div>

        <div class="space-y-4">
            <h3 class="text-sm font-bold text-primary">All images</h3>
            @foreach ($imageBuckets as $label => $paths)
                @if (count($paths))
                    <div class="space-y-2">
                        <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ $label }} ({{ count($paths) }})</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                            @foreach ($paths as $path)
                                <img src="{{ asset('storage/' . $path) }}" alt="{{ $car->title }} {{ strtolower($label) }} image" class="w-full h-24 object-cover rounded-lg border border-slate-200/80" />
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
