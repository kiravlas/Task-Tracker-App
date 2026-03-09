<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])
        ->name('login.post')
        ->middleware('throttle:login');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    //    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'index'])->name('verification.notice');

});

Route::middleware(['auth', 'verified'])->group(function () {
    //    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    //    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::redirect('/', 'dashboard');
});
