<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateMarketplaceSettingsRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class AdminSettingsController extends Controller
{
    private function storagePath(): string
    {
        return storage_path('app/marketplace_settings.json');
    }

    public function index(): View
    {
        return view('admin.settings.index', [
            'settings' => $this->mergedSettings(),
        ]);
    }

    public function update(UpdateMarketplaceSettingsRequest $request): RedirectResponse
    {
        $path = $this->storagePath();
        File::ensureDirectoryExists(dirname($path));

        $payload = $request->marketplacePayload();
        File::put($path, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()
            ->route('admin.settings.index')
            ->with('settings_saved', __('Settings saved.'));
    }

    /**
     * Defaults from config merged with persisted JSON (admin UI).
     *
     * @return array<string, mixed>
     */
    private function mergedSettings(): array
    {
        $locale = (string) config('app.locale');

        $defaults = [
            'marketplace_name' => (string) config('marketplace.name'),
            'support_email' => (string) config('sahara.support_email'),
            'whatsapp_phone' => (string) config('sahara.whatsapp_phone'),
            'tagline' => (string) config('marketplace.tagline'),
            'legal_entity_name' => (string) config('sahara.legal_entity_name'),
            'public_site_url' => (string) config('sahara.public_site_url'),
            'instagram_url' => (string) config('sahara.instagram_url'),
            'instagram_label' => (string) config('sahara.instagram_label'),
            'primary_location_label' => (string) config('sahara.primary_location_label'),
            'footer_intro_extra' => (string) config('sahara.footer_intro_extra'),
            'footer_hours_summary' => (string) config('sahara.footer_hours_summary'),
            'home_shortcuts_title' => 'Shop by shortcuts',
            'home_shortcuts_subtitle' => 'Fast paths for high-intent buyers',
            'home_shortcuts_lines' => implode("\n", [
                'Foreign Used|'.route('cars.index', ['locale' => $locale, 'condition' => 'foreign_used']),
                'Brand New|'.route('cars.index', ['locale' => $locale, 'condition' => 'brand_new']),
                'From Japan|'.route('cars.index', ['locale' => $locale, 'source_country' => 'Japan']),
                'From Germany|'.route('cars.index', ['locale' => $locale, 'source_country' => 'Germany']),
                'Under 100M|'.route('cars.index', ['locale' => $locale, 'price_max' => 100000000]),
                'Above 100M|'.route('cars.index', ['locale' => $locale, 'price_min' => 100000000]),
            ]),
            'home_import_flow_title' => 'From request to delivery',
            'home_import_flow_subtitle' => 'Import purchase flow',
            'home_import_flow_steps' => implode("\n", [
                'Request|Tell us your preferred brand, model, and budget.',
                'Quote|We share options, specs, and landed-cost estimates.',
                'Shipment|Track status from on-order to in-transit.',
                'Delivery|Handover and support from our Dar team.',
            ]),
            'theme_primary' => '#8A6528',
            'theme_secondary' => '#0B6B3A',
            'theme_primary_container' => '#5C4320',
        ];

        $path = $this->storagePath();
        if (! File::exists($path)) {
            return $defaults;
        }

        try {
            $stored = json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return $defaults;
        }

        if (! is_array($stored)) {
            return $defaults;
        }

        foreach (array_keys($defaults) as $key) {
            if (isset($stored[$key]) && is_string($stored[$key])) {
                $defaults[$key] = $stored[$key];
            }
        }

        return $defaults;
    }
}
