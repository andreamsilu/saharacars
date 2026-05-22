@extends('admin.layout')

@section('title', 'Edit Car')
@section('breadcrumb', 'Sahara Autolink / Inventory / Edit')

@section('content')
    <div class="flex items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-black tracking-tight text-primary font-headline">Edit car</h1>
            <p class="text-sm text-on-surface-variant mt-2">{{ $car->title }}</p>
        </div>
        <a href="{{ route('admin.cars.index') }}" class="inline-flex min-h-[44px] items-center justify-center gap-1.5 rounded-xl border border-slate-200/80 bg-white px-4 py-2 text-sm font-semibold text-primary hover:bg-slate-50" title="Back to inventory">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_back</span>
            <span>Back</span>
        </a>
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

    <section class="mb-8 rounded-2xl border border-slate-200/80 bg-surface-container-lowest p-6 space-y-6">
        <div>
            <h2 class="text-xl font-extrabold text-primary font-headline">Current listing details</h2>
            <p class="text-sm text-on-surface-variant">Quick preview of all saved data before you make changes.</p>
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
            <div><span class="text-on-surface-variant">Condition:</span> <span class="font-semibold text-on-surface">{{ $car->condition ?: '—' }}</span></div>
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
            @forelse ($imageBuckets as $label => $paths)
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
            @empty
                <p class="text-sm text-on-surface-variant">No images available.</p>
            @endforelse
        </div>
    </section>

    <form id="car-edit-form" method="POST" action="{{ route('admin.cars.update', $car) }}" enctype="multipart/form-data" class="admin-car-form space-y-6">
        @csrf
        @method('PUT')
        @include('admin.cars._form', ['car' => $car])
    </form>

    <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
        <form method="POST" action="{{ route('admin.cars.destroy', $car) }}" class="inline" onsubmit="return confirm('Delete this car?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-800 hover:bg-red-100">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true">delete</span>
                <span>Delete listing</span>
            </button>
        </form>

        <button type="submit" form="car-edit-form" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-bold text-on-primary shadow-sm hover:opacity-95 transition border border-primary/20">
            <span class="material-symbols-outlined text-[20px]" aria-hidden="true">save</span>
            <span>Save changes</span>
        </button>
    </div>
@endsection

