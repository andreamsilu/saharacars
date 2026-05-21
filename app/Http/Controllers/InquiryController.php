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
            'inquiry_type' => 'contact',
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        return back()->with('status', 'Thanks! Your message has been sent.');
    }

    public function storeOrderRequest(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'preferred_brand' => ['nullable', 'string', 'max:80'],
            'preferred_model' => ['nullable', 'string', 'max:120'],
            'year_min' => ['nullable', 'integer', 'between:1980,'.(int) date('Y') + 1],
            'year_max' => ['nullable', 'integer', 'between:1980,'.(int) date('Y') + 1],
            'budget_min_tzs' => ['nullable', 'integer', 'min:0', 'max:999999999999'],
            'budget_max_tzs' => ['nullable', 'integer', 'min:0', 'max:999999999999'],
            'source_country' => ['nullable', 'string', 'max:80'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        if (
            ! empty($validated['year_min']) &&
            ! empty($validated['year_max']) &&
            (int) $validated['year_min'] > (int) $validated['year_max']
        ) {
            return back()
                ->withErrors(['year_max' => 'Maximum year must be greater than or equal to minimum year.'])
                ->withInput();
        }

        if (
            ! empty($validated['budget_min_tzs']) &&
            ! empty($validated['budget_max_tzs']) &&
            (int) $validated['budget_min_tzs'] > (int) $validated['budget_max_tzs']
        ) {
            return back()
                ->withErrors(['budget_max_tzs' => 'Maximum budget must be greater than or equal to minimum budget.'])
                ->withInput();
        }

        $throttleKey = 'order-request|'.$request->ip().'|'.Str::lower($validated['email']);
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return back()
                ->withErrors(['email' => 'Too many requests sent. Please try again later.'])
                ->withInput();
        }
        RateLimiter::hit($throttleKey, 60);

        Inquiry::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => 'Order Request',
            'message' => $validated['message'] ?? 'No additional notes provided.',
            'inquiry_type' => 'order_request',
            'status' => Inquiry::STATUS_PENDING,
            'preferred_brand' => $validated['preferred_brand'] ?? null,
            'preferred_model' => $validated['preferred_model'] ?? null,
            'year_min' => $validated['year_min'] ?? null,
            'year_max' => $validated['year_max'] ?? null,
            'budget_min_tzs' => $validated['budget_min_tzs'] ?? null,
            'budget_max_tzs' => $validated['budget_max_tzs'] ?? null,
            'source_country' => $validated['source_country'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        return back()->with('status', 'Order request received. Our team will contact you shortly.');
    }
}

