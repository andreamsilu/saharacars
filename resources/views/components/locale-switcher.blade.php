{{-- Compact locale toggles; labels from lang/*/site.php. --}}
@php
    $locales = config('app.supported_locales', ['en', 'sw']);
@endphp
@if (count($locales) > 1)
    <div
        class="inline-flex items-center gap-0.5 rounded-full border border-slate-200/90 bg-white/90 px-0.5 py-0.5 text-[10px] sm:text-xs font-bold uppercase tracking-wide text-slate-600 shrink-0"
        role="navigation"
        aria-label="{{ __('site.locale_switcher.aria') }}"
    >
        @foreach ($locales as $loc)
            @if (app()->getLocale() === $loc)
                <span
                    class="inline-flex min-h-[36px] min-w-[36px] items-center justify-center px-1.5 rounded-full bg-primary/12 text-primary sm:min-h-0 sm:min-w-0 sm:px-2 sm:py-1"
                    aria-current="true"
                    title="{{ __('site.locale_switcher.'.$loc) }}"
                >{{ strtoupper($loc) }}</span>
            @else
                <a
                    href="{{ \App\Support\LocaleUrls::alternative($loc) }}"
                    class="inline-flex min-h-[36px] min-w-[36px] items-center justify-center px-1.5 rounded-full hover:bg-slate-100 text-slate-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary sm:min-h-0 sm:min-w-0 sm:px-2 sm:py-1"
                    hreflang="{{ $loc }}"
                    title="{{ __('site.locale_switcher.'.$loc) }}"
                >{{ strtoupper($loc) }}</a>
            @endif
        @endforeach
    </div>
@endif
