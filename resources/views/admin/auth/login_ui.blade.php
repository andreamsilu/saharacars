<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login | Sahara Cars Admin Console</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "on-secondary-container": "#007232",
              "surface-variant": "#e0e3e5",
              "secondary-container": "#5dfd8a",
              "on-secondary-fixed": "#002109",
              "surface-container-highest": "#e0e3e5",
              "on-background": "#191c1e",
              "on-tertiary": "#ffffff",
              "outline-variant": "#c3c6d1",
              "primary-container": "#5c4320",
              "on-surface": "#191c1e",
              "on-primary-fixed-variant": "#4a3614",
              "on-tertiary-container": "#d8885c",
              "primary-fixed-dim": "#d4b57a",
              "on-primary-fixed": "#2a1d09",
              "surface-tint": "#a67c40",
              "on-error-container": "#93000a",
              "tertiary-fixed-dim": "#ffb690",
              "surface-bright": "#f3f3f3",
              "on-tertiary-fixed-variant": "#723610",
              "error": "#ba1a1a",
              "on-primary": "#1a1208",
              "on-secondary": "#ffffff",
              "tertiary-container": "#592300",
              "tertiary-fixed": "#ffdbca",
              "primary-fixed": "#f0dfc4",
              "outline": "#737780",
              "secondary": "#006d2f",
              "inverse-primary": "#e8c889",
              "on-primary-container": "#f4e4c4",
              "on-tertiary-fixed": "#341100",
              "on-error": "#ffffff",
              "surface": "#f3f3f3",
              "secondary-fixed-dim": "#3de273",
              "surface-container-low": "#f2f4f6",
              "tertiary": "#381300",
              "inverse-on-surface": "#eff1f3",
              "inverse-surface": "#2d3133",
              "error-container": "#ffdad6",
              "secondary-fixed": "#66ff8e",
              "on-secondary-fixed-variant": "#005322",
              "on-surface-variant": "#43474f",
              "surface-dim": "#d8dadc",
              "primary": "#b48a40",
              "surface-container": "#eceef0",
              "background": "#f3f3f3",
              "surface-container-lowest": "#ffffff",
              "surface-container-high": "#e6e8ea"
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .editorial-gradient {
            background: linear-gradient(135deg, #f3f3f3 0%, #eceef0 100%);
        }
        .car-overlay {
            background: linear-gradient(to bottom right, rgba(92, 67, 32, 0.92), rgba(92, 67, 32, 0.75));
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">
<!-- Main Auth Canvas -->
<main class="min-h-screen flex items-center justify-center p-6 editorial-gradient relative overflow-hidden">
<!-- Subtle Background Decorative Element -->
<div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
<img alt="Premium automotive silhouette" class="w-full h-full object-cover grayscale" data-alt="Blurred silhouette of a high-end luxury sedan in a dark studio with dramatic rim lighting and shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJ3abMBQnHm9DstkPSqGmOlM7uZr89KCexgRNF6mrGRw7FdZ6OnQStTBm_Z8kS_O3pHALjb4r1jQgKyUpjbP8WyaPVUalXCR5gzLJrwrVE8R0JDucoKIqrkQxBJTqeLropzVujwsgZru-zq3fOYYJmwLEmcbHQS1-ftJqxffq4uM0KnUfpsCuRIuSUxxAVX8LeUy_QatBOJpTIIxKFIzprng10Y8lIad4wEZQFKG0MPlacddGjAqL0xX7lU-CS3MvlN4Rg4LqagAU"/>
</div>
<!-- Login Container (Bento Style Layout) -->
<div class="relative z-10 w-full max-w-5xl grid grid-cols-1 md:grid-cols-12 bg-surface-container-lowest rounded-xl shadow-2xl overflow-hidden min-h-[600px]">
<!-- Left Panel: Brand Editorial -->
<div class="md:col-span-5 relative hidden md:block">
<div class="absolute inset-0 car-overlay z-10"></div>
<img alt="Desert landscape with premium vehicle" class="absolute inset-0 w-full h-full object-cover z-0" data-alt="A sleek black high-end SUV parked on a dusty road during golden hour with vast savannah plains in the background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1QU26O0wYhUE7ALkH_LnArRYGJHiEJNvLC_0HqjpH8EgrMPASxELCvGBlNcOwItb_XD4aMLSGvcjPI1bb-_31mlYtW5HHRDFHgeEXqvC122rhT8JcDugW9cNcacwAsbBr8RI8JmbzuC-ml2e7MlZlKzlCzppV5gehrr77tJp9TpJtcN4w2SgYbeLwaaByXL_z0QBet8DnrrO6gM86_igHUscjg51Ekq6jFxh53r3sjDv02h9TT7T87I2DdvpZIbhxZalgGMsNCek"/>
<div class="relative z-20 h-full flex flex-col justify-between p-12 text-white">
<div>
<div class="flex items-center gap-3 mb-8">
<span class="material-symbols-outlined text-4xl text-secondary-container" data-icon="shield_person">shield_person</span>
<span class="font-headline font-extrabold text-2xl tracking-tight">Sahara Cars</span>
</div>
<h1 class="font-headline text-4xl font-extrabold leading-tight mb-4">The Editorial Curator Console</h1>
<p class="text-on-primary-container font-medium opacity-90 leading-relaxed">Secure access to Tanzania's premium automotive marketplace management system.</p>
</div>
<div class="space-y-6">
<div class="flex items-center gap-4 bg-white/10 backdrop-blur-md p-4 rounded-xl">
<span class="material-symbols-outlined text-secondary-fixed" data-icon="verified_user">verified_user</span>
<div class="text-sm">
<p class="font-bold">Enterprise Security</p>
<p class="opacity-70">256-bit encrypted session</p>
</div>
</div>
</div>
</div>
</div>
<!-- Right Panel: Login Form -->
<div class="md:col-span-7 p-8 md:p-16 flex flex-col justify-center bg-surface-container-lowest">
<div class="md:hidden flex items-center gap-2 mb-10">
<span class="material-symbols-outlined text-3xl text-primary" data-icon="shield_person">shield_person</span>
<span class="font-headline font-extrabold text-xl text-primary tracking-tight">Sahara Cars</span>
</div>
<div class="mb-10">
<h2 class="font-headline text-3xl font-extrabold text-primary mb-2">Welcome Back</h2>
<p class="text-on-surface-variant font-medium">Please enter your credentials to access the admin panel.</p>
</div>

@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-900">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form class="space-y-6" method="POST" action="{{ route('admin.login.store') }}">
@csrf
<!-- Email Field -->
<div class="space-y-2">
<label class="block text-sm font-bold text-primary tracking-wide" for="email">EMAIL ADDRESS</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline">
<span class="material-symbols-outlined text-xl" data-icon="mail">mail</span>
</div>
<input class="w-full pl-11 pr-4 py-4 bg-surface-container-highest border-none rounded-lg focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all duration-200 outline-none text-on-surface font-medium" id="email" name="email" placeholder="admin@saharacars.co.tz" required="" type="email"/>
</div>
</div>
<!-- Password Field -->
<div class="space-y-2">
<div class="flex justify-between items-center">
<label class="block text-sm font-bold text-primary tracking-wide" for="password">PASSWORD</label>
<a class="text-xs font-bold text-primary hover:underline underline-offset-4 decoration-primary/20 transition-all" href="#">Forgot password?</a>
</div>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline">
<span class="material-symbols-outlined text-xl" data-icon="lock">lock</span>
</div>
<input class="w-full pl-11 pr-12 py-4 bg-surface-container-highest border-none rounded-lg focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all duration-200 outline-none text-on-surface font-medium" id="password" name="password" placeholder="••••••••••••" required="" type="password"/>
<button class="absolute inset-y-0 right-0 pr-4 flex items-center text-outline hover:text-primary transition-colors" type="button">
<span class="material-symbols-outlined text-xl" data-icon="visibility">visibility</span>
</button>
</div>
</div>
<!-- Actions Row -->
<div class="flex items-center">
<label class="flex items-center cursor-pointer group">
<div class="relative">
<input class="sr-only peer" type="checkbox"/>
<div class="w-5 h-5 bg-surface-container-highest rounded border border-outline-variant peer-checked:bg-secondary peer-checked:border-secondary transition-all"></div>
<span class="material-symbols-outlined absolute inset-0 text-white text-base opacity-0 peer-checked:opacity-100 flex items-center justify-center pointer-events-none" data-icon="check">check</span>
</div>
<span class="ml-3 text-sm font-medium text-on-surface-variant group-hover:text-primary transition-colors">Remember this device</span>
</label>
</div>
<!-- Submit Button -->
<button class="w-full py-4 bg-secondary text-on-secondary font-headline font-bold text-lg rounded-full shadow-lg shadow-secondary/20 hover:bg-on-secondary-fixed-variant active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2" type="submit">
                        Sign In to Console
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
</button>
</form>
<!-- Footer Trust Labels -->
<div class="mt-12 pt-8 border-t border-surface-container flex flex-wrap gap-6 items-center justify-center md:justify-start opacity-60">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-lg" data-icon="security">security</span>
<span class="text-xs font-bold tracking-widest">ENCRYPTED</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-lg" data-icon="history">history</span>
<span class="text-xs font-bold tracking-widest">IP LOGGED</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-lg" data-icon="language">language</span>
<span class="text-xs font-bold tracking-widest">TZ DOMAIN</span>
</div>
</div>
</div>
</div>
<!-- System Footer -->
<div class="absolute bottom-6 left-0 w-full text-center z-10">
<p class="text-xs font-medium text-outline-variant">
                © 2024 Sahara Cars Automotive Marketplace. Internal Admin Use Only.
            </p>
</div>
</main>
</body></html>

