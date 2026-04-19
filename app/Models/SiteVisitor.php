<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisitor extends Model
{
    protected $fillable = [
        'visitor_hash',
        'visits_count',
        'first_seen_at',
        'last_seen_at',
    ];

    protected function casts(): array
    {
        return [
            'visits_count' => 'integer',
            'first_seen_at' => 'datetime',
            'last_seen_at' => 'datetime',
        ];
    }
}

