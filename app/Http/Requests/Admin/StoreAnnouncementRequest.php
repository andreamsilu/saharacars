<?php

namespace App\Http\Requests\Admin;

use App\Models\Announcement;
use App\Rules\OptionalUrlOrInternalPath;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:180'],
            'summary' => ['nullable', 'string', 'max:500'],
            'link_url' => ['nullable', 'string', 'max:500', new OptionalUrlOrInternalPath],
            'link_new_tab' => ['sometimes', 'boolean'],
            'kind' => ['required', 'string', Rule::in([
                Announcement::KIND_OFFER,
                Announcement::KIND_NEWS,
                Announcement::KIND_DISCOUNT,
            ])],
            'is_published' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => [
                'nullable',
                'date',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (! $value || ! $this->input('starts_at')) {
                        return;
                    }
                    if (strtotime((string) $value) < strtotime((string) $this->input('starts_at'))) {
                        $fail('The end date must be on or after the start date.');
                    }
                },
            ],
        ];
    }
}
