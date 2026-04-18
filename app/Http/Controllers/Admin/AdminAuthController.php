<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function create(): View
    {
        return view('admin.auth.login_ui');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:200'],
        ]);

        $throttleKey = Str::lower($validated['email']).'|'.$request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()
                ->withErrors(['email' => "Too many login attempts. Try again in {$seconds} seconds."])
                ->onlyInput('email');
        }

        $user = User::query()
            ->whereRaw('LOWER(email) = ?', [Str::lower($validated['email'])])
            ->first();

        $passwordOk = $user !== null && Hash::check($validated['password'], $user->password);

        if (!$passwordOk) {
            RateLimiter::hit($throttleKey, 60);

            return back()
                ->withErrors(['email' => 'These credentials do not match our records.'])
                ->onlyInput('email');
        }

        RateLimiter::clear($throttleKey);

        $request->session()->regenerate();
        $request->session()->put('admin.authenticated', true);
        $request->session()->put('admin.user_id', $user->id);

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin.authenticated', 'admin.user_id']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}

