@extends('admin.layout')

@section('title', 'Offers & news')
@section('breadcrumb', 'Cars Admin / Offers & news')

@section('content')
    <div class="space-y-6">
        <div class="rounded-3xl card-lift bg-surface text-on-surface shadow-xl ring-1 ring-slate-200/70 overflow-hidden">
            <div class="p-7 md:p-8 border-b border-outline-variant/20 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-primary font-headline tracking-tight mb-2 inline-flex items-center gap-2">
                        <span class="material-symbols-outlined">campaign</span>
                        Offers, discounts &amp; news
                    </h1>
                    <p class="text-on-surface-variant text-sm max-w-2xl">Post short updates here. They appear in the dedicated strip on the home page (below the hero), not inside the hero image.</p>
                </div>
                <a href="{{ route('admin.announcements.create') }}" class="inline-flex items-center justify-center gap-2 min-h-[44px] rounded-full bg-primary text-on-primary font-bold text-sm px-5 hover:opacity-95 transition">
                    <span class="material-symbols-outlined text-base">add</span>
                    New post
                </a>
            </div>

            <div class="p-7 md:p-8 overflow-x-auto">
                <table class="w-full min-w-[800px] text-sm">
                    <thead>
                        <tr class="text-left text-on-surface-variant border-b border-outline-variant/30">
                            <th class="py-2 pr-4">Type</th>
                            <th class="py-2 pr-4">Title</th>
                            <th class="py-2 pr-4">Window</th>
                            <th class="py-2 pr-4">Order</th>
                            <th class="py-2 pr-4">On home</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $row)
                            <tr class="border-b border-outline-variant/20 align-top">
                                <td class="py-3 pr-4">
                                    <span class="inline-block rounded-full px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wide bg-surface-container-high text-primary">{{ $row->kind }}</span>
                                </td>
                                <td class="py-3 pr-4 font-semibold text-on-surface max-w-xs">
                                    <span class="line-clamp-2">{{ $row->title }}</span>
                                </td>
                                <td class="py-3 pr-4 text-on-surface-variant text-xs">
                                    @if ($row->starts_at || $row->ends_at)
                                        {{ $row->starts_at?->format('M j, H:i') ?? '—' }}
                                        <span class="text-on-surface-variant/60"> → </span>
                                        {{ $row->ends_at?->format('M j, H:i') ?? '—' }}
                                    @else
                                        Always (no dates)
                                    @endif
                                </td>
                                <td class="py-3 pr-4">{{ $row->sort_order }}</td>
                                <td class="py-3 pr-4">{{ $row->is_published ? 'Yes' : 'No' }}</td>
                                <td class="py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.announcements.edit', $row) }}" class="text-primary font-bold underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.announcements.destroy', $row) }}" onsubmit="return confirm('Delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-error font-bold underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-on-surface-variant">No posts yet. Create one to show offers on the home page.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
