<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-fixed": "#f0dfc4",
              "primary-container": "#5c4320",
              "error-container": "#ffdad6",
              "secondary-fixed": "#66ff8e",
              "on-tertiary-container": "#d8885c",
              "error": "#ba1a1a",
              "surface-container-highest": "#e0e3e5",
              "surface-tint": "#8a6528",
              "on-secondary-container": "#007232",
              "surface-container-lowest": "#ffffff",
              "on-background": "#191c1e",
              "inverse-primary": "#e8c889",
              "on-surface": "#191c1e",
              "surface-container-high": "#e6e8ea",
              "inverse-on-surface": "#eff1f3",
              "surface-container-low": "#f2f4f6",
              "surface-bright": "#f3f3f3",
              "primary-fixed-dim": "#d4b57a",
              "on-tertiary-fixed": "#341100",
              "tertiary-fixed": "#ffdbca",
              "tertiary-fixed-dim": "#ffb690",
              "on-surface-variant": "#43474f",
              "on-primary-fixed": "#2a1d09",
              "background": "#f3f3f3",
              "on-tertiary": "#ffffff",
              "on-secondary": "#ffffff",
              "on-error": "#ffffff",
              "on-error-container": "#93000a",
              "surface": "#f3f3f3",
              "tertiary-container": "#592300",
              "tertiary": "#381300",
              "on-secondary-fixed": "#002109",
              "outline": "#737780",
              "secondary": "#006d2f",
              "secondary-fixed-dim": "#3de273",
              "on-tertiary-fixed-variant": "#723610",
              "on-primary-fixed-variant": "#4a3614",
              "surface-dim": "#d8dadc",
              "on-primary": "#ffffff",
              "outline-variant": "#c3c6d1",
              "surface-container": "#eceef0",
              "secondary-container": "#5dfd8a",
              "surface-variant": "#e0e3e5",
              "inverse-surface": "#2d3133",
              "on-primary-container": "#f4e4c4",
              "primary": "#8a6528",
              "on-secondary-fixed-variant": "#005322"
            },
            fontFamily: {
              "headline": ["Manrope"],
              "body": ["Inter"],
              "label": ["Inter"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }
    </script>
<style>
      @include('components.public-typography-tokens')
      @include('components.public-effects-tokens')
      @include('components.public-design-tokens')
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed attention-mesh pb-mobile-nav md:pb-0">
<!-- TopNavBar -->
<x-navbar />
<main>
<!-- Hero Section -->
<section class="relative min-h-[min(90svh,819px)] md:h-[819px] flex items-center overflow-hidden py-16 md:py-0">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="luxury off-road vehicle driving through the vast golden Serengeti plains at sunset, high-end editorial automotive photography" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdoekZbNAVkxYdV5iREnckqm2Ql0A-u0qL3xf21tljGkOjG1o_L0BkRS7mFzlWe8q3p9H7GSUhqCs4vJVTnTw2NZSWUSt8pSKuZS9Wr9KJ-CQwbRvioDCN4qEUDsxsP4xsve93_xVv55Xg3f4KYsLP4mhobNfA7K8shqLRYq1WPDvb8HySLWrbZvitps3LtFYIMAoJ-bygyNo68jwAPUQlJP0CwEgbVJY_lj2ryEUTFUjQ7jzmkzNig-WjE_ZhO7ietypjMyZ4IKA"/>
<div class="absolute inset-0 bg-gradient-to-r from-primary/80 via-primary/40 to-transparent"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 w-full">
<div class="max-w-2xl">
<span class="inline-block px-4 py-1.5 bg-secondary-container text-on-secondary-fixed-variant rounded-full text-xs font-bold tracking-widest uppercase mb-6 font-label">The Sahara Legacy</span>
<h1 class="text-[clamp(2rem,7vw,4.5rem)] md:text-7xl font-headline font-extrabold text-white tracking-tighter leading-[1.1] mb-6">
                        The Editorial Curator of <span class="text-secondary-fixed">Automotive Excellence.</span>
</h1>
<p class="text-lg text-white/80 font-body leading-relaxed mb-8 max-w-lg">
                        Beyond a marketplace, we are the guardians of trust in Tanzania's automotive landscape, connecting discerning drivers with verified prestige.
                    </p>
</div>
</div>
</section>
<!-- Our Story: Asymmetric Bento Grid -->
<section class="section-editorial px-6 bg-surface-container-low">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
<div class="md:col-span-5 space-y-8">
<div>
<h2 class="text-sm font-bold text-primary tracking-[0.2em] uppercase mb-4 font-label">Our Journey</h2>
<h3 class="text-4xl font-headline font-extrabold text-on-surface tracking-tight mb-6">From Local Roots to National Leadership.</h3>
<p class="text-on-surface-variant leading-relaxed">
                                Sahara Cars began with a single observation: the Tanzanian automotive market lacked a unified standard of trust. Our founders envisioned a platform where transparency wasn't just a feature, but the core foundation.
                            </p>
</div>
<div class="p-8 bg-surface-container-lowest rounded-xl shadow-[0_16px_24px_rgba(25,28,30,0.04)] attention-panel">
<p class="italic text-lg font-headline text-primary font-medium">
                                "We don't just sell vehicles; we facilitate life's journeys by ensuring every car that carries the Sahara name is worthy of the road."
                            </p>
</div>
</div>
<div class="md:col-span-7 grid grid-cols-2 gap-4">
<div class="pt-12">
<img class="w-full h-[400px] object-cover rounded-xl shadow-lg" data-alt="Modern high-end car showroom in Dar es Salaam with clean minimalist architecture and natural light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDDqaAL1SlulmeJQN0Mf919wkx1qCkb-M6mRfMTZhJG9Zt4mo8IGJ_s8oJxu3r4MTMgswdtLDF70tspFDhE-nfA8WHqKSbU-NIjRZyc2u67B7IeUiew-ni8lFQAIFfWbQLs1dpAPaRLR9VeOaPYN3IGfAFaPUJ7f5wCFTd6kUrU97n7GpUH_nia40KL1GFuidVzB9aqZwivX31uPe1audfi98guiQD8VAebDHAii3wLwqhwA84IXryj_UMMjlCwRo3BQxa4IJy25Ww"/>
</div>
<div>
<img class="w-full h-[500px] object-cover rounded-xl shadow-lg" data-alt="Close up of a premium car steering wheel and dashboard with luxury textures and details" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpJMAk-bmiY8uhilYwsVJT4x0Ywk1qfmGKKPWwjtubthUrUkSvkgH1URMKOQZ9XpxDmtHCQi3an00jjKKa9raLEqwqOO6JCxoiiGUqABlz5QwzLqhILHNK1EI-2eYP2UTLe0oG_LBwAeyNbCEw-9Y0iqFHRw3TX_EObCMlUZPXk6AO1C3c9H7XYjcjq-5igsTnx4KxDL8oyDaHdB1UQj6ruKzMtZc6O1f9p9rXLzPl4FlJikONqKBUSg-IfJfyWxvFLmCZG4Ti6vg"/>
</div>
</div>
</div>
</div>
</section>
<!-- Mission & Values: Tonal Layering -->
<section class="section-editorial px-6 bg-surface attention-mesh">
<div class="max-w-7xl mx-auto text-center mb-16">
<h2 class="text-sm font-bold text-primary tracking-[0.2em] uppercase mb-4 font-label">The Sahara Way</h2>
<h3 class="text-4xl md:text-5xl font-headline font-extrabold text-on-surface tracking-tight">Built on Foundational Values.</h3>
</div>
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
<!-- Reliability -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 bg-primary-container text-white rounded-2xl flex items-center justify-center mb-6 transition-transform group-hover:scale-110">
<span class="material-symbols-outlined text-3xl">verified_user</span>
</div>
<h4 class="text-xl font-headline font-bold mb-3">Reliability</h4>
<p class="text-on-surface-variant text-sm leading-relaxed">Every transaction and listing is backed by our rigorous standards, ensuring you drive away with peace of mind.</p>
</div>
<!-- Quality -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 bg-secondary text-white rounded-2xl flex items-center justify-center mb-6 transition-transform group-hover:scale-110">
<span class="material-symbols-outlined text-3xl">workspace_premium</span>
</div>
<h4 class="text-xl font-headline font-bold mb-3">Quality</h4>
<p class="text-on-surface-variant text-sm leading-relaxed">We curate only the finest vehicles, focusing on mechanical integrity and aesthetic excellence for our clients.</p>
</div>
<!-- Customer Service -->
<div class="flex flex-col items-center text-center group">
<div class="w-16 h-16 bg-on-tertiary-container text-white rounded-2xl flex items-center justify-center mb-6 transition-transform group-hover:scale-110">
<span class="material-symbols-outlined text-3xl">handshake</span>
</div>
<h4 class="text-xl font-headline font-bold mb-3">Customer Service</h4>
<p class="text-on-surface-variant text-sm leading-relaxed">Our concierge approach ensures a seamless experience from the first click to the final handshake.</p>
</div>
</div>
</section>
<x-partner-logos-slider
    title="Related Companies We Work With"
    subtitle="Our ecosystem includes trusted institutions supporting finance, verification, transport, and post-sale confidence."
/>
<!-- Verification Process: Editorial Layout -->
<section class="section-editorial px-6 bg-primary text-white overflow-hidden relative">
<div class="absolute right-0 top-0 w-1/2 h-full opacity-20 hidden lg:block">
<img class="w-full h-full object-cover" data-alt="Professional mechanic inspecting a modern luxury engine with high-tech diagnostic equipment" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUzqmb7H2OOJ7YBEcHZjwhaSBvJ61So5O52b0AqsBEJL9-_qYVFwckQ56iLPBnLmRjgZVoqCPJ2mPCQNSYpzwRhBiW-dhb9NlyVYDgQFpwyH_umLqlUceoCDKtGg7rktA_OCrMUbH0WI4jYi6m3pMUMdwVZaPendoIouloqM7hMe_Xf3630UW_YpB9ubx4GA8hFl4ivIUrM80fG2z2TlZNrvopaCBLspcyy9rlZu9kLoa-AjdsGTCT34TtCVpmsvn-Iw9pyxuQJIY"/>
</div>
<div class="max-w-7xl mx-auto relative z-10">
<div class="max-w-xl">
<h2 class="text-secondary-fixed text-sm font-bold tracking-[0.2em] uppercase mb-4 font-label">Listing Verification</h2>
<h3 class="text-4xl font-headline font-extrabold mb-8">Not Just Anyone Can List on Sahara.</h3>
<div class="space-y-8">
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full bg-white/15 glass-effect flex items-center justify-center font-headline font-bold">01</div>
<div>
<h5 class="text-lg font-headline font-bold mb-2">Legal Compliance</h5>
<p class="text-white/70 text-sm">We verify seller identity and required compliance details before listings go live.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full bg-white/15 glass-effect flex items-center justify-center font-headline font-bold">02</div>
<div>
<h5 class="text-lg font-headline font-bold mb-2">Inventory Audit</h5>
<p class="text-white/70 text-sm">Our team performs random physical inspections of showroom inventory to match digital listings.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full bg-white/15 glass-effect flex items-center justify-center font-headline font-bold">03</div>
<div>
<h5 class="text-lg font-headline font-bold mb-2">Reputation Score</h5>
<p class="text-white/70 text-sm">A rolling quality review helps us keep only reliable listings on the platform.</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Call to Action -->
<section class="section-editorial px-6 text-center">
<div class="max-w-4xl mx-auto bg-surface-container-lowest rounded-3xl p-12 shadow-xl relative overflow-hidden attention-panel">
<div class="absolute top-0 right-0 p-4 opacity-5">
<span class="material-symbols-outlined text-9xl">directions_car</span>
</div>
<h3 class="text-4xl font-headline font-extrabold text-primary mb-6">Ready to find your perfect drive?</h3>
<p class="text-on-surface-variant mb-10 text-lg max-w-2xl mx-auto">Explore Tanzania's most exclusive collection of verified vehicles, from rugged 4x4s to luxury urban cruisers.</p>
<div class="flex flex-col sm:flex-row justify-center gap-4">
<a class="cta-gradient text-white px-10 py-4 rounded-full font-headline font-extrabold text-lg shadow-lg hover:shadow-primary/20 transition-all active:scale-95" href="{{ route('cars.index') }}">
                        Browse Our Inventory
                    </a>
<button class="bg-secondary text-white px-10 py-4 rounded-full font-headline font-extrabold text-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-secondary/20 transition-all active:scale-95" type="button">
<span class="material-symbols-outlined">chat</span>
                        Speak to Sales Team
                    </button>
</div>
</div>
</section>
</main>
<!-- Footer -->
<x-footer />
<x-mobile-nav active="about" />
<x-whatsapp-float />
</body></html>

