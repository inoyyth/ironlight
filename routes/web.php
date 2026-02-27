<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Web Routes
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/login', [HomePageController::class, 'login'])->name('login');
Route::get('/register', [HomePageController::class, 'register'])->name('register');
Route::get('/about', [HomePageController::class, 'about'])->name('about');
Route::get('/services', [HomePageController::class, 'services'])->name('services');
Route::get('/contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [HomePageController::class, 'privacyPolicy'])->name('privacy');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
    // user routes
    Route::middleware('auth:user')->prefix('users')->name('users.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    });
    // product routes
    Route::middleware('auth:user')->prefix('products')->name('products.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    });
    // order routes
    Route::middleware('auth:user')->prefix('orders')->name('orders.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
    });
});