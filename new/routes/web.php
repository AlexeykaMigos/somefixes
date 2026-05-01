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

// React also calls /cms/index.php?rest_route=... (old WP permalink style)
Route::get('/cms/index.php', [FrontendController::class, 'wpRestRoute']);

// CMS static pages (must be after /cms/index.php)
Route::get('/cms/{page}', [FrontendController::class, 'serveCmsPage']);

// Inline editing API
Route::post('/api/save-content', [FrontendController::class, 'saveContent'])->middleware(['auth']);
