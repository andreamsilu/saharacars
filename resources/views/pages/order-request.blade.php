<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <x-public-seo
        :title="__('public.meta.order_title', ['company' => config('sahara.legal_entity_name')])"
        :description="__('public.cars.page_description_fallback', ['company' => config('sahara.legal_entity_name')])"
        :canonical="route('order.request', ['locale' => app()->getLocale()])"
    />
    <x-public-head-assets />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @include('components.public-typography-tokens')
        @include('components.public-effects-tokens')
        @include('components.public-design-tokens')
        @include('components.public-a11y-tokens')
    </style>
</head>
<body class="bg-surface font-body text-on-surface attention-mesh pb-mobile-nav md:pb-0">
<x-skip-to-main />
<x-navbar />
<main id="main-content" tabindex="-1" class="outline-none max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <section class="sahara-live-panel bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-[0_16px_24px_rgba(25,28,30,0.04)] attention-panel">
        <h1 class="font-headline text-editorial-hero font-extrabold text-primary tracking-tight text-center sm:text-left">{{ __('public.order.title') }}</h1>
        <p class="mt-2 text-on-surface-variant text-editorial-body text-center sm:text-left">{{ __('public.order.subtitle') }}</p>

        @if (session('status'))
            <div class="mt-6 rounded-xl bg-green-500/10 p-4 text-sm text-green-900 ghost-border">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="mt-6 rounded-xl bg-red-500/10 p-4 text-sm text-red-900 ghost-border">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-6 space-y-5" method="POST" action="{{ route('order.request.store') }}">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="order-full-name" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_full_name') }}</label>
                    <input id="order-full-name" name="full_name" value="{{ old('full_name') }}" required class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="order-email" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_email') }}</label>
                    <input id="order-email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" />
                </div>
                <div>
                    <label for="order-phone" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_phone') }}</label>
                    <input id="order-phone" name="phone" value="{{ old('phone') }}" required class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="{{ __('public.order.placeholder_phone') }}" />
                </div>
                <div>
                    <label for="order-source-country" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_source_country') }}</label>
                    <select id="order-source-country" name="source_country" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30">
                        <option value="">{{ __('public.order.any_country') }}</option>
                        @foreach (['Japan', 'Germany', 'Thailand', 'United Kingdom', 'United Arab Emirates', 'South Korea'] as $country)
                            <option value="{{ $country }}" {{ old('source_country') === $country ? 'selected' : '' }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="order-brand" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_brand') }}</label>
                    <input id="order-brand" name="preferred_brand" value="{{ old('preferred_brand') }}" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="{{ __('public.order.placeholder_brand') }}" />
                </div>
                <div>
                    <label for="order-model" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_model') }}</label>
                    <input id="order-model" name="preferred_model" value="{{ old('preferred_model') }}" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="{{ __('public.order.placeholder_model') }}" />
                </div>
                <div>
                    <label for="order-year-min" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_year_min') }}</label>
                    <input id="order-year-min" name="year_min" type="number" value="{{ old('year_min') }}" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="{{ __('public.order.placeholder_year') }}" />
                </div>
                <div>
                    <label for="order-year-max" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_year_max') }}</label>
                    <input id="order-year-max" name="year_max" type="number" value="{{ old('year_max') }}" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="2024" />
                </div>
                <div>
                    <label for="order-budget-min" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_budget_min') }}</label>
                    <input id="order-budget-min" name="budget_min_tzs" type="number" value="{{ old('budget_min_tzs') }}" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="50000000" />
                </div>
                <div>
                    <label for="order-budget-max" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_budget_max') }}</label>
                    <input id="order-budget-max" name="budget_max_tzs" type="number" value="{{ old('budget_max_tzs') }}" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="200000000" />
                </div>
            </div>
            <div>
                <label for="order-message" class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">{{ __('public.order.label_notes') }}</label>
                <textarea id="order-message" name="message" rows="4" class="w-full rounded-xl bg-surface-container-highest py-3 px-4 ghost-border focus:ring-2 focus:ring-primary/30" placeholder="{{ __('public.order.placeholder_notes') }}">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="sahara-live-cta w-full cta-gradient text-on-primary font-bold py-3.5 rounded-full min-h-[48px] focus-ring-on-dark">{{ __('public.order.submit') }}</button>
        </form>
    </section>
</main>
<x-footer class="mt-20" />
<x-mobile-nav active="" />
<x-whatsapp-float />
</body>
</html>

