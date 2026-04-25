@extends('admin.layout')

@section('title', 'Order Requests')
@section('breadcrumb', 'Cars Admin / Order Requests')

@section('content')
    <div class="rounded-2xl bg-surface-container-lowest ring-1 ring-slate-200/80 border border-slate-200/90 overflow-hidden">
        <div class="p-6 border-b border-slate-200/80">
            <h1 class="text-3xl font-extrabold text-primary font-headline">Order Requests</h1>
            <p class="text-sm text-on-surface-variant mt-1">Customer requests for imported cars.</p>
        </div>

        <div class="md:hidden p-4 space-y-3">
            @forelse($orders as $order)
                <article class="rounded-xl border border-slate-200/80 bg-white p-4 space-y-2">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-on-surface">{{ $order->full_name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->email }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->phone ?: '—' }}</p>
                        </div>
                        @if($order->read_at)
                            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">Read</span>
                        @endif
                    </div>

                    <div class="text-xs text-on-surface-variant space-y-1">
                        <p><span class="font-semibold text-on-surface">Brand:</span> {{ $order->preferred_brand ?: 'Any' }}</p>
                        <p><span class="font-semibold text-on-surface">Model:</span> {{ $order->preferred_model ?: 'Any' }}</p>
                        <p><span class="font-semibold text-on-surface">Year:</span> {{ $order->year_min ?: '—' }} - {{ $order->year_max ?: '—' }}</p>
                        <p><span class="font-semibold text-on-surface">Source:</span> {{ $order->source_country ?: 'Any' }}</p>
                    </div>

                    <div class="text-xs text-on-surface-variant">
                        <span class="font-semibold text-on-surface">Budget:</span>
                        {{ $order->budget_min_tzs ? number_format($order->budget_min_tzs) : '—' }}
                        -
                        {{ $order->budget_max_tzs ? number_format($order->budget_max_tzs) : '—' }}
                    </div>
                    <div class="text-xs text-on-surface-variant">
                        <span class="font-semibold text-on-surface">Submitted:</span> {{ $order->created_at?->format('M d, Y H:i') }}
                    </div>

                    @if(!$order->read_at)
                        <form method="POST" action="{{ route('admin.inquiries.read', $order) }}" class="pt-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-primary text-on-primary text-xs font-bold">Mark read</button>
                        </form>
                    @endif
                </article>
            @empty
                <div class="rounded-xl border border-slate-200/80 bg-white px-4 py-8 text-center text-sm text-on-surface-variant">No order requests yet.</div>
            @endforelse
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                <tr class="bg-surface-container-low">
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Customer</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Request</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Budget</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Submitted</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant text-right">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-4 py-3 text-sm">
                            <p class="font-semibold text-on-surface">{{ $order->full_name }}</p>
                            <p class="text-on-surface-variant">{{ $order->email }}</p>
                            <p class="text-on-surface-variant">{{ $order->phone ?: '—' }}</p>
                        </td>
                        <td class="px-4 py-3 text-sm text-on-surface-variant">
                            <p><span class="font-semibold text-on-surface">Brand:</span> {{ $order->preferred_brand ?: 'Any' }}</p>
                            <p><span class="font-semibold text-on-surface">Model:</span> {{ $order->preferred_model ?: 'Any' }}</p>
                            <p><span class="font-semibold text-on-surface">Year:</span> {{ $order->year_min ?: '—' }} - {{ $order->year_max ?: '—' }}</p>
                            <p><span class="font-semibold text-on-surface">Source:</span> {{ $order->source_country ?: 'Any' }}</p>
                        </td>
                        <td class="px-4 py-3 text-sm text-on-surface-variant">
                            {{ $order->budget_min_tzs ? number_format($order->budget_min_tzs) : '—' }}
                            -
                            {{ $order->budget_max_tzs ? number_format($order->budget_max_tzs) : '—' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-on-surface-variant">
                            {{ $order->created_at?->format('M d, Y H:i') }}
                            @if($order->read_at)
                                <div class="text-emerald-700 text-xs font-semibold mt-1">Read</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            @if(!$order->read_at)
                                <form method="POST" action="{{ route('admin.inquiries.read', $order) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-primary text-on-primary text-xs font-bold">Mark read</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-sm text-on-surface-variant">No order requests yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection

