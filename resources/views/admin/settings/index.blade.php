@extends('admin.layout')

@section('title', 'System Settings')
@section('breadcrumb', 'Sahara Autolink / Settings')

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
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant inline-flex items-center gap-1" for="whatsapp_phone"><span class="material-symbols-outlined text-base icon-neutral">chat</span>WhatsApp Phone (E.164 digits)</label>
                    <input id="whatsapp_phone" name="whatsapp_phone" type="text" inputmode="numeric" pattern="[0-9]{10,15}" value="{{ old('whatsapp_phone', $settings['whatsapp_phone']) }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-2xl p-3 text-on-surface" placeholder="Digits only e.g. 255791666101" required />
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-surface-container-low/60 p-5 space-y-4">
                <h3 class="text-sm font-bold text-primary inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">public</span>
                    Public site · legal identity · location
                </h3>
                <p class="text-xs text-on-surface-variant">Website, social, and map URLs are configured here only—not in <code class="text-[11px]">.env</code>. Values populate the footer, contact page, and SEO.</p>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="legal_entity_name">Legal / registered entity name</label>
                    <input id="legal_entity_name" name="legal_entity_name" type="text" value="{{ old('legal_entity_name', $settings['legal_entity_name'] ?? '') }}" maxlength="255" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" required />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="public_site_url">Public website URL</label>
                        <input id="public_site_url" name="public_site_url" type="url" inputmode="url" value="{{ old('public_site_url', $settings['public_site_url'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" required />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="primary_location_label">Primary location (display)</label>
                        <input id="primary_location_label" name="primary_location_label" type="text" maxlength="255" value="{{ old('primary_location_label', $settings['primary_location_label'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" required />
                    </div>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Social media (footer &amp; contact page)</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="instagram_url">Instagram profile URL</label>
                        <input id="instagram_url" name="instagram_url" type="url" inputmode="url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" placeholder="Leave empty to hide Instagram links" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="instagram_label">Instagram handle (display)</label>
                        <input id="instagram_label" name="instagram_label" type="text" maxlength="160" value="{{ old('instagram_label', $settings['instagram_label'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" placeholder="e.g. @brandhandle" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="facebook_url">Facebook page URL</label>
                        <input id="facebook_url" name="facebook_url" type="url" inputmode="url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" placeholder="Leave empty to hide Facebook links" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="facebook_label">Facebook page name (display)</label>
                        <input id="facebook_label" name="facebook_label" type="text" maxlength="160" value="{{ old('facebook_label', $settings['facebook_label'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" placeholder="e.g. Sahara Autolink" />
                    </div>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Contact map &amp; video embeds</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="contact_map_embed_url">Google Maps embed URL (iframe src)</label>
                        <input id="contact_map_embed_url" name="contact_map_embed_url" type="url" inputmode="url" value="{{ old('contact_map_embed_url', $settings['contact_map_embed_url'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface text-sm" placeholder="https://www.google.com/maps/embed?..." />
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="contact_map_directions_url">Google Maps directions link</label>
                        <input id="contact_map_directions_url" name="contact_map_directions_url" type="url" inputmode="url" value="{{ old('contact_map_directions_url', $settings['contact_map_directions_url'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface text-sm" placeholder="https://www.google.com/maps/dir/?api=1&destination=..." />
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="about_owner_video_embed_url">About page owner video embed URL</label>
                        <input id="about_owner_video_embed_url" name="about_owner_video_embed_url" type="url" inputmode="url" value="{{ old('about_owner_video_embed_url', $settings['about_owner_video_embed_url'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface text-sm" placeholder="https://www.youtube.com/embed/... (optional)" />
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="why_choose_us_owner_video_embed_url">Why choose us video embed URL</label>
                        <input id="why_choose_us_owner_video_embed_url" name="why_choose_us_owner_video_embed_url" type="url" inputmode="url" value="{{ old('why_choose_us_owner_video_embed_url', $settings['why_choose_us_owner_video_embed_url'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface text-sm" placeholder="Leave empty to reuse About video" />
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant inline-flex items-center gap-1" for="tagline"><span class="material-symbols-outlined text-base icon-neutral">campaign</span>Brand tagline (footer + marketplace copy)</label>
                <textarea id="tagline" name="tagline" rows="3" class="w-full bg-surface-container-low border border-slate-200/80 rounded-2xl p-3 text-on-surface" placeholder="Short line under your marketplace name">{{ old('tagline', $settings['tagline']) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant inline-flex items-center gap-1" for="footer_intro_extra"><span class="material-symbols-outlined text-base icon-neutral">notes</span>Footer supporting text</label>
                    <textarea id="footer_intro_extra" name="footer_intro_extra" rows="2" maxlength="2000" class="w-full bg-surface-container-low border border-slate-200/80 rounded-2xl p-3 text-on-surface" placeholder="Second line under tagline on the footer (optional)">{{ old('footer_intro_extra', $settings['footer_intro_extra'] ?? '') }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant inline-flex items-center gap-1" for="footer_hours_summary"><span class="material-symbols-outlined text-base icon-neutral">schedule</span>Hours summary (footer)</label>
                    <input id="footer_hours_summary" name="footer_hours_summary" type="text" maxlength="255" value="{{ old('footer_hours_summary', $settings['footer_hours_summary'] ?? '') }}" class="w-full bg-surface-container-low border border-slate-200/80 rounded-2xl p-3 text-on-surface" required />
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/80 bg-surface-container-low p-5 space-y-4">
                <h3 class="text-sm font-bold text-primary inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">home</span>
                    Homepage Utility Modules
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="home_shortcuts_title">Shortcuts Title</label>
                        <input id="home_shortcuts_title" name="home_shortcuts_title" type="text" value="{{ old('home_shortcuts_title', $settings['home_shortcuts_title'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="home_shortcuts_subtitle">Shortcuts Subtitle</label>
                        <input id="home_shortcuts_subtitle" name="home_shortcuts_subtitle" type="text" value="{{ old('home_shortcuts_subtitle', $settings['home_shortcuts_subtitle'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="home_shortcuts_lines">Shortcut Chips (one per line: Label|URL)</label>
                    <textarea id="home_shortcuts_lines" name="home_shortcuts_lines" rows="6" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface">{{ old('home_shortcuts_lines', $settings['home_shortcuts_lines'] ?? '') }}</textarea>
                    <p class="text-[11px] text-on-surface-variant">Format example: <span class="font-mono">From Japan|/cars?source_country=Japan</span></p>
                    <div id="home-shortcuts-warning" class="hidden rounded-xl border border-amber-300/70 bg-amber-50 px-3 py-2 text-xs text-amber-800" aria-live="polite"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="home_import_flow_subtitle">Import Flow Eyebrow</label>
                        <input id="home_import_flow_subtitle" name="home_import_flow_subtitle" type="text" value="{{ old('home_import_flow_subtitle', $settings['home_import_flow_subtitle'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="home_import_flow_title">Import Flow Title</label>
                        <input id="home_import_flow_title" name="home_import_flow_title" type="text" value="{{ old('home_import_flow_title', $settings['home_import_flow_title'] ?? '') }}" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant" for="home_import_flow_steps">Import Flow Steps (one per line: Step title|Step description)</label>
                    <textarea id="home_import_flow_steps" name="home_import_flow_steps" rows="5" class="w-full bg-white border border-slate-200/80 rounded-2xl p-3 text-on-surface">{{ old('home_import_flow_steps', $settings['home_import_flow_steps'] ?? '') }}</textarea>
                    <p class="text-[11px] text-on-surface-variant">Format example: <span class="font-mono">Quote|We share options, specs, and landed-cost estimates.</span></p>
                    <div id="home-flow-warning" class="hidden rounded-xl border border-amber-300/70 bg-amber-50 px-3 py-2 text-xs text-amber-800" aria-live="polite"></div>
                </div>
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
                <div class="rounded-2xl border border-outline-variant/40 bg-white p-4">
                    <p class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-3">Live preview</p>
                    <div class="flex flex-wrap items-center gap-3">
                        <span id="preview-primary" class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-bold text-white" style="background-color: {{ old('theme_primary', $settings['theme_primary'] ?? '#8A6528') }};">Primary</span>
                        <span id="preview-secondary" class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-bold text-white" style="background-color: {{ old('theme_secondary', $settings['theme_secondary'] ?? '#0B6B3A') }};">Secondary</span>
                        <span id="preview-primary-container" class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-bold text-white" style="background-color: {{ old('theme_primary_container', $settings['theme_primary_container'] ?? '#5C4320') }};">Primary Container</span>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button
                        id="theme-reset-defaults"
                        type="button"
                        class="inline-flex items-center justify-center gap-1.5 min-h-10 rounded-xl border border-outline-variant/40 px-3 text-on-surface-variant text-xs font-semibold hover:bg-surface-container-high smooth bg-white"
                    >
                        <span class="material-symbols-outlined text-base" aria-hidden="true">restart_alt</span>
                        <span>Reset defaults</span>
                    </button>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="inline-flex min-h-[44px] items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-bold text-on-primary shadow-sm hover:opacity-95 transition border border-primary/20">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true">save</span>
                    <span>Save changes</span>
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
            const previewMap = {
                theme_primary: document.getElementById('preview-primary'),
                theme_secondary: document.getElementById('preview-secondary'),
                theme_primary_container: document.getElementById('preview-primary-container'),
            };
            const defaults = {
                theme_primary: '#8A6528',
                theme_secondary: '#0B6B3A',
                theme_primary_container: '#5C4320',
            };
            const shortcutsInput = document.getElementById('home_shortcuts_lines');
            const shortcutsWarning = document.getElementById('home-shortcuts-warning');
            const flowInput = document.getElementById('home_import_flow_steps');
            const flowWarning = document.getElementById('home-flow-warning');

            const bindPreview = (id) => {
                const input = document.getElementById(id);
                const preview = previewMap[id];
                if (!input || !preview) return;
                input.addEventListener('input', () => {
                    preview.style.backgroundColor = input.value;
                });
            };

            Object.keys(previewMap).forEach(bindPreview);

            const validatePipedLines = (input, warningEl, valueName, minParts = 2) => {
                if (!input || !warningEl) return;

                const lines = input.value.split(/\r?\n/);
                const invalidRows = [];

                lines.forEach((rawLine, idx) => {
                    const line = rawLine.trim();
                    if (line === '') return;

                    const parts = line.split('|').map((part) => part.trim()).filter(Boolean);
                    if (parts.length < minParts) {
                        invalidRows.push(idx + 1);
                    }
                });

                if (invalidRows.length === 0) {
                    warningEl.classList.add('hidden');
                    warningEl.textContent = '';
                    return;
                }

                warningEl.classList.remove('hidden');
                warningEl.textContent = `Check ${valueName} format on line(s): ${invalidRows.join(', ')}. Use "left|right" format.`;
            };

            shortcutsInput?.addEventListener('input', () => validatePipedLines(shortcutsInput, shortcutsWarning, 'shortcut'));
            flowInput?.addEventListener('input', () => validatePipedLines(flowInput, flowWarning, 'step'));
            validatePipedLines(shortcutsInput, shortcutsWarning, 'shortcut');
            validatePipedLines(flowInput, flowWarning, 'step');

            resetBtn?.addEventListener('click', () => {
                Object.entries(defaults).forEach(([id, value]) => {
                    const el = document.getElementById(id);
                    if (el) {
                        el.value = value;
                        el.dispatchEvent(new Event('input'));
                    }
                });
            });
        })();
    </script>
@endsection
