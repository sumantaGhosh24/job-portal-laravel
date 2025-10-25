<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', [ProfileController::class, 'index'])->middleware(['verified'])->name('home');

    Route::get('logout', [ProfileController::class, 'destroy'])->name('logout');
});