@props([
    'templateId',
    'title',
])

@php
    $hasFull = isset($full) && trim((string) $full) !== '';
@endphp

<div {{ $attributes->merge(['class' => 'space-y-4 text-on-surface-variant text-editorial-body']) }}>
    {!! $preview ?? '' !!}
    @if ($hasFull)
        <button
            type="button"
            class="why-read-more-trigger inline-flex items-center gap-1.5 rounded-full border border-primary/30 bg-primary/5 px-4 py-2.5 min-h-[44px] text-sm font-bold text-primary hover:bg-primary/10 transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary touch-manipulation"
            data-why-read-more-open="{{ $templateId }}"
            data-why-read-more-title="{{ $title }}"
            aria-haspopup="dialog"
        >
            <span>{{ __('public.why.read_more') }}</span>
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true">expand_content</span>
        </button>
        <template id="{{ $templateId }}">
            <div class="space-y-4 text-on-surface-variant text-editorial-body">
                {!! $full !!}
            </div>
        </template>
    @endif
</div>
