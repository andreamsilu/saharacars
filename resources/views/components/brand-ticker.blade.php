{{-- Legal / brand name marquee (sits above main nav on public site). --}}
@php
    $legalName = (string) config('sahara.legal_entity_name', 'SAHARA AUTOLINK TZ LIMITED');
@endphp
<div class="public-brand-ticker w-full overflow-hidden border-b border-amber-500/25 bg-gradient-to-b from-slate-950 via-[#0f172a] to-slate-950 py-2 sm:py-2.5" role="region" aria-label="Registered company name">
    <span class="sr-only">{{ $legalName }}</span>
    <div class="public-brand-ticker__track flex w-max" aria-hidden="true">
        @foreach ([1, 2] as $cycle)
            <div class="public-brand-ticker__cycle flex items-center shrink-0">
                @for ($i = 0; $i < 4; $i++)
                    <span class="public-brand-ticker__text font-headline text-[clamp(1.05rem,2.8vw,2.15rem)] font-extrabold leading-none tracking-[0.16em] sm:tracking-[0.22em] text-amber-50 uppercase whitespace-nowrap px-5 sm:px-8 md:px-10 [text-shadow:0_2px_8px_rgba(0,0,0,0.45)]">{{ $legalName }}</span>
                    <span class="shrink-0 select-none text-amber-500/50 text-lg sm:text-xl md:text-2xl font-extralight leading-none px-0.5 sm:px-1" aria-hidden="true">·</span>
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
        animation: public-brand-ticker 48s linear infinite reverse;
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
