@props([
    'title' => null,
    'subtitle' => null,
])

@php
    $title = $title ?? __('public.partner_slider.default_title');
    $subtitle = $subtitle ?? __('public.partner_slider.default_subtitle');
    $partners = [
        ['name' => 'NMB Bank', 'tag' => __('public.partner_slider.financing'), 'abbr' => 'NMB', 'color' => '#0F4C81'],
        ['name' => 'CRDB Bank', 'tag' => __('public.partner_slider.auto_loans'), 'abbr' => 'CRDB', 'color' => '#006C35'],
        ['name' => 'Jubilee Insurance', 'tag' => __('public.partner_slider.insurance'), 'abbr' => 'JUB', 'color' => '#BE1E2D'],
        ['name' => 'Alliance Insurance', 'tag' => __('public.partner_slider.coverage'), 'abbr' => 'ALL', 'color' => '#5A2A82'],
        ['name' => 'Tanzania Ports', 'tag' => __('public.partner_slider.logistics'), 'abbr' => 'TPA', 'color' => '#0077B6'],
        ['name' => 'TRA Motor Registry', 'tag' => __('public.partner_slider.compliance'), 'abbr' => 'TRA', 'color' => '#A61E4D'],
        ['name' => 'A-One Inspection', 'tag' => __('public.partner_slider.vehicle_checks'), 'abbr' => 'A1', 'color' => '#1F6F78'],
        ['name' => 'Swift Freight', 'tag' => __('public.partner_slider.shipping'), 'abbr' => 'SFT', 'color' => '#7A5C00'],
    ];
@endphp

<section class="section-editorial px-6 bg-surface-container-low overflow-hidden" aria-labelledby="partner-logos-heading" data-nosnippet>
    <style>
        .partner-marquee {
            mask-image: linear-gradient(to right, transparent, black 12%, black 88%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 12%, black 88%, transparent);
        }
        .partner-track {
            animation: partner-slide 28s linear infinite;
            width: max-content;
        }
        .partner-track:hover {
            animation-play-state: paused;
        }
        @keyframes partner-slide {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        @media (prefers-reduced-motion: reduce) {
            .partner-track {
                animation: none;
                transform: none;
            }
        }
    </style>

    <div class="max-w-7xl mx-auto space-y-8">
        <div class="text-center space-y-3">
            <h3 id="partner-logos-heading" class="font-headline text-3xl md:text-4xl font-extrabold text-primary">{{ $title }}</h3>
            <p class="text-on-surface-variant max-w-2xl mx-auto">{{ $subtitle }}</p>
        </div>

        <div class="partner-marquee">
            <div class="partner-track flex items-center gap-4 md:gap-6">
                @foreach (array_merge($partners, $partners) as $index => $partner)
                    <div
                        class="bg-surface-container-lowest rounded-2xl px-4 sm:px-5 py-4 min-w-[min(100%,200px)] sm:min-w-[220px] max-w-[85vw] sm:max-w-none ghost-border shadow-[0_12px_20px_rgba(25,28,30,0.04)] {{ $index >= count($partners) ? 'opacity-90' : '' }}"
                        @if ($index >= count($partners)) aria-hidden="true" @endif
                    >
                        <div class="flex items-center gap-3">
                            <div class="h-10 min-w-[64px] rounded-lg text-white flex items-center justify-center px-2 shadow-sm" style="background-color: {{ $partner['color'] }};">
                                <span class="font-headline text-[11px] font-extrabold tracking-wider">{{ $partner['abbr'] }}</span>
                            </div>
                            <div>
                                <p class="font-headline text-sm font-bold text-primary">{{ $partner['name'] }}</p>
                                <p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant">{{ $partner['tag'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
