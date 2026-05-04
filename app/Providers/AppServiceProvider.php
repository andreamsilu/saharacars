<?php

namespace App\Providers;

use App\Support\MarketplaceSettingsHydrator;
use Illuminate\Support\Facades\URL;
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
        // Ensures route() works outside localized requests (e.g. admin "view site").
        URL::defaults(['locale' => config('app.locale')]);

        $themeColors = MarketplaceSettingsHydrator::hydrateFromStorage();

        View::composer('*', static function ($view) use ($themeColors): void {
            $view->with('themeColors', $themeColors);
        });
    }
}
