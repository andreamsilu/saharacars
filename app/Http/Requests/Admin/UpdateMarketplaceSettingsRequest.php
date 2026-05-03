<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketplaceSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('instagram_url') && trim((string) $this->input('instagram_url')) === '') {
            $this->merge(['instagram_url' => null]);
        }

        if ($this->has('instagram_label') && trim((string) $this->input('instagram_label')) === '') {
            $this->merge(['instagram_label' => null]);
        }
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
            'legal_entity_name' => ['required', 'string', 'max:255'],
            'public_site_url' => ['required', 'string', 'max:2048', 'url:http,https'],
            'instagram_url' => ['nullable', 'string', 'max:2048', 'url:http,https'],
            'instagram_label' => ['nullable', 'string', 'max:160'],
            'primary_location_label' => ['required', 'string', 'max:255'],
            'footer_intro_extra' => ['nullable', 'string', 'max:2000'],
            'footer_hours_summary' => ['required', 'string', 'max:255'],
            'home_shortcuts_title' => ['nullable', 'string', 'max:120'],
            'home_shortcuts_subtitle' => ['nullable', 'string', 'max:255'],
            'home_shortcuts_lines' => ['nullable', 'string', 'max:5000'],
            'home_import_flow_title' => ['nullable', 'string', 'max:120'],
            'home_import_flow_subtitle' => ['nullable', 'string', 'max:120'],
            'home_import_flow_steps' => ['nullable', 'string', 'max:5000'],
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
            'legal_entity_name' => trim($validated['legal_entity_name']),
            'public_site_url' => trim($validated['public_site_url']),
            'instagram_url' => trim((string) ($validated['instagram_url'] ?? '')),
            'instagram_label' => trim((string) ($validated['instagram_label'] ?? '')),
            'primary_location_label' => trim($validated['primary_location_label']),
            'footer_intro_extra' => trim((string) ($validated['footer_intro_extra'] ?? '')),
            'footer_hours_summary' => trim($validated['footer_hours_summary']),
            'home_shortcuts_title' => $validated['home_shortcuts_title'] ?? '',
            'home_shortcuts_subtitle' => $validated['home_shortcuts_subtitle'] ?? '',
            'home_shortcuts_lines' => $validated['home_shortcuts_lines'] ?? '',
            'home_import_flow_title' => $validated['home_import_flow_title'] ?? '',
            'home_import_flow_subtitle' => $validated['home_import_flow_subtitle'] ?? '',
            'home_import_flow_steps' => $validated['home_import_flow_steps'] ?? '',
            'theme_primary' => strtoupper($validated['theme_primary']),
            'theme_secondary' => strtoupper($validated['theme_secondary']),
            'theme_primary_container' => strtoupper($validated['theme_primary_container']),
        ];
    }
}
