@php
    $rentalWaDigits = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
    $rentalWaHref = 'https://wa.me/' . $rentalWaDigits . '?text=' . rawurlencode(__('public.home.rental_wa_message'));
@endphp
<section class="max-w-7xl mx-auto px-4 sm:px-6 mt-6 sm:mt-8" aria-labelledby="home-services-heading">
    <div class="bg-surface-container-lowest rounded-2xl border border-outline-variant/30 p-5 sm:p-6 md:p-8 shadow-[0_12px_22px_rgba(25,28,30,0.05)] attention-panel">
        <div class="text-center sm:text-left max-w-2xl mx-auto sm:mx-0 mb-6 sm:mb-8">
            <p class="font-label text-editorial-kicker text-on-surface-variant">{{ __('public.home.services_kicker') }}</p>
            <h2 id="home-services-heading" class="font-headline text-editorial-section-title font-extrabold text-primary tracking-tight leading-tight mt-1">
                {{ __('public.home.services_title') }}
            </h2>
            <p class="text-on-surface-variant text-editorial-body mt-2">{{ __('public.home.services_subtitle') }}</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <article class="flex flex-col rounded-2xl bg-surface-container-low border border-outline-variant/20 p-5 text-center sm:text-left h-full">
                <span class="material-symbols-outlined text-primary text-[32px] mb-3" aria-hidden="true">directions_car</span>
                <h3 class="font-headline font-extrabold text-primary text-lg">{{ __('public.home.service_sales_title') }}</h3>
                <p class="text-on-surface-variant text-sm mt-2 flex-1">{{ __('public.home.service_sales_body') }}</p>
                <a href="{{ route('cars.index') }}" class="mt-4 inline-flex items-center justify-center sm:justify-start gap-1 text-sm font-bold text-primary hover:underline">
                    {{ __('public.home.service_sales_cta') }}
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_forward</span>
                </a>
            </article>
            <article class="flex flex-col rounded-2xl bg-surface-container-low border border-outline-variant/20 p-5 text-center sm:text-left h-full">
                <span class="material-symbols-outlined text-primary text-[32px] mb-3" aria-hidden="true">car_rental</span>
                <h3 class="font-headline font-extrabold text-primary text-lg">{{ __('public.home.service_rental_title') }}</h3>
                <p class="text-on-surface-variant text-sm mt-2 flex-1">{{ __('public.home.service_rental_body') }}</p>
                <a href="{{ $rentalWaHref }}" target="_blank" rel="noopener noreferrer" class="mt-4 inline-flex items-center justify-center sm:justify-start gap-1 text-sm font-bold text-primary hover:underline">
                    {{ __('public.home.service_rental_cta') }}
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_forward</span>
                </a>
            </article>
            <article class="flex flex-col rounded-2xl bg-surface-container-low border border-outline-variant/20 p-5 text-center sm:text-left h-full">
                <span class="material-symbols-outlined text-primary text-[32px] mb-3" aria-hidden="true">local_shipping</span>
                <h3 class="font-headline font-extrabold text-primary text-lg">{{ __('public.home.service_import_title') }}</h3>
                <p class="text-on-surface-variant text-sm mt-2 flex-1">{{ __('public.home.service_import_body') }}</p>
                <a href="{{ route('order.request') }}" class="mt-4 inline-flex items-center justify-center sm:justify-start gap-1 text-sm font-bold text-primary hover:underline">
                    {{ __('public.home.service_import_cta') }}
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true">arrow_forward</span>
                </a>
            </article>
        </div>
    </div>
</section>
