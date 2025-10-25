<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\OfficeBearerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutContentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// About Routes
Route::prefix('about')->name('about.')->group(function () {
    Route::get('/history', [AboutContentController::class, 'history'])->name('history');
    Route::get('/club', [AboutContentController::class, 'club'])->name('club');
    Route::get('/arena', [AboutContentController::class, 'arena'])->name('arena');
    Route::get('/office-bearers', [OfficeBearerController::class, 'index'])->name('office-bearers');
    Route::get('/bank-details', [AboutContentController::class, 'bankDetails'])->name('bank-details');
});

// SportsPress Routes
Route::prefix('sportspress')->name('sportspress.')->group(function () {
    Route::get('/fixtures', [FixtureController::class, 'index'])->name('fixtures');
    Route::get('/league', [FixtureController::class, 'league'])->name('league');
});

// Other Public Routes
Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors');
Route::get('/gallery', [GalleryImageController::class, 'index'])->name('gallery');
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{product:slug}', [ProductController::class, 'show'])->name('shop.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Authentication Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
