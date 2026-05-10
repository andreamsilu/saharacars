<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Uses {@see config('app.locale')} for unprefixed public routes (e.g. /cars/{id}).
 */
class SetDefaultAppLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = (string) config('app.locale');
        App::setLocale($locale);
        Carbon::setLocale($locale);

        return $next($request);
    }
}
