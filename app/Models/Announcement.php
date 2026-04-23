<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public const KIND_OFFER = 'offer';

    public const KIND_NEWS = 'news';

    public const KIND_DISCOUNT = 'discount';

    protected $fillable = [
        'title',
        'summary',
        'link_url',
        'kind',
        'is_published',
        'sort_order',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    /**
     * Live on the storefront: published and within optional date window.
     */
    public function scopeActiveForHome(Builder $query): Builder
    {
        $now = now();

        return $query
            ->where('is_published', true)
            ->where(function (Builder $q) use ($now): void {
                $q->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', $now);
            })
            ->where(function (Builder $q) use ($now): void {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', $now);
            })
            ->orderBy('sort_order')
            ->orderByDesc('created_at');
    }
}
