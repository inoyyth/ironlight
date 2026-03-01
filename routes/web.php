<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OtherController;

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
    
    // contact routes
    Route::middleware('auth:admin')->prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::post('/', [ContactController::class, 'update'])->name('update');
    });

    // other routes
    Route::middleware('auth:admin')->prefix('others')->name('others.')->group(function () {
        Route::get('/', [OtherController::class, 'index'])->name('index');
        Route::post('/', [OtherController::class, 'update'])->name('update');

        Route::post('/tech', [OtherController::class, 'storeTech'])->name('tech.store');
        Route::put('/tech/{tech}', [OtherController::class, 'updateTech'])->name('tech.update');
        Route::delete('/tech/{tech}', [OtherController::class, 'destroyTech'])->name('tech.destroy');

        Route::post('/solution', [OtherController::class, 'storeSolution'])->name('solution.store');
        Route::put('/solution/{solution}', [OtherController::class, 'updateSolution'])->name('solution.update');
        Route::delete('/solution/{solution}', [OtherController::class, 'destroySolution'])->name('solution.destroy');
    });
    
    // banner routes
    Route::middleware('auth:admin')->prefix('banners')->name('banners.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::put('/', [BannerController::class, 'update'])->name('update');
    });
    
    // image upload for ckeditor
    Route::middleware('auth:admin')->post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');
    // product routes
    Route::middleware('auth:admin')->prefix('stats')->name('stats.')->group(function () {
        Route::get('/', [StatController::class, 'index'])->name('index');
        Route::get('/add', [StatController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [StatController::class, 'edit'])->name('edit');
        Route::post('/store', [StatController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [StatController::class, 'destroy'])->name('destroy');
    });
});