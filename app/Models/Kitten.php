<?php

namespace App\Models;

use App\Support\FrontendCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kitten extends Model
{
    use HasFactory;

    protected $fillable = [
        'litter_id',
        'name',
        'price',
        'old_price',
        'birth_date',
        'gender',
        'age',
        'breed_type',
        'character',
        'description',
        'tags',
        'features',
        'status',
        'gallery',
        'show_parents',
        'mother_title',
        'mother_name',
        'mother_breed',
        'mother_photo',
        'father_title',
        'father_name',
        'father_breed',
        'father_photo',
    ];

    protected $casts = [
        'tags' => 'array',
        'features' => 'array',
        'gallery' => 'array',
        'show_parents' => 'boolean',
        'birth_date' => 'date',
        'litter_id' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => FrontendCache::forgetAll());
        static::deleted(fn () => FrontendCache::forgetAll());
    }

    public function litter(): BelongsTo
    {
        return $this->belongsTo(Litter::class);
    }
}
