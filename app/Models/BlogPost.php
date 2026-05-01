<?php

namespace App\Models;

use App\Support\FrontendCache;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'category',
        'image_url',
        'author_name',
        'author_role',
        'author_avatar',
        'read_time',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => FrontendCache::forgetAll());
        static::deleted(fn () => FrontendCache::forgetAll());
    }

    public function setImageUrlAttribute($value): void
    {
        $this->attributes['image_url'] = is_array($value) ? (reset($value) ?: null) : ($value ?: null);
    }

    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = is_array($value) ? json_encode($value) : ($value ?? '');
    }
}
