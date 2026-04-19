<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCarController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/bento', [CarController::class, 'bento'])->name('cars.bento');
Route::get('/cars/{slug}', [CarController::class, 'show'])->name('cars.show');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/why-choose-us', [PageController::class, 'whyChooseUs'])->name('why.choose.us');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [InquiryController::class, 'store'])->name('contact.store');
Route::get('/saved', [PageController::class, 'saved'])->name('saved');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

    Route::get('/', [AdminDashboardController::class, 'index'])
        ->middleware('admin')
        ->name('dashboard');

    Route::middleware('admin')->group(function () {
        Route::get('/cars', [AdminCarController::class, 'index'])->name('cars.index');
        Route::get('/cars/data/table', [AdminCarController::class, 'data'])->name('cars.data');
        Route::get('/cars/create', [AdminCarController::class, 'create'])->name('cars.create');
        Route::post('/cars', [AdminCarController::class, 'store'])->name('cars.store');
        Route::get('/cars/{car}', [AdminCarController::class, 'show'])->name('cars.show');
        Route::get('/cars/{car}/edit', [AdminCarController::class, 'edit'])->name('cars.edit');
        Route::put('/cars/{car}', [AdminCarController::class, 'update'])->name('cars.update');
        Route::delete('/cars/{car}', [AdminCarController::class, 'destroy'])->name('cars.destroy');

        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
    });
});
