<footer {{ $attributes->merge(['class' => 'sahara-motion-footer w-full mt-auto bg-slate-950 text-slate-200']) }}>
    @php
        $footerPhoneDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
        $footerPhoneLabel = \App\Support\PhoneDisplay::tzMobileLabel($footerPhoneDigits);
        $footerLegal = (string) config('sahara.legal_entity_name');
        $footerSiteUrl = (string) config('sahara.public_site_url');
        $footerSiteHost = parse_url($footerSiteUrl, PHP_URL_HOST) ?: $footerSiteUrl;
        $footerInstagramUrl = trim((string) config('sahara.instagram_url'));
        $footerInstagramLabel = trim((string) config('sahara.instagram_label'));
        $footerSupportEmail = (string) config('sahara.support_email');
        $footerLocation = (string) config('sahara.primary_location_label');
        $footerTagline = (string) config('sahara.brand_tagline');
        $footerHours = (string) config('sahara.footer_hours_summary');
        $footerIntro = trim((string) config('sahara.footer_intro_extra'));
        $footerHasLeadCopy = filled($footerTagline) || filled($footerIntro);
    @endphp
    <style>
        :root {
            --theme-primary: {{ $themeColors['primary'] ?? '#8A6528' }};
            --theme-secondary: {{ $themeColors['secondary'] ?? '#0B6B3A' }};
            --theme-primary-container: {{ $themeColors['primary_container'] ?? '#5C4320' }};
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12 grid grid-cols-1 md:grid-cols-4 gap-8 sm:gap-10 bg-slate-950 text-center md:text-left">
        <div class="md:col-span-2 space-y-5 flex flex-col items-center md:items-start">
            <a href="{{ route('home') }}" class="inline-block rounded-xl bg-white/95 p-2.5 hover:bg-white transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-slate-950">
                <picture>
                    <source
                        type="image/webp"
                        srcset="{{ asset('images/logo-240.webp') }} 240w, {{ asset('images/logo-320.webp') }} 320w"
                        sizes="(min-width: 640px) 240px, 200px"
                    />
                    <img
                        src="{{ asset('images/logo-320.png') }}"
                        alt="{{ config('marketplace.name') }}"
                        class="h-9 w-auto sm:h-10 object-contain max-w-[200px] sm:max-w-[240px]"
                        width="240"
                        height="40"
                        decoding="async"
                    />
                </picture>
            </a>
            @if($footerHasLeadCopy)
            <p class="text-sm text-slate-300 max-w-md leading-relaxed">
                @if(filled($footerTagline))
                    <span class="font-semibold text-slate-100">{{ $footerTagline }}</span>
                @endif
                @if(filled($footerIntro))
                    <span class="block {{ filled($footerTagline) ? 'mt-2' : '' }}">{{ $footerIntro }}</span>
                @endif
            </p>
            @endif
            <div class="flex items-center justify-center md:justify-start gap-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 px-4 py-2 min-h-[44px] rounded-full bg-white/10 text-slate-100 hover:bg-white/25 hover:text-white text-xs font-semibold transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white [&_.material-symbols-outlined]:text-inherit">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">mail</span>
                    {{ __('site.footer.contact') }}
                </a>
                <a href="https://wa.me/{{ $footerPhoneDigits }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2 min-h-[44px] rounded-full bg-[#128C4A] text-white text-xs font-semibold transition-colors hover:bg-[#0E7A41] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white [&_svg]:text-white">
                    <svg viewBox="0 0 32 32" aria-hidden="true" class="w-4 h-4 fill-current">
                        <path d="M19.11 17.34c-.29-.14-1.69-.83-1.95-.92-.26-.1-.45-.14-.64.15-.18.29-.74.92-.9 1.1-.17.19-.33.22-.62.07-.29-.14-1.2-.44-2.29-1.39-.84-.75-1.42-1.68-1.58-1.96-.17-.29-.02-.44.12-.58.13-.13.29-.33.44-.5.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.08-.14-.64-1.55-.88-2.13-.23-.55-.46-.47-.64-.48h-.55c-.19 0-.5.07-.76.36-.26.29-1 1-.95 2.43.05 1.43 1 2.81 1.14 3 .14.19 1.95 2.98 4.72 4.17.66.29 1.17.46 1.57.59.66.21 1.27.18 1.75.11.53-.08 1.69-.69 1.93-1.35.24-.67.24-1.24.17-1.35-.08-.11-.27-.18-.55-.33z"/>
                        <path d="M16.02 3.2c-7.05 0-12.77 5.72-12.77 12.77 0 2.25.59 4.45 1.71 6.39L3.2 28.8l6.6-1.73c1.86 1.01 3.95 1.54 6.09 1.54h.01c7.05 0 12.77-5.72 12.77-12.77 0-3.42-1.33-6.63-3.76-9.05A12.67 12.67 0 0 0 16.02 3.2zm-.12 23.3h-.01c-1.91 0-3.78-.51-5.41-1.48l-.39-.23-3.92 1.03 1.05-3.82-.25-.39a10.58 10.58 0 0 1-1.62-5.65c0-5.86 4.77-10.62 10.63-10.62 2.84 0 5.51 1.1 7.51 3.11a10.54 10.54 0 0 1 3.1 7.51c0 5.86-4.77 10.62-10.62 10.62z"/>
                    </svg>
                    {{ __('site.cta.whatsapp_short') }}
                </a>
            </div>
        </div>

        <div>
            <h4 class="text-sm font-bold text-white mb-4 uppercase tracking-wider">{{ __('site.footer.navigation') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('cars.index') }}">{{ __('site.nav.inventory') }}</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('why.choose.us') }}">{{ __('site.nav.why_sahara') }}</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('saved') }}">{{ __('site.nav.saved_cars') }}</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-bold text-white mb-4 uppercase tracking-wider">{{ __('site.footer.team_heading') }}</h4>
            <ul class="space-y-2 text-sm text-slate-300">
                <li class="inline-flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-[16px]" aria-hidden="true">location_on</span>{{ $footerLocation }}</li>
                <li class="inline-flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-[16px]" aria-hidden="true">schedule</span>{{ $footerHours }}</li>
                <li class="inline-flex items-center gap-2 justify-center md:justify-start">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">call</span>
                    <a href="tel:+{{ $footerPhoneDigits }}" class="text-slate-200 hover:text-white rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">{{ $footerPhoneLabel }}</a>
                </li>
                <li class="inline-flex items-center gap-2 justify-center md:justify-start">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">mail</span>
                    <a href="mailto:{{ $footerSupportEmail }}" class="text-slate-200 hover:text-white break-all rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">{{ $footerSupportEmail }}</a>
                </li>
                <li class="inline-flex items-center gap-2 justify-center md:justify-start">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">language</span>
                    <a href="{{ $footerSiteUrl }}" target="_blank" rel="noopener noreferrer" class="text-slate-200 hover:text-white break-all rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">{{ $footerSiteHost }}</a>
                </li>
                @if(filled($footerInstagramUrl))
                <li class="inline-flex items-center gap-2 justify-center md:justify-start">
                    <svg class="w-4 h-4 shrink-0 text-slate-300" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <a href="{{ $footerInstagramUrl }}" target="_blank" rel="noopener noreferrer" class="text-slate-200 hover:text-white rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">{{ filled($footerInstagramLabel) ? $footerInstagramLabel : config('sahara.instagram_fallback_caption') }}</a>
                </li>
                @endif
            </ul>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-400">
            <p>© {{ now()->year }} {{ $footerLegal }}</p>
            <p>{{ __('site.footer.rights') }}</p>
        </div>
    </div>
    <x-engagement-cta />
    <x-page-load-progress />
    <x-scroll-to-top />
    <script>
        (function () {
            var scripts = [
                "{{ asset('js/sahara-saved-cars.min.js') }}",
                "{{ asset('js/sahara-engagement-cta.min.js') }}",
                "{{ asset('js/sahara-page-load.min.js') }}",
            ];

            var loaded = false;
            function loadScripts() {
                if (loaded) return;
                loaded = true;
                scripts.forEach(function (src) {
                    var s = document.createElement('script');
                    s.src = src;
                    s.defer = true;
                    document.body.appendChild(s);
                });
            }

            if ('requestIdleCallback' in window) {
                requestIdleCallback(loadScripts, { timeout: 1200 });
            } else {
                window.setTimeout(loadScripts, 800);
            }
            window.addEventListener('load', loadScripts, { once: true });
            window.addEventListener('pointerdown', loadScripts, { once: true, passive: true });
        })();
    </script>
    @include('components.public-motion-init')
</footer>

