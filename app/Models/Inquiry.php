<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    public const STATUS_DONE = 'done';

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'subject',
        'message',
        'inquiry_type',
        'status',
        'preferred_brand',
        'preferred_model',
        'year_min',
        'year_max',
        'budget_min_tzs',
        'budget_max_tzs',
        'source_country',
        'ip_address',
        'user_agent',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'year_min' => 'integer',
            'year_max' => 'integer',
            'budget_min_tzs' => 'integer',
            'budget_max_tzs' => 'integer',
        ];
    }
}

