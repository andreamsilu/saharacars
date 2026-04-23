{{-- Legal / brand name marquee (sits above main nav on public site). --}}
@php
    $legalName = (string) config('sahara.legal_entity_name', 'SAHARA AUTOLINK TZ LIMITED');
@endphp
<div class="public-brand-ticker w-full overflow-hidden border-b border-amber-500/20 bg-gradient-to-b from-slate-950 via-[#0f172a] to-slate-950 py-1.5 sm:py-2" role="region" aria-label="Registered company name">
    <span class="sr-only">{{ $legalName }}</span>
    <div class="public-brand-ticker__track flex w-max" aria-hidden="true">
        @foreach ([1, 2] as $cycle)
            <div class="public-brand-ticker__cycle flex items-center shrink-0">
                @for ($i = 0; $i < 4; $i++)
                    <span class="public-brand-ticker__text font-headline text-[clamp(0.9rem,2vw,1.45rem)] font-bold leading-none tracking-[0.11em] sm:tracking-[0.16em] text-amber-50 uppercase whitespace-nowrap px-4 sm:px-6 md:px-7 [text-shadow:0_2px_8px_rgba(0,0,0,0.45)]">{{ $legalName }}</span>
                    <span class="shrink-0 select-none text-amber-500/45 text-sm sm:text-base md:text-lg font-light leading-none px-0.5" aria-hidden="true">·</span>
                @endfor
            </div>
        @endforeach
    </div>
</div>
<style>
    @keyframes public-brand-ticker {
        0% {
            transform: translate3d(0, 0, 0);
        }
        100% {
            transform: translate3d(-50%, 0, 0);
        }
    }
    .public-brand-ticker__track {
        /* Reverse: text appears to move left-to-right across the bar */
        animation: public-brand-ticker 62s linear infinite reverse;
    }
    @media (prefers-reduced-motion: reduce) {
        .public-brand-ticker__track {
            animation: none;
            width: 100% !important;
            justify-content: center;
        }
        .public-brand-ticker__track .public-brand-ticker__cycle:last-child {
            display: none;
        }
    }
</style>
