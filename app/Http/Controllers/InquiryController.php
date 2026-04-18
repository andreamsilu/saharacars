<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:190'],
            'subject' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $throttleKey = 'inquiry|'.$request->ip().'|'.Str::lower($validated['email']);
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return back()
                ->withErrors(['email' => 'Too many messages sent. Please try again later.'])
                ->onlyInput('email', 'full_name', 'subject', 'message');
        }
        RateLimiter::hit($throttleKey, 60);

        Inquiry::create([
            ...$validated,
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        return back()->with('status', 'Thanks! Your message has been sent.');
    }
}

