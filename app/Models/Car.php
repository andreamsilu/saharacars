<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'brand',
        'brand_id',
        'model',
        'body_color',
        'body_type',
        'doors',
        'seats',
        'slug',
        'year',
        'location',
        'source_country',
        'transmission',
        'fuel',
        'condition',
        'import_status',
        'eta_date',
        'mileage_km',
        'engine',
        'engine_capacity_cc',
        'price_tzs',
        'landed_cost_tzs',
        'price_is_negotiable',
        'description',
        'hero_image_path',
        'front_image_path',
        'rear_image_path',
        'side_image_path',
        'interior_image_path',
        'front_image_paths',
        'rear_image_paths',
        'side_image_paths',
        'interior_image_paths',
        'gallery_image_paths',
        'is_featured',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'brand_id' => 'integer',
            'eta_date' => 'date',
            'mileage_km' => 'integer',
            'engine_capacity_cc' => 'integer',
            'doors' => 'integer',
            'seats' => 'integer',
            'price_tzs' => 'integer',
            'landed_cost_tzs' => 'integer',
            'price_is_negotiable' => 'boolean',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'front_image_paths' => 'array',
            'rear_image_paths' => 'array',
            'side_image_paths' => 'array',
            'interior_image_paths' => 'array',
            'gallery_image_paths' => 'array',
        ];
    }

    public function brandEntity(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Canonical public URL: /{locale}/cars/{id}
     */
    public function publicShowUrl(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $supported = config('app.supported_locales', ['en', 'sw']);
        if (! is_string($locale) || ! in_array($locale, $supported, true)) {
            $locale = (string) config('app.locale');
        }

        return url('/'.$locale.'/cars/'.$this->getKey());
    }
}
