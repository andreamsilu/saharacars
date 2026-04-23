<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarSearchHit extends Model
{
    protected $fillable = [
        'car_id',
        'hits_count',
        'last_hit_at',
    ];

    protected function casts(): array
    {
        return [
            'car_id' => 'integer',
            'hits_count' => 'integer',
            'last_hit_at' => 'datetime',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}

