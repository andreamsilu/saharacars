{{-- Compact locale toggles; labels from lang/*/site.php. --}}
@php
    $locales = config('app.supported_locales', ['en', 'sw']);
@endphp
@if (count($locales) > 1)
    <div
        class="inline-flex items-center gap-1 rounded-full border border-slate-200/90 bg-white/90 px-1 py-0.5 text-[10px] sm:text-xs font-bold uppercase tracking-wide text-slate-600"
        role="navigation"
        aria-label="{{ __('site.locale_switcher.aria') }}"
    >
        @foreach ($locales as $loc)
            @if (app()->getLocale() === $loc)
                <span
                    class="px-2 py-1 rounded-full bg-primary/12 text-primary"
                    aria-current="true"
                    title="{{ __('site.locale_switcher.'.$loc) }}"
                >{{ strtoupper($loc) }}</span>
            @else
                <a
                    href="{{ \App\Support\LocaleUrls::alternative($loc) }}"
                    class="px-2 py-1 rounded-full hover:bg-slate-100 text-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary"
                    hreflang="{{ $loc }}"
                    title="{{ __('site.locale_switcher.'.$loc) }}"
                >{{ strtoupper($loc) }}</a>
            @endif
        @endforeach
    </div>
@endif
