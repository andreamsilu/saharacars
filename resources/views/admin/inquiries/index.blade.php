@extends('admin.layout')

@section('title', 'Order Requests')
@section('breadcrumb', 'Sahara Autolink / Order Requests')

@section('content')
    <div class="rounded-2xl bg-surface-container-lowest ring-1 ring-slate-200/80 border border-slate-200/90 overflow-hidden">
        <div class="p-6 border-b border-slate-200/80 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-primary font-headline">Order Requests</h1>
                <p class="text-sm text-on-surface-variant mt-1">Customer requests for imported cars. Mark as <strong>Done</strong> when handled, or back to <strong>Pending</strong> if you need to reopen.</p>
            </div>
            <div class="flex flex-wrap gap-2" role="tablist" aria-label="Filter by status">
                @foreach ([
                    'all' => 'All (' . number_format($statusCounts['all']) . ')',
                    \App\Models\Inquiry::STATUS_PENDING => 'Pending (' . number_format($statusCounts[\App\Models\Inquiry::STATUS_PENDING]) . ')',
                    \App\Models\Inquiry::STATUS_DONE => 'Done (' . number_format($statusCounts[\App\Models\Inquiry::STATUS_DONE]) . ')',
                ] as $value => $label)
                    <a
                        href="{{ route('admin.inquiries.index', $value === 'all' ? [] : ['status' => $value]) }}"
                        class="inline-flex items-center justify-center min-h-[40px] px-4 rounded-full text-xs font-bold border transition-colors {{ $statusFilter === $value ? 'bg-primary text-on-primary border-primary/30' : 'bg-white text-on-surface-variant border-slate-200/80 hover:border-primary/30 hover:text-primary' }}"
                        @if ($statusFilter === $value) aria-current="page" @endif
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        @if (session('status'))
            <div class="mx-6 mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900" role="status">
                {{ session('status') }}
            </div>
        @endif

        <div class="md:hidden p-4 space-y-3">
            @forelse($orders as $order)
                <article class="rounded-xl border border-slate-200/80 bg-white p-4 space-y-2">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-on-surface">{{ $order->full_name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->email }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->phone ?: '—' }}</p>
                        </div>
                    </div>

                    <div class="text-xs text-on-surface-variant space-y-1">
                        <p><span class="font-semibold text-on-surface">Brand:</span> {{ $order->preferred_brand ?: 'Any' }}</p>
                        <p><span class="font-semibold text-on-surface">Model:</span> {{ $order->preferred_model ?: 'Any' }}</p>
                        <p><span class="font-semibold text-on-surface">Year:</span> {{ $order->year_min ?: '—' }} - {{ $order->year_max ?: '—' }}</p>
                        <p><span class="font-semibold text-on-surface">Source:</span> {{ $order->source_country ?: 'Any' }}</p>
                    </div>

                    @if ($order->message)
                        <p class="text-xs text-on-surface-variant"><span class="font-semibold text-on-surface">Notes:</span> {{ $order->message }}</p>
                    @endif

                    <div class="text-xs text-on-surface-variant">
                        <span class="font-semibold text-on-surface">Budget:</span>
                        {{ $order->budget_min_tzs ? number_format($order->budget_min_tzs) : '—' }}
                        -
                        {{ $order->budget_max_tzs ? number_format($order->budget_max_tzs) : '—' }}
                    </div>
                    <div class="text-xs text-on-surface-variant">
                        <span class="font-semibold text-on-surface">Submitted:</span> {{ $order->created_at?->format('M d, Y H:i') }}
                    </div>

                    @php $isDone = $order->status === \App\Models\Inquiry::STATUS_DONE; @endphp
                    <div class="flex flex-wrap items-center justify-between gap-2 pt-1">
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[11px] font-semibold border {{ $isDone ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-amber-100 text-amber-900 border-amber-200' }}">
                            {{ $isDone ? 'Done' : 'Pending' }}
                        </span>
                        @if (! $isDone)
                            <form method="POST" action="{{ route('admin.inquiries.status', $order) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ \App\Models\Inquiry::STATUS_DONE }}" />
                                <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-primary text-on-primary text-xs font-bold">Mark done</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.inquiries.status', $order) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ \App\Models\Inquiry::STATUS_PENDING }}" />
                                <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-lg border border-slate-300 bg-white text-on-surface text-xs font-bold">Mark pending</button>
                            </form>
                        @endif
                    </div>
                </article>
            @empty
                <div class="rounded-xl border border-slate-200/80 bg-white px-4 py-8 text-center text-sm text-on-surface-variant">
                    @if ($statusFilter === \App\Models\Inquiry::STATUS_PENDING)
                        No pending order requests.
                    @elseif ($statusFilter === \App\Models\Inquiry::STATUS_DONE)
                        No completed order requests yet.
                    @else
                        No order requests yet.
                    @endif
                </div>
            @endforelse
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                <tr class="bg-surface-container-low">
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Customer</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Request</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Budget</th>
                    <th class="px-4 py-3 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Status</th>
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
                            @if ($order->message)
                                <p class="mt-1"><span class="font-semibold text-on-surface">Notes:</span> {{ Str::limit($order->message, 120) }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-on-surface-variant">
                            {{ $order->budget_min_tzs ? number_format($order->budget_min_tzs) : '—' }}
                            -
                            {{ $order->budget_max_tzs ? number_format($order->budget_max_tzs) : '—' }}
                        </td>
                        <td class="px-4 py-3">
                            @php $isDone = $order->status === \App\Models\Inquiry::STATUS_DONE; @endphp
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold border {{ $isDone ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-amber-100 text-amber-900 border-amber-200' }}">
                                {{ $isDone ? 'Done' : 'Pending' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-on-surface-variant">
                            {{ $order->created_at?->format('M d, Y H:i') }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            @if (! $isDone)
                                <form method="POST" action="{{ route('admin.inquiries.status', $order) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ \App\Models\Inquiry::STATUS_DONE }}" />
                                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-lg bg-primary text-on-primary text-xs font-bold">Mark done</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.inquiries.status', $order) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ \App\Models\Inquiry::STATUS_PENDING }}" />
                                    <button type="submit" class="inline-flex items-center justify-center px-3 py-2 rounded-lg border border-slate-300 bg-white text-on-surface text-xs font-bold hover:bg-slate-50">Mark pending</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-sm text-on-surface-variant">
                            @if ($statusFilter === \App\Models\Inquiry::STATUS_PENDING)
                                No pending order requests.
                            @elseif ($statusFilter === \App\Models\Inquiry::STATUS_DONE)
                                No completed order requests yet.
                            @else
                                No order requests yet.
                            @endif
                        </td>
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
