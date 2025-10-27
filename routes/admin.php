<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminFixtureController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminSponsorController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\AdminTeamCategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminOfficeBearerController;
use App\Http\Controllers\Admin\AdminMemberApplicationController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings/logo', [SettingsController::class, 'deleteLogo'])->name('settings.delete-logo');
    
    // Slider Management
    Route::resource('sliders', AdminSliderController::class);
    
    // News Management
    Route::resource('news', AdminNewsController::class);
    
    // Team Management
    Route::resource('team', AdminTeamController::class);
    
    // Team Categories Management
    Route::resource('team-categories', AdminTeamCategoryController::class);
    
    // Fixtures Management
    Route::resource('fixtures', AdminFixtureController::class);
    
    // Gallery Management
    Route::get('gallery/bulk-upload/form', [AdminGalleryController::class, 'bulkUpload'])->name('gallery.bulk-upload');
    Route::post('gallery/bulk-upload/store', [AdminGalleryController::class, 'storeBulk'])->name('gallery.bulk-store');
    Route::get('gallery/chunked-upload/form', [AdminGalleryController::class, 'chunkedUpload'])->name('gallery.chunked-upload');
    Route::post('gallery/chunked-upload/store', [AdminGalleryController::class, 'chunkedStore'])->name('gallery.chunked-store');
    Route::post('gallery/bulk-delete', [AdminGalleryController::class, 'bulkDelete'])->name('gallery.bulk-delete');
    Route::resource('gallery', AdminGalleryController::class);
    
    // Sponsors Management
    Route::resource('sponsors', AdminSponsorController::class);
    
    // Products Management
    Route::resource('products', AdminProductController::class);
    
    // Office Bearers Management
    Route::resource('office-bearers', AdminOfficeBearerController::class);
    
    // Member Applications Management
    Route::resource('member-applications', AdminMemberApplicationController::class)->except(['create', 'store']);
    Route::post('/member-applications/{memberApplication}/approve', [AdminMemberApplicationController::class, 'approve'])->name('member-applications.approve');
    Route::post('/member-applications/{memberApplication}/reject', [AdminMemberApplicationController::class, 'reject'])->name('member-applications.reject');
});

