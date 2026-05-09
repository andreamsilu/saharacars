<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login | {{ config('sahara.legal_entity_name') }} Admin Console</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
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
              "surface-tint": "#8a6528",
              "on-error-container": "#93000a",
              "tertiary-fixed-dim": "#ffb690",
              "surface-bright": "#f3f3f3",
              "on-tertiary-fixed-variant": "#723610",
              "error": "#ba1a1a",
              "on-primary": "#ffffff",
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
              "primary": "#8a6528",
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
<main class="min-h-screen flex flex-col items-center justify-center p-6 editorial-gradient relative overflow-hidden">
<!-- Subtle Background Decorative Element -->
<div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
<img alt="Premium automotive silhouette" class="w-full h-full object-cover grayscale" data-alt="Blurred silhouette of a high-end luxury sedan in a dark studio with dramatic rim lighting and shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJ3abMBQnHm9DstkPSqGmOlM7uZr89KCexgRNF6mrGRw7FdZ6OnQStTBm_Z8kS_O3pHALjb4r1jQgKyUpjbP8WyaPVUalXCR5gzLJrwrVE8R0JDucoKIqrkQxBJTqeLropzVujwsgZru-zq3fOYYJmwLEmcbHQS1-ftJqxffq4uM0KnUfpsCuRIuSUxxAVX8LeUy_QatBOJpTIIxKFIzprng10Y8lIad4wEZQFKG0MPlacddGjAqL0xX7lU-CS3MvlN4Rg4LqagAU"/>
</div>
<!-- Login Container -->
<div class="relative z-10 w-full max-w-sm bg-surface-container-lowest rounded-2xl shadow-2xl overflow-hidden">
<div class="p-5 md:p-6 flex flex-col justify-center bg-surface-container-lowest">
<div class="mb-5 flex justify-center">
<img
    src="{{ asset('images/logo.png') }}"
    alt="Sahara Cars"
    class="h-10 w-auto object-contain"
    width="180"
    height="40"
    decoding="async"
/>
</div>

@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-900">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form class="space-y-4" method="POST" action="{{ route('admin.login.store') }}">
@csrf
<!-- Email Field -->
<div class="space-y-2">
<label class="block text-sm font-bold text-primary tracking-wide" for="email">EMAIL ADDRESS</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline">
<span class="material-symbols-outlined text-xl" data-icon="mail">mail</span>
</div>
<input class="w-full pl-11 pr-4 py-3 bg-surface-container-highest border-none rounded-lg focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all duration-200 outline-none text-on-surface font-medium" id="email" name="email" placeholder="admin@saharacars.co.tz" required="" type="email"/>
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
<input class="w-full pl-11 pr-12 py-3 bg-surface-container-highest border-none rounded-lg focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all duration-200 outline-none text-on-surface font-medium" id="password" name="password" placeholder="••••••••••••" required="" type="password"/>
<button class="absolute inset-y-0 right-0 pr-4 flex items-center text-outline hover:text-primary transition-colors" type="button" data-password-toggle aria-label="Show password" aria-pressed="false" aria-controls="password">
<span class="material-symbols-outlined text-xl" data-password-toggle-icon data-icon="visibility">visibility</span>
</button>
</div>
</div>
<!-- Submit Button -->
<button class="w-full py-3 bg-secondary text-on-secondary font-headline font-bold text-base rounded-full shadow-lg shadow-secondary/20 hover:bg-on-secondary-fixed-variant active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2" type="submit">
                        Sign In to Console
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
</button>
</form>
</div>
</div>
<div class="relative z-10 mt-6 text-center">
<p class="text-xs font-medium text-outline-variant">
                © {{ now()->year }} {{ config('sahara.legal_entity_name') }} Automotive Marketplace. Internal Admin Use Only.
            </p>
</div>
</main>
<script>
    (() => {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.querySelector('[data-password-toggle]');
        const toggleIcon = document.querySelector('[data-password-toggle-icon]');

        if (!passwordInput || !toggleButton || !toggleIcon) {
            return;
        }

        toggleButton.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            toggleIcon.textContent = isHidden ? 'visibility_off' : 'visibility';
            toggleButton.setAttribute('aria-pressed', isHidden ? 'true' : 'false');
            toggleButton.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        });
    })();
</script>
</body></html>

