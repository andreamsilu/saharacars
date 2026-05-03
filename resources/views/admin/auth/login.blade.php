<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login • {{ config('sahara.legal_entity_name') }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <div class="min-h-screen flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-md bg-white/5 border border-white/10 rounded-2xl p-8 shadow-2xl">
            <div class="space-y-2 mb-8">
                <div class="rounded-xl bg-white/10 p-3 inline-block mb-1">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Sahara Cars"
                        class="h-9 w-auto object-contain max-w-[200px]"
                        width="200"
                        height="36"
                        decoding="async"
                    />
                </div>
                <h1 class="text-3xl font-black tracking-tight">Admin Login</h1>
                <p class="text-sm text-white/70">Sign in to manage vehicle listings.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-100">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
                @csrf

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-white/70" for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                        class="w-full rounded-xl bg-white/10 border-white/10 text-white placeholder:text-white/40 focus:border-white/30 focus:ring-white/20"
                        placeholder="admin@example.com"
                    />
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-semibold text-white/70" for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="w-full rounded-xl bg-white/10 border-white/10 text-white placeholder:text-white/40 focus:border-white/30 focus:ring-white/20"
                        placeholder="••••••••"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full rounded-xl bg-white text-slate-950 font-bold py-3 hover:bg-white/90 active:scale-[0.99] transition"
                >
                    Sign in
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="text-xs text-white/60 hover:text-white underline underline-offset-4">
                    Back to website
                </a>
            </div>
        </div>
    </div>
</body>
</html>

