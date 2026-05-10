{{-- Renders a section/hero image when present under public/images; otherwise a static placeholder (no broken image icon). --}}
@props([
    'file',
    'alt' => '',
    'eager' => false,
    'icon' => 'directions_car',
])
@php
    $relative = str_starts_with($file, 'images/') ? $file : 'images/' . ltrim($file, '/');
    $present = is_file(public_path($relative));
    $loading = $eager ? 'eager' : 'lazy';
@endphp
@if ($present)
<img
    src="{{ asset($relative) }}"
    alt="{{ $alt }}"
    class="absolute inset-0 h-full w-full object-cover"
    @if ($eager) width="960" height="640" fetchpriority="high" @endif
    loading="{{ $loading }}"
    decoding="async"
/>
@else
<div
    class="absolute inset-0 h-full w-full flex items-center justify-center bg-gradient-to-br from-primary/15 via-surface-container to-primary/10"
    role="img"
    aria-label="{{ $alt }}"
>
    <span class="material-symbols-outlined text-[clamp(2.75rem,10vw,4.5rem)] text-primary/30" aria-hidden="true">{{ $icon }}</span>
</div>
@endif
