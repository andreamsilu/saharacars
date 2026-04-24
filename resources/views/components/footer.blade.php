<footer {{ $attributes->merge(['class' => 'sahara-motion-footer w-full mt-auto bg-slate-950 text-slate-200']) }}>
    @php
        $footerPhoneDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone', '255000000000'));
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
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Sahara Cars"
                    class="h-9 w-auto sm:h-10 object-contain max-w-[200px] sm:max-w-[240px]"
                    width="240"
                    height="40"
                    decoding="async"
                />
            </a>
            <p class="text-sm text-slate-300 max-w-md leading-relaxed">
                Trusted car marketplace run by our Dar es Salaam team. We help you find verified cars with confidence.
            </p>
            <div class="flex items-center justify-center md:justify-start gap-3">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 px-4 py-2 min-h-[44px] rounded-full bg-white/10 text-slate-100 hover:bg-white/25 hover:text-white text-xs font-semibold transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white [&_.material-symbols-outlined]:text-inherit">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">mail</span>
                    Contact
                </a>
                <a href="https://wa.me/{{ preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone', '255000000000')) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-4 py-2 min-h-[44px] rounded-full bg-[#25D366] text-white text-xs font-semibold transition-[filter] hover:brightness-110 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white [&_svg]:text-white">
                    <svg viewBox="0 0 32 32" aria-hidden="true" class="w-4 h-4 fill-current">
                        <path d="M19.11 17.34c-.29-.14-1.69-.83-1.95-.92-.26-.1-.45-.14-.64.15-.18.29-.74.92-.9 1.1-.17.19-.33.22-.62.07-.29-.14-1.2-.44-2.29-1.39-.84-.75-1.42-1.68-1.58-1.96-.17-.29-.02-.44.12-.58.13-.13.29-.33.44-.5.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.08-.14-.64-1.55-.88-2.13-.23-.55-.46-.47-.64-.48h-.55c-.19 0-.5.07-.76.36-.26.29-1 1-.95 2.43.05 1.43 1 2.81 1.14 3 .14.19 1.95 2.98 4.72 4.17.66.29 1.17.46 1.57.59.66.21 1.27.18 1.75.11.53-.08 1.69-.69 1.93-1.35.24-.67.24-1.24.17-1.35-.08-.11-.27-.18-.55-.33z"/>
                        <path d="M16.02 3.2c-7.05 0-12.77 5.72-12.77 12.77 0 2.25.59 4.45 1.71 6.39L3.2 28.8l6.6-1.73c1.86 1.01 3.95 1.54 6.09 1.54h.01c7.05 0 12.77-5.72 12.77-12.77 0-3.42-1.33-6.63-3.76-9.05A12.67 12.67 0 0 0 16.02 3.2zm-.12 23.3h-.01c-1.91 0-3.78-.51-5.41-1.48l-.39-.23-3.92 1.03 1.05-3.82-.25-.39a10.58 10.58 0 0 1-1.62-5.65c0-5.86 4.77-10.62 10.63-10.62 2.84 0 5.51 1.1 7.51 3.11a10.54 10.54 0 0 1 3.1 7.51c0 5.86-4.77 10.62-10.62 10.62z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>

        <div>
            <h4 class="text-sm font-bold text-white mb-4 uppercase tracking-wider">Navigation</h4>
            <ul class="space-y-2 text-sm">
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('home') }}">Home</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('cars.index') }}">Inventory</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('why.choose.us') }}">Why Sahara</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('contact') }}">Contact</a></li>
                <li><a class="text-slate-200 hover:text-white transition-colors rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white" href="{{ route('saved') }}">Saved cars</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-bold text-white mb-4 uppercase tracking-wider">Dar Team</h4>
            <ul class="space-y-2 text-sm text-slate-300">
                <li class="inline-flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-[16px]" aria-hidden="true">location_on</span>Dar es Salaam</li>
                <li class="inline-flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-[16px]" aria-hidden="true">schedule</span>Mon-Sat, 08:00-18:00</li>
                <li class="inline-flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-[16px]" aria-hidden="true">call</span>+{{ $footerPhoneDigits }}</li>
            </ul>
        </div>
    </div>

    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-400">
            <p>© {{ now()->year }} SAHARA COMMISSION AGENTS LIMITED</p>
            <p>All rights reserved.</p>
        </div>
    </div>
    <x-engagement-cta />
    <x-page-load-progress />
    <x-scroll-to-top />
    <script src="{{ asset('js/sahara-saved-cars.js') }}" defer></script>
    @include('components.public-motion-init')
</footer>

