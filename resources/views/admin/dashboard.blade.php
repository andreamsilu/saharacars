@extends('admin.layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 mb-12">
        <a href="{{ route('admin.cars.index') }}" class="block bg-surface-container-lowest p-7 rounded-2xl card-lift ring-1 ring-slate-300/80 border border-slate-200/90 relative overflow-hidden hover:bg-surface-container-low smooth" aria-label="Open inventory listings">
            <div class="absolute top-0 right-0 p-4 text-primary/20">
                <span class="material-symbols-outlined text-6xl">directions_car</span>
            </div>
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Total Listings</p>
            <h3 class="text-4xl font-extrabold text-primary mb-1">{{ number_format($carsTotal) }}</h3>
            <p class="text-sm text-on-surface-variant">All vehicles in the system</p>
        </a>

        <div class="bg-surface-container-lowest p-7 rounded-2xl card-lift ring-1 ring-slate-300/80 border border-slate-200/90 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 text-emerald-600/25">
                <span class="material-symbols-outlined text-6xl">check_circle</span>
            </div>
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Published</p>
            <h3 class="text-4xl font-extrabold text-primary mb-1">{{ number_format($publishedTotal) }}</h3>
            <p class="text-xs text-secondary font-semibold">Live on the site</p>
        </div>

        <div class="bg-surface-container-lowest p-7 rounded-2xl card-lift ring-1 ring-slate-300/80 border border-slate-200/90 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 text-amber-600/25">
                <span class="material-symbols-outlined text-6xl">edit_note</span>
            </div>
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Drafts</p>
            <h3 class="text-4xl font-extrabold text-primary mb-1">{{ number_format($draftTotal) }}</h3>
            <p class="text-sm text-on-surface-variant">Not yet published</p>
        </div>

        <div class="bg-surface-container-lowest p-7 rounded-2xl card-lift ring-1 ring-slate-300/80 border border-slate-200/90 border-b-4 border-secondary relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 text-rose-600/25">
                <span class="material-symbols-outlined text-6xl">local_fire_department</span>
            </div>
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Featured</p>
            <h3 class="text-4xl font-extrabold text-primary mb-1">{{ number_format($featuredTotal) }}</h3>
            <p class="text-sm text-on-surface-variant">Highlighted on the homepage</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-9 mb-12">
        <div class="lg:col-span-2 bg-surface-container-lowest rounded-2xl p-9 ring-1 ring-slate-300/80 border border-slate-200/90">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-primary font-headline inline-flex items-center gap-2">
                        <span class="material-symbols-outlined icon-info">monitoring</span>
                        Listing volume
                    </h2>
                    <p class="text-sm text-on-surface-variant">Placeholder chart — connect real time-series data when needed.</p>
                </div>
            </div>
            <div class="relative h-[240px] w-full flex items-end justify-between px-4 gap-2">
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="border-t border-slate-200/80 w-full"></div>
                    @endfor
                </div>
                @for ($i = 0; $i < 6; $i++)
                    @php
                        $h = 40 + ($i * 17) % 100;
                    @endphp
                    <div class="flex flex-col items-center flex-1 z-10 max-w-[48px]">
                        <div class="w-full bg-primary/30 rounded-t-lg" style="height: {{ $h }}px"></div>
                    </div>
                @endfor
            </div>
            <p class="mt-4 text-sm text-on-surface-variant">This month’s published inventory value (proxy): <span class="font-bold text-primary">TZS {{ number_format($monthlyRevenue) }}</span></p>
        </div>

        <div class="bg-surface-container-lowest rounded-2xl p-9 ring-1 ring-slate-300/80 border border-slate-200/90">
            <h2 class="text-2xl font-extrabold text-primary font-headline mb-2 inline-flex items-center gap-2">
                <span class="material-symbols-outlined icon-neutral">bolt</span>
                Quick links
            </h2>
            <p class="text-sm text-on-surface-variant mb-6">Manage your showroom listings.</p>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.cars.create') }}" class="inline-flex items-center justify-center w-11 h-11 text-primary bg-surface-container-low hover:bg-surface-container-high smooth rounded-2xl ring-1 ring-slate-200/60 border border-slate-200/80" title="New listing" aria-label="New listing">
                    <span class="material-symbols-outlined icon-info text-[20px]">add_circle</span>
                    <span class="sr-only">New listing</span>
                </a>
                <a href="{{ route('admin.cars.index') }}" class="inline-flex items-center justify-center w-11 h-11 text-primary bg-surface-container-low hover:bg-surface-container-high smooth rounded-2xl ring-1 ring-slate-200/60 border border-slate-200/80" title="Open inventory" aria-label="Open inventory">
                    <span class="material-symbols-outlined icon-info text-[20px]">directions_car</span>
                    <span class="sr-only">Open inventory</span>
                </a>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-11 h-11 text-on-surface-variant bg-white hover:bg-surface-container-low smooth rounded-2xl ring-1 ring-slate-200/60 border border-slate-200/80" title="View public site" aria-label="View public site" target="_blank" rel="noopener noreferrer">
                    <span class="material-symbols-outlined icon-neutral text-[20px]">open_in_new</span>
                    <span class="sr-only">View public site</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl card-lift ring-1 ring-slate-300/80 border border-slate-200/90 overflow-hidden">
        <div class="p-7 md:p-9 border-b border-slate-200/80 flex justify-between items-center flex-wrap gap-4">
            <h2 class="text-2xl font-extrabold text-primary font-headline inline-flex items-center gap-2">
                <span class="material-symbols-outlined icon-info">history</span>
                Recent listings
            </h2>
            <a href="{{ route('admin.cars.index') }}" class="inline-flex items-center justify-center w-9 h-9 rounded-full text-primary hover:bg-slate-100 hover:text-primary smooth border border-primary/30 bg-white" title="View all listings" aria-label="View all listings">
                <span class="material-symbols-outlined text-[20px]">list</span>
                <span class="sr-only">View all</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low">
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">directions_car</span>Vehicle</span></th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">rule</span>Status</span></th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">event</span>Updated</span></th>
                        <th class="px-6 py-4 text-xs font-bold text-on-surface-variant uppercase tracking-widest text-right"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">build</span>Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80">
                    @forelse ($recentCars as $car)
                        <tr
                            class="hover:bg-surface-container-low/80 smooth cursor-pointer"
                            onclick="window.location='{{ route('admin.cars.edit', $car) }}'"
                            role="link"
                            tabindex="0"
                            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();window.location='{{ route('admin.cars.edit', $car) }}';}"
                            aria-label="Edit {{ $car->title }}"
                        >
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-on-surface">{{ $car->title }}</p>
                                <p class="text-xs text-on-surface-variant font-mono">{{ $car->slug }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($car->is_published)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-900 border border-emerald-200">Live</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-surface-container-high text-on-surface-variant border border-slate-200/80">Draft</span>
                                @endif
                                @if ($car->is_featured)
                                    <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-primary/10 text-primary">Featured</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $car->updated_at?->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="inline-flex items-center justify-center w-9 h-9 text-primary hover:bg-slate-100 hover:text-primary rounded-full smooth border border-primary/30 bg-white" title="Edit listing" aria-label="Edit listing">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                    <span class="sr-only">Edit</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-sm text-on-surface-variant text-center">No vehicles yet. <a href="{{ route('admin.cars.create') }}" class="text-primary font-semibold underline">Create a listing</a>.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <button
        class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-[1.05] active:scale-95 transition-transform z-50"
        type="button"
        title="Quick add (coming soon)"
        disabled
    >
        <span class="material-symbols-outlined">add</span>
    </button>
@endsection
