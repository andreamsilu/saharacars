@extends('admin.layout')

@section('title', 'System Settings')
@section('breadcrumb', 'Cars Admin / Settings')

@section('content')
    <div class="rounded-3xl card-lift bg-surface text-on-surface shadow-xl ring-1 ring-slate-200/70 overflow-hidden">
        <div class="p-7 md:p-10 border-b border-outline-variant/20">
            <h1 class="text-4xl md:text-5xl font-extrabold text-primary font-headline tracking-tight mb-2 inline-flex items-center gap-2">
                <span class="material-symbols-outlined icon-info">settings</span>
                System Settings
            </h1>
            <p class="text-on-surface-variant text-sm">Manage core marketplace profile details used in your car listings experience.</p>
        </div>

        <form method="post" action="{{ route('admin.settings.update') }}" class="p-7 md:p-10 space-y-7">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="rounded-2xl border border-error/30 bg-error-container/40 px-4 py-3 text-sm text-error" role="alert">
                    <p class="font-bold mb-1 inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-base icon-danger">error</span>Please fix the following:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant inline-flex items-center gap-1" for="marketplace_name"><span class="material-symbols-outlined text-base icon-neutral">storefront</span>Marketplace Name</label>
                    <input id="marketplace_name" name="marketplace_name" type="text" value="{{ old('marketplace_name', $settings['marketplace_name']) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-2xl p-3 text-on-surface" required />
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant inline-flex items-center gap-1" for="support_email"><span class="material-symbols-outlined text-base icon-neutral">mail</span>Support Email</label>
                    <input id="support_email" name="support_email" type="email" value="{{ old('support_email', $settings['support_email']) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-2xl p-3 text-on-surface" required />
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant inline-flex items-center gap-1" for="tagline"><span class="material-symbols-outlined text-base icon-neutral">campaign</span>Marketplace Tagline</label>
                <textarea id="tagline" name="tagline" rows="3" class="w-full bg-surface-container-low border border-slate-200/80 rounded-2xl p-3 text-on-surface">{{ old('tagline', $settings['tagline']) }}</textarea>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-surface-container-low p-5 space-y-4">
                <h3 class="text-sm font-bold text-primary inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">palette</span>
                    Theme Colors
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="theme_primary">Primary</label>
                        <input id="theme_primary" name="theme_primary" type="color" value="{{ old('theme_primary', $settings['theme_primary'] ?? '#8A6528') }}" class="w-full h-12 rounded-xl border border-slate-200/80 bg-white p-1" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="theme_secondary">Secondary</label>
                        <input id="theme_secondary" name="theme_secondary" type="color" value="{{ old('theme_secondary', $settings['theme_secondary'] ?? '#0B6B3A') }}" class="w-full h-12 rounded-xl border border-slate-200/80 bg-white p-1" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="theme_primary_container">Primary Container</label>
                        <input id="theme_primary_container" name="theme_primary_container" type="color" value="{{ old('theme_primary_container', $settings['theme_primary_container'] ?? '#5C4320') }}" class="w-full h-12 rounded-xl border border-slate-200/80 bg-white p-1" />
                    </div>
                </div>
                <div class="flex justify-end">
                    <button
                        id="theme-reset-defaults"
                        type="button"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-outline-variant/40 text-on-surface-variant text-xs font-semibold hover:bg-surface-container-high smooth bg-white"
                        title="Reset theme defaults"
                        aria-label="Reset theme defaults"
                    >
                        <span class="material-symbols-outlined text-base">restart_alt</span>
                        <span class="sr-only">Reset to Defaults</span>
                    </button>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="bg-primary text-on-primary px-4 py-3.5 rounded-full font-bold text-sm hover:opacity-95 transition inline-flex items-center justify-center border border-primary/20" title="Save settings" aria-label="Save settings">
                    <span class="material-symbols-outlined text-base">save</span>
                    <span class="sr-only">Save Changes</span>
                </button>
            </div>
        </form>
    </div>

    @if (session('settings_saved'))
        <div class="fixed bottom-8 right-8 z-50 flex items-center bg-primary text-on-primary px-5 py-4 rounded-2xl shadow-2xl space-x-4 max-w-sm" role="status">
            <span class="material-symbols-outlined icon-success shrink-0">check_circle</span>
            <div class="pr-2 min-w-0">
                <p class="text-sm font-bold leading-tight">Saved</p>
                <p class="text-[10px] opacity-80 uppercase tracking-wider">{{ session('settings_saved') }}</p>
            </div>
        </div>
    @endif

    <script>
        (() => {
            const resetBtn = document.getElementById('theme-reset-defaults');
            const defaults = {
                theme_primary: '#8A6528',
                theme_secondary: '#0B6B3A',
                theme_primary_container: '#5C4320',
            };
            resetBtn?.addEventListener('click', () => {
                Object.entries(defaults).forEach(([id, value]) => {
                    const el = document.getElementById(id);
                    if (el) el.value = value;
                });
            });
        })();
    </script>
@endsection
