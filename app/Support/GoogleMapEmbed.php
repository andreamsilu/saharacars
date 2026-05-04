<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Validates Google Maps URLs before rendering iframes or external links on the public site.
 */
final class GoogleMapEmbed
{
    /** @var list<string> */
    private const EMBED_PREFIXES = [
        'https://www.google.com/maps/embed',
        'https://maps.google.com/maps/embed',
        'https://www.google.com/maps?q=',
        'https://maps.google.com/maps?q=',
    ];

    /** @var list<string> */
    private const MAPS_LINK_PREFIXES = [
        'https://www.google.com/maps/',
        'https://maps.google.com/maps/',
    ];

    /**
     * Returns the trimmed embed URL if it is an allowed Google Maps embed, otherwise null.
     */
    public static function allowedEmbedSrc(string $url): ?string
    {
        $trimmed = trim($url);
        if ($trimmed === '') {
            return null;
        }
        foreach (self::EMBED_PREFIXES as $prefix) {
            if (str_starts_with($trimmed, $prefix)) {
                return $trimmed;
            }
        }

        return null;
    }

    /**
     * Returns the trimmed URL if it is an allowed Google Maps domain, otherwise null.
     */
    public static function allowedMapsLink(string $url): ?string
    {
        $trimmed = trim($url);
        if ($trimmed === '') {
            return null;
        }
        foreach (self::MAPS_LINK_PREFIXES as $prefix) {
            if (str_starts_with($trimmed, $prefix)) {
                return $trimmed;
            }
        }

        return null;
    }
}
