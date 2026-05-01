<?php

namespace App\Models;

use App\Support\FrontendCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    public const CACHE_KEY = 'settings.key_value_pairs';

    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }

    public static function keyValueArray(): array
    {
        return Cache::rememberForever(static::CACHE_KEY, function () {
            return static::query()
                ->select(['key', 'value'])
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget(static::CACHE_KEY);
        FrontendCache::forgetAll();
    }

    public static function setMany(array $data): void
    {
        $now = now();

        $rows = collect($data)
            ->map(fn ($value, $key) => [
                'key' => (string) $key,
                'value' => $value,
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->values()
            ->all();

        if ($rows === []) {
            return;
        }

        static::query()->upsert($rows, ['key'], ['value', 'updated_at']);
        static::clearCache();
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::setMany([$key => $value]);
    }
}
