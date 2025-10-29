<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('posts')->name('posts.')->group(function () {
    Route::get('/{id}', [PostController::class, 'show'])->name('show');

    Route::get('/', [PostController::class, 'create'])->name('create');

    Route::post('/', [PostController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');

    Route::patch('/{id}', [PostController::class, 'update'])->name('update');

    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
});