<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

/**
 * Binds the {locale} route parameter to application + URL generation for the request.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');
        $supported = config('app.supported_locales', ['en', 'sw']);

        if (! is_string($locale) || ! in_array($locale, $supported, true)) {
            abort(404);
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
