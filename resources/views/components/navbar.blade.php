<header class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-[20px] shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
    <style>
        :root {
            --theme-primary: {{ $themeColors['primary'] ?? '#8A6528' }};
            --theme-secondary: {{ $themeColors['secondary'] ?? '#0B6B3A' }};
            --theme-primary-container: {{ $themeColors['primary_container'] ?? '#5C4320' }};
        }
        .text-primary { color: var(--theme-primary) !important; }
        .bg-primary { background-color: var(--theme-primary) !important; }
        .border-primary { border-color: var(--theme-primary) !important; }
        .ring-primary { --tw-ring-color: var(--theme-primary) !important; }
        .text-secondary { color: var(--theme-secondary) !important; }
        .bg-secondary { background-color: var(--theme-secondary) !important; }
        .bg-primary-container { background-color: var(--theme-primary-container) !important; }
        .cta-gradient {
            background-image: linear-gradient(135deg, var(--theme-primary-container), var(--theme-primary));
        }
    </style>
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 py-3.5 flex items-center justify-between gap-3">
        {{-- Brand: logo from public/images (see asset path) --}}
        <a class="inline-flex items-center gap-2 shrink-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 rounded-lg" href="{{ route('home') }}">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Sahara Cars"
                class="h-9 w-auto sm:h-10 object-contain object-left max-w-[200px] sm:max-w-[240px]"
                width="240"
                height="40"
                decoding="async"
            />
        </a>

        <div class="hidden md:flex items-center gap-6">
            <a class="{{ request()->routeIs('home') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('cars.*') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm" href="{{ route('cars.index') }}">Inventory</a>
            <a class="{{ request()->routeIs('about') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm" href="{{ route('about') }}">About</a>
            <a class="{{ request()->routeIs('contact') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm" href="{{ route('contact') }}">Contact</a>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <form action="{{ route('cars.index') }}" method="GET" class="hidden lg:flex items-center gap-2 rounded-full bg-slate-100 border border-slate-200 px-3 py-1.5">
                <span class="material-symbols-outlined text-slate-500 text-[18px]">search</span>
                <input
                    class="bg-transparent border-none focus:ring-0 text-sm w-44 text-slate-800 placeholder:text-slate-500"
                    placeholder="Search cars..."
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    aria-label="Search cars"
                />
            </form>

            <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 cta-gradient text-white px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-bold hover:opacity-95 active:scale-95 transition-transform shadow-[0_10px_24px_rgba(92,67,32,0.2)]">
                <span class="material-symbols-outlined text-[18px]">support_agent</span>
                Contact Sales
            </a>
        </div>
    </nav>
</header>

