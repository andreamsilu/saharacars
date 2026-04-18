<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'brand' => ['nullable', 'string', 'max:80'],
            'slug' => ['nullable', 'string', 'max:190', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('cars', 'slug')],
            'year' => ['nullable', 'integer', 'between:1950,'.(int) date('Y') + 1],
            'location' => ['nullable', 'string', 'max:120'],
            'transmission' => ['nullable', 'string', 'max:60'],
            'fuel' => ['nullable', 'string', 'max:60'],
            'condition' => ['nullable', Rule::in(['brand_new', 'foreign_used', 'local_used'])],
            'mileage_km' => ['nullable', 'integer', 'min:0', 'max:5000000'],
            'engine' => ['nullable', 'string', 'max:60'],
            'engine_capacity_cc' => ['nullable', 'integer', 'min:100', 'max:20000'],
            'price_tzs' => ['nullable', 'integer', 'min:0', 'max:999999999999'],
            'description' => ['nullable', 'string', 'max:5000'],

            'hero_image' => ['nullable', File::types(['jpg', 'jpeg', 'png', 'webp', 'avif', 'heic', 'heif'])->max(5120)],
            'front_images' => ['nullable', 'array', 'max:12'],
            'front_images.*' => [File::types(['jpg', 'jpeg', 'png', 'webp', 'avif', 'heic', 'heif'])->max(5120)],
            'rear_images' => ['nullable', 'array', 'max:12'],
            'rear_images.*' => [File::types(['jpg', 'jpeg', 'png', 'webp', 'avif', 'heic', 'heif'])->max(5120)],
            'side_images' => ['nullable', 'array', 'max:12'],
            'side_images.*' => [File::types(['jpg', 'jpeg', 'png', 'webp', 'avif', 'heic', 'heif'])->max(5120)],
            'interior_images' => ['nullable', 'array', 'max:12'],
            'interior_images.*' => [File::types(['jpg', 'jpeg', 'png', 'webp', 'avif', 'heic', 'heif'])->max(5120)],
            'gallery_images' => ['nullable', 'array', 'max:12'],
            'gallery_images.*' => [File::types(['jpg', 'jpeg', 'png', 'webp', 'avif', 'heic', 'heif'])->max(5120)],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.max' => 'Each image must be 5MB or smaller.',
            '*.mimes' => 'Allowed image formats: jpg, jpeg, png, webp, avif, heic, heif.',
        ];
    }
}

