<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', [ProfileController::class, 'index'])->middleware(['verified'])->name('home');

    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');

    Route::patch('/profile/personal', [ProfileController::class, 'personal'])->name('profile.update.personal');

    Route::patch('/profile/profile_image', [ProfileController::class, 'profile_image'])->name('profile.update.profile_image');

    Route::patch('/profile/background_image', [ProfileController::class, 'background_image'])->name('profile.update.background_image');

    Route::patch('/profile/password', [ProfileController::class, 'password'])->name('profile.update.password');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('logout', [ProfileController::class, 'logout'])->name('logout');
});