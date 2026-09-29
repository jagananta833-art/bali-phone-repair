<?php

use App\Http\Controllers\Api\SeoPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for SEO & GEO Tools Integration
|--------------------------------------------------------------------------
| Endpoint ini digunakan oleh sistem otomasi konten:
| 1. https://seo.baliphonerepair.com (D:\Projekku\seo-geo-tools)
| 2. Tools SEO (D:\Tools SEO)
|
| Semua route di file ini otomatis memiliki prefix /api.
*/

// Endpoint Ping / Test Koneksi
Route::get('/seo/ping', [SeoPostController::class, 'ping'])->name('api.seo.ping');
Route::get('/seo-tools/ping', [SeoPostController::class, 'ping'])->name('api.seo_tools.ping');

// Endpoint Penerima Artikel dari seo-geo-tools (penerbitan harian jam 08:00 WITA)
Route::post('/seo/posts', [SeoPostController::class, 'store'])->name('api.seo.posts.store');
Route::put('/seo/posts/{id}', [SeoPostController::class, 'update'])->name('api.seo.posts.update');

// Endpoint Kompatibilitas Legacy untuk Tools SEO
Route::post('/seo-posts', [SeoPostController::class, 'store'])->name('api.seo_posts.store');
Route::put('/seo-posts/{id}', [SeoPostController::class, 'update'])->name('api.seo_posts.update');
