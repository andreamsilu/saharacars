<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Accepts a full http(s) URL or an app-relative path starting with /.
 */
class OptionalUrlOrInternalPath implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '') {
            return;
        }

        $v = trim((string) $value);
        if (mb_strlen($v) > 500) {
            $fail('The :attribute may not be greater than 500 characters.');

            return;
        }

        if (str_starts_with($v, '/')) {
            if (mb_strlen($v) > 1 && ! preg_match('#^/[\p{L}0-9/_.\-\?=&%#~]*$#u', $v)) {
                $fail('The :attribute must be a path like /cars or /order-request, or a full https URL.');
            }

            return;
        }

        if (filter_var($v, FILTER_VALIDATE_URL) === false) {
            $fail('The :attribute must be a full URL (https://…) or a path starting with /.');
        }
    }
}
