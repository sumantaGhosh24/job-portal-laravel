<?php


use App\Http\Controllers\Admin\AdminAuthenticationController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthenticationController::class, 'login_create'])->name('login');

    Route::post('login', [AdminAuthenticationController::class, 'login_store']);
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/address', [ProfileController::class, 'address'])->name('profile.address');

    Route::patch('/image', [ProfileController::class, 'image'])->name('profile.image');

    Route::put('password', [AdminAuthenticationController::class, 'password_update'])->name('password.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [ManageUserController::class, 'users'])->name('users');

    Route::get('/employers', [ManageUserController::class, 'employers'])->name('employers');

    Route::get('/admins', [ManageUserController::class, 'admins'])->name('admins');

    Route::get('logout', [AdminAuthenticationController::class, 'destroy'])->name('logout');
});