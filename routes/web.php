<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/login', [HomePageController::class, 'login'])->name('login');
Route::get('/register', [HomePageController::class, 'register'])->name('register');
Route::get('/about', [HomePageController::class, 'about'])->name('about');
Route::get('/services', [HomePageController::class, 'services'])->name('services');
Route::get('/contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [HomePageController::class, 'privacyPolicy'])->name('privacy');