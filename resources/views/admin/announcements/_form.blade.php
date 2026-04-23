@php
    $a = $announcement ?? null;
    $kinds = [
        \App\Models\Announcement::KIND_OFFER => 'Offer',
        \App\Models\Announcement::KIND_DISCOUNT => 'Discount',
        \App\Models\Announcement::KIND_NEWS => 'News / update',
    ];
@endphp
<div class="space-y-4 max-w-2xl">
    <div class="space-y-1">
        <label for="ann-title" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Title</label>
        <input id="ann-title" name="title" type="text" value="{{ old('title', $a?->title) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-3 text-on-surface" required maxlength="180" />
    </div>
    <div class="space-y-1">
        <label for="ann-summary" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Short text (optional)</label>
        <textarea id="ann-summary" name="summary" rows="2" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-3 text-on-surface" maxlength="500" placeholder="One line for the home strip">{{ old('summary', $a?->summary) }}</textarea>
    </div>
    <div class="space-y-1">
        <label for="ann-link" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Link (optional)</label>
        <input id="ann-link" name="link_url" type="text" value="{{ old('link_url', $a?->link_url) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-3 text-on-surface" placeholder="https://… or /cars, /order-request" autocomplete="off" />
        <p class="text-[11px] text-on-surface-variant">Use a full <span class="font-mono">https://…</span> link or an internal path starting with <span class="font-mono">/</span> (e.g. <span class="font-mono">/cars?sort=newest</span>).</p>
    </div>
    <div class="space-y-1">
        <input type="hidden" name="link_new_tab" value="0" />
        <label class="inline-flex items-center gap-2 min-h-[44px]">
            <input name="link_new_tab" type="checkbox" value="1" class="rounded border-slate-300 text-primary focus:ring-primary/30" @checked((string) old('link_new_tab', $a?->link_new_tab === null ? '1' : ($a?->link_new_tab ? '1' : '0')) === '1') />
            <span class="text-sm font-semibold text-on-surface">Open link in a new tab</span>
        </label>
    </div>
    <div class="space-y-1">
        <label for="ann-kind" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Type</label>
        <select id="ann-kind" name="kind" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-3 text-on-surface" required>
            @foreach ($kinds as $value => $label)
                <option value="{{ $value }}" {{ old('kind', $a?->kind ?? \App\Models\Announcement::KIND_NEWS) === $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="space-y-1">
            <label for="ann-start" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Show from (optional)</label>
            <input id="ann-start" name="starts_at" type="datetime-local" value="{{ old('starts_at', $a?->starts_at?->format('Y-m-d\TH:i')) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-3 text-on-surface" />
        </div>
        <div class="space-y-1">
            <label for="ann-end" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Hide after (optional)</label>
            <input id="ann-end" name="ends_at" type="datetime-local" value="{{ old('ends_at', $a?->ends_at?->format('Y-m-d\TH:i')) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-3 text-on-surface" />
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
        <div class="space-y-1">
            <label for="ann-order" class="block text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Sort order</label>
            <input id="ann-order" name="sort_order" type="number" min="0" max="9999" value="{{ old('sort_order', $a?->sort_order ?? 0) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-xl p-3 text-on-surface" />
        </div>
        <label class="inline-flex items-center gap-2 min-h-[44px]">
            <input name="is_published" type="hidden" value="0" />
            <input name="is_published" type="checkbox" value="1" class="rounded border-slate-300 text-primary focus:ring-primary/30" {{ old('is_published', $a?->is_published ?? true) ? 'checked' : '' }} />
            <span class="text-sm font-semibold text-on-surface">Published on home</span>
        </label>
    </div>
</div>
