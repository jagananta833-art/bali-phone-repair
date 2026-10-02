<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/services', [PublicController::class, 'services'])->name('services.index');
Route::get('/services/{service:slug}', [PublicController::class, 'service'])->name('services.show');
Route::get('/about', [PublicController::class, 'pageBySlug'])->defaults('slug', 'about')->name('about');
Route::get('/contact', [PublicController::class, 'pageBySlug'])->defaults('slug', 'contact')->name('contact');
Route::get('/blog', [PublicController::class, 'blog'])->name('blog');
Route::get('/blog/{post:slug}', [PublicController::class, 'post'])->name('posts.show');
Route::get('/service-areas', [PublicController::class, 'serviceAreas'])->name('areas.index');
Route::get('/service-areas/{serviceArea:slug}', [PublicController::class, 'location'])->name('areas.show');
Route::get('/locations/{serviceArea:slug}', [PublicController::class, 'location'])->name('locations.show');
Route::get('/sitemap.xml', [PublicController::class, 'sitemap'])->name('sitemap');
Route::get('/feed.xml', [PublicController::class, 'rss'])->name('rss');
Route::get('/robots.txt', fn () => response()
    ->view('public.robots')
    ->header('Content-Type', 'text/plain; charset=UTF-8'))->name('robots');
Route::get('/4c3b28b78912443a9d94943fcf13db1b.txt', fn () => response('4c3b28b78912443a9d94943fcf13db1b', 200, ['Content-Type' => 'text/plain; charset=UTF-8']))->name('indexnow.key');
Route::get('/indexnow.txt', fn () => response('4c3b28b78912443a9d94943fcf13db1b', 200, ['Content-Type' => 'text/plain; charset=UTF-8']))->name('indexnow.txt');
Route::get('/llms.txt', fn () => response(file_exists(public_path('llms.txt')) ? file_get_contents(public_path('llms.txt')) : '', 200, ['Content-Type' => 'text/plain; charset=UTF-8']))->name('llms.txt');
Route::permanentRedirect('/assets/bali-phone-repair/index-improved.html', '/')
    ->name('legacy.home');

Route::name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage.index');
        Route::get('/homepage/sections/{section}', [HomepageController::class, 'editSection'])->name('homepage.sections.edit');
        Route::put('/homepage/sections/{section}', [HomepageController::class, 'updateSection'])->name('homepage.sections.update');
        Route::get('/homepage/full', [HomepageController::class, 'edit'])->name('homepage.edit');
        Route::put('/homepage/full', [HomepageController::class, 'update'])->name('homepage.update');
        Route::resource('pages', PageController::class)->except('show');
        Route::resource('services', ServiceController::class)->except('show');
        Route::resource('locations', LocationController::class)
            ->parameters(['locations' => 'serviceArea'])
            ->except('show');
        Route::resource('posts', PostController::class)->except('show');
        Route::get('/media', [ContentController::class, 'media'])->name('media.index');
        Route::post('/media', [ContentController::class, 'uploadMedia'])->name('media.store');
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/users', [SettingController::class, 'profile'])->name('users.index');
        Route::put('/users/password', [SettingController::class, 'password'])->name('users.password');
        Route::get('/{resource}', [ContentController::class, 'index'])->name('content.index');
        Route::get('/{resource}/create', [ContentController::class, 'create'])->name('content.create');
        Route::post('/{resource}', [ContentController::class, 'store'])->name('content.store');
        Route::get('/{resource}/{id}/edit', [ContentController::class, 'edit'])->name('content.edit');
        Route::put('/{resource}/{id}', [ContentController::class, 'update'])->name('content.update');
        Route::delete('/{resource}/{id}', [ContentController::class, 'destroy'])->name('content.destroy');
    });
});

Route::post('/wp-json/wp/v2/posts', [\App\Http\Controllers\Api\SeoPostController::class, 'store'])->name('wp.posts.store');

Route::get('/{page:slug}', [PublicController::class, 'page'])->name('pages.show');


