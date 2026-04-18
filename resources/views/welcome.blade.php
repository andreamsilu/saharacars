<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
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
              "on-primary": "#ffffff",
              "on-background": "#191c1e",
              "primary": "#8a6528",
              "surface-container-lowest": "#ffffff",
              "surface-container-high": "#e6e8ea",
              "on-error-container": "#93000a",
              "on-error": "#ffffff",
              "on-primary-fixed": "#2a1d09",
              "secondary-fixed": "#66ff8e",
              "on-secondary-container": "#007232",
              "on-primary-fixed-variant": "#4a3614",
              "on-surface-variant": "#43474f",
              "on-tertiary-fixed-variant": "#723610",
              "surface-container-highest": "#e0e3e5",
              "secondary-container": "#5dfd8a",
              "tertiary-fixed": "#ffdbca",
              "surface-variant": "#e0e3e5",
              "on-secondary-fixed-variant": "#005322",
              "tertiary-container": "#592300",
              "on-tertiary": "#ffffff",
              "background": "#f3f3f3",
              "inverse-on-surface": "#eff1f3",
              "surface-tint": "#8a6528",
              "secondary": "#006d2f",
              "surface-container": "#eceef0",
              "surface": "#f3f3f3",
              "tertiary": "#381300",
              "primary-fixed": "#f0dfc4",
              "on-tertiary-container": "#d8885c",
              "inverse-surface": "#2d3133",
              "surface-bright": "#f3f3f3",
              "outline": "#737780",
              "error-container": "#ffdad6",
              "tertiary-fixed-dim": "#ffb690",
              "primary-container": "#5c4320",
              "error": "#ba1a1a",
              "outline-variant": "#c3c6d1",
              "surface-dim": "#d8dadc",
              "on-secondary-fixed": "#002109",
              "on-surface": "#191c1e",
              "primary-fixed-dim": "#d4b57a",
              "on-tertiary-fixed": "#341100",
              "inverse-primary": "#e8c889",
              "on-secondary": "#ffffff",
              "on-primary-container": "#f4e4c4",
              "surface-container-low": "#f2f4f6",
              "secondary-fixed-dim": "#3de273"
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
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased overflow-x-hidden attention-mesh">
<!-- TopNavBar -->
<x-navbar />
<!-- Hero Section -->
<section class="relative min-h-[870px] flex flex-col items-center justify-center px-6 overflow-hidden">
<div class="absolute inset-0 -z-10">
<img class="w-full h-full object-cover" data-alt="Luxurious silver SUV parked on a high cliff overlooking the Tanzanian savannah at golden hour with soft warm cinematic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCcLzDyWFTrb_mlvvRDjD6O6TXBwgMidDKlVC2iLF6Nn9HEu6IZlh0mKX-9KzISNLSsM3ehX7ecqfkZArD_muxt4lWX4L6TNXYFeEDoZQSdXI2ii4QM_usRKJMoS1tmTI05i1aM0v2omzUpW-1aU_R0S9kCvuNMJdMpjbcK1lBc253kHSwAKVtOF1vTgySgsdS9XTxkBcU58WT5AU4TmJXz4wHKicICEUbjOeVC1EgHg-9rQKJnl727mLPPHqder-uWzeej4sl-nbc"/>
<div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/20 to-surface"></div>
</div>
<div class="max-w-4xl w-full text-center space-y-8">
<h1 class="font-headline text-5xl md:text-7xl font-black text-white tracking-tighter leading-tight">
                Find Your Journey in <span class="text-secondary-container">Tanzania</span>
</h1>
<p class="text-white/90 text-lg md:text-xl font-medium max-w-2xl mx-auto">
                Discover the most reliable luxury and rugged vehicles curated for the African terrain.
            </p>
<!-- Search Bar (Centered) -->
<div class="bg-white/90 backdrop-blur-xl p-3 md:p-4 rounded-3xl md:rounded-full shadow-2xl flex flex-col md:flex-row gap-2 items-center w-full max-w-4xl">
<div class="flex-1 w-full grid grid-cols-1 md:grid-cols-3 gap-2 px-4">
<div class="flex flex-col items-start border-b md:border-b-0 md:border-r border-slate-200 py-2">
<span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Brand</span>
<select class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-primary">
<option>Toyota Land Cruiser</option>
<option>Range Rover</option>
<option>Mercedes Benz</option>
<option>Nissan Patrol</option>
</select>
</div>
<div class="flex flex-col items-start border-b md:border-b-0 md:border-r border-slate-200 py-2">
<span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Price Range</span>
<select class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-primary">
<option>TZS 20M - 50M</option>
<option>TZS 50M - 100M</option>
<option>TZS 100M+</option>
</select>
</div>
<div class="flex flex-col items-start py-2">
<span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Location</span>
<select class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-primary">
<option>Dar es Salaam</option>
<option>Arusha</option>
<option>Zanzibar</option>
</select>
</div>
</div>
<a class="w-full md:w-auto bg-secondary text-white px-10 py-4 rounded-full font-bold flex items-center justify-center gap-2 hover:bg-on-secondary-container transition-all active:scale-95 shadow-lg" href="{{ route('cars.index') }}">
<span class="material-symbols-outlined">search</span>
                    Find Cars
                </a>
</div>
</div>
</section>
<!-- Content: Featured Cars Section -->
<main class="max-w-7xl mx-auto px-6 py-24">
<div class="flex justify-between items-end mb-12">
<div class="space-y-2">
<span class="text-secondary font-bold text-sm uppercase tracking-[0.2em]">Our Collection</span>
<h2 class="font-headline text-4xl font-black text-primary">Featured Vehicles</h2>
</div>
<a class="hidden md:flex items-center gap-2 text-primary font-bold border-b-2 border-primary/10 hover:border-primary transition-all pb-1" href="{{ route('cars.index') }}">
                View All Inventory
                <span class="material-symbols-outlined">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Car Card 1 -->
<div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100/50">
<div class="relative h-64 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" data-alt="Side profile of a white Toyota Land Cruiser 300 series on a clean asphalt road with modern architectural background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA22fbpK55YPmmHt7FAjsI5kZ3xflK1M1r3WMtrkINveXqYJz2qshh0Oah6Jn2V-xOo5U5JZgHA_dKNGWILKtpV377uJgkD75zQCZrFD3Kc1zRzV_Zp8c1bM9Lrr6DJXBdMuK35gOAcsrUonwVX4IAXiDkWHSWHUMgSj5fx_c00WJtwGHAumv1I502U9zX05d_ScrpBqQGZjG04WsRyYHddMDWli9Y8b1TcnKi3-nf_wf54iHQMDmYaSYGf5T7b9JLA2a1DQ1fHUVI"/>
<div class="absolute top-4 left-4">
<span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black uppercase text-primary tracking-widest flex items-center gap-1">
<span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">verified</span> Verified
                        </span>
</div>
<button class="absolute top-4 right-4 bg-white/20 backdrop-blur-md p-2 rounded-full text-white hover:bg-white hover:text-red-500 transition-all">
<span class="material-symbols-outlined">favorite</span>
</button>
</div>
<div class="p-6 space-y-4">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-xl font-bold text-primary">Toyota Land Cruiser 300</h3>
<div class="flex items-center gap-1 text-slate-400 text-xs mt-1">
<span class="material-symbols-outlined text-sm">location_on</span> Dar es Salaam
                            </div>
</div>
<span class="bg-secondary-container text-on-secondary-container text-xs font-bold px-2 py-1 rounded">2023</span>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="bg-surface-container-low p-3 rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-blue-900/50 text-lg">settings</span>
<span class="text-xs font-semibold text-slate-600">Automatic</span>
</div>
<div class="bg-surface-container-low p-3 rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-blue-900/50 text-lg">oil_barrel</span>
<span class="text-xs font-semibold text-slate-600">3.5L Diesel</span>
</div>
</div>
<div class="pt-4 flex items-center justify-between border-t border-slate-50">
<div class="font-headline text-2xl font-black text-primary">TZS 185M</div>
<button class="bg-primary text-white px-6 py-2 rounded-full text-sm font-bold active:scale-95 transition-all">Details</button>
</div>
</div>
</div>
<!-- Car Card 2 -->
<div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100/50">
<div class="relative h-64 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" data-alt="Luxury midnight blue sedan parked in a minimalist showroom with soft overhead lighting and reflective floor" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXB-5OAKMKhfuuczXDa-iwqvEkwdKV0QursU_GgS3F_3uwInFeS7cwPIHLLRvQKDpJ3IaYhOiNvqtTkmqrX02KZyO-qZrxHzMp6QCK3_MM2P4NARa9UzaMEBcLtorgqN1l4Q0FMiOSUEMUsZ5vzNcHq3mrHU8hX-2gF0Bjswg5HPCEkbBhFU4T_QiCv1jDBVt3xB1FKqozSS0UZk6qA36oo5793YL6lXw2j2YRLpV1wDouuapc1e4bFGbDn03OyW6XACvZCkCD13E"/>
<div class="absolute top-4 left-4">
<span class="bg-secondary text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">New Listing</span>
</div>
</div>
<div class="p-6 space-y-4">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-xl font-bold text-primary">Mercedes-Benz G-Class</h3>
<div class="flex items-center gap-1 text-slate-400 text-xs mt-1">
<span class="material-symbols-outlined text-sm">location_on</span> Arusha
                            </div>
</div>
<span class="bg-secondary-container text-on-secondary-container text-xs font-bold px-2 py-1 rounded">2021</span>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="bg-surface-container-low p-3 rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-blue-900/50 text-lg">speed</span>
<span class="text-xs font-semibold text-slate-600">12,400 KM</span>
</div>
<div class="bg-surface-container-low p-3 rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-blue-900/50 text-lg">local_gas_station</span>
<span class="text-xs font-semibold text-slate-600">Petrol</span>
</div>
</div>
<div class="pt-4 flex items-center justify-between border-t border-slate-50">
<div class="font-headline text-2xl font-black text-primary">TZS 310M</div>
<button class="bg-primary text-white px-6 py-2 rounded-full text-sm font-bold active:scale-95 transition-all">Details</button>
</div>
</div>
</div>
<!-- Car Card 3 -->
<div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100/50">
<div class="relative h-64 overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" data-alt="Black Range Rover Defender driving through a muddy track in a lush jungle with dramatic lighting and water splashes" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAsJ6aUGKVE9Zi6tHEqPGLRxcreFUH-BykJsww2wPjB3OaLtOejsVupKxt_rU-kMncvfiRvTz_yCnHosXmay1iGjiPWYrwKwcnd8ysImPfqngblujt9HC5bxE5GoEoNmrnOH8B4eJHM5UrNCTOMk1xUhrOVJ1mgx3e3kAzHXFOS7vUQG8w1X06E-tAN7d3lCEEiNCaCaTt2nxK_UYYsLJ-2r9pEmuudXS4b7yaP22iko8RIb1q1FOldNSmjJy1Jg_ZZj2FbbXw6os"/>
<div class="absolute top-4 left-4">
<span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black uppercase text-primary tracking-widest flex items-center gap-1">
                            Featured
                        </span>
</div>
</div>
<div class="p-6 space-y-4">
<div class="flex justify-between items-start">
<div>
<h3 class="font-headline text-xl font-bold text-primary">Range Rover Defender</h3>
<div class="flex items-center gap-1 text-slate-400 text-xs mt-1">
<span class="material-symbols-outlined text-sm">location_on</span> Zanzibar
                            </div>
</div>
<span class="bg-secondary-container text-on-secondary-container text-xs font-bold px-2 py-1 rounded">2022</span>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="bg-surface-container-low p-3 rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-blue-900/50 text-lg">explore</span>
<span class="text-xs font-semibold text-slate-600">4WD Active</span>
</div>
<div class="bg-surface-container-low p-3 rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-blue-900/50 text-lg">calendar_month</span>
<span class="text-xs font-semibold text-slate-600">Aug 2022</span>
</div>
</div>
<div class="pt-4 flex items-center justify-between border-t border-slate-50">
<div class="font-headline text-2xl font-black text-primary">TZS 245M</div>
<button class="bg-primary text-white px-6 py-2 rounded-full text-sm font-bold active:scale-95 transition-all">Details</button>
</div>
</div>
</div>
</div>
</main>
<!-- SideNavBar (Hidden on desktop, legacy demo block) -->
<aside class="hidden lg:flex flex-col p-6 fixed left-0 top-0 h-full w-64 border-r border-slate-200 bg-slate-50 -translate-x-full">
<div class="text-xl font-black text-blue-900 mb-8">Sahara Sales</div>
<div class="mb-8 flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary-container"></div>
<div>
<div class="text-sm font-bold text-primary">Premium Dealer</div>
<div class="text-[10px] text-slate-500 font-medium">Dar es Salaam Center</div>
</div>
</div>
<nav class="space-y-2 flex-1">
<a class="flex items-center gap-3 p-3 bg-white text-blue-900 shadow-sm rounded-xl font-bold" href="#">
<span class="material-symbols-outlined">directions_car</span> Inventory
            </a>
<a class="flex items-center gap-3 p-3 text-slate-500 hover:text-blue-900 hover:translate-x-1 transition-all" href="#">
<span class="material-symbols-outlined">insights</span> Analytics
            </a>
<a class="flex items-center gap-3 p-3 text-slate-500 hover:text-blue-900 hover:translate-x-1 transition-all" href="#">
<span class="material-symbols-outlined">chat</span> Messages
            </a>
<a class="flex items-center gap-3 p-3 text-slate-500 hover:text-blue-900 hover:translate-x-1 transition-all" href="#">
<span class="material-symbols-outlined">people</span> Leads
            </a>
<a class="flex items-center gap-3 p-3 text-slate-500 hover:text-blue-900 hover:translate-x-1 transition-all" href="#">
<span class="material-symbols-outlined">settings</span> Settings
            </a>
</nav>
<button class="bg-primary text-white w-full py-3 rounded-xl font-bold text-sm">Add New Listing</button>
</aside>
<x-mobile-nav active="home" />
<x-whatsapp-float />
<x-footer />
</body></html>
