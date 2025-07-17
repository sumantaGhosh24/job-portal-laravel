<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserAuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:user')->prefix('user')->name('user.')->group(function () {
    Route::get('register', [UserAuthenticationController::class, 'register_create'])->name('register');

    Route::post('register', [UserAuthenticationController::class, 'register_store']);

    Route::get('login', [UserAuthenticationController::class, 'login_create'])->name('login');

    Route::post('login', [UserAuthenticationController::class, 'login_store']);
});

Route::middleware('auth:user')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/address', [ProfileController::class, 'address'])->name('profile.address');

    Route::patch('/image', [ProfileController::class, 'image'])->name('profile.image');

    Route::put('password', [UserAuthenticationController::class, 'password_update'])->name('password.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('logout', [UserAuthenticationController::class, 'destroy'])->name('logout');
});