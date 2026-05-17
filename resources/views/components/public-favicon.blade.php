{{-- Brand favicons from public/images/logo.png (transparent PNG). Regenerate: node scripts/generate-favicons.mjs --}}
@php
    $favicon48Url = asset('images/favicon-48.png');
    $favicon96Url = asset('images/favicon-96.png');
    $favicon192Url = asset('images/favicon-192.png');
    $favicon512Url = asset('images/favicon-512.png');
    $appleTouchIconUrl = asset('images/favicon-180.png');
    $faviconIcoUrl = url('/favicon.ico');
@endphp
<link rel="icon" type="image/png" sizes="48x48" href="{{ $favicon48Url }}"/>
<link rel="icon" type="image/png" sizes="96x96" href="{{ $favicon96Url }}"/>
<link rel="icon" type="image/png" sizes="192x192" href="{{ $favicon192Url }}"/>
<link rel="icon" type="image/png" sizes="512x512" href="{{ $favicon512Url }}"/>
<link rel="shortcut icon" href="{{ $faviconIcoUrl }}"/>
<link rel="apple-touch-icon" sizes="180x180" href="{{ $appleTouchIconUrl }}"/>
