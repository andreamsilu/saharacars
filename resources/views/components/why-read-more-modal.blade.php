{{-- Single dialog for Why Sahara section “Read more” content (filled via JS from <template> siblings). --}}
<div
    id="why-read-more-root"
    class="fixed inset-0 z-[80] hidden"
    aria-hidden="true"
>
    <div
        class="absolute inset-0 bg-slate-900/55 backdrop-blur-[2px]"
        data-why-read-more-dismiss="backdrop"
        aria-hidden="true"
    ></div>
    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
        <div
            id="why-read-more-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="why-read-more-title"
            class="sahara-modal-panel relative flex max-h-[min(88vh,720px)] w-full max-w-2xl flex-col rounded-2xl border border-outline-variant/40 bg-white text-on-surface shadow-2xl shadow-primary/10 [color-scheme:light] motion-reduce:transition-none"
        >
            <div class="flex shrink-0 items-start justify-between gap-3 border-b border-outline-variant/30 px-5 py-4 sm:px-6">
                <h2 id="why-read-more-title" class="font-headline text-lg font-extrabold text-primary tracking-tight leading-snug sm:text-xl pr-2 min-w-0"></h2>
                <button
                    type="button"
                    class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-high focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary"
                    data-why-read-more-dismiss="action"
                    aria-label="{{ __('public.why.read_more_close') }}"
                >
                    <span class="material-symbols-outlined text-[22px]" aria-hidden="true">close</span>
                </button>
            </div>
            <div
                id="why-read-more-body"
                class="overflow-y-auto overscroll-contain px-5 py-5 sm:px-6 sm:py-6 text-on-surface-variant text-editorial-body space-y-4"
            ></div>
        </div>
    </div>
</div>
