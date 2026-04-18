@php
    /** @var string $active */
    $active = $active ?? '';
    /** @var string $detailsHref */
    $detailsHref = $detailsHref ?? '#';
@endphp

<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-6 pt-3 md:hidden bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border-t border-slate-100 dark:border-slate-800 shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">
    <a class="{{ $active === 'home' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-900 dark:text-blue-300 rounded-2xl' : 'text-slate-400 dark:text-slate-500' }} flex flex-col items-center justify-center px-5 py-2 tap-highlight-transparent transition-transform active:scale-90" href="{{ route('home') }}">
        <span class="material-symbols-outlined" style="{{ $active === 'home' ? "font-variation-settings: 'FILL' 1;" : '' }}">home</span>
        <span class="font-inter text-[10px] font-semibold uppercase tracking-widest mt-1">Home</span>
    </a>

    <a class="{{ $active === 'search' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-900 dark:text-blue-300 rounded-2xl' : 'text-slate-400 dark:text-slate-500' }} flex flex-col items-center justify-center px-5 py-2 transition-transform active:scale-90" href="{{ route('cars.index') }}">
        <span class="material-symbols-outlined">search</span>
        <span class="font-inter text-[10px] font-semibold uppercase tracking-widest mt-1">Search</span>
    </a>

    <a class="{{ $active === 'details' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-900 dark:text-blue-300 rounded-2xl' : 'text-slate-400 dark:text-slate-500' }} flex flex-col items-center justify-center px-5 py-2 transition-transform active:scale-90" href="{{ $detailsHref }}">
        <span class="material-symbols-outlined" style="{{ $active === 'details' ? "font-variation-settings: 'FILL' 1;" : '' }}">directions_car</span>
        <span class="font-inter text-[10px] font-semibold uppercase tracking-widest mt-1">Details</span>
    </a>

    <a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 px-5 py-2 transition-transform active:scale-90" href="#">
        <span class="material-symbols-outlined">favorite</span>
        <span class="font-inter text-[10px] font-semibold uppercase tracking-widest mt-1">Saved</span>
    </a>

    <a class="{{ $active === 'menu' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-900 dark:text-blue-300 rounded-2xl' : 'text-slate-400 dark:text-slate-500' }} flex flex-col items-center justify-center px-5 py-2 transition-transform active:scale-90" href="#">
        <span class="material-symbols-outlined" style="{{ $active === 'menu' ? "font-variation-settings: 'FILL' 1;" : '' }}">menu</span>
        <span class="font-inter text-[10px] font-semibold uppercase tracking-widest mt-1">Menu</span>
    </a>
</nav>

