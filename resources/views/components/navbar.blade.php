@php
    $salesWaDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
    $salesWaIntro = 'Hi Sahara Cars sales, I need help choosing a car.';
    $salesWaHref = 'https://wa.me/' . $salesWaDigits . '?text=' . rawurlencode($salesWaIntro);
@endphp
{{-- Ticker + nav share one sticky stack so the legal name stays visible when scrolling. --}}
<div class="sahara-motion-header sticky top-0 z-50 w-full">
    <x-brand-ticker />
<header class="w-full bg-white/80 backdrop-blur-[20px] shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
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
            background-color: var(--theme-primary);
        }
    </style>
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 py-3.5 flex items-center justify-between gap-2 sm:gap-3" aria-label="Main">
        {{-- Brand: logo from public/images (see asset path) --}}
        <a class="inline-flex items-center gap-2 shrink-0 min-w-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 rounded-lg" href="{{ route('home') }}">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Sahara Cars"
                class="h-8 w-auto sm:h-10 object-contain object-left max-w-[min(200px,52vw)] sm:max-w-[240px]"
                width="240"
                height="40"
                decoding="async"
            />
        </a>

        <p class="md:hidden flex-1 text-center px-1 text-[10px] font-black uppercase tracking-[0.14em] text-primary truncate">
            GET YOUR DREAM CAR
        </p>

        <div class="hidden md:flex items-center gap-4 lg:gap-6">
            <a class="{{ request()->routeIs('home') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm rounded-md px-1 py-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('cars.*') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm rounded-md px-1 py-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="{{ route('cars.index') }}">Inventory</a>
            <a class="{{ request()->routeIs('order.request') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm rounded-md px-1 py-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="{{ route('order.request') }}">Order Request</a>
            <a class="{{ request()->routeIs('saved') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm rounded-md px-1 py-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="{{ route('saved') }}">Saved</a>
            <a class="{{ request()->routeIs('why.choose.us') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm rounded-md px-1 py-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="{{ route('why.choose.us') }}">Why Sahara</a>
            <a class="{{ request()->routeIs('contact') ? 'text-primary font-extrabold' : 'text-slate-700 hover:text-primary font-semibold' }} transition-colors text-sm rounded-md px-1 py-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" href="{{ route('contact') }}">Contact</a>
        </div>

        <div class="flex items-center gap-1.5 sm:gap-3 shrink-0">
            <a href="{{ $salesWaHref }}" target="_blank" rel="noopener noreferrer" class="hidden md:inline-flex items-center gap-1.5 cta-gradient text-white px-4 sm:px-5 py-2.5 min-h-[44px] rounded-full text-xs sm:text-sm font-bold transition-[filter,transform] hover:brightness-110 active:scale-95 shadow-[0_10px_24px_rgba(92,67,32,0.2)] touch-manipulation focus-ring-on-dark focus-visible:outline-offset-2 [&_.material-symbols-outlined]:text-white">
                <span class="material-symbols-outlined text-[18px] shrink-0 text-white" aria-hidden="true">support_agent</span>
                <span class="whitespace-nowrap">Chat on WhatsApp</span>
            </a>

            {{-- Mobile: open full navigation (primary links hidden on small screens) --}}
            <button
                type="button"
                id="public-nav-toggle"
                class="md:hidden inline-flex items-center justify-center min-w-[44px] min-h-[44px] rounded-xl border border-slate-200 bg-white text-slate-800 hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 touch-manipulation"
                aria-expanded="false"
                aria-controls="public-nav-panel"
                aria-label="Open menu"
            >
                <span class="material-symbols-outlined text-[26px]" data-nav-icon="menu">menu</span>
            </button>
        </div>
    </nav>

    {{-- Mobile menu panel --}}
    <div
        id="public-nav-panel"
        class="hidden md:hidden border-t border-slate-200/90 bg-white/95 backdrop-blur-md shadow-[0_12px_24px_rgba(15,23,42,0.08)]"
        hidden
    >
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-4">
            <ul class="flex flex-col gap-1">
                <li>
                    <a class="flex items-center min-h-[48px] px-3 rounded-xl text-base font-semibold focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-inset {{ request()->routeIs('home') ? 'bg-primary/10 text-primary' : 'text-slate-800' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a class="flex items-center min-h-[48px] px-3 rounded-xl text-base font-semibold focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-inset {{ request()->routeIs('cars.*') ? 'bg-primary/10 text-primary' : 'text-slate-800' }}" href="{{ route('cars.index') }}">Inventory</a>
                </li>
                <li>
                    <a class="flex items-center min-h-[48px] px-3 rounded-xl text-base font-semibold focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-inset {{ request()->routeIs('order.request') ? 'bg-primary/10 text-primary' : 'text-slate-800' }}" href="{{ route('order.request') }}">Order Request</a>
                </li>
                <li>
                    <a class="flex items-center min-h-[48px] px-3 rounded-xl text-base font-semibold focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-inset {{ request()->routeIs('saved') ? 'bg-primary/10 text-primary' : 'text-slate-800' }}" href="{{ route('saved') }}">Saved cars</a>
                </li>
                <li>
                    <a class="flex items-center min-h-[48px] px-3 rounded-xl text-base font-semibold focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-inset {{ request()->routeIs('why.choose.us') ? 'bg-primary/10 text-primary' : 'text-slate-800' }}" href="{{ route('why.choose.us') }}">Why Sahara</a>
                </li>
                <li>
                    <a class="flex items-center min-h-[48px] px-3 rounded-xl text-base font-semibold focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-inset {{ request()->routeIs('contact') ? 'bg-primary/10 text-primary' : 'text-slate-800' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <a href="{{ $salesWaHref }}" target="_blank" rel="noopener noreferrer" class="flex md:hidden items-center justify-center gap-2 w-full cta-gradient text-white py-3.5 min-h-[48px] rounded-2xl text-sm font-bold shadow-md touch-manipulation focus-ring-on-dark transition-[filter] hover:brightness-110 [&_.material-symbols-outlined]:text-white">
                <span class="material-symbols-outlined text-[20px] text-white" aria-hidden="true">support_agent</span>
                Chat on WhatsApp
            </a>
        </div>
    </div>
</header>
</div>

<script>
(function () {
    var btn = document.getElementById('public-nav-toggle');
    var panel = document.getElementById('public-nav-panel');
    if (!btn || !panel) return;

    function setOpen(open) {
        panel.hidden = !open;
        panel.classList.toggle('hidden', !open);
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        btn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        var icon = btn.querySelector('[data-nav-icon]');
        if (icon) {
            icon.textContent = open ? 'close' : 'menu';
        }
    }

    btn.addEventListener('click', function () {
        setOpen(panel.hidden);
    });

    panel.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            setOpen(false);
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !panel.hidden) {
            setOpen(false);
        }
    });
})();
</script>
