@php
    $waDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
    $waIntro = __('site.engagement.intro');
    $waHref = 'https://wa.me/'.$waDigits.'?text='.rawurlencode($waIntro);
@endphp
<div
    id="sahara-engagement-root"
    class="fixed inset-0 hidden"
    style="z-index: 200"
    aria-hidden="true"
>
    <div
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-[2px] transition-opacity duration-200 motion-reduce:transition-none"
        data-engagement-dismiss="backdrop"
        aria-hidden="true"
    ></div>
    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
        <div
            id="sahara-engagement-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="sahara-engagement-title"
            class="sahara-modal-panel relative w-full max-w-md rounded-2xl border border-outline-variant/40 bg-white p-6 text-on-surface shadow-2xl shadow-primary/10 sm:p-8 [color-scheme:light] motion-reduce:transition-none"
        >
            <button
                type="button"
                class="absolute right-3 top-3 inline-flex h-10 w-10 items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-high focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                data-engagement-dismiss="action"
                aria-label="{{ __('site.engagement.close') }}"
            >
                <span class="material-symbols-outlined text-[22px]" aria-hidden="true">close</span>
            </button>
            <p class="font-label text-editorial-kicker text-secondary mb-2">{{ config('marketplace.name') }}</p>
            <h2 id="sahara-engagement-title" class="font-headline text-xl font-extrabold text-primary tracking-tight sm:text-2xl pr-8">
                {{ __('site.engagement.title') }}
            </h2>
            <p class="mt-3 text-sm leading-relaxed text-on-surface-variant">
                {{ __('site.engagement.body') }}
            </p>
            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                <a
                    href="{{ route('cars.index') }}"
                    data-engagement-focus
                    class="inline-flex min-h-[48px] flex-1 items-center justify-center gap-2 rounded-full bg-primary px-5 py-3 text-center text-sm font-bold text-on-primary shadow-md shadow-primary/20 transition-[filter,transform] hover:brightness-110 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary motion-reduce:transform-none"
                >
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">directions_car</span>
                    {{ __('site.engagement.browse_cars') }}
                </a>
                <a
                    href="{{ $waHref }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex min-h-[48px] flex-1 items-center justify-center gap-2 rounded-full border-2 border-secondary bg-white px-5 py-3 text-center text-sm font-bold text-secondary transition-[filter,background-color] hover:bg-secondary-container/40 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary"
                >
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">chat</span>
                    {{ __('site.engagement.whatsapp') }}
                </a>
            </div>
            <div class="mt-6 flex flex-col gap-3 border-t border-outline-variant/40 pt-5 sm:flex-row sm:items-center sm:justify-between">
                <label class="flex cursor-pointer items-start gap-2 text-sm text-on-surface-variant">
                    <input
                        id="sahara-engagement-noremind"
                        type="checkbox"
                        class="mt-0.5 h-4 w-4 rounded border-outline text-primary"
                    />
                    <span>{{ __('site.engagement.dont_show') }}</span>
                </label>
                <button
                    type="button"
                    class="shrink-0 text-sm font-bold text-primary underline underline-offset-2 decoration-primary/40 hover:decoration-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary sm:min-h-[44px]"
                    data-engagement-dismiss="action"
                >
                    {{ __('site.engagement.not_now') }}
                </button>
            </div>
        </div>
    </div>
</div>
