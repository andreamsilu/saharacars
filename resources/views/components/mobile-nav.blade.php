@php
    /**
     * Bottom navigation for small screens (md:hidden in component).
     * $active: home | inventory | about | contact
     */
    $active = $active ?? '';
    $linkClass = function (string $key) use ($active): string {
        $isActive = $active === $key;
        $base = 'flex flex-col items-center justify-center gap-1 flex-1 min-h-[52px] min-w-0 px-1 py-2 rounded-2xl transition-colors touch-manipulation tap-highlight-transparent active:scale-95';

        return $isActive
            ? $base.' bg-primary/12 text-primary font-semibold'
            : $base.' text-slate-500 hover:text-slate-800';
    };
@endphp

<nav
    class="fixed bottom-0 left-0 right-0 z-50 md:hidden flex justify-between items-stretch px-2 pt-2 bg-white/95 backdrop-blur-xl border-t border-slate-200/90 shadow-[0_-4px_24px_rgba(15,23,42,0.08)]"
    style="padding-bottom: max(0.5rem, env(safe-area-inset-bottom, 0px));"
    aria-label="Quick navigation"
>
    <a class="{{ $linkClass('home') }}" href="{{ route('home') }}">
        <span class="material-symbols-outlined text-[24px]" style="{{ $active === 'home' ? "font-variation-settings: 'FILL' 1;" : '' }}">home</span>
        <span class="text-[10px] font-semibold uppercase tracking-wide leading-tight text-center">Home</span>
    </a>

    <a class="{{ $linkClass('inventory') }}" href="{{ route('cars.index') }}">
        <span class="material-symbols-outlined text-[24px]" style="{{ $active === 'inventory' ? "font-variation-settings: 'FILL' 1;" : '' }}">directions_car</span>
        <span class="text-[10px] font-semibold uppercase tracking-wide leading-tight text-center">Cars</span>
    </a>

    <a class="{{ $linkClass('about') }}" href="{{ route('about') }}">
        <span class="material-symbols-outlined text-[24px]" style="{{ $active === 'about' ? "font-variation-settings: 'FILL' 1;" : '' }}">info</span>
        <span class="text-[10px] font-semibold uppercase tracking-wide leading-tight text-center">About</span>
    </a>

    <a class="{{ $linkClass('contact') }}" href="{{ route('contact') }}">
        <span class="material-symbols-outlined text-[24px]" style="{{ $active === 'contact' ? "font-variation-settings: 'FILL' 1;" : '' }}">chat</span>
        <span class="text-[10px] font-semibold uppercase tracking-wide leading-tight text-center">Contact</span>
    </a>
</nav>
