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
        $defaults = [
            'marketplace_name' => (string) config('marketplace.name'),
            'support_email' => (string) config('marketplace.support_email'),
            'tagline' => (string) config('marketplace.tagline'),
            'theme_primary' => '#B48A40',
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
