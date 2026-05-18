{{--
  Blocking stylesheets avoid FOUC from async "print" font/icon hacks.
  Load Tailwind CDN without "defer" so utilities apply before first paint (see pages: script order = config, then cdn).

  Icons: self-hosted Material Symbols only (~310 KB). Do NOT load Material Symbols from fonts.googleapis.com
  (full variable font is 1 MB+ and triggers Search Console "BigFile" warnings).
--}}
<link rel="preload" href="{{ asset('fonts/material-symbols-outlined-400.woff2') }}" as="font" type="font/woff2" crossorigin/>
<link rel="stylesheet" href="{{ asset('css/material-symbols-outlined.css') }}"/>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&amp;family=Inter:wght@400;600;700&amp;display=swap"/>
{{-- Shared public tokens (typography, effects, motion, design, a11y): external file avoids premature inline style termination. --}}
<link rel="stylesheet" href="{{ asset('css/sahara-public-tokens.css') }}"/>
<x-public-favicon />
