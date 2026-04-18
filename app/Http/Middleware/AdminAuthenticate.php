<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Protect admin routes using an authenticated admin session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isAuthenticated = ($request->session()->get('admin.authenticated') ?? false) === true;
        $adminUserId = $request->session()->get('admin.user_id');
        $adminUserExists = is_numeric($adminUserId)
            && User::query()->whereKey((int) $adminUserId)->exists();

        if (!$isAuthenticated || !$adminUserExists) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

