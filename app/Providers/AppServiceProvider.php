<?php

namespace App\Providers;

use App\Support\MarketplaceSettingsHydrator;
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
        $themeColors = MarketplaceSettingsHydrator::hydrateFromStorage();

        View::composer('*', static function ($view) use ($themeColors): void {
            $view->with('themeColors', $themeColors);
        });
    }
}
