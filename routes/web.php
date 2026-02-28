<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ImageUploadController;

// Web Routes
Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Admin Routes
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/login');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
    // user routes
    Route::middleware('auth:admin')->prefix('seos')->name('seos.')->group(function () {
        Route::get('/', [SeoController::class, 'index'])->name('index');
        Route::post('/', [SeoController::class, 'update'])->name('update');
    });
    // banner routes
    Route::middleware('auth:admin')->prefix('banners')->name('banners.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::put('/', [BannerController::class, 'update'])->name('update');
    });
    
    // image upload for ckeditor
    Route::middleware('auth:admin')->post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');
    // product routes
    Route::middleware('auth:admin')->prefix('products')->name('products.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    });
    // order routes
    Route::middleware('auth:admin')->prefix('orders')->name('orders.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    });
});