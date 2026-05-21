@extends('admin.layout')

@section('title', 'Brand Management')
@section('breadcrumb', 'Sahara Autolink / Brands')

@section('content')
    <div class="space-y-6">
        <div class="rounded-3xl card-lift bg-surface text-on-surface shadow-xl ring-1 ring-slate-200/70 overflow-hidden">
            <div class="p-7 md:p-8 border-b border-outline-variant/20">
                <h1 class="text-3xl md:text-4xl font-extrabold text-primary font-headline tracking-tight mb-2 inline-flex items-center gap-2">
                    <span class="material-symbols-outlined">branding_watermark</span>
                    Brand Management
                </h1>
                <p class="text-on-surface-variant text-sm">Manage brand names and logos used on home page and linked inventory.</p>
            </div>

            <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data" class="p-5 sm:p-7 md:p-8 grid grid-cols-1 md:grid-cols-12 gap-4 items-end border-b border-outline-variant/20">
                @csrf
                <div class="md:col-span-3 space-y-1">
                    <label for="brand-name" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Brand name</label>
                    <input id="brand-name" name="name" type="text" value="{{ old('name') }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-2.5 text-on-surface" placeholder="Toyota" required />
                </div>
                <div class="md:col-span-5 space-y-1">
                    <label for="brand-logo" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Brand logo</label>
                    <input id="brand-logo" name="logo" type="file" accept="image/*,.webp,.avif" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-2.5 text-on-surface file:mr-3 file:px-3 file:py-1.5 file:rounded-lg file:border-0 file:bg-primary file:text-on-primary file:font-bold" required />
                </div>
                <div class="md:col-span-2 space-y-1">
                    <label for="brand-order" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Sort order</label>
                    <input id="brand-order" name="sort_order" type="number" min="0" max="9999" value="{{ old('sort_order', 0) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-2.5 text-on-surface" />
                </div>
                <div class="md:col-span-1 flex items-center gap-2">
                    <input id="brand-featured" name="is_featured" type="checkbox" value="1" checked class="rounded border-slate-300 text-primary focus:ring-primary/30" />
                    <label for="brand-featured" class="text-xs font-semibold text-on-surface-variant">Show</label>
                </div>
                <div class="md:col-span-1">
                    <button type="submit" class="w-full min-h-[44px] rounded-xl bg-primary text-on-primary font-bold text-sm hover:opacity-95 transition">Add</button>
                </div>
            </form>

            <div class="p-5 sm:p-7 md:p-8 overflow-x-auto">
                <table class="w-full min-w-[960px] text-sm">
                    <thead>
                        <tr class="text-left text-on-surface-variant border-b border-outline-variant/30">
                            <th class="py-2 pr-4">Brand</th>
                            <th class="py-2 pr-4">Logo Preview</th>
                            <th class="py-2 pr-4">Published Cars</th>
                            <th class="py-2 pr-4">Show on Home</th>
                            <th class="py-2 pr-4">Order</th>
                            <th class="py-2">Manage</th>
                        </tr>
                    </thead>
                    <tbody class="align-top">
                        @forelse ($brands as $brand)
                            <tr class="border-b border-outline-variant/20">
                                <td class="py-4 pr-4 font-semibold text-primary">{{ $brand->name }}</td>
                                <td class="py-4 pr-4">
                                    @if ($brand->logo_path)
                                        <img src="{{ asset('storage/' . $brand->logo_path) }}" alt="{{ $brand->name }} logo" class="h-7 w-auto object-contain" loading="lazy" decoding="async" />
                                    @else
                                        <span class="text-on-surface-variant text-xs">No logo</span>
                                    @endif
                                </td>
                                <td class="py-4 pr-4 font-semibold text-primary">{{ $brand->published_cars_count }}</td>
                                <td class="py-4 pr-4">{{ $brand->is_featured ? 'Yes' : 'No' }}</td>
                                <td class="py-4 pr-4">{{ $brand->sort_order }}</td>
                                <td class="py-4">
                                    <div class="flex items-start flex-wrap gap-2">
                                        <form method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data" class="grid grid-cols-1 gap-2 w-full sm:w-[360px]">
                                            @csrf
                                            @method('PUT')
                                            <input name="name" type="text" value="{{ $brand->name }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-2 text-on-surface" required />
                                            <input name="logo" type="file" accept="image/*,.webp,.avif" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-2 text-on-surface file:mr-2 file:px-2 file:py-1 file:rounded-lg file:border-0 file:bg-primary file:text-on-primary file:font-bold" />
                                            <div class="flex items-center flex-wrap gap-2">
                                                <label class="inline-flex items-center gap-1 text-xs text-on-surface-variant whitespace-nowrap">
                                                    <input name="is_featured" type="checkbox" value="1" {{ $brand->is_featured ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary/30" />
                                                    Show on Home
                                                </label>
                                                <input name="sort_order" type="number" min="0" max="9999" value="{{ $brand->sort_order }}" class="w-20 bg-surface-container-low border border-slate-200/80 rounded-xl p-2 text-on-surface" />
                                                <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-outline-variant/40 text-primary hover:bg-surface-container-high" title="Save brand" aria-label="Save brand">
                                                    <span class="material-symbols-outlined text-base">save</span>
                                                </button>
                                            </div>
                                        </form>
                                        <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}" onsubmit="return confirm('Delete this brand? Linked cars will remain but without brand link.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-outline-variant/40 text-error hover:bg-error-container/30" title="Delete brand" aria-label="Delete brand">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                            </button>
                                        </form>
                                        <a href="{{ route('cars.index', ['brand' => $brand->name]) }}" class="text-primary font-semibold underline underline-offset-2 whitespace-nowrap" target="_blank" rel="noopener noreferrer">
                                            View cars
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-on-surface-variant">No brands yet. Add your first brand above.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

