<?php

namespace App\Http\Requests\Admin\Concerns;

trait MergesCarSpecChoices
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'transmission' => $this->resolvedSpecChoice('transmission_preset', 'transmission_other'),
            'fuel' => $this->resolvedSpecChoice('fuel_preset', 'fuel_other'),
        ]);
    }

    protected function resolvedSpecChoice(string $presetKey, string $otherKey): ?string
    {
        $preset = (string) $this->input($presetKey, '');

        if ($preset === '__other__') {
            $value = trim((string) $this->input($otherKey, ''));

            return $value === '' ? null : $value;
        }

        if ($preset === '') {
            return null;
        }

        return $preset;
    }
}
