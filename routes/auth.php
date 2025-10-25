<?php
use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthenticationController::class, 'create'])->name('register');

    Route::post('register', [AuthenticationController::class, 'store']);

    Route::get('login', [AuthenticationController::class, 'login_create'])->name('login');

    Route::post('login', [AuthenticationController::class, 'login_store']);
});

