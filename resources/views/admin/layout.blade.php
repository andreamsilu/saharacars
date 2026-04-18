<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin') • Sahara Cars</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#8a6528",
                        secondary: "#0b6b3a",
                        "secondary-container": "#5dfd8a",
                        "on-secondary-container": "#007232",
                        surface: "#f8f9fb",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#2f3a45",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "surface-container-high": "#e6e8ea",
                        "surface-container-highest": "#e0e3e5",
                        "surface-dim": "#d8dadc",
                        outline: "#737780",
                        "outline-variant": "#c3c6d1",
                        error: "#ba1a1a",
                        "error-container": "#ffdad6",
                        tertiary: "#381300",
                        "tertiary-fixed-dim": "#ffb690",
                        "tertiary-container": "#592300",
                        "on-tertiary-container": "#d8885c",
                        "primary-container": "#5c4320",
                        "on-primary": "#ffffff",
                        "on-primary-container": "#f4e4c4",
                        "tertiary-fixed": "#ffdbca",
                        "surface-container": "#eceef0",
                    },
                    fontFamily: {
                        headline: ["Manrope"],
                        body: ["Inter"],
                        label: ["Inter"],
                    },
                },
            },
        };
    </script>
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
        .text-primary-container { color: var(--theme-primary-container) !important; }

        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .smooth { transition: all .2s ease; }
        .card-lift { transition: transform .2s ease, box-shadow .2s ease; }
        .card-lift:hover { transform: translateY(-1px); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08); }
        body {
            font-family: 'Inter', sans-serif;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-feature-settings: "cv11", "ss01";
        }
        h1, h2, h3, .font-headline {
            font-family: 'Manrope', sans-serif;
            letter-spacing: -0.015em;
            line-height: 1.15;
        }
        .font-label {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            letter-spacing: 0.02em;
        }
        input, select, textarea, button {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }
        :focus-visible { outline: 3px solid #8a6528; outline-offset: 2px; }
        .admin-link:hover { text-decoration: none; }

        .icon-info { color: #8a6528; }
        .icon-success { color: #0b6b3a; }
        .icon-warning { color: #a16207; }
        .icon-danger { color: #ba1a1a; }
        .icon-neutral { color: #475569; }
    </style>
    @yield('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-surface via-slate-50 to-slate-100 text-on-surface font-body antialiased">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:bg-primary focus:text-white focus:px-4 focus:py-2 focus:rounded-lg">Skip to content</a>
    <div class="min-h-screen">
        <aside class="hidden lg:flex fixed top-0 left-0 z-50 w-[280px] h-screen flex-col border-r border-slate-200/90 bg-gradient-to-b from-slate-50 to-slate-100">
            <div class="px-6 py-8 border-b border-slate-200/80">
                <a href="{{ route('home') }}" class="block rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2" title="Sahara Cars — view site">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Sahara Cars"
                        class="h-8 w-auto object-contain object-left max-w-[200px]"
                        width="200"
                        height="32"
                        decoding="async"
                    />
                </a>
                <p class="text-[10px] tracking-[0.2em] font-medium text-slate-400 mt-2 uppercase">Admin Console</p>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                @php
                    $link = function (string $route, string $pattern, string $label, string $icon) {
                        $active = request()->routeIs($pattern);
                        $base = 'flex items-center gap-3 py-3.5 pl-4 rounded-2xl mr-2 text-[15px] font-medium tracking-tight transition-colors';
                        $classes = $active
                            ? 'bg-primary text-white shadow-sm ring-1 ring-primary/20 font-bold '.$base
                            : 'text-slate-500 hover:text-primary hover:bg-surface-container '.$base;
                        return compact('route', 'label', 'icon', 'classes', 'active');
                    };
                    $items = [
                        $link('admin.dashboard', 'admin.dashboard', 'Overview', 'dashboard'),
                        $link('admin.cars.index', 'admin.cars.*', 'Inventory', 'directions_car'),
                        $link('admin.settings.index', 'admin.settings.*', 'Settings', 'settings'),
                    ];
                @endphp
                @foreach ($items as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="admin-link smooth {{ $item['classes'] }}"
                        title="{{ $item['label'] }}"
                        aria-label="{{ $item['label'] }}"
                        aria-current="{{ $item['active'] ? 'page' : 'false' }}"
                    >
                        <span class="material-symbols-outlined text-[22px]">{{ $item['icon'] }}</span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-slate-200/80">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-xs font-semibold px-4 py-3 rounded-2xl bg-white text-primary border border-slate-300/80 hover:bg-surface-container-low shadow-sm smooth inline-flex items-center justify-center" title="Logout" aria-label="Logout">
                        <span class="material-symbols-outlined text-base icon-neutral">logout</span>
                        <span class="sr-only">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="min-w-0 flex flex-col min-h-screen lg:ml-[280px]">
            <header class="sticky top-0 z-40 border-b border-slate-200/90 bg-white/85 backdrop-blur-md shadow-sm">
                <div class="max-w-7xl mx-auto px-5 sm:px-8 py-4 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 min-w-0">
                        <a href="{{ route('home') }}" class="lg:hidden shrink-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg">
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="Sahara Cars"
                                class="h-8 w-auto object-contain max-w-[160px]"
                                width="160"
                                height="32"
                                decoding="async"
                            />
                        </a>
                        <div class="hidden lg:block">
                            <h1 class="text-base font-bold text-primary font-headline truncate">@yield('title', 'Admin')</h1>
                            <p class="text-xs text-on-surface-variant truncate">@yield('breadcrumb', 'Cars Admin')</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                        <a href="{{ route('home') }}" class="w-10 h-10 rounded-full bg-primary text-on-primary hover:bg-primary-container smooth inline-flex items-center justify-center border border-primary/20" title="View site" aria-label="View site">
                            <span class="material-symbols-outlined text-base">public</span>
                            <span class="sr-only">View site</span>
                        </a>
                        <form class="lg:hidden" method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-10 h-10 rounded-full border border-slate-200 bg-white text-primary hover:bg-surface-container-low smooth inline-flex items-center justify-center" title="Logout" aria-label="Logout">
                                <span class="material-symbols-outlined text-base icon-neutral">logout</span>
                                <span class="sr-only">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main id="main-content" class="flex-1 max-w-7xl w-full mx-auto px-5 sm:px-8 py-10">
                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900 inline-flex items-start gap-2">
                        <span class="material-symbols-outlined icon-success text-base">check_circle</span>
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    @yield('scripts')
</body>
</html>
