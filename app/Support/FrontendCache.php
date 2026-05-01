<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class FrontendCache
{
    public const BLOG_POSTS_KEY = 'frontend.blog_posts.formatted';
    public const KITTENS_KEY = 'frontend.api.kittens';
    public const HOME_HTML_KEY = 'frontend.home.rendered_html';
    public const PAGE_PREFIX = 'frontend.api.page.';

    public static function homeHtmlKey(): string
    {
        $viewPath = resource_path('views/index.blade.php');
        $mtime = @filemtime($viewPath) ?: '0';

        return static::HOME_HTML_KEY . '.' . $mtime;
    }

    public static function pageKey(?int $id = null): string
    {
        return static::PAGE_PREFIX . ($id ?? 'home');
    }

    public static function forgetAll(): void
    {
        Cache::forget(static::BLOG_POSTS_KEY);
        Cache::forget(static::KITTENS_KEY);
        Cache::forget(static::HOME_HTML_KEY);
        Cache::forget(static::homeHtmlKey());
        Cache::forget(static::pageKey());

        foreach ([37059] as $id) {
            Cache::forget(static::pageKey($id));
        }
    }
}
