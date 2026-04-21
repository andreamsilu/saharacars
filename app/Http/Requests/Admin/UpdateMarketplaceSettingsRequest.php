<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketplaceSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'marketplace_name' => ['required', 'string', 'max:255'],
            'support_email' => ['required', 'email', 'max:255'],
            'whatsapp_phone' => ['required', 'string', 'max:20', 'regex:/^\d{10,15}$/'],
            'tagline' => ['nullable', 'string', 'max:1000'],
            'theme_primary' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'theme_secondary' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'theme_primary_container' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function marketplacePayload(): array
    {
        $validated = $this->validated();

        return [
            'marketplace_name' => $validated['marketplace_name'],
            'support_email' => $validated['support_email'],
            'whatsapp_phone' => preg_replace('/\D+/', '', $validated['whatsapp_phone']) ?: $validated['whatsapp_phone'],
            'tagline' => $validated['tagline'] ?? '',
            'theme_primary' => strtoupper($validated['theme_primary']),
            'theme_secondary' => strtoupper($validated['theme_secondary']),
            'theme_primary_container' => strtoupper($validated['theme_primary_container']),
        ];
    }
}
