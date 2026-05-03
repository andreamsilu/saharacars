<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\File;

/**
 * Loads admin-persisted identity (storage/app/marketplace_settings.json) into runtime config
 * so public views read values via config() only — no hardcoded Blade fallbacks.
 */
final class MarketplaceSettingsHydrator
{
    /**
     * Merge marketplace JSON overrides into config and return footer/nav theme RGB hex values.
     *
     * @return array{primary: string, secondary: string, primary_container: string}
     */
    public static function hydrateFromStorage(): array
    {
        $themeColors = [
            'primary' => '#8A6528',
            'secondary' => '#0B6B3A',
            'primary_container' => '#5C4320',
        ];

        $path = storage_path('app/marketplace_settings.json');
        if (! File::exists($path)) {
            return $themeColors;
        }

        try {
            /** @var mixed $decoded */
            $decoded = json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return $themeColors;
        }

        if (! is_array($decoded)) {
            return $themeColors;
        }

        $stored = $decoded;

        if (isset($stored['support_email']) && is_string($stored['support_email']) && filter_var($stored['support_email'], FILTER_VALIDATE_EMAIL)) {
            config([
                'sahara.support_email' => $stored['support_email'],
                'marketplace.support_email' => $stored['support_email'],
            ]);
        }

        if (isset($stored['whatsapp_phone']) && is_string($stored['whatsapp_phone'])) {
            $digits = preg_replace('/\D+/', '', $stored['whatsapp_phone']);
            if (is_string($digits) && preg_match('/^\d{10,15}$/', $digits)) {
                config(['sahara.whatsapp_phone' => $digits]);
            }
        }

        if (isset($stored['marketplace_name']) && is_string($stored['marketplace_name']) && trim($stored['marketplace_name']) !== '') {
            config(['marketplace.name' => trim($stored['marketplace_name'])]);
        }

        // Single tagline drives both marketplace copy and Sahara brand line used in footer.
        if (isset($stored['tagline']) && is_string($stored['tagline']) && trim($stored['tagline']) !== '') {
            $t = trim($stored['tagline']);
            config([
                'marketplace.tagline' => $t,
                'sahara.brand_tagline' => $t,
            ]);
        }

        if (isset($stored['legal_entity_name']) && is_string($stored['legal_entity_name']) && trim($stored['legal_entity_name']) !== '') {
            config(['sahara.legal_entity_name' => trim($stored['legal_entity_name'])]);
        }

        if (isset($stored['public_site_url']) && is_string($stored['public_site_url'])) {
            $u = trim($stored['public_site_url']);
            if ($u !== '' && filter_var($u, FILTER_VALIDATE_URL)) {
                config(['sahara.public_site_url' => $u]);
            }
        }

        if (array_key_exists('instagram_url', $stored) && is_string($stored['instagram_url'])) {
            $iu = trim($stored['instagram_url']);
            if ($iu === '') {
                config(['sahara.instagram_url' => '']);
            } elseif (filter_var($iu, FILTER_VALIDATE_URL)) {
                config(['sahara.instagram_url' => $iu]);
            }
        }

        if (array_key_exists('instagram_label', $stored) && is_string($stored['instagram_label'])) {
            config(['sahara.instagram_label' => trim($stored['instagram_label'])]);
        }

        if (isset($stored['primary_location_label']) && is_string($stored['primary_location_label']) && trim($stored['primary_location_label']) !== '') {
            config(['sahara.primary_location_label' => trim($stored['primary_location_label'])]);
        }

        if (array_key_exists('footer_intro_extra', $stored) && is_string($stored['footer_intro_extra'])) {
            config(['sahara.footer_intro_extra' => trim($stored['footer_intro_extra'])]);
        }

        if (isset($stored['footer_hours_summary']) && is_string($stored['footer_hours_summary']) && trim($stored['footer_hours_summary']) !== '') {
            config(['sahara.footer_hours_summary' => trim($stored['footer_hours_summary'])]);
        }

        foreach ([
            'theme_primary' => 'primary',
            'theme_secondary' => 'secondary',
            'theme_primary_container' => 'primary_container',
        ] as $key => $mapTo) {
            if (isset($stored[$key]) && is_string($stored[$key]) && preg_match('/^#[0-9A-Fa-f]{6}$/', $stored[$key])) {
                $themeColors[$mapTo] = strtoupper($stored[$key]);
            }
        }

        return $themeColors;
    }
}
