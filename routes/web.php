<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\HomeController as ProfileHomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GalleryImageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProfileHomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/services', ServiceController::class);
    Route::resource('/projects', ProjectController::class);
    Route::resource('/galleries', GalleryController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/galleries/{gallery}/images', [GalleryImageController::class, 'index'])->name('galleries.images.index');
    Route::post('/galleries/{gallery}/images', [GalleryImageController::class, 'store'])->name('galleries.images.store');
    Route::delete('/galleries/images/{image}', [GalleryImageController::class, 'destroy'])->name('galleries.images.destroy');
});


Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
