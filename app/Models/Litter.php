<?php

namespace App\Models;

use App\Support\FrontendCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Litter extends Model
{
    protected $fillable = [
        'name',
        'date',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'date' => 'date',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => FrontendCache::forgetAll());
        static::deleted(fn () => FrontendCache::forgetAll());
    }

    public function kittens(): HasMany
    {
        return $this->hasMany(Kitten::class);
    }
}
