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
        'transmission',
        'fuel',
        'condition',
        'mileage_km',
        'engine',
        'engine_capacity_cc',
        'price_tzs',
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
            'mileage_km' => 'integer',
            'engine_capacity_cc' => 'integer',
            'doors' => 'integer',
            'seats' => 'integer',
            'price_tzs' => 'integer',
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
}
