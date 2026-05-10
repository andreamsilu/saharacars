{{--
  Blocking stylesheets avoid FOUC from async "print" font/icon hacks.
  Load Tailwind CDN without "defer" so utilities apply before first paint (see pages: script order = config, then cdn).
--}}
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap"/>
<link rel="stylesheet" href="{{ asset('css/material-symbols-outlined.css') }}"/>
{{-- Shared public tokens (typography, effects, motion, design, a11y): external file avoids premature inline style termination. --}}
<link rel="stylesheet" href="{{ asset('css/sahara-public-tokens.css') }}"/>
