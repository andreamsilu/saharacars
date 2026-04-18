<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            // UI primary meets WCAG 2.1 AA vs canvas #f3f3f3 (text) and vs white (filled controls).
            $themeColors = [
                'primary' => '#8A6528',
                'secondary' => '#0B6B3A',
                'primary_container' => '#5C4320',
            ];

            $path = storage_path('app/marketplace_settings.json');
            if (File::exists($path)) {
                try {
                    $stored = json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException) {
                    $stored = [];
                }

                if (is_array($stored)) {
                    foreach ([
                        'theme_primary' => 'primary',
                        'theme_secondary' => 'secondary',
                        'theme_primary_container' => 'primary_container',
                    ] as $key => $mapTo) {
                        if (isset($stored[$key]) && is_string($stored[$key]) && preg_match('/^#[0-9A-Fa-f]{6}$/', $stored[$key])) {
                            $themeColors[$mapTo] = strtoupper($stored[$key]);
                        }
                    }
                }
            }

            $view->with('themeColors', $themeColors);
        });
    }
}
