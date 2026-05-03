<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Helpers for formatting public phone numbers shown in views (Models stay unaware of presentation).
 */
final class PhoneDisplay
{
    /**
     * Format TZ mobile digits (12 chars, leading 255) as +255 xxx xxx xxx; otherwise "+{digits}".
     */
    public static function tzMobileLabel(string $digitsOnly): string
    {
        $d = preg_replace('/\D+/', '', $digitsOnly) ?? '';

        if (strlen($d) === 12 && str_starts_with($d, '255')) {
            return sprintf(
                '+%s %s %s %s',
                substr($d, 0, 3),
                substr($d, 3, 3),
                substr($d, 6, 3),
                substr($d, 9, 3)
            );
        }

        return $d !== '' ? '+'.$d : '';
    }
}
