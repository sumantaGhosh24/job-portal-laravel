<?php

use App\Http\Controllers\Employer\EmployerAuthenticationController;
use App\Http\Controllers\Employer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:employer')->prefix('employer')->name('employer.')->group(function () {
    Route::get('register', [EmployerAuthenticationController::class, 'register_create'])->name('register');

    Route::post('register', [EmployerAuthenticationController::class, 'register_store']);

    Route::get('login', [EmployerAuthenticationController::class, 'login_create'])->name('login');

    Route::post('login', [EmployerAuthenticationController::class, 'login_store']);
});

Route::middleware('auth:employer')->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/address', [ProfileController::class, 'address'])->name('profile.address');

    Route::patch('/image', [ProfileController::class, 'image'])->name('profile.image');

    Route::put('password', [EmployerAuthenticationController::class, 'password_update'])->name('password.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('logout', [EmployerAuthenticationController::class, 'destroy'])->name('logout');
});