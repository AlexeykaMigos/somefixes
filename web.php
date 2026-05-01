<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);

// WP REST API emulation — all variants React might call
Route::prefix('wp-json/wp/v2')->group(function () {
    Route::get('/posts', [FrontendController::class, 'getKittens']);
    Route::get('/pages', [FrontendController::class, 'getPages']);
    Route::get('/pages/{id}', [FrontendController::class, 'getPages']); // React calls /pages/37059, /pages/37158 etc.
});

// Blog posts JSON API (for admin-managed posts)
Route::get('/api/blog-posts', [FrontendController::class, 'getBlogPosts']);

// React also calls cms/index.php?rest_route=... (relative or absolute)
Route::get('/cms/index.php', [FrontendController::class, 'wpRestRoute']);
Route::get('/{any}/cms/index.php', [FrontendController::class, 'wpRestRoute'])->where('any', '.*');

// CMS static pages (must be after /cms/index.php)
Route::get('/cms/{page}', [FrontendController::class, 'serveCmsPage']);

// Fallback for React routing
Route::fallback([FrontendController::class, 'index']);
