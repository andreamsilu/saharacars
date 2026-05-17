@props([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'image' => null,
    'imageAlt' => null,
    'type' => 'website',
    'noindex' => false,
    'structuredData' => null,
])

@php
    use App\Support\PublicSeoBuilder;

    $siteName = (string) config('sahara.legal_entity_name', config('app.name'));
    $defaultDescription = __('public.meta.default_description', ['company' => $siteName]);
    $resolvedTitle = trim((string) ($title ?? $siteName)) ?: $siteName;
    $resolvedDescription = trim((string) ($description ?? $defaultDescription)) ?: $defaultDescription;
    $resolvedCanonical = $canonical ?: url()->current();
    $resolvedImage = $image ?: asset('images/login-bg-hero.jpg');
    $resolvedImageAlt = trim((string) ($imageAlt ?? $resolvedTitle));
    $shouldNoindex = (bool) $noindex;
    $robotsValue = $shouldNoindex ? 'noindex, nofollow' : 'index, follow, max-image-preview:large';
    $twitterCard = $resolvedImage ? 'summary_large_image' : 'summary';
    $localeTag = str_replace('_', '-', app()->getLocale());
    $supportedLocales = config('app.supported_locales', ['en', 'sw']);
    $hreflangAlternates = PublicSeoBuilder::hreflangAlternates();

    $jsonLd = [];
    if ($structuredData) {
        $payload = is_array($structuredData) ? $structuredData : [$structuredData];
        if (isset($payload['@graph']) || isset($payload['@context'])) {
            $jsonLd = [$payload];
        } else {
            $jsonLd = [PublicSeoBuilder::graphWithProduct($payload)];
        }
    } elseif (! $shouldNoindex) {
        $jsonLd = [PublicSeoBuilder::defaultGraph()];
    }
@endphp

<title>{{ e($resolvedTitle) }}</title>
<meta name="description" content="{{ e($resolvedDescription) }}"/>
<link rel="canonical" href="{{ e($resolvedCanonical) }}"/>
<meta name="robots" content="{{ $robotsValue }}"/>
<meta name="theme-color" content="#8a6528"/>

@foreach ($hreflangAlternates as $alternate)
    <link rel="alternate" hreflang="{{ $alternate['hreflang'] }}" href="{{ e($alternate['href']) }}"/>
@endforeach

<meta property="og:locale" content="{{ $localeTag }}"/>
@foreach ($supportedLocales as $altLocale)
    @if ($altLocale !== app()->getLocale())
        <meta property="og:locale:alternate" content="{{ str_replace('_', '-', $altLocale) }}"/>
    @endif
@endforeach
<meta property="og:type" content="{{ e($type) }}"/>
<meta property="og:site_name" content="{{ e($siteName) }}"/>
<meta property="og:title" content="{{ e($resolvedTitle) }}"/>
<meta property="og:description" content="{{ e($resolvedDescription) }}"/>
<meta property="og:url" content="{{ e($resolvedCanonical) }}"/>
<meta property="og:image" content="{{ e($resolvedImage) }}"/>
<meta property="og:image:alt" content="{{ e($resolvedImageAlt) }}"/>

<meta name="twitter:card" content="{{ $twitterCard }}"/>
<meta name="twitter:title" content="{{ e($resolvedTitle) }}"/>
<meta name="twitter:description" content="{{ e($resolvedDescription) }}"/>
<meta name="twitter:image" content="{{ e($resolvedImage) }}"/>
<meta name="twitter:image:alt" content="{{ e($resolvedImageAlt) }}"/>

@foreach ($jsonLd as $schema)
    @if (is_array($schema))
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endif
@endforeach
