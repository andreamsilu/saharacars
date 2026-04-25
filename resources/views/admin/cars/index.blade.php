@extends('admin.layout')

@section('title', 'Inventory Management')
@section('breadcrumb', 'Fleet · Inventory')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <style>
        #admin-cars-table_wrapper {
            padding: 1rem 1.5rem 1.25rem;
        }

        #admin-cars-table_wrapper .dt-layout-row {
            gap: 0.75rem;
        }

        #admin-cars-table_wrapper .dt-layout-cell {
            color: #475569;
            font-size: 0.8rem;
        }

        #admin-cars-table_wrapper .dt-input,
        #admin-cars-table_wrapper .dt-length select {
            border: 1px solid #cbd5e1;
            border-radius: 0.6rem;
            padding: 0.4rem 0.6rem;
            background: #fff;
            color: #334155;
        }

        #admin-cars-table_wrapper .dt-paging .dt-paging-button {
            border-radius: 0.6rem;
            border: 1px solid #cbd5e1 !important;
            background: #fff !important;
            color: #334155 !important;
            margin: 0 0.15rem;
            min-width: 2rem;
        }

        #admin-cars-table_wrapper .dt-paging .dt-paging-button.current,
        #admin-cars-table_wrapper .dt-paging .dt-paging-button:hover {
            background: #8a6528 !important;
            color: #ffffff !important;
            border-color: #8a6528 !important;
        }

        #admin-cars-table tbody tr {
            border-bottom: 1px solid rgba(195, 198, 209, 0.28);
        }

        @media (max-width: 767px) {
            #admin-cars-table {
                min-width: 100%;
            }

            #admin-cars-table thead {
                display: none;
            }

            #admin-cars-table tbody,
            #admin-cars-table tr,
            #admin-cars-table td {
                display: block;
                width: 100%;
            }

            #admin-cars-table tbody tr {
                margin: 0.75rem 0.75rem 1rem;
                border: 1px solid rgba(195, 198, 209, 0.45);
                border-radius: 1rem;
                overflow: hidden;
                background: #fff;
                box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04);
            }

            #admin-cars-table td {
                border-bottom: 1px solid rgba(195, 198, 209, 0.2);
            }

            #admin-cars-table td:last-child {
                border-bottom: 0;
            }

            #admin-cars-table .text-right,
            #admin-cars-table .text-center {
                text-align: left !important;
            }

            #admin-cars-table td > div {
                padding: 0.75rem 1rem !important;
            }

            #admin-cars-table td > div > div {
                justify-content: flex-start !important;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $hasFilters = $status !== 'all' || $featured !== 'all' || ($priceMin !== null && $priceMin > 0) || ($priceMax !== null && $priceMax > 0);
    @endphp

    <div class="rounded-3xl card-lift bg-surface text-on-surface shadow-xl ring-1 ring-slate-200/80 overflow-hidden">
        {{-- Page header --}}
        <div class="p-7 md:p-8 border-b border-outline-variant/20">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-7 mb-8">
                <div>
                    <nav class="flex items-center gap-2 text-xs font-label uppercase tracking-wider text-on-surface-variant mb-3">
                        <span>Fleet</span>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="text-primary font-bold">Inventory Management</span>
                    </nav>
                </div>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_auto] gap-3 items-stretch">
                        <form method="get" action="{{ route('admin.cars.index') }}" class="relative w-full">
                            @if ($perPage !== 15)
                                <input type="hidden" name="per_page" value="{{ $perPage }}"/>
                            @endif
                            <input type="hidden" name="status" value="{{ $status }}"/>
                            <input type="hidden" name="featured" value="{{ $featured }}"/>
                            @if ($priceMin)
                                <input type="hidden" name="price_min" value="{{ $priceMin }}"/>
                            @endif
                            @if ($priceMax)
                                <input type="hidden" name="price_max" value="{{ $priceMax }}"/>
                            @endif
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                            <input
                                type="search"
                                name="q"
                                value="{{ $q }}"
                                class="w-full pl-10 pr-4 py-3 bg-surface-container-low rounded-2xl border border-outline-variant/30 focus:ring-2 focus:ring-primary/20 focus:border-primary/30 text-sm font-body text-on-surface placeholder:text-on-surface-variant/70"
                                placeholder="Search title or slug…"
                                autocomplete="off"
                            />
                        </form>
                        <div class="flex items-center justify-end gap-2 shrink-0">
                            <a href="{{ route('admin.cars.create') }}" class="h-11 bg-primary text-on-primary font-bold rounded-full text-sm shadow-lg shadow-primary/30 inline-flex items-center gap-1.5 px-4 justify-center transition-[filter] hover:brightness-110 border border-primary/20 [&_.material-symbols-outlined]:text-on-primary" title="Add New Car" aria-label="Add New Car">
                                <span class="material-symbols-outlined text-lg">add</span>
                                <span>Add New Car</span>
                            </a>
                        </div>
                    </div>

                    <form method="get" action="{{ route('admin.cars.index') }}" class="rounded-2xl border border-outline-variant/25 bg-surface-container-lowest p-3 md:p-4">
                        <input type="hidden" name="q" value="{{ $q }}"/>
                        @if ($perPage !== 15)
                            <input type="hidden" name="per_page" value="{{ $perPage }}"/>
                        @endif
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                            <select name="status" class="bg-surface-container-low border border-outline-variant/30 rounded-xl px-3 py-2.5 text-sm text-on-surface">
                                <option value="all" @selected($status === 'all')>All status</option>
                                <option value="published" @selected($status === 'published')>Published</option>
                                <option value="draft" @selected($status === 'draft')>Draft</option>
                            </select>

                            <select name="featured" class="bg-surface-container-low border border-outline-variant/30 rounded-xl px-3 py-2.5 text-sm text-on-surface">
                                <option value="all" @selected($featured === 'all')>All featured</option>
                                <option value="yes" @selected($featured === 'yes')>Featured only</option>
                                <option value="no" @selected($featured === 'no')>Not featured</option>
                            </select>

                            <input type="number" min="0" name="price_min" value="{{ $priceMin }}" placeholder="Min price" class="bg-surface-container-low border border-outline-variant/30 rounded-xl px-3 py-2.5 text-sm text-on-surface"/>
                            <input type="number" min="0" name="price_max" value="{{ $priceMax }}" placeholder="Max price" class="bg-surface-container-low border border-outline-variant/30 rounded-xl px-3 py-2.5 text-sm text-on-surface"/>

                            <div class="flex items-center justify-end gap-2">
                                <button type="submit" class="w-11 h-11 bg-surface-container-high text-primary font-bold rounded-xl text-sm hover:bg-surface-container-highest smooth inline-flex items-center justify-center border border-slate-200/80" title="Apply filters" aria-label="Apply filters">
                                    <span class="material-symbols-outlined text-base">tune</span>
                                    <span class="sr-only">Apply</span>
                                </button>
                                <a href="{{ route('admin.cars.index', ['q' => $q, 'per_page' => $perPage]) }}" class="w-11 h-11 border border-outline-variant/40 text-on-surface-variant font-semibold rounded-xl text-sm hover:bg-surface-container-low smooth inline-flex items-center justify-center {{ $hasFilters ? '' : 'opacity-60 pointer-events-none' }}" title="Reset filters" aria-label="Reset filters">
                                    <span class="material-symbols-outlined text-base">refresh</span>
                                    <span class="sr-only">Reset</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm flex items-center gap-4 ring-1 ring-slate-200/70">
                    <div class="w-12 h-12 bg-primary-container/10 rounded-lg flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined icon-info">directions_car</span>
                    </div>
                    <div>
                        <p class="text-xs font-label uppercase tracking-wider text-on-surface-variant">Total Units</p>
                        <p class="text-xl font-bold font-headline">{{ number_format($stats['total']) }}</p>
                    </div>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm flex items-center gap-4 ring-1 ring-slate-200/70">
                    <div class="w-12 h-12 bg-secondary-container/20 rounded-lg flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined icon-success">verified</span>
                    </div>
                    <div>
                        <p class="text-xs font-label uppercase tracking-wider text-on-surface-variant">Published</p>
                        <p class="text-xl font-bold font-headline">{{ number_format($stats['active']) }}</p>
                    </div>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm flex items-center gap-4 border-l-4 border-tertiary-fixed-dim ring-1 ring-slate-200/70">
                    <div class="w-12 h-12 bg-tertiary-fixed-dim/30 rounded-lg flex items-center justify-center text-tertiary">
                        <span class="material-symbols-outlined icon-warning">pending_actions</span>
                    </div>
                    <div>
                        <p class="text-xs font-label uppercase tracking-wider text-on-surface-variant">Drafts</p>
                        <p class="text-xl font-bold font-headline">{{ number_format($stats['pending']) }}</p>
                    </div>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm flex items-center gap-4 border-l-4 border-error/20 ring-1 ring-slate-200/70">
                    <div class="w-12 h-12 bg-error-container/30 rounded-lg flex items-center justify-center text-error">
                        <span class="material-symbols-outlined icon-danger">report</span>
                    </div>
                    <div>
                        <p class="text-xs font-label uppercase tracking-wider text-on-surface-variant">Flagged</p>
                        <p class="text-xl font-bold font-headline">{{ number_format($stats['flagged']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table id="admin-cars-table" class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant/20">
                        <th class="px-6 py-4 text-xs font-label uppercase tracking-wider text-on-surface-variant"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">directions_car</span>Vehicle Details</span></th>
                        <th class="px-6 py-4 text-xs font-label uppercase tracking-wider text-on-surface-variant text-right"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">payments</span>Price (TZS)</span></th>
                        <th class="px-6 py-4 text-xs font-label uppercase tracking-wider text-on-surface-variant text-center"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">rule</span>Status</span></th>
                        <th class="px-6 py-4 text-xs font-label uppercase tracking-wider text-on-surface-variant text-right"><span class="inline-flex items-center gap-1"><span class="material-symbols-outlined text-base">build</span>Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/15"></tbody>
            </table>
        </div>
    </div>

    {{-- Insight row --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-7">
        <div class="lg:col-span-2 bg-primary p-8 rounded-2xl relative overflow-hidden group ring-1 ring-slate-200/80">
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div>
                    <span class="px-3 py-1 bg-secondary text-white text-[11px] font-bold rounded-full uppercase tracking-widest">Inventory Health</span>
                    <h3 class="text-2xl font-bold text-white font-headline mt-4">Publishing progress</h3>
                    <p class="text-white/70 text-sm mt-2 max-w-md">
                        Draft listings awaiting review: <strong class="text-white">{{ number_format($stats['pending']) }}</strong>.
                        Publish from the edit screen when a vehicle is ready for the showroom.
                    </p>
                </div>
                <div class="mt-8 flex items-center gap-7 flex-wrap">
                    <div class="flex flex-col">
                        <span class="text-secondary font-bold text-2xl font-headline">{{ number_format($stats['active']) }}</span>
                        <span class="text-[11px] uppercase tracking-wider text-white/50 font-label">Live listings</span>
                    </div>
                    <div class="w-px h-10 bg-white/10 hidden sm:block"></div>
                    <div class="flex flex-col">
                        <span class="text-white font-bold text-2xl font-headline">{{ $stats['total'] > 0 ? round(100 * $stats['active'] / $stats['total']) : 0 }}%</span>
                        <span class="text-[11px] uppercase tracking-wider text-white/50 font-label">Published share</span>
                    </div>
                </div>
            </div>
            <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-primary-container/30 rounded-full blur-3xl group-hover:bg-secondary/10 smooth duration-700"></div>
        </div>
        <div class="bg-surface text-on-surface p-7 rounded-2xl shadow-sm ring-1 ring-slate-200/80 border border-outline-variant/10">
            <h4 class="text-sm font-bold text-primary font-headline mb-4">Quick actions</h4>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.cars.create') }}" class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-surface-container-low hover:bg-surface-container-high smooth text-primary border border-slate-200/80" title="New listing" aria-label="New listing">
                    <span class="material-symbols-outlined icon-info">add_circle</span>
                    <span class="sr-only">New listing</span>
                </a>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-surface-container-low hover:bg-surface-container-high smooth text-on-surface-variant border border-slate-200/80" title="View public site" aria-label="View public site" target="_blank" rel="noopener noreferrer">
                    <span class="material-symbols-outlined icon-neutral">open_in_new</span>
                    <span class="sr-only">View public site</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        (() => {
            const table = new DataTable('#admin-cars-table', {
                processing: true,
                serverSide: true,
                searching: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: {{ (int) $perPage }},
                ajax: {
                    url: "{{ route('admin.cars.data') }}",
                    data: (d) => {
                        d.q = document.querySelector('input[name="q"]')?.value ?? '';
                        d.status = document.querySelector('select[name="status"]')?.value ?? 'all';
                        d.featured = document.querySelector('select[name="featured"]')?.value ?? 'all';
                        d.price_min = document.querySelector('input[name="price_min"]')?.value ?? '';
                        d.price_max = document.querySelector('input[name="price_max"]')?.value ?? '';
                    }
                },
                order: [[3, 'desc']],
                columns: [
                    {
                        data: null,
                        orderable: true,
                        render: (row) => {
                            const bits = [row.transmission, row.fuel, row.mileage_km ? `${Number(row.mileage_km).toLocaleString()} km` : null].filter(Boolean);
                            const hero = row.hero_image_path
                                ? `<img src="/storage/${row.hero_image_path}" alt="" class="w-full h-full object-cover" />`
                                : `<div class="w-full h-full flex items-center justify-center text-on-surface-variant/70"><span class="material-symbols-outlined">image</span></div>`;
                            return `
                                <div class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="relative w-20 h-14 rounded-lg overflow-hidden bg-surface-dim shrink-0">${hero}</div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-bold text-primary font-headline truncate">${row.title ?? ''}</p>
                                            <p class="text-xs text-on-surface-variant">${bits.length ? bits.join(' • ') : '—'}</p>
                                        </div>
                                    </div>
                                </div>`;
                        }
                    },
                    {
                        data: 'price_tzs',
                        orderable: true,
                        className: 'text-right',
                        render: (value, type, row) => {
                            const price = value ? Number(value).toLocaleString() : '—';
                            return `<div class="px-6 py-5 text-right"><p class="text-sm font-bold text-primary">${price}</p>${row.year ? `<p class="text-[11px] font-label text-on-surface-variant uppercase tracking-tighter">${row.year} model</p>` : ''}</div>`;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: (row) => {
                            const status = row.is_published
                                ? '<span class="px-3 py-1 bg-secondary-container/20 text-on-secondary-container text-xs font-bold rounded-full inline-flex items-center gap-1 uppercase tracking-wider"><span class="w-1.5 h-1.5 bg-secondary rounded-full"></span>Live</span>'
                                : '<span class="px-3 py-1 bg-tertiary-fixed-dim/30 text-tertiary text-xs font-bold rounded-full inline-flex items-center gap-1 uppercase tracking-wider"><span class="w-1.5 h-1.5 bg-tertiary rounded-full"></span>Draft</span>';
                            const featured = row.is_featured ? '<span class="px-2 py-1 bg-primary/10 text-primary text-[11px] font-bold rounded-full uppercase">Featured</span>' : '';
                            return `<div class="px-6 py-5"><div class="flex justify-center flex-wrap gap-1">${status}${featured}</div></div>`;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-right',
                        render: (row) => {
                            const deleteForm = `
                                <form method="POST" action="${row.delete_url}" class="inline" onsubmit="return confirm('Delete this listing?');">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="inline-flex items-center justify-center w-9 h-9 text-error hover:bg-error/10 rounded-full smooth border border-error/30 bg-white" title="Delete" aria-label="Delete">
                                        <span class="material-symbols-outlined text-[20px] icon-danger">delete</span>
                                        <span class="sr-only">Delete</span>
                                    </button>
                                </form>`;
                            return `
                                <div class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2 flex-wrap">
                                        <a href="${row.show_url}" class="inline-flex items-center justify-center w-9 h-9 text-primary hover:bg-slate-100 hover:text-primary rounded-full smooth border border-primary/30 bg-white" title="View details" aria-label="View details">
                                            <span class="material-symbols-outlined text-[20px] icon-info">visibility</span>
                                            <span class="sr-only">View</span>
                                        </a>
                                        <a href="${row.edit_url}" class="inline-flex items-center justify-center w-9 h-9 text-on-surface-variant hover:bg-surface-container-high rounded-full smooth border border-slate-300/80 bg-white" title="Edit" aria-label="Edit">
                                            <span class="material-symbols-outlined text-[20px] icon-neutral">edit</span>
                                            <span class="sr-only">Edit</span>
                                        </a>
                                        ${deleteForm}
                                    </div>
                                </div>`;
                        }
                    }
                ],
                language: {
                    emptyTable: 'No vehicles found for the selected filters.',
                    processing: 'Loading cars...'
                }
            });

            const searchInput = document.querySelector('input[name="q"]');
            const statusSelect = document.querySelector('select[name="status"]');
            const featuredSelect = document.querySelector('select[name="featured"]');
            const minInput = document.querySelector('input[name="price_min"]');
            const maxInput = document.querySelector('input[name="price_max"]');
            const applyBtn = document.querySelector('button[title="Apply filters"]');
            const resetBtn = document.querySelector('a[title="Reset filters"]');

            let searchDebounce;
            searchInput?.addEventListener('input', () => {
                clearTimeout(searchDebounce);
                searchDebounce = setTimeout(() => table.ajax.reload(), 300);
            });

            [statusSelect, featuredSelect, minInput, maxInput].forEach((el) => {
                el?.addEventListener('change', () => table.ajax.reload());
            });

            applyBtn?.addEventListener('click', (event) => {
                event.preventDefault();
                table.ajax.reload();
            });

            resetBtn?.addEventListener('click', (event) => {
                event.preventDefault();
                if (searchInput) searchInput.value = '';
                if (statusSelect) statusSelect.value = 'all';
                if (featuredSelect) featuredSelect.value = 'all';
                if (minInput) minInput.value = '';
                if (maxInput) maxInput.value = '';
                table.ajax.reload();
            });
        })();
    </script>
@endsection
