<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Build localized URLs without duplicating locale parameters in Blade.
 */
final class LocaleUrls
{
    /** Same-named route under a different locale; falls back to home. */
    public static function alternative(string $targetLocale): string
    {
        $supported = config('app.supported_locales', ['en']);
        if (! in_array($targetLocale, $supported, true)) {
            return route('home', ['locale' => config('app.locale')]);
        }

        $route = request()->route();
        if ($route === null || $route->getName() === null) {
            return route('home', ['locale' => $targetLocale]);
        }

        if (! array_key_exists('locale', $route->parameters())) {
            return route('home', ['locale' => $targetLocale]);
        }

        $parameters = array_merge($route->parameters(), ['locale' => $targetLocale]);

        try {
            return route($route->getName(), $parameters);
        } catch (\Throwable) {
            return route('home', ['locale' => $targetLocale]);
        }
    }
}
