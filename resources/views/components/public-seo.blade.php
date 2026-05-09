@props([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'image' => null,
    'type' => 'website',
    'noindex' => false,
    'structuredData' => null,
])

@php
    $siteName = (string) config('sahara.legal_entity_name', config('app.name'));
    $defaultDescription = __('public.cars.page_description_fallback', ['company' => $siteName]);
    $resolvedTitle = trim((string) ($title ?? $siteName)) ?: $siteName;
    $resolvedDescription = trim((string) ($description ?? $defaultDescription)) ?: $defaultDescription;
    $resolvedCanonical = $canonical ?: url()->current();
    $resolvedImage = $image ?: asset('images/login-bg-hero.jpg');
    $shouldNoindex = (bool) $noindex;
    $robotsValue = $shouldNoindex ? 'noindex, nofollow' : 'index, follow, max-image-preview:large';
    $twitterCard = $resolvedImage ? 'summary_large_image' : 'summary';

    // Keep wide logo for site UI, but use square icons for search/browser favicons.
    $logoUrl = asset('images/logo.png');
    $favicon48Url = asset('images/favicon-mark-48.png');
    $favicon192Url = asset('images/favicon-mark-192.png');
    $favicon512Url = asset('images/favicon-mark-512.png');
    $appleTouchIconUrl = asset('images/favicon-mark-180.png');
    $faviconIcoUrl = url('/favicon.ico');

    $jsonLd = [];
    if ($structuredData) {
        $jsonLd = is_array($structuredData) ? $structuredData : [$structuredData];
    } elseif (! $shouldNoindex) {
        $siteUrl = rtrim((string) config('sahara.public_site_url', url('/')), '/');
        $jsonLd = [[
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    'name' => $siteName,
                    'url' => $siteUrl,
                    'inLanguage' => str_replace('_', '-', app()->getLocale()),
                    'publisher' => ['@id' => $siteUrl.'#organization'],
                ],
                [
                    '@id' => $siteUrl.'#organization',
                    '@type' => 'Organization',
                    'name' => $siteName,
                    'url' => $siteUrl,
                    'logo' => ['@type' => 'ImageObject', 'url' => $favicon512Url],
                ],
            ],
        ]];
    }
@endphp

<link rel="icon" type="image/png" sizes="48x48" href="{{ $favicon48Url }}"/>
<link rel="icon" type="image/png" sizes="192x192" href="{{ $favicon192Url }}"/>
<link rel="icon" type="image/png" sizes="512x512" href="{{ $favicon512Url }}"/>
<link rel="shortcut icon" href="{{ $faviconIcoUrl }}"/>
<link rel="apple-touch-icon" sizes="180x180" href="{{ $appleTouchIconUrl }}"/>
<title>{{ e($resolvedTitle) }}</title>
<meta name="description" content="{{ e($resolvedDescription) }}"/>
<link rel="canonical" href="{{ e($resolvedCanonical) }}"/>
<meta name="robots" content="{{ $robotsValue }}"/>

<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
<meta property="og:type" content="{{ e($type) }}"/>
<meta property="og:site_name" content="{{ e($siteName) }}"/>
<meta property="og:title" content="{{ e($resolvedTitle) }}"/>
<meta property="og:description" content="{{ e($resolvedDescription) }}"/>
<meta property="og:url" content="{{ e($resolvedCanonical) }}"/>
<meta property="og:image" content="{{ e($resolvedImage) }}"/>

<meta name="twitter:card" content="{{ $twitterCard }}"/>
<meta name="twitter:title" content="{{ e($resolvedTitle) }}"/>
<meta name="twitter:description" content="{{ e($resolvedDescription) }}"/>
<meta name="twitter:image" content="{{ e($resolvedImage) }}"/>

@foreach ($jsonLd as $schema)
    @if (is_array($schema))
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endif
@endforeach
