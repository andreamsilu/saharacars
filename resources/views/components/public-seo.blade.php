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

    // Full-width header logo (not ideal as favicon — use square mark for tabs + Google).
    $logoUrl = asset('images/logo.png');
    $faviconSvgUrl = asset('favicon.svg');
    $faviconIcoUrl = url('/favicon.ico'); // resolves to favicon.svg (see routes/web.php)

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
                    'logo' => ['@type' => 'ImageObject', 'url' => $faviconSvgUrl],
                ],
            ],
        ]];
    }
@endphp

<link rel="icon" href="{{ $faviconSvgUrl }}" type="image/svg+xml" sizes="any"/>
<link rel="icon" type="image/svg+xml" href="{{ $faviconIcoUrl }}" sizes="48x48"/>
<link rel="shortcut icon" href="{{ $faviconIcoUrl }}"/>
<link rel="apple-touch-icon" href="{{ $faviconIcoUrl }}"/>
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
