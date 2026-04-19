<?php

namespace App\Http\Middleware;

use App\Models\SiteVisitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldSkipTracking($request, $response)) {
            return $response;
        }

        $visitorHash = hash('sha256', implode('|', [
            (string) $request->ip(),
            (string) $request->userAgent(),
        ]));

        $visitor = SiteVisitor::query()->where('visitor_hash', $visitorHash)->first();

        if ($visitor === null) {
            SiteVisitor::query()->create([
                'visitor_hash' => $visitorHash,
                'visits_count' => 1,
                'first_seen_at' => now(),
                'last_seen_at' => now(),
            ]);

            return $response;
        }

        $visitor->increment('visits_count');
        $visitor->forceFill(['last_seen_at' => now()])->save();

        return $response;
    }

    private function shouldSkipTracking(Request $request, Response $response): bool
    {
        if (!$request->isMethod('GET') || $request->expectsJson() || $response->getStatusCode() >= 400) {
            return true;
        }

        if ($request->is('admin*') || $request->is('up')) {
            return true;
        }

        if ($request->routeIs('admin.*')) {
            return true;
        }

        $userAgent = trim((string) $request->userAgent());

        return $userAgent === '';
    }
}

